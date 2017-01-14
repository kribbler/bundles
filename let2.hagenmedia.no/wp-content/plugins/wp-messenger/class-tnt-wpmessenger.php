<?php
/**
 * Description of WPMessenger
 * @author nur
 */
require_once('class-tnt-wpmessenger-config.php');
function wpmessenger_editor( $content, $editor_id, $settings = array() ) {
	if ( ! class_exists( '_WP_Editors' ) )
		require( 'class-wpmessenger-editor.php' );
	_WPMessenger_Editors::editor($content, $editor_id, $settings);
}

if (!class_exists('WPMessenger')) {
    class WPMessenger {
        function WPMessenger(){
            $this->__construct();
        }
        function __construct() {
            register_activation_hook(WP_PLUGIN_DIR.'/'.WPMESSENGER_FOLDER.'/'.'wpmessenger.php',array(&$this,'activate'));        	
            register_deactivation_hook(WP_PLUGIN_DIR.'/'.WPMESSENGER_FOLDER.'/'.'wpmessenger.php',array(&$this,'deactivate') );            
            $this->conf = WPMessengerConfig::getInstance();
            $this->activate();
            add_action('init', array(&$this, 'check_login'));
            add_action('init', array(&$this,'wp_messenger_widget_init'));
            add_action('init',array(&$this,'loadLibrary'));
            add_action('wp_ajax_wpmessenger_autosearch',array(&$this,'autoseachUser'));            
            add_action('wp_ajax_wpmessenger_save_draft',array(&$this,'save_draft_ajax'));
            add_action('wp_footer',array(&$this, 'addToFooter'));
            add_shortcode('wp_messenger_launch_link', array(&$this,'wp_messenger_launch_link_handler'));
            if(isset($_GET['wpmessenger_op'])){
                add_action('init', array(&$this, 'processPageRequest'));                
                add_filter('wpmessenger_head',array(&$this,'includeScripts'));
                add_filter( 'wp_default_editor', create_function('', 'return "tinymce";') );    
                add_filter( 'user_can_richedit', create_function('', 'return true;') );    
                add_filter( 'show_admin_bar', create_function('', 'return false;') );
            }
            else
                add_action('wp_head',array(&$this,'includeScripts'));                                        
        }
        function addToFooter(){
            include_once('overlay.php');// needed for getMessengerLink            
        }
        function wp_messenger_launch_link_handler($atts){
			extract(shortcode_atts(array(
				'anchor' => 'Launch Messenger',
			), $atts));
			return $this->getMessengerLink($anchor);	        	
        }
        function check_login(){
            if(!is_user_logged_in() && isset($_GET['wpmessenger_op'])){
                wp_redirect(wp_login_url( home_url() . '?wpmessenger_op=inbox' ));
                exit;
            } 
        }
        function processPageRequest(){           
            if(is_user_logged_in() && isset($_GET['wpmessenger_op'])){ 
                $userInfo = wp_get_current_user();
                $m = $this->conf->msgtbl;
                $r = $this->conf->recipients;                
                $msgbody = "Your text here";                                                
                $context['ref'] = '';// for new msg this field is empty.
                $context['stat'] = 'new';
                $context['reply_to'] = 0;
                $context['realm'] = 'new';
                $action = 'send'; // can be send, reply, draft
                $subject = '';
                $recipients = array();
                global $wpdb;
                include('header.php');
                switch($_GET['wpmessenger_op']){
                    case 'compose':                       
                        if(isset($_POST['wpmessenger_action'])){
                            $this->saveMessage();
                        }
                        else if(isset($_GET['realm'])){
                            if($_GET['realm'] == 'draft'){
                                $this->read_draft();                                                      
                            }else if (isset($_GET['id'])){
                                $id = strip_tags($_GET['id']);       
                                $msg = $wpdb->get_row("SELECT * FROM $m WHERE id = " . $id);                            
                                     
                                if($_GET['realm'] == 'inbox'){
                                    $recipientinfo = $wpdb->get_row("SELECT * FROM $r WHERE msg_id=". $id . " AND recipient_id=". $userInfo->ID);
                                    $context['ref'] = '';// for new msg this field is empty.
                                    $context['stat'] = 'reply';
                                    $context['reply_to'] = $msg->msg_id;
                                    $context['realm'] = 'inbox';                                    
                                    if(!empty($recipientinfo)){
                                        $subject = stripslashes($msg->subject);                                           
                                        $recipientinfo =  get_userdata($msg->user_id);
                                        $msgbody  = "<br/><U>On " . $msg->created . " " . $recipientinfo->display_name . " wrote:</U> <br/>";
                                        $msgbody .= stripslashes($msg->body);  
                                        $recipients = array(
                                            $msg->user_id=>$recipientinfo->display_name);                                                   
                                    }             
                                }else if($_GET['realm'] == 'sent'){
                                    if($msg->user_id == $userInfo->ID){
                                            $subject = stripslashes($msg->subject);                                                   
                                            $context['ref'] = '';// for new msg this field is empty.
                                            $context['stat'] = 'reply';
                                            $context['reply_to'] = $msg->msg_id;
                                            $context['realm'] = 'sent';                                                                        
                                            $recipientinfo = $wpdb->get_results("SELECT * FROM $r WHERE msg_id=". strip_tags($_GET['id']));
                                            $recipients = array();
                                            $msgbody  = "<br/><U>Message Sent On " . $msg->created . ": </U><br/>";
                                            $msgbody .= stripslashes($msg->body);                                              
                                            if(!empty($recipientinfo))
                                            foreach($recipientinfo as $info){
                                                $usr = get_userdata($info->recipient_id);
                                                $recipients[$info->recipient_id] = $usr->display_name;
                                            }                                        
                                    }
                                }else if($_GET['realm'] == 'trash'){
                                    $context['ref'] = '';// for new msg this field is empty.
                                    $context['stat'] = 'reply';
                                    $context['reply_to'] = $msg->msg_id;
                                    $context['realm'] = 'trash';
                                    $subject = stripslashes($msg->subject);                                           
                                    if($userInfo->ID == $msg->user_id){                                        
                                        $recipientinfo = $wpdb->get_results("SELECT * FROM $r WHERE msg_id=". strip_tags($_GET['id']));
                                        $recipients = array();
                                        $msgbody  = "<br/><U>Message Sent On " . $msg->created . ":</U> <br/>";
                                        $msgbody .= stripslashes($msg->body);                                          
                                        if(!empty($recipientinfo))
                                        foreach($recipientinfo as $info){
                                            $usr = get_userdata($info->recipient_id);
                                            $recipients[$info->recipient_id] = $usr->display_name;
                                        }
                                    }else{                                                           
                                        $recipientinfo =  get_userdata($msg->user_id);
                                        $msgbody  = "<br/>On " . $msg->created . " " . $recipientinfo->display_name . " wrote: <br/>";
                                        $msgbody .= stripslashes($msg->body);  
                                        $recipients = array($msg->user_id=>$recipientinfo->display_name);
                                    }                                                                   
                                }   
                            }
                            include_once ('compose_messages.php');                                    
                        }else{           
                            include_once ('compose_messages.php'); 
                        }                                                                           
                        break;
                    case 'sent':
                        $this->sent();break;
                    case 'draft':                        
                        $this->draft();break;
                    case 'trashed':
                        $this->trashed();break;
                    case 'delete':
                        $this->delete();break;
                    case 'read': 
                        $this->read();break;
                    case 'inbox':
                    default:
                        $this->inbox();break;
                }
                include('footer.php');
                exit();
            }            
        }
        function read_draft(){
            if(is_user_logged_in() && isset($_GET['id'])){                
                global $wpdb;                
                $user = wp_get_current_user();                
                $query = "SELECT * FROM " . $this->conf->draft . ' WHERE id = ' .  strip_tags($_GET['id']). ' AND user_id=' .$user->ID;
                $result = $wpdb->get_row($query);
                $sender = get_userdata($result->user_id);                
                $msgbody = stripslashes($result->body);                                                
                $context['ref'] = $result->id;// for new msg this field is empty.
                $context['stat'] = 'draft';
                $context['reply_to'] = $result->ref_id;
                $context['realm'] = 'draft';
                $action = 'send'; // can be send, reply, draft
                $subject = stripslashes($result->subject);                 
                $recipientinfo = unserialize($result->recipients);
                $recipientinfo = ($recipientinfo === false)?  array(): explode(',',$recipientinfo);
                $recipients = array();
                if($recipientinfo){
                    foreach($recipientinfo as $r){
                        $rec = get_userdata($r);                
                        $recipients[$r] = $rec->display_name;
                    }
                }               
                include_once('compose_messages.php');
            }
            else{
                $this->showAuthErrorMsg();            
            }            
        }         
        function delete(){
            if(!isset($_GET['level'])|| empty($_GET['level'])) return;
            global $wpdb;
            $userInfo = wp_get_current_user();
            switch($_GET['level']){
                case 'inbox':
                    $query = "DELETE FROM " . $this->conf->recipients . 
                              " WHERE msg_id = " .strip_tags($_GET['record_id']) . 
                              " AND recipient_id=" . $userInfo->ID;
                    $wpdb->query($query);
                break;                               
            }
        }
        function read(){
            if(is_user_logged_in() && isset($_GET['id'])){                
                global $wpdb;                
                $user = wp_get_current_user();
                $realm = isset($_GET['realm'])?$_GET['realm']:"";
                $query = "SELECT * FROM " . $this->conf->msgtbl . ' WHERE id = ' .  strip_tags($_GET['id']). ' AND user_id=' .$user->ID;
                $result = $wpdb->get_row($query);
                $sender = get_userdata($result->user_id);   
                $result->subject = stripslashes($result->subject);             
                $result->body = stripslashes($result->body);
                include_once('read_messages.php');
            }
            else{
                $this->showAuthErrorMsg();            
            }
        }
        function trashed(){
            if(is_user_logged_in()){        
                require_once('class.wpmessenger.list_trashed.php');
                $inbox_list = new WPMessenger_List_Trashed();
                $inbox_list->prepare_items();                                                 
                include_once ('trashed_messages.php');
            }
            else
                $this->showAuthErrorMsg();            
        }
        function draft(){
            if(is_user_logged_in()){        
                require_once('class.wpmessenger.list_draft.php');
                $inbox_list = new WPMessenger_List_Draft();
                $inbox_list->prepare_items();                
                include_once ('draft_messages.php');        
            }
            else
                $this->showAuthErrorMsg();                        
        }
        function sent(){
            if(is_user_logged_in()){ 
                require_once('class.wpmessenger.list_sent.php');
                $sent_list = new WPMessenger_List_Sent();
                $sent_list->prepare_items();                
                include_once ('sent_messages.php');
            }
            else
                $this->showAuthErrorMsg();                                
        } 
        function inbox(){
            global $wpdb;

            if(is_user_logged_in()){
                require_once('class.wpmessenger.list_inbox.php');
                $inbox_list = new WPMessenger_List_Inbox();
                $inbox_list->prepare_items();                
                include_once('inbox_messages.php');
            }
            else
                $this->showAuthErrorMsg();                                
        }      
        function autoseachUser(){
            if(isset($_GET['q'])){
                global $wpdb;
                $result = $wpdb->get_results("SELECT ID,display_name FROM $wpdb->users WHERE display_name  LIKE '" .$_GET['q'] ."%'");
                $r = array();
                foreach($result as $item)$r[] = array("id"=>$item->ID,"name"=>$item->display_name);
                echo json_encode($r);
            }
            exit();
        }
        function activate (){
            global $wpdb;
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

$sql = "CREATE TABLE `" . $this->conf->msgtbl . "` (
id INT(12) NOT NULL AUTO_INCREMENT ,
user_id INT(12) NOT NULL ,
subject VARCHAR(255) NOT NULL ,
body TEXT NOT NULL,
created datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
state   enum('sent','deleted','draft') DEFAULT 'draft',
PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";
dbDelta($sql);

$sql_one = "CREATE TABLE `" . $this->conf->draft . "` (
id INT(12) NOT NULL AUTO_INCREMENT,
user_id INT(12) NOT NULL ,
subject VARCHAR(255) NOT NULL ,
body TEXT NOT NULL,
recipients VARCHAR(255) NOT NULL DEFAULT '',
ref_id INT(12)  NOT NULL DEFAULT 0,
created datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";
dbDelta($sql_one);

$sql_two = "CREATE TABLE `" . $this->conf->recipients . "` (
id INT(12) NOT NULL AUTO_INCREMENT ,
msg_id INT(12) NOT NULL ,
label enum('inbox','trash','starred') DEFAULT 'inbox',
status enum('read','unread') DEFAULT 'unread',
received datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
recipient_id INT(12) NOT NULL,
origin_id INT(12) NOT NULL ,
parent_id INT(12) NOT NULL,
PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";
dbDelta($sql_two);
}

        function deactivate(){

        }
        function includeScripts(){
            if(!is_admin()){
                include_once('menu_control.php');
            }
        }
        function loadLibrary(){            
            wp_enqueue_script('jquery');
            if(!is_admin()){
                wp_enqueue_style('wpmessenger', WPMESSENGER_URL.'/css/wpmessenger.css');
                wp_enqueue_script('jquery.tools', WPMESSENGER_URL.'/js/jquery.tools.min.js');
                if(isset($_GET['wpmessenger_op']) && ($_GET['wpmessenger_op'] == 'compose')){            
                    wp_enqueue_script(array( 'editor', 'thickbox', 'media-upload','quicktags','word-count'));            
                    wp_enqueue_style('thickbox');
                    wp_enqueue_style('token-input', WPMESSENGER_URL.'/css/token-input.css');            
                    wp_enqueue_style('token-input-facebook', WPMESSENGER_URL.'/css/token-input-facebook.css');            
                    wp_enqueue_script('jquery.tokeninput', WPMESSENGER_URL.'/js/jquery.tokeninput.js');                     
                }
            }
        }
        function adminMenu(){
            add_options_page('WPMessenger', 'WPMessenger', 'manage_options', 
                    "wp_messenger_manage",array(&$this,'MessengerHook'));
            add_submenu_page(__FILE__, "WPMessenger", "WPMessenger", 
                    'add_users', 'wp_messenger_manage', array(&$this,'MessengerHook'));        
        }
        function MessengerHook(){
            echo 'here';
        }
        function wp_messenger_widget_init(){            
            $widget_options = array('classname' => 'wpmessenger_widget', 'description' => __( "My Messages") );
            wp_register_sidebar_widget('wpmessenger_widget','WPMessenger', array(&$this,'showLoginWidget'), $widget_options);           
        }
        function showLoginWidget($args){
            extract($args);            
            echo $before_widget;
            echo $before_title .$widget_name. $after_title;           
            echo $this->getMessengerLink();            
            echo $after_widget;
        }
        function getMessengerLink($anchor='Launch Messenger'){       
            if(is_user_logged_in()){            
                return '<a href="#" class="wpmessengermenu" menuid="inbox" >'.$anchor.'</a><br/>';
            }else{
                return '<a href="#" class="wpmessengermenu" menuid="login" >'.$anchor.'</a><br/>';
            }           
        }
        function saveMessage(){ 
            $result = array('status'=>'error', 'msg'=>'');                       
            $userInfo = wp_get_current_user();
            $realm = array('inbox','sent','draft','trash');
            global $wpdb;
            $_POST['subject'] = empty($_POST['subject'])? "(no subject)": $_POST['subject'];                        
            switch($_POST['wpmessenger_action']){
                case 'send':
                    $context = $_POST['context'];
                    if(!empty($context['ref']))
                        $wpdb->query("DELETE FROM " . $this->conf->draft . " WHERE id=" . $context['ref']);
                    $fields = array('user_id'=>$userInfo->ID,
                        'subject'=>$_POST['subject'],'body'=>$_POST['body'],
                        'state'=>'sent','created'=>date('Y-m-d H:i:s'));
                    $wpdb->insert($this->conf->msgtbl, $fields);
                    $msgId = $wpdb->insert_id;
                    $parents = array();
                    if(in_array($context['realm'], $realm)){
                        $reply_to = $context['reply_to'];
                        $rs = $wpdb->get_results("SELECT * FROM ".$this->conf->recipients . " WHERE msg_id=" . $reply_to);
                        foreach($rs as $r){
                            $parents[$r->recipient_id] = $r;
                        }
                    }
                    $recipients = explode(',', $_POST['recipients']);

                    foreach($recipients as $id){
                        $parent_id = 0;
                        $origin_id = 0;
                        if(isset($parents[$id])){
                            $p = $parents[$id];
                            $parent_id = $p->parent_id;
                            $origin_id = $p->origin_id;
                        }                        
                        $fields = array('msg_id'=>$msgId,
                            'label'=>'inbox','status'=>'unread','origin_id'=>$origin_id,
                            'received'=>date('Y-m-d H:i:s'),'parent_id'=>$parent_id);                    
                        $fields['recipient_id'] = $id;
                        $wpdb->insert($this->conf->recipients, $fields);
                    }      
                    $result = array('status'=>'success', 'msg'=>'Message Sent!');           
                break;       
                case 'draft':
                    $fields = array('user_id'=>$userInfo->ID,
                        'subject'=>$_POST['subject'],'body'=>$_POST['body'],
                        'created'=>date('Y-m-d H:i:s'),
                        'recipients'=>serialize($_POST['recipients']));
                    $wpdb->insert($this->conf->draft, $fields);
                    $result = array('status'=>'success', 'msg'=>'Draft Saved!');                             
                break;                     
            }
            echo '<script type="text/javascript">wpmessengerresult=' . json_encode($result) . ';</script>' ;                           
        }
        function showAuthErrorMsg($erroType='not_logged_in'){
            switch($erroType){
                case 'not_logged_in':
                default:
                    include_once ('not_logged_in.php');
                    break;                
            }                
        }
        function echoJSON($arr){
            if (empty($arr)) return '[]';
            $json  = '[';
            foreach($arr as $key=>$value){
                $json .= '{id:"'. $key. '",name:"' . $value . '"},'; 
            }
            $json = rtrim($json, ',');
            $json .= ']';
            return $json;
        }
        function save_draft_ajax(){
            if(!isset($_POST['context'])) return;
            $userInfo = wp_get_current_user();
            global $wpdb;            
            $_POST['subject'] = empty($_POST['subject'])? "(no subject)": $_POST['subject'];                                    
            $context = $_POST['context'];
            $fields = array('user_id'=>$userInfo->ID,
                'subject'=>$_POST['subject'],'body'=>$_POST['body'],
                'created'=>date('Y-m-d H:i:s'),
                'ref_id'=>$context['reply_to'],
                'recipients'=>serialize($_POST['recipients']));            
            if($context['stat'] == 'new'){
                $wpdb->insert($this->conf->draft, $fields);            
                $context['ref'] = $wpdb->insert_id;
                $context['stat'] = 'draft';
            }else if(($context['stat'] == 'draft') && isset($context['ref'])){
                $wpdb->update($this->conf->draft, $fields,array('id'=>$context['ref']));            
            }
            echo json_encode($context);
            exit(0);
        }
    }
}
