<?php

/*
  Plugin Name: People Manager
  Plugin URI: http://www.divinedesigns.ca/
  Description: Adds a new Custom Post Type to manage people
  Author: Daniel Roth
  Version: 1.0.0
  Author URI: http://www.divinedesigns.ca
 */

DD_PeopleManager::register_hooks();

class DD_PeopleManager {

	static $cpt				 = "dd_peoplemanager";
	static $cpt_name		 = "Person";
	static $cpt_name_plural	 = "People";
	static $taxonomy		 = "dd_peoplemanager_category";
	static $allowed_roles	 = array('administrator');

	/*
	 * All cpt fields are {CPT}_fieldname
	 */
	static $custom_meta_fields = array(
		'position'		 => 'Position',
		'credentials'	 => 'Credentials',
		'phone_number'	 => 'Phone Number',
		'phone_ext'		 => 'Phone Extension',
		'email'			 => 'Email Address',
		'contact_form_shortcode'	 => 'Contact Form Shortcode'
	);

	function register_hooks() {
		register_activation_hook(__FILE__, array(__CLASS__, 'activate'));
		register_deactivation_hook(__FILE__, array(__CLASS__, 'deactivate'));

		/*
		 * Adds needed javascript files
		 */
		add_action('wp_enqueue_scripts', array(__CLASS__, 'register_scripts'));

		/*
		 *  Creates custom post types
		 */
		add_action('init', array(__CLASS__, 'register_custom_post_type'));

		/*
		 *  Hook into the 'init' action
		 */
		add_action('init', array(__CLASS__, 'register_custom_taxonomy'), 0);

		add_action('add_meta_boxes', array(__CLASS__, 'add_meta_boxes'));

		add_action('save_post', array(__CLASS__, 'save_meta_data'));
		
		/*
		 * Added for debugging;
		 */
		add_action('wpcf7_mail_failed', array(__CLASS__, 'wpcf7_mail_failed'));

		/*
		 *  Used to change the "Set featured image" text 
		 */
		add_filter('admin_post_thumbnail_html', array(__CLASS__, 'custom_admin_post_thumbnail_html'));

		add_filter('enter_title_here', array(__CLASS__, 'change_enter_cpt_title'));

		/*
		 * These are for the Recipient field
		 */
		wpcf7_add_shortcode('dd-cf7recipient', array(__CLASS__, 'descramble_recipient_address'));
		wpcf7_add_shortcode('dd_person_recipient_dropdown', array(__CLASS__, 'wpcf7_recipient_dropdown'));

		/*
		 * Adds a shortcode to dispaly this CPT
		 */
		//add_filter('wpcf7_form_elements', array(__CLASS__, 'descramble_recipient_address'));
		/*
		 * This changes the recipient from used in contact Form 7
		 */
		add_filter('wpcf7_mail_components', array(__CLASS__, 'modify_form_to_field'), 10, 3);
		//add_filter('wpcf7_posted_data', array(__CLASS__, 'modify_form_to_field'));

		add_shortcode('dd_person_recipient_dropdown', array(__CLASS__, 'wpcf7_recipient_dropdown'));

		add_shortcode(self::$cpt, array(__CLASS__, 'shortcode'));
	}

	function register_scripts() {
		wp_enqueue_script('dd-peoplemanager', plugins_url('js/dd-peoplemanager.js', __FILE__), array(), false, true);
	}

	function activate() {

		flush_rewrite_rules();

		$capability_type = self::$cpt;

		foreach (self::$allowed_roles as $role_level) {
			$role = get_role($role_level);
			/* If the role exists, add required capabilities for the plugin. */
			if (!empty($role)) {
				$role->add_cap("edit_{$capability_type}");
				$role->add_cap("read_{$capability_type}");
				$role->add_cap("delete_{$capability_type}");
				$role->add_cap("edit_{$capability_type}s");
				$role->add_cap("edit_others_{$capability_type}s");
				$role->add_cap("publish_{$capability_type}s");
				$role->add_cap("read_private_{$capability_type}s");
				$role->add_cap("delete_{$capability_type}s");
				$role->add_cap("delete_private_{$capability_type}s");
				$role->add_cap("delete_published_{$capability_type}s");
				$role->add_cap("delete_others_{$capability_type}s");
				$role->add_cap("edit_private_{$capability_type}s");
				$role->add_cap("edit_published_{$capability_type}s");
			}
		}
	}

	function deactivate() {

		flush_rewrite_rules();

		$capability_type = self::$cpt;

		foreach (self::$allowed_roles as $role_level) {
			$role = get_role($role_level);
			/* If the role exists, add required capabilities for the plugin. */
			if (!empty($role)) {
				$role->remove_cap("edit_{$capability_type}");
				$role->remove_cap("read_{$capability_type}");
				$role->remove_cap("delete_{$capability_type}");
				$role->remove_cap("edit_{$capability_type}s");
				$role->remove_cap("edit_others_{$capability_type}s");
				$role->remove_cap("publish_{$capability_type}s");
				$role->remove_cap("read_private_{$capability_type}s");
				$role->remove_cap("delete_{$capability_type}s");
				$role->remove_cap("delete_private_{$capability_type}s");
				$role->remove_cap("delete_published_{$capability_type}s");
				$role->remove_cap("delete_others_{$capability_type}s");
				$role->remove_cap("edit_private_{$capability_type}s");
				$role->remove_cap("edit_published_{$capability_type}s");
			}
		}
	}

	function register_custom_post_type() {
		$labels = array(
			'name'				 => self::$cpt_name_plural,
			'singular_name'		 => self::$cpt_name,
			'menu_name'			 => self::$cpt_name_plural,
			'name_admin_bar'	 => self::$cpt_name,
			'add_new'			 => 'Add New',
			'add_new_item'		 => 'Add New ' . self::$cpt_name,
			'new_item'			 => 'New ' . self::$cpt_name,
			'edit_item'			 => 'Edit ' . self::$cpt_name,
			'view_item'			 => 'View ' . self::$cpt_name,
			'all_items'			 => 'All ' . self::$cpt_name_plural,
			'search_items'		 => 'Search ' . self::$cpt_name_plural,
			'not_found'			 => 'No ' . strtolower(self::$cpt_name_plural) . ' found.',
			'not_found_in_trash' => 'No ' . strtolower(self::$cpt_name_plural) . ' found in Trash.',
		);
		register_post_type(self::$cpt, array(
			'labels'			 => $labels,
			'public'			 => true,
			'has_archive'		 => true,
			'rewrite'			 => array('slug' => 'person'),
			'capability_type'	 => 'post',
			'hierarchical'		 => false,
			'supports'			 => array('title', 'editor', 'thumbnail'),
			'capability_type'	 => self::$cpt,
			'map_meta_cap'		 => true,
			'menu_icon'			 => 'dashicons-businessman',
				)
		);
	}

	// Register Custom Taxonomy
	function register_custom_taxonomy() {

		$labels	 = array(
			'name'						 => 'Categories',
			'singular_name'				 => 'Category',
			'menu_name'					 => 'Categories',
			'all_items'					 => 'All Categories',
			'parent_item'				 => 'Parent Category',
			'parent_item_colon'			 => 'Parent Category:',
			'new_item_name'				 => 'New Category Name',
			'add_new_item'				 => 'Add New Category',
			'edit_item'					 => 'Edit Category',
			'update_item'				 => 'Update Category',
			'view_item'					 => 'View Category',
			'separate_items_with_commas' => 'Separate items with commas',
			'add_or_remove_items'		 => 'Add or remove categories',
		);
		$args	 = array(
			'labels'			 => $labels,
			'hierarchical'		 => true,
			'public'			 => true,
			'show_ui'			 => true,
			'show_admin_column'	 => true,
			'show_in_nav_menus'	 => false,
			'show_tagcloud'		 => true,
		);
		register_taxonomy(self::$taxonomy, array(DD_PeopleManager::$cpt), $args);
	}

	/*
	 * Changes "Set featured image" to "Set {self::$cpt_name}'s image"
	 */

	function custom_admin_post_thumbnail_html($content) {
		global $current_screen;
		if (is_object($current_screen) && self::$cpt == $current_screen->post_type)
			return $content = str_replace(__('Set featured image'), __('Set ' . strtolower(self::$cpt_name) . '\'s image'), $content);
		else
			return $content;
	}

	/*
	 * Changes the Title on the edit page for this CPT
	 */

	function change_enter_cpt_title($title) {
		global $post_type;

		if (is_admin() && self::$cpt == $post_type)
			return 'Enter ' . self::$cpt_name . '\'s name';

		return $title;
	}

	function shortcode($instance) {
		ob_start();
		if (is_array($instance) && $instance)
			extract($instance);
		if ($view && file_exists(__DIR__ . '/view_' . $view . '.php'))
			include(__DIR__ . '/view_' . $view . '.php');
		else
			include __DIR__ . '/view.php';
		$cont = ob_get_contents();
		ob_end_clean();
		return $cont;
	}

	function add_meta_boxes() {
		add_meta_box(
				self::$cpt . '_meta', self::$cpt_name . " Extras", array(__CLASS__, 'display_meta_boxes'), self::$cpt, 'side'
		);
	}

	function display_meta_boxes($post) {

		wp_nonce_field(plugin_basename(__FILE__), self::$cpt . '_meta_nonce');
		include dirname(__FILE__) . '/meta.php';
	}

	function save_meta_data($id) {
		if (empty($_POST[self::$cpt . '_meta_nonce']) || !wp_verify_nonce($_POST[self::$cpt . '_meta_nonce'], plugin_basename(__FILE__))) {
			return $id;
		}
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $id;
		}
		if (self::$cpt == $_POST['post_type']) {
			if (!current_user_can('edit_' . self::$cpt, $id)) {
				return $id;
			}
		} else {
			if (!current_user_can('edit_' . self::$cpt, $id)) {
				return $id;
			}
		}

		foreach (self::$custom_meta_fields as $field => $label) {
			$field_name	 = self::$cpt . '_' . $field;
			$plug		 = '';
			if (!empty($_POST[$field_name])) {
				$plug = trim(self::post($field_name));
			}
			delete_post_meta($id, $field_name);
			if ($plug) {
				add_post_meta($id, $field_name, $plug);
				update_post_meta($id, $field_name, $plug);
			}
		}
	}

	/*
	 * Makes grabbing $_POST values easier
	 * @author: James Cantrell
	 */

	function post($value, $default = "") {

		if (isset($_POST[$value])) {
			if (is_string($_POST[$value]))
				return ((get_magic_quotes_gpc() || true) ? stripslashes($_POST[$value]) : $_POST[$value]);
			else
				return $_POST[$value];
		}
		return $default;
	}
	function modify_form_to_field($components, $current_contact7_form, $this_wpcf7_mail) {
		if ($components->recipient == "[dd-cf7recipient]") {
			/* $components['recipient'] = descramble("daniel@divinedesigns.ca"); */
			$components['recipient'] = descramble(self::post('dd-cf7recipient'));
		}
		return $components;
	}
	
	function descramble_recipient_address($address) {
		//die(print_r($address,true));
//		print_r($address);
//		return 'daniel@divinedesigns.ca';//descramble($address);
		print_r(self::post('dd-cf7recipient'));
		return descramble(self::post('dd-cf7recipient'));
	}

	function wpcf7_recipient_dropdown() {
		$args = array('post_type'		 => self::$cpt,
			'post_status'	 => 'publish',
			'posts_per_page' => -1,
			'tax_query'		 => array(
				array(
					'taxonomy'	 => self::$taxonomy,
					'field'		 => 'slug',
					'terms'		 => 'contact'
				)
		));

		// The Query
		$the_query	 = new WP_Query($args);
		$return		 = "";
// The Loop
		$contacts	 = array();
		if ($the_query->have_posts()) {
			while ($the_query->have_posts()) {
				$the_query->the_post();
				$email		 = self::generateEmailKey(get_post_meta(get_the_ID(), self::$cpt . '_email', true));
				$name		 = get_the_title();
				$position	 = get_post_meta(get_the_ID(), self::$cpt . '_position', true);

				$contacts[$name] = array('email' => $email, 'name' => $name, 'position' => $position);
			}
		} else {
			// no posts found
		}
		/* Restore original Post Data */
		wp_reset_postdata();
		ksort($contacts);
		if (!empty($contacts)) {
			$return .= '<select name="dd-cf7recipient" class="recipient">';
			foreach ($contacts as $contact) {
				$return .= '<option value="' . $contact['email'] . '">' . html($contact['name']) . (!empty($contact['position']) ? ' - ' . html($contact['position']) : '') . '</option>';
			}
			$return .= '</select>';
		}
		return $return;
	}

	function disable_updates($value) {
		if (isset($value->response[plugin_basename(__FILE__)]))
			unset($value->response[plugin_basename(__FILE__)]);
		return $value;
	}

	function generateEmailKey($email) {
		static $emails	 = array();
		if (isset($emails[$email]))
			return $emails[$email];
		return $emails[$email]	 = scramble($email);
	}
	
	function wpcf7_mail_failed($contact_form){
	//	print_r($contact_form->get_current());
	}

}
