<?php
// File Security Check
if (!defined('ABSPATH'))
    exit;

class WC_Email_Inquiry_Less
{
	public $plugin_name = 'wc_orders_quotes';
	public $css_file_name = 'wc_email_inquiry_cart_options';
	public $plugin_folder = WC_EMAIL_INQUIRY_FOLDER;
	public $plugin_dir = WC_EMAIL_INQUIRY_DIR;
    
    /*-----------------------------------------------------------------------------------*/
    /* Constructor */
    /*-----------------------------------------------------------------------------------*/
    public function __construct()
    {
		add_action( $this->plugin_name.'_after_settings_save_reset', array ($this, 'plugin_build_sass') );
		add_action( 'wp_head', array ($this, 'apply_style_css_fontend') , 11 );
    }
	
	public function apply_style_css_fontend()
	{
		$_upload_dir = wp_upload_dir();
		if ( file_exists( $_upload_dir['basedir'] . '/sass/' . $this->css_file_name . '.min.css' ) )
			echo '<link media="screen" type="text/css" href="' . $_upload_dir['baseurl'] . '/sass/' . $this->css_file_name . '.min.css" rel="stylesheet" />' . "\n";
	}
	
	public function plugin_build_sass()
    {
		$sass = $this->sass_content_data();
		$this->plugin_compile_less_mincss( $sass );
	}
	
	public function plugin_compile_less_mincss( $sass, $css_file_name = '' )
    {
		@ini_set( 'display_errors', false );
        $_upload_dir = wp_upload_dir();
        @chmod($_upload_dir['basedir'], 0777);
        if (!is_dir($_upload_dir['basedir'] . '/sass')) {
            @mkdir($_upload_dir['basedir'] . '/sass', 0777);
        } else {
            @chmod($_upload_dir['basedir'] . '/sass', 0777);
        }
		
		if ( trim( $css_file_name ) == '' ) $css_file_name = $this->css_file_name;
        
        if ( $css_file_name == '' )
            return;
			
		if ( $this->plugin_folder == '' )
            return;
        
        $filename = $css_file_name;
        
        if (!file_exists($_upload_dir['basedir'] . '/sass/' . $filename . '.less')) {
            @file_put_contents($_upload_dir['basedir'] . '/sass/' . $filename . '.less', '');
            @file_put_contents($_upload_dir['basedir'] . '/sass/' . $filename . '.css', '');
            @file_put_contents($_upload_dir['basedir'] . '/sass/' . $filename . '.min.css', '');
        }
        $files = array_diff(scandir($_upload_dir['basedir'] . '/sass'), array(
            '.',
            '..'
        ));
        if ($files) {
            foreach ($files as $file) {
                @chmod($_upload_dir['basedir'] . '/sass/' . $file, 0777);
            }
        }
        
        $sass_data = '';
      
        if ($sass != '') {
            
            $sass_data = '@import "'.$this->plugin_dir.'/admin/less/assets/css/mixins.less";' . "\n";
            
            $sass_data .= $sass;
            
            $sass_data = str_replace(':;', ': transparent;', $sass_data);
            $sass_data = str_replace(': ;', ': transparent;', $sass_data);
            $sass_data = str_replace(': !important', ': transparent !important', $sass_data);
            $sass_data = str_replace(':px', ':0px', $sass_data);
            $sass_data = str_replace(': px', ': 0px', $sass_data);
            
            $less_file = $_upload_dir['basedir'] . '/sass/' . $filename . '.less';
            if (is_writable($less_file)) {
                
                if (!class_exists('Compile_Less_Sass'))
                    include( dirname( __FILE__ ) . '/compile_less_sass_class.php');
                file_put_contents($less_file, $sass_data);
                $css_file     = $_upload_dir['basedir'] . '/sass/' . $filename . '.css';
                $css_min_file = $_upload_dir['basedir'] . '/sass/' . $filename . '.min.css';
                $compile      = new Compile_Less_Sass;
                $compile->compileLessFile($less_file, $css_file, $css_min_file);
            }
        }
    }
    
    public function sass_content_data()
    {
		do_action($this->plugin_name . '_get_all_settings');
		
        ob_start();
		include( $this->plugin_dir. '/templates/customized_style.php' );
		$sass = ob_get_clean();
		$sass = str_replace( '<style>', '', str_replace( '</style>', '', $sass ) );
		
        // Start Less
        $sass_ext = '';
        
        $sass_ext = apply_filters( $this->plugin_name.'_build_sass', $sass_ext );
        
        if ($sass_ext != '')
            $sass .= "\n" . $sass_ext;
        
        return $sass;
    }
}
global $wc_email_inquiry_less;
$wc_email_inquiry_less = new WC_Email_Inquiry_Less();
?>