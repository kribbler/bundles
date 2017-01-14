<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WPMessengerConfig
 *
 * @author nur
 */
class WPMessengerConfig {
    static $_this;
    function WPMessengerConfig(){
        $this->__construct();
    }
    function __construct(){
        global $wpdb;
        $this->msgtbl = $wpdb->prefix.'wpmessages';
        $this->recipients = $wpdb->prefix.'wpmsg_recipients';
        $this->draft = $wpdb->prefix.'wpmsg_drafts';
    }
    static function getInstance(){
        if(null === self::$_this){
            self::$_this = new WPMessengerConfig();        
        }        
        return self::$_this;
    }
}
?>
