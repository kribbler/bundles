<?php

/*
  Plugin Name: Useful Links
  Plugin URI: http://www.divinedesigns.ca/
  Description: Adds a new Custom Post Type for the Useful Links
  Author: Daniel Roth
  Version: 1.0.0
  Author URI: http://www.divinedesigns.ca
 */

DD_UsefulLinks::register_hooks();

class DD_UsefulLinks {

	static $cpt				 = "dd_usefullinks";
	static $cpt_name		 = "Useful Link";
	static $cpt_name_plural	 = "Useful Links";
	static $allowed_roles	 = array('administrator');

	/*
	 * All cpt fields are CPT_fieldname
	 */
	static $custom_meta_fields = array(
		'link' => 'Organization\'s Link',
	);

	function register_hooks() {

		register_activation_hook(__FILE__, array(__CLASS__, 'activate'));
		register_deactivation_hook(__FILE__, array(__CLASS__, 'deactivate'));

		// Creates custom post types
		add_action('init', array(__CLASS__, 'register_custom_post_type'));

		add_action('add_meta_boxes', array(__CLASS__, 'add_meta_boxes'));

		add_action('save_post', array(__CLASS__, 'save_meta_data'));

		// Used to change the "Set featured image" text 
		add_filter('admin_post_thumbnail_html', array(__CLASS__, 'custom_admin_post_thumbnail_html'));

		add_filter('enter_title_here', array(__CLASS__, 'change_enter_cpt_title'));

		add_shortcode(self::$cpt, array(__CLASS__, 'shortcode'));
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
			'rewrite'			 => array('slug' => 'useful-link'),
			'capability_type'	 => 'post',
			'hierarchical'		 => false,
			'supports'			 => array('title', 'editor', 'thumbnail'),
			'capability_type'	 => self::$cpt,
			'map_meta_cap'		 => true,
			'menu_icon'			 => 'dashicons-admin-links',
				)
		);
	}

	/*
	 * Changes "Set featured image" to "Set {self::$cpt_name}'s image"
	 */

	function custom_admin_post_thumbnail_html($content) {
		global $current_screen;
		if (is_object($current_screen) && self::$cpt == $current_screen->post_type)
			return $content = str_replace(__('Set featured image'), __('Set organization\'s logo'), $content);
		else
			return $content;
	}

	/*
	 * Changes the Title on the edit page for this CPT
	 */

	function change_enter_cpt_title($title) {
		global $post_type;

		if (is_admin() && self::$cpt == $post_type)
			return 'Organization\'s name';

		return $title;
	}

	function shortcode($instance) {
		ob_start();
		if (is_array($instance) && $instance)
			extract($instance);
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
				$plug	 = trim(self::post($field_name));
				if ($field == "link")
					$plug	 = esc_url_raw($plug);
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

}
