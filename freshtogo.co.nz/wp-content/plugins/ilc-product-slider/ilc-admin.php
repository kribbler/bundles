<?php
/**
 * Creates a settings page for the plugin
 * @author Elio Rivero
 * @since 1.0.0
 */
class ILCPSAdmin {

	static $settings;
	static $settings_page_id;
	static $basefile;
	static $prefix = 'ilc_ps_';
	
	function __construct($args = array()) {
		$defaults = array( 'basefile' => '' );
		$args = wp_parse_args($args, $defaults);
		
		self::$settings = get_option(self::$prefix . 'settings');
		
		if( is_admin() ) {
			
			self::$settings_page_id = 'ilc_product_slider_options';
			self::$basefile = $args['basefile'];
			
			add_action( 'admin_init', array(&$this, 'admin_init') );
			add_action( 'admin_menu', array(&$this, 'plugin_menu'));
			register_activation_hook(	self::$basefile, array(&$this, 'activate'));
			register_deactivation_hook(	self::$basefile, array(&$this, 'deactivate'));

			add_filter('manage_edit-product_cat_columns', 'custom_category_header', 10, 2);
			add_filter('manage_product_cat_custom_column', 'custom_category', 10, 3);

			function custom_category_header($cat_columns){
			    $cat_columns['product_cat_id'] = 'ID';
			    return $cat_columns;
			}

			function custom_category($columns, $column, $termid){
				if('product_cat_id' == $column){
					return $termid;
				}
			}
		}
	}
	
	/**
	 * Creates the contextual help for this plugin
	 * @param string
	 * @return string
	 * @since 1.0.0
	 */
	function help() {
		
		$screen = get_current_screen();
			
		$html = '<h5>' . __('Welcome!', 'ilc') . '</h5>';
		$html .= '<p>' . __('Thanks for purchasing ILC Product Slider. This plugin will create a carousel displaying WooCommerce products.', 'ilc') . '</p>';
		$html .= '<p>' . sprintf(__('For any support questions, access the <a href="%s">support forums</a>.', 'ilc'), 'http://themesrobot.com/forum/product-slider-carousel-for-woocommerce/') . '</p>';
		$html .= '<h5>' . __('About the settings', 'ilc') . '</h5>';
		$html .= '<p>' . __('The settings in this page set default values to be used throughout the site but you can override the value in each shortcode instance.', 'ilc') . '</p>';
		
		$html .= '<p><em>' . sprintf( __('ILC Product Slider created by Elio Rivero. Follow %s on Twitter for the latest updates.', 'ilc'), '<a href="http://twitter.com/eliorivero">@eliorivero</a>') . '</em></p>';
		$screen->add_help_tab( array(
			'id'      => 'ilc-main',
			'title'   => __('Introduction', 'ilc'),
			'content' => $html,
		));
		
		$html = '<p>' . __('To place the products carousel in your post or page you can use the <a href="http://codex.wordpress.org/Shortcode" target="_blank">shortcode</a> provided. While editing your post, type', 'ilc') . '</p>';
		$html .= '<code>[products_carousel product_cat="24" featured="yes" numberposts="4" image_size="medium" ]</code>';
		$html .= '<p>' . __('These and all the parameters are described in the documentation.', 'ilc') . '</p>';
		$screen->add_help_tab( array(
			'id'      => 'ilc-shortcode',
			'title'   => __('Shortcode', 'ilc'),
			'content' => $html,
		));

	}
	
	/**
	 * Creates the options page for this plugin
	 * @since 1.0.0
	 */
	function options_page(){
		if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.', 'ilc') );
		}
		?>
		<div class="wrap">
			<?php screen_icon(); ?>
			<h2><?php _e('ILC Product Slider', 'ilc'); ?></h2>
			
			<form action="options.php" method="post">
				<?php settings_fields(self::$prefix . 'settings'); ?>
				<?php do_settings_sections(self::$prefix . 'options'); ?>
				<input class="button-primary" name="<?php _e('Submit','ilc'); ?>" type="submit" value="<?php esc_attr_e('Save Changes', 'ilc'); ?>" />
			</form>
		</div>
		<?php
	}
	
	/**
	 * Defines the settings field for the plugin options page.
	 * @since 1.0.0
	 */
	
	function admin_init(){
		
		wp_enqueue_style( 'farbtastic' );
		wp_enqueue_script( 'farbtastic' );
		
		register_setting( self::$prefix . 'settings', self::$prefix . 'settings', array(&$this, 'validate_options') );
		
		add_settings_section( self::$prefix . 'main_section', __('Product settings', 'ilc'), array(&$this, 'main_desc'), self::$prefix . 'options' );
		
		add_settings_section( self::$prefix . 'carousel', __('Carousel', 'ilc'), array(&$this, 'carousel_desc'), self::$prefix . 'options' );
		
		add_settings_section( self::$prefix . 'customcss', __('Styling', 'ilc'), array(&$this, 'customcss_desc'), self::$prefix . 'options' );
		
		$product_cats = array();
		$terms = get_terms('product_cat');
		$product_cats[__('All Featured Products', 'ilc')] = 'featured';
		foreach ($terms as $term => $obj) {
			$product_cats[$obj->name] = $obj->term_id;
		}
		$image_sizes = get_intermediate_image_sizes();

		$sections['main_section'] = array(
			array(
				'id' => 'numberposts_int',
				'label' => __('Products to show', 'ilc'),
				'type' => 'text',
				'default' => 5,
				'class' => 'small-text',
				'help' => __('Default number of products to show.', 'ilc')
			),
			array(
				'id' => 'product_cat',
				'label' => __('Product criteria', 'ilc'),
				'type' => 'select',
				'default' => 'category',
				'options' => $product_cats,
				'help' => __('Choose a category or display featured products from all categories.', 'ilc')
			),
			array(
				'id' => 'featimg',
				'label' => __('Featured Image', 'ilc'),
				'type' => 'select',
				'default' => 'thumbnail',
				'options' => array(
					__('Thumbnail', 'ilc') => 'thumbnail',
					__('Medium', 'ilc') => 'medium',
					__('Large', 'ilc') => 'large',
					__('Original size', 'ilc') => 'full',
					__('None', 'ilc') => 'none',
				),
				'help' => __('Choose the size of the featured image to use.', 'ilc')
			),
			array(
				'id' => 'price_chk',
				'label' => __('Price', 'ilc'),
				'type' => 'checkbox',
				'default' => 'on',
				'help' => __('Show product price.', 'ilc') 
			),
			array(
				'id' => 'add_to_cart_chk',
				'label' => __('Add to cart', 'ilc'),
				'type' => 'checkbox',
				'default' => 'on',
				'help' => __('Show "add to cart" button.', 'ilc')
			),
			array(
				'id' => 'quantity_chk',
				'label' => __('Quantity', 'ilc'),
				'type' => 'checkbox',
				'default' => null,
				'help' => __('Show quantity input.', 'ilc')
			),
			array(
				'id' => 'featured_chk',
				'label' => __('Featured products', 'ilc'),
				'type' => 'checkbox',
				'default' => null,
				'help' => __('Show only featured products from the selected category.', 'ilc')
			)
		);
		
		$sections['carousel'] = array(
			array(
				'id' => 'makecarousel_chk',
				'label' => __('Products carousel', 'ilc'),
				'type' => 'checkbox',
				'default' => 'on',
				'help' => __('Create carousel if possible.', 'ilc')
			),
			array(
				'id' => 'minimum_int',
				'label' => __('Minimum number of items', 'ilc'),
				'type' => 'text',
				'default' => 3,
				'class' => 'small-text',
				'help' => __('For the carousel to be created, this value must be <strong>smaller</strong> than "Products to show" at least by 1.', 'ilc')
			),
			array(
				'id' => 'min_int',
				'label' => __('Minimum visible items', 'ilc'),
				'type' => 'text',
				'default' => 1,
				'class' => 'small-text'
			),
			array(
				'id' => 'max_int',
				'label' => __('Maximum visible items', 'ilc'),
				'type' => 'text',
				'default' => 3,
				'class' => 'small-text'
			),
			array(
				'id' => 'itemwidth_int',
				'label' => __('General width of items', 'ilc'),
				'type' => 'text',
				'default' => 160,
				'class' => 'small-text'
			),
			array(
				'id' => 'auto_chk',
				'label' => __('Automatic scroll', 'ilc'),
				'type' => 'checkbox',
				'default' => null,
				'help' => __('Play carousel automatically.', 'ilc') 
			),
			array(
				'id' => 'nscroll_int',
				'label' => __('Items to scroll', 'ilc'),
				'type' => 'text',
				'default' => 1,
				'class' => 'small-text'
			),
			array(
				'id' => 'timeout_int',
				'label' => __('Autoplay timeout', 'ilc'),
				'type' => 'text',
				'default' => 3000,
				'class' => 'small-text'
			),
			array(
				'id' => 'pager_chk',
				'label' => __('Pagination', 'ilc'),
				'type' => 'checkbox',
				'default' => 'on',
				'help' => __('Show carousel pagination.', 'ilc') 
			)
		);
		
		$sections['customcss'] = array(
			array(
				'id' => 'front_color',
				'label' => __('Direction arrows', 'ilc'),
				'type' => 'color',
				'default' => 'inherit'
			),
			array(
				'id' => 'fronthover_color',
				'label' => __('Direction arrows hover', 'ilc'),
				'type' => 'color',
				'default' => 'inherit'
			),
			array(
				'id' => 'bg_color',
				'label' => __('Butttons background', 'ilc'),
				'type' => 'color',
				'default' => 'inherit'
			),
			array(
				'id' => 'bghover_color',
				'label' => __('Buttons background hover', 'ilc'),
				'type' => 'color',
				'default' => 'inherit'
			),
			array(
				'id' => 'border_color',
				'label' => __('Buttons border', 'ilc'),
				'type' => 'color',
				'default' => 'inherit'
			),
			array(
				'id' => 'arrowradius_int',
				'label' => __('Buttons roundness', 'ilc'),
				'type' => 'step',
				'default' => 5,
				'class' => 'small-text',
				'help' => __('Enter pixel-based value.', 'ilc')
			),
			array(
				'id' => 'customcss',
				'label' => __('Custom Styling', 'ilc'),
				'type' => 'textarea',
				'default' => '',
				'class' => 'large-text code',
				'help' => __('Enter your custom CSS to fine tune details.', 'ilc')
			)
		);
		
		foreach ($sections as $key => $fields) {
			foreach($fields as $field){
				add_settings_field(
					self::$prefix . $field['id'],
					$field['label'],
					array( &$this, $field['type']),
					self::$prefix . 'options',
					self::$prefix . $key,
					array(
						'field_id' => $field['id'],
						'field_default' => $field['default'],
						'field_class' => isset($field['class'])? $field['class'] : null,
						'field_help' => isset($field['help'])? $field['help'] : null,
						'field_ops' => isset($field['options'])? $field['options'] : null
					)
				);
			}
		}
	}
	
	/**
	 * Validates options trying to be saved. Specific sentences are required for each value.
	 * @param array
	 * @since 1.0.0
	 */
	function validate_options($input){
		$options = self::$settings;
		
		//Validate colors
		foreach ($input as $key => $value) {
			if(strpos($key,'_color')){
				$options[$key] = $value;
				if(!preg_match('/#[0-9A-F]{3,6}$/i', $options[$key])) {
					$options[$key] = 'inherit';
				}
			}
			elseif(strpos($key,'_int')){
				$options[$key] = $value;
				if(!preg_match('/[0-9]$/i', $options[$key])) {
					switch($key){
						case 'numberposts_int':
							$options[$key] = 3;
							break;
					}
				}
			}
		}
		
		// Transfer checkboxes
		foreach ( $options as $key => $value ) {
			if( strpos($key, '_chk') ) {
				$options[$key] = $input[$key];
			}
		}
		
		// Sanitize taxonomies select
		$terms = get_terms('product_cat');
		$termfirst = true;
		foreach ($terms as $term) {
			if($termfirst){
				$termstring = '/[featured';
				$termfirst = false;
			}
			$termstring .= '|[';
			$termstring .= $term->term_id;
			$termstring .= ']';
		}
		$termstring .= '/i';
		$options['product_cat'] = $input['product_cat'];
		if(!preg_match($termstring, $options['product_cat'])){
			$options['product_cat'] = 'featured';
		}
		
		// Sanitize featured image size
		$options['featimg'] = $input['featimg'];
		if(!preg_match('/[thumbnail]|[medium]|[large]|[full]|[none]/i', $options['featimg'])){
			$options['featimg'] = 'thumbnail';
		}
		
		// Sanitize featured image size
		$options['placement'] = $input['placement'];
		if(!preg_match('/[after]|[before]|[none]/i', $options['placement'])){
			$options['placement'] = 'after';
		}
		
		// Sanitize custom CSS declarations
		$options['customcss'] = strip_tags( $input['customcss'] );		
		
		return $options;
	}
	
	/**
	 * Callback for settings section
	 */
	function main_desc(){
		echo '<p>'.__('Set default values to retrieve products.', 'ilc') . '</p>';
	}
	/**
	 * Callback for carousel section
	 */
	function carousel_desc(){
		echo '<p>'.__('General values for the carousel throughout the site.', 'ilc') . '</p>';
	}
	/**
	 * Callback for custom CSS section
	 */
	function customcss_desc(){
		echo '<p>'.__('Use this section to tweak the style so it matches your site.', 'ilc'). '</p>';
	}

	/**
	 * Creates a checkbox control
	 * @param array
	 * @since 1.0.0
	 */
	function checkbox($args) {
		extract($args);
		$options = self::$settings;
		
		if( isset($options[$field_id]) ){
			$checked = 'checked="checked"';
		}
		else {
			$checked = '';
		}
		echo "<label for='".self::$prefix."$field_id'><input $checked id='".self::$prefix."$field_id' name='".self::$prefix."settings[$field_id]' type='checkbox' />";
		if( isset($field_help) ) echo " $field_help";
		echo '</label>';
	}
	
	
	/**
	 * Creates a select element
	 * @param array
	 * @since 1.0.0
	 */
	function select($args) {
		extract($args);
		$options = self::$settings;
		$options[$field_id] = isset($options[$field_id])? $options[$field_id] : $field_default;
		$class = ( isset($field_class) )? "class='$field_class'" : "";
		echo "<select id='".self::$prefix."$field_id' $class name='".self::$prefix."settings[$field_id]'>";
		foreach($field_ops as $name => $value){
			if( isset($options[$field_id]) ){
				if( $value == $options[$field_id]) {
					$selected = 'selected="selected"';
				} else {
					$selected = '';
				}
			} else {
				$selected = '';
			}
			echo "<option value='$value' $selected>" . $name . '</option>';
		}
		echo '</select>';
		if( isset($field_help) ){
			echo "<br/><span class='description'>$field_help</span>";
		}
	}
	
	/**
	 * Creates radio buttons
	 * @param array
	 * @since 1.0.0
	 */
	function radio($args) {
		extract($args);
		$options = self::$settings;
		$options[$field_id] = isset($options[$field_id])? $options[$field_id] : $field_default;
		$class = ( isset($field_class) )? "class='$field_class'" : "";
		foreach($field_ops as $name => $value){
			if( isset ($options[$field_id]) ){
				if( $value == $options[$field_id]) {
					$checked = 'checked="checked"';
				}
				else{
					$checked = '';
				}
			}
			else {
				$checked = '';
			}
			echo "<label for='".self::$prefix."$field_id-$value'><input id='".self::$prefix."$field_id-$value' $class name='".self::$prefix."settings[$field_id]' type='radio' value='$value' $checked /> $name</label>";
			echo '<br/>';
		}
		if( isset($field_help) ){
			echo "<span class='description'>$field_help</span>";
		}
	}
	
	/**
	 * Creates a color picker using Farbtastic
	 * @param array
	 * @since 1.0.0
	 */
	function color($args) {
		extract($args);
		$options = self::$settings;
		$options[$field_id] = isset($options[$field_id])? $options[$field_id] : $field_default;
		$colorpicker = self::$prefix.'color_' . $field_id;
		if( '' == $options[$field_id] ) $options[$field_id] = ' ';
		echo "<input id='".self::$prefix."$field_id' name='".self::$prefix."settings[$field_id]' type='text' value='{$options[$field_id]}' />";
		echo '<input type="button" class="button hide-if-no-js" value="' . __('Pick color', 'ilc') . '" id="ilc_pick_' . $field_id . '">';
		echo "<div id='$colorpicker' class='ilc-color-picker'></div>";
		if( isset($field_help) ){
			echo "<br/><span class='description'>$field_help</span>";
		}
		echo "<script type='text/javascript'>
		jQuery(document).ready(function() {
			jQuery('#$colorpicker').hide();
			jQuery('#$colorpicker').farbtastic('#".self::$prefix."$field_id');
			jQuery('#ilc_pick_$field_id').click(function(){
				jQuery('.ilc-color-picker').not(document.getElementById('$colorpicker')).slideUp();
				jQuery('#$colorpicker').slideToggle();
			});
		});
		</script>";
	}
	
	/**
	 * Creates a textarea
	 * @param array
	 * @since 1.0.0
	 */
	function textarea($args) {
		extract($args);
		$options = self::$settings;
		$options[$field_id] = isset($options[$field_id])? $options[$field_id] : $field_default;
		$class = ( isset($field_class) )? "class='$field_class'" : "";
		echo "<textarea id='".self::$prefix."$field_id' $class rows='5' name='".self::$prefix."settings[$field_id]'>{$options[$field_id]}</textarea>";
		if( isset($field_help) ){
			echo "<br/><span class='description'>$field_help</span>";
		}
	}
	
	/**
	 * Creates a number input field
	 * @param array
	 * @since 1.0.0
	 */
	function step($args) {
		extract($args);
		$options = self::$settings;
		$options[$field_id] = isset($options[$field_id])? $options[$field_id] : $field_default;
		$class = ( isset($field_class) )? "class='$field_class'" : '';
		echo "<input id='".self::$prefix."$field_id' $class name='".self::$prefix."settings[$field_id]' type='number' value='{$options[$field_id]}' />";
		if( isset($field_help) ){
			echo "<br/><span class='description'>$field_help</span>";
		}
	}
	
	/**
	 * Creates a text input field
	 * @param array
	 * @since 1.0.0
	 */
	function text($args) {
		extract($args);
		$options = self::$settings;
		$options[$field_id] = isset($options[$field_id])? $options[$field_id] : $field_default;
		$class = ( isset($field_class) )? "class='$field_class'" : "";
		echo "<input id='".self::$prefix."$field_id' $class name='".self::$prefix."settings[$field_id]' type='text' value='{$options[$field_id]}' />";
		if( isset($field_help) ){
			echo "<br/><span class='description'>$field_help</span>";
		}
	}
	
	/**
	 * Creates Settings link on plugins list page.
	 * @param array
	 * @param string
	 * @return array
	 * @since 1.0.0
	 */
	function settings_link($links, $file) {
		if ($file == plugin_basename( self::$basefile )) {
			foreach($links as $k=>$v) {
				if (strpos($v, 'plugin-editor.php?file=') !== false)
					unset($links[$k]);
			}
			$links[] = sprintf('<a href="options-general.php?page=%s" title="%s">%s</a>',
						self::$settings_page_id, __('Set plugin options', 'ilc'), __('Settings', 'ilc'));
			$links[] = sprintf('<a href="%s" title="%s">%s</a>',
						'http://themesrobot.com/forums/', __('Access the support forums', 'ilc'), __('Support', 'ilc'));
		}
		return $links;
	}
	
	/**
	 * Adds Settings link on plugins page. Create options page on wp-admin.
	 * @since 1.0.0
	 */
	function plugin_menu() {
		$plugindata = get_plugin_data( self::$basefile );
		add_filter( 'plugin_action_links', array(&$this, 'settings_link'), -10, 2);
		$op = add_options_page($plugindata['Name'], $plugindata['Name'], 'manage_options', self::$settings_page_id, array(&$this, 'options_page'));
		add_action('load-' . $op, array(&$this, 'help'));
	}
	
	
	/**
	 * Get plugin setting
	 * @param string
	 * @return mixed
	 * @since 1.0.0
	 */
	function get($key) {
		return self::$settings[$key];
	}
	
	/**
	 * Get and echo plugin setting
	 * @param string
	 * @since 1.0.0
	 */
	function gecho($key) {
		echo $this->get($key);
	}
	
	/**
	 * When the plugin is activated, we will setup some options on the database
	 * @since 1.0.0
	 */
	function activate(){
		$defaults = array(
			'numberposts_int'	=> 5,
			'product_cat' 		=> 'featured',
			'featimg'			=> 'thumbnail',
			'price_chk'				=> 'on',
			'add_to_cart_chk'		=> 'on',
			'quantity_chk'			=> null,
			'featured_chk'			=> null,
			
			'makecarousel_chk' => 'on',
			'minimum_int' => 3,
			'min_int' => 1,
			'max_int' => 3,
			'nscroll_int' => 1,
			'timeout_int' => 1,
			'itemwidth_int' => 160,
			'auto_chk' => null,
			'pager_chk' => 'on',
			
			'front_color' => 'inherit',
			'fronthover_color' => 'inherit',
			'bg_color' => 'inherit',
			'bghover_color' => 'inherit',
			'border_color' => 'inherit',
			'arrowradius_int' => 5,
			'customcss'	=> ''
		);
		add_option(self::$prefix.'settings', $defaults);
	}

	/**
	 * When the plugin is deactivated, erase all options from database.
	 * @since 1.0.0
	 */
	function deactivate(){
		delete_option(self::$prefix.'settings');
	}
}


?>