<?php

/**
 * Class FUE_Admin_Controller
 *
 * Controller for the Admin Panel
 */
class FUE_Admin_Controller {

    /**
     * Register the menu items
     */
    public static function add_menu() {
        add_menu_page( __('Follow-Up Emails', 'follow_up_emails'), __('Follow-Up Emails', 'follow_up_emails'), 'manage_follow_up_emails', 'followup-emails', 'FUE_Admin_Controller::admin_controller', 'dashicons-email-alt', '54.51' );
        add_submenu_page( 'followup-emails', __('Follow-Up Emails', 'follow_up_emails'), __('Emails', 'follow_up_emails'), 'manage_follow_up_emails', 'followup-emails', 'FUE_Admin_Controller::admin_controller' );
        add_submenu_page( 'followup-emails', __('Campaigns', 'follow_up_emails'), __('Campaigns', 'follow_up_emails'), 'manage_follow_up_emails', 'fue_campaigns', 'FUE_Admin_Controller::admin_controller' );

        add_submenu_page( 'followup-emails', __('New Email', 'follow_up_emails'), __('New Email', 'follow_up_emails'), 'manage_follow_up_emails', 'fue_post_email', 'FUE_Admin_Controller::admin_controller' );

        do_action( 'fue_menu' );

        add_submenu_page( 'followup-emails', __('Scheduled Emails', 'follow_up_emails'), __('Scheduled Emails', 'follow_up_emails'), 'manage_follow_up_emails', 'followup-emails-queue', 'FUE_Admin_Controller::queue_table' );
        add_submenu_page( 'followup-emails', __('Subscribers', 'follow_up_emails'), __('Subscribers', 'follow_up_emails'), 'manage_follow_up_emails', 'followup-emails-subscribers', 'FUE_Admin_Controller::subscribers_table' );
        add_submenu_page( 'followup-emails', __('Manage Opt-outs', 'follow_up_emails'), __('Opt-outs', 'follow_up_emails'), 'manage_follow_up_emails', 'followup-emails-optouts', 'FUE_Admin_Controller::optout_table' );
        add_submenu_page( 'followup-emails', __('Follow-Up Emails Templates', 'follow_up_emails'), __('Templates', 'follow_up_emails'), 'manage_follow_up_emails', 'followup-emails-templates', 'FUE_Admin_Controller::templates' );
        add_submenu_page( 'followup-emails', __('Follow-Up Emails Settings', 'follow_up_emails'), __('Settings', 'follow_up_emails'), 'manage_follow_up_emails', 'followup-emails-settings', 'FUE_Admin_Controller::settings' );
    }

    public static function get_screen_ids() {
        return apply_filters('fue_screen_ids', array(
            'toplevel_page_followup-emails',
            'follow_up_email',
            'edit-follow_up_email_campaign',
            'follow-up-emails_page_followup-emails-reports',
            'follow-up-emails_page_followup-emails-coupons',
            'follow-up-emails_page_followup-emails-queue',
            'follow-up-emails_page_followup-emails-subscribers',
            'follow-up-emails_page_followup-emails-optouts',
            'follow-up-emails_page_followup-emails-settings',
            'follow-up-emails_page_followup-emails-addons'
        ));
    }

    /**
     * Enable all elements when working with HTML templates
     *
     * @unused
     * @param array $options
     * @return array
     */
    public static function enable_mce_elements( $options ) {

        if ( empty( $_GET['page'] ) || $_GET['page'] != 'followup-emails-templates' ) {
            return $options;
        }

        if ( ! isset( $options['extended_valid_elements'] ) ) {
            $options['extended_valid_elements'] = '';
        } else {
            $options['extended_valid_elements'] .= ',';
        }

        if ( ! isset( $options['custom_elements'] ) ) {
            $options['custom_elements'] = '';
        } else {
            $options['custom_elements'] .= ',';
        }

        $options['extended_valid_elements'] .= '*[*]';
        $options['custom_elements']         .= '*[*]';
        $options['plugins']                 .= ',fullpage';

        return $options;
    }

    /**
     * Register the full_page plugin for TinyMCE to edit full HTML templates
     * @param array $plugins_array
     * @return array
     */
    public static function register_mce_plugins( $plugins_array ) {
        if ( empty( $_GET['page'] ) || $_GET['page'] != 'followup-emails-templates' ) {
            return $plugins_array;
        }

        $plugins = array('fullpage'); //Add any more plugins you want to load here

        //Build the response - the key is the plugin name, value is the URL to the plugin JS
        foreach ($plugins as $plugin ) {
            $plugins_array[ $plugin ] = FUE_TEMPLATES_URL .'/js/tinymce/' . $plugin . '/plugin.min.js';
        }
        return $plugins_array;
    }

    /**
     * Replace the placeholder URL we're using for the Email Form page with the actual URL.
     *
     * @param $url
     * @param $original_url
     * @param $_context
     *
     * @return string|void
     */
    public static function replace_email_form_url($url, $original_url, $_context) {
        if ( $url == 'admin.php?page=fue_post_email' ){
            //remove_filter('clean_url', 'FUE_Admin_Controller::replace_email_form_url', 0);
            return admin_url('post-new.php?post_type=follow_up_email');
        } elseif ( $url == 'admin.php?page=fue_campaigns' ) {
            //remove_filter( 'clean_url', 'FUE_Admin_Controller::replace_email_form_url', 0 );
            return admin_url( 'edit-tags.php?taxonomy=follow_up_email_campaign' );
        } elseif ( strpos($url, 'edit.php?follow_up_email_campaign=') !== false ) {
            $parts = array();
            parse_str( $url, $parts );
            $terms = array_values( $parts );

            //remove_filter( 'clean_url', 'FUE_Admin_Controller::replace_email_form_url', 0 );
            return esc_url( 'admin.php?page=followup-emails&campaign='. $terms[0] );
        }

        return $url;
    }

    /**
     * Set the current submenu item in the admin nav menu
     * @param string $parent_file
     * @return string
     */
    public static function set_active_submenu( $parent_file ) {
        global $submenu_file, $plugin_page;

        if ( $parent_file == 'edit.php?post_type=follow_up_email') {
            $parent_file = 'followup-emails';
            $submenu_file = null;
        } elseif ( $submenu_file == 'edit-tags.php?taxonomy=follow_up_email_campaign' ) {
            $parent_file = 'followup-emails';
            $submenu_file = 'fue_campaigns';
        }

        return $parent_file;
    }

    /**
     * Routes the request to the correct page/file
     */
    public static function admin_controller() {
        $tab = isset($_GET['tab']) ? $_GET['tab'] : 'list';

        switch ( $tab ) {

            case 'list':
                self::list_emails_page();
                break;

            case 'edit':
                self::email_form( 1, $_GET['id'] );
                break;

            case 'send':
                $id    = $_GET['id'];
                $email = new FUE_Email( $id );

                if ( ! $email->exists() ) {
                    wp_die( "The requested data could not be found!" );
                }

                self::send_manual_form( $email );
                break;

            case 'send_manual_emails':
                self::send_manual_emails();
                break;

            case 'updater':
                self::updater_page();
                break;

            default:
                // allow add-ons to add tabs
                do_action( 'fue_admin_controller', $tab );
                break;

        }

    }

    /**
     * FUE Dashboard Widget
     */
    public static function dashboard_widget() {
        wp_add_dashboard_widget( 'fue-dashboard', __('Follow-Up Emails', 'follow_up_emails'), array('FUE_Report_Dashboard_Widget', 'display'));
    }

    /**
     * Page that lists all FUE_Emails
     */
    public static function list_emails_page() {
        $types          = Follow_Up_Emails::get_email_types();
        $campaigns      = get_terms( 'follow_up_email_campaign', array('hide_empty' => false) );
        $bccs           = get_option('fue_bcc_types', false);
        $from_addresses = get_option('fue_from_email_types', false);
        $from_names     = get_option('fue_from_name_types', false);

        include FUE_TEMPLATES_DIR .'/email-list/email-list.php';
    }

    /**
     * Send Manual Email form
     *
     * @param $email
     */
    public static function send_manual_form( $email ) {
        $wpdb = Follow_Up_Emails::instance()->wpdb;

        include FUE_TEMPLATES_DIR .'/send_manual_form.php';
    }

    /**
     * Send manual emails in batches
     */
    public static function send_manual_emails() {
        include FUE_TEMPLATES_DIR .'/send_manual_emails.php';
    }

    /**
     * Admin interface for managing subscribers
     */
    public static function subscribers_table() {
        $wpdb = Follow_Up_Emails::instance()->wpdb;

        $newsletter     = Follow_Up_Emails::instance()->newsletter;
        $lists          = $newsletter->get_lists();
        $date_format    = get_option('date_format') .' '. get_option('time_format');
        $email_order    = !empty( $_GET['orderby'] ) && $_GET['orderby'] == 'email' ? $_GET['order'] : 'asc';
        $new_email_order= 'desc';
        $date_order     = !empty( $_GET['orderby'] ) && $_GET['orderby'] == 'date_added' ? $_GET['order'] : 'desc';
        $new_date_order = 'asc';
        $email_order_class  = 'sortable';
        $date_order_class   = 'sortable';
        $orderby        = 'date_added';
        $order          = 'desc';
        $base_url       = 'admin.php?page=followup-emails-subscribers';
        $page           = 1;

        if ( isset( $_GET['list'] ) ) {
            $base_url = add_query_arg( 'list', $_GET['list'], $base_url );
        }

        if ( !empty( $_GET['orderby'] ) && $_GET['orderby'] == 'email' ) {
            $email_order_class = 'sorted';
            $orderby = 'email';
            if ( $_GET['order'] == 'asc' ) {
                $order = 'asc';
                $email_order = 'asc';
                $new_email_order = 'desc';
            } else {
                $order = 'desc';
                $email_order = 'desc';
                $new_email_order = 'asc';
            }
        }

        if ( !empty( $_GET['orderby'] ) && $_GET['orderby'] == 'date_added' ) {
            $date_order_class = 'sorted';
            $orderby = 'date_added';
            if ( $_GET['order'] == 'asc' ) {
                $order = 'asc';
                $date_order = 'asc';
                $new_date_order = 'desc';
            } else {
                $order = 'desc';
                $date_order = 'desc';
                $new_date_order = 'asc';
            }
        }

        if ( !isset( $_GET['list'] ) || $_GET['list'] == -1 ) {
            $list_filter = false;
        } else {
            if ( empty( $_GET['list'] ) ) {
                $list_filter = '';
            } else {
                $list_filter = $_GET['list'];
            }
        }

        if ( !empty( $_GET['paged'] ) ) {
            $page = absint( $_GET['paged'] );
        }

        $subscribers = $newsletter->get_subscribers( array(
            'list'      => $list_filter,
            'orderby'   => $orderby,
            'order'     => $order,
            'length'    => 10,
            'page'      => $page
        ) );
        $total_pages = ceil( $newsletter->found_subscribers / 10 );

        $page_links = paginate_links( array(
            'base'      => $base_url .'%_%',
            'format'    => '&paged=%#%',
            'total'     => $total_pages,
            'current'   => $page,
            'end_size'  => 2,
            'mid_size'  => 2,
            'prev_next' => true,
            'prev_text' => '‹',
            'next_text' => '›'
        ) );

        include FUE_TEMPLATES_DIR .'/subscribers_table.php';
    }

    /**
     * Admin interface for managing opt-outs
     */
    public static function optout_table() {
        $wpdb = Follow_Up_Emails::instance()->wpdb;

        include FUE_TEMPLATES_DIR .'/optout_table.php';
    }

    /**
     * Admin Updater interface
     */
    public static function updater_page() {
        global $wpdb;

        include FUE_TEMPLATES_DIR .'/updater.php';
    }

    /**
     * Settings Interface
     */
    public static function settings() {
        global $wpdb;

        $pages                  = get_pages();
        $emails                 = get_option( 'fue_daily_emails' );
        $bcc                    = get_option( 'fue_bcc', '' );
        $from                   = get_option( 'fue_from_email', '' );
        $from_name              = get_option( 'fue_from_name', get_bloginfo('name') );
        $bounce                 = get_option( 'fue_bounce_settings', '' );
        $email_batches          = get_option( 'fue_email_batches', 0 );
        $disable_logging        = get_option( 'fue_disable_action_scheduler_logging', 1 );
        $api_enabled            = get_option( 'fue_api_enabled', 'yes' );
        $emails_per_batch       = get_option( 'fue_emails_per_batch', 100 );
        $email_batch_interval   = get_option( 'fue_batch_interval', 10 );
        $spf                    = get_option( 'fue_spf', array() );
        $dkim                   = get_option( 'fue_dkim', array() );
        $tab                    = (isset($_GET['tab'])) ? $_GET['tab'] : 'system';

        include FUE_TEMPLATES_DIR .'/settings/settings.php';
    }

    /**
     * Render the templates page
     */
    public static function templates() {
        add_thickbox();

        include FUE_TEMPLATES_DIR .'/add-ons/templates.php';
    }

    /**
     * System Info page
     */
    public static function system_info() {
        include FUE_TEMPLATES_DIR .'/settings/system-info.php';
    }

    /**
     * Display the queue items
     */
    public static function queue_table() {
        $table = new FUE_Sending_Queue_List_Table();
        $table->prepare_items();
        $table->messages();
        ?>
        <style>
            span.trash a {
                color: #a00 !important;
            }

        </style>
        <script>
            jQuery(document).ready(function($) {
                $("#delete-all-submit").click(function(e) {
                    if ( confirm("<?php _e('This will delete ALL scheduled emails! Continue?', 'follow_up_emails'); ?>") ) {
                        return true;
                    }
                    return false;
                });
            });
        </script>
        <div class="wrap">
            <h2><?php _e( 'Scheduled Emails', 'follow_up_emails' ); ?></h2>

            <form id="queue-filter" action="" method="get">
                <?php $table->display(); ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register the scripts early so other addons can use them
     */
    public static function register_scripts() {
        $screen = get_current_screen();

        if ( !in_array( $screen->id, self::get_screen_ids() ) ) {
            return;
        }

        if (! wp_script_is( 'jquery-tiptip', 'registered' ) ) {
            wp_register_script( 'jquery-tiptip', FUE_URL .'/templates/js/jquery.tipTip.min.js', array( 'jquery' ), FUE_VERSION, true );
        }

        // blockUI
        if (! wp_script_is('jquery-blockui', 'registered') ) {
            wp_register_script( 'jquery-blockui', FUE_URL . '/templates/js/jquery-blockui/jquery.blockUI.min.js', array( 'jquery' ), FUE_VERSION, true );
        }

        // select2
        if (! wp_script_is('select2', 'registered') ) {
            wp_register_script( 'select2', '//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.js', array( 'jquery' ), '3.5.2' );
            wp_register_style( 'select2', '//cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.css' );
            wp_register_style( 'select2-fue', plugins_url( 'templates/select2.css', FUE_FILE ), array(), '3.5.2' );
        }
    }

    /**
     * Load the necessary scripts
     */
    public static function settings_scripts() {

        $screen = get_current_screen();

        $page = isset($_GET['page']) ? $_GET['page'] : '';
        $fue_pages = array(
            'followup-emails', 'followup-emails-form', 'followup-emails-reports', 'followup-emails-queue', 'followup-emails-subscribers'
        );

        if ( in_array( $page, $fue_pages ) || $screen->post_type == 'follow_up_email' ) {
            wp_enqueue_script('jquery-blockui');
            wp_enqueue_script('media-upload');
            wp_enqueue_script('thickbox');
            wp_enqueue_script('editor');

            wp_enqueue_style('thickbox');

            wp_enqueue_script( 'jquery-tiptip' );
            wp_enqueue_script( 'jquery-ui-core', null, array('jquery') );
            wp_enqueue_script( 'jquery-ui-datepicker', null, array('jquery-ui-core') );
            wp_enqueue_script( 'jquery-ui-sortable', null, array('jquery-ui-core') );
            wp_enqueue_script( 'fue-list', plugins_url( 'templates/js/email-list.js', FUE_FILE ), array('jquery', 'jquery-ui-datepicker', 'jquery-ui-sortable'), FUE_VERSION );
            wp_enqueue_script( 'raphael', plugins_url( 'templates/js/justgage/raphael.min.js', FUE_FILE ), null, '2.1.0', true );
            wp_enqueue_script( 'justgage', plugins_url( 'templates/js/justgage/justgage.1.1.min.js', FUE_FILE ), null, '1.1', true );

            wp_enqueue_style( 'jquery-ui-css', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/themes/base/jquery-ui.css' );
            wp_enqueue_style( 'fue_email_form', plugins_url( 'templates/email-form.css', FUE_FILE ) );

            $translate = apply_filters( 'fue_script_locale', array(
                'email_name'            => __('Email Name', 'follow_up_emails'),
                'processing_request'    => __('Processing request...', 'follow_up_emails'),
                'dupe'                  => __('A follow-up email with the same settings already exists. Do you want to create it anyway?', 'follow_up_emails'),
                'similar'               => __('A similar follow-up email already exists. Do you wish to continue?', 'follow_up_emails'),
                'save'                  => isset($_GET['mode']) ? __('Save', 'follow_up_emails') : __('Build your email', 'follow_up_emails'),
                'ajax_loader'           => plugins_url() .'/woocommerce-follow-up-emails/templates/images/ajax-loader.gif'
            ) );
            wp_localize_script( 'fue-list', 'FUE', $translate );

        }

        if ( in_array( $screen->id, array( 'dashboard' ) ) ) {
            wp_enqueue_style( 'fue_admin_dashboard_styles', plugins_url('templates/dashboard.css', FUE_FILE ), array(), FUE_VERSION );

            wp_enqueue_script( 'jsapi', '//www.google.com/jsapi' );
            wp_enqueue_script( 'fue-reports', FUE_TEMPLATES_URL .'/js/reports.js', array('jsapi'), FUE_VERSION );

            wp_enqueue_script( 'raphael', plugins_url( 'templates/js/justgage/raphael.min.js', FUE_FILE ), null, '2.1.0', true );
            wp_enqueue_script( 'justgage', plugins_url( 'templates/js/justgage/justgage.1.1.min.js', FUE_FILE ), null, '1.1', true );

            wp_enqueue_script( 'circliful', plugins_url( 'templates/js/circliful/js/jquery.circliful.min.js', FUE_FILE), array('jquery') );
            wp_enqueue_style( 'circliful', plugins_url('templates/js/circliful/css/jquery.circliful.css', FUE_FILE ), array(), FUE_VERSION );

            wp_enqueue_script( 'jquery-tiptip' );
        }

        if ( $page == 'followup-emails-reports' ) {
            wp_enqueue_style( 'fue_admin_report_flags', plugins_url('templates/flags.css', FUE_FILE ), array(), FUE_VERSION );
            wp_enqueue_style( 'fue_admin_report_styles', plugins_url('templates/reports.css', FUE_FILE ), array(), FUE_VERSION );

            wp_enqueue_script( 'circliful', plugins_url( 'templates/js/circliful/js/jquery.circliful.min.js', FUE_FILE), array('jquery') );
            wp_enqueue_style( 'circliful', plugins_url('templates/js/circliful/css/jquery.circliful.css', FUE_FILE ), array(), FUE_VERSION );
        }

        if ( $page == 'followup-emails-settings' || $page == 'followup-emails' || $page == 'followup-emails-subscribers' ) {
            wp_enqueue_script( 'select2' );
            wp_enqueue_style( 'select2' );
            wp_enqueue_style( 'select2-fue' );
            wp_enqueue_script( 'jquery-tiptip' );

            if ( !empty( $_GET['tab'] ) && $_GET['tab'] == 'send_manual_emails') {
                wp_enqueue_script( 'fue_manual_send', FUE_TEMPLATES_URL .'/js/manual_send.js', array('jquery', 'jquery-ui-progressbar'), FUE_VERSION );
            }
        }

        if ( $page == 'followup-emails-settings' ) {
            wp_enqueue_script( 'fue_settings', FUE_TEMPLATES_URL .'/js/settings.js', array('jquery'), FUE_VERSION, true );
        }

        if ( $page == 'followup-emails-templates' ) {
            wp_enqueue_script('jquery-blockui');
            wp_enqueue_script( 'ace', FUE_TEMPLATES_URL .'/js/ace/ace.js', array(), '1.1.9', true );
            wp_enqueue_script( 'fue_templates', FUE_TEMPLATES_URL .'/js/templates.js', array('jquery', 'ace'), FUE_VERSION );

            $translate = apply_filters( 'fue_script_locale', array(
                'ajax_loader'           => plugins_url() .'/woocommerce-follow-up-emails/templates/images/ajax-loader.gif',
                'get_template_nonce'    => wp_create_nonce('get_template_html'),
                'save_template_nonce'   => wp_create_nonce('save_template_html')
            ) );
            wp_localize_script( 'fue_templates', 'FUE_Templates', $translate );

            wp_enqueue_style( 'fue-addons', FUE_TEMPLATES_URL .'/add-ons/templates.css' );
        }

    }

}
