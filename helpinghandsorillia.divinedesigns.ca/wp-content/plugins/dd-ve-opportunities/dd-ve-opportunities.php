<?php

/*
  Plugin Name: Opportunities
  Plugin URI: http://www.divinedesigns.ca/
  Description: Adds a new Custom Post Type for the Opportunities
  Author: Daniel Roth
  Version: 1.0.0
  Author URI: http://www.divinedesigns.ca
 */

DD_VE_Opportunities::register_hooks();

class DD_VE_Opportunities {

	static $cpt				 = "dd_ve_opportunities";
	static $cpt_name		 = "Opportunity";
	static $cpt_name_plural	 = "Opportunities";
	static $taxonomy		 = "dd_ve_opportunities_type";
	static $allowed_roles	 = array('administrator');

	/*
	 * All cpt fields are CPT_fieldname
	 */
	static $custom_meta_fields = array(
		/* Sidebar */
		'contact_id'			 => array('label' => 'Contact Person', 'type' => 'custom_owner', 'position' => 'side'),
		'closing_date'		 => array('label' => 'Closing Date', 'type' => 'date', 'position' => 'side'),
		'hours'				 => array('label' => 'Hours', 'type' => 'text', 'position' => 'side'),
		'time_commitment'	 => array('label' => 'Time commitment', 'type' => 'text', 'position' => 'side'),
		'rate'				 => array('label' => 'Rate', 'type' => 'text', 'position' => 'side'),
		'supervision'		 => array('label' => 'Supervision', 'type' => 'text', 'position' => 'side'),
		/* 'job_call'			 => array('label' => 'Job Call', 'type' => 'text', 'position' => 'side'), */
		/* Normal Position (below content area) */
		'to_apply'			 => array('label' => 'To Apply', 'type' => 'text', 'position' => 'normal'),
		'duties'			 => array('label' => 'Duties/Responsibilities', 'type' => 'wysiwyg', 'position' => 'normal'),
		'qualifications'	 => array('label' => 'Qualifications', 'type' => 'wysiwyg', 'position' => 'normal'),
		'skills'			 => array('label' => 'Required Skills', 'type' => 'wysiwyg', 'position' => 'normal'),
		'ideal_candidate'	 => array('label' => 'Ideal Candidate', 'type' => 'wysiwyg', 'position' => 'normal'),
		'training'			 => array('label' => 'Training', 'type' => 'wysiwyg', 'position' => 'normal'),
		'benefits'			 => array('label' => 'Benefits', 'type' => 'wysiwyg', 'position' => 'normal'),
	);

	static function get_meta_boxes() {
		$meta_boxes = array();
		foreach (self::$custom_meta_fields as $field => $properties) {
			$meta_boxes[$properties['position']][$field] = $properties;
		}
		return $meta_boxes;
	}

	function register_hooks() {

		register_activation_hook(__FILE__, array(__CLASS__, 'activate'));
		register_deactivation_hook(__FILE__, array(__CLASS__, 'deactivate'));

		// Creates custom post types
		add_action('init', array(__CLASS__, 'register_custom_post_type'));
		add_action('init', array(__CLASS__, 'register_custom_taxonomy'), 0);

		add_action('add_meta_boxes', array(__CLASS__, 'add_meta_boxes'));

		add_action('save_post', array(__CLASS__, 'save_meta_data'));

		// Used to change the "Set featured image" text 
		add_filter('admin_post_thumbnail_html', array(__CLASS__, 'custom_admin_post_thumbnail_html'));

		add_filter('enter_title_here', array(__CLASS__, 'change_enter_cpt_title'));

		add_shortcode(self::$cpt, array(__CLASS__, 'shortcode'));

		add_filter('site_transient_update_plugins', array(__CLASS__, 'disable_updates'));
	}

	function activate() {

		self::register_custom_post_type();
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
			'rewrite'			 => array('slug' => 'opportunity'),
			'capability_type'	 => 'post',
			'hierarchical'		 => false,
			'supports'			 => array('title', 'editor', 'thumbnail'),
			'capability_type'	 => self::$cpt,
			'map_meta_cap'		 => true,
			'menu_icon'			 => 'dashicons-pressthis',
				)
		);
	}

	// Register Custom Taxonomy
	function register_custom_taxonomy() {

		$labels	 = array(
			'name'						 => 'Types of Jobs',
			'singular_name'				 => 'Type of Job',
			'menu_name'					 => 'Types of Jobs',
			'all_items'					 => 'All Types of Jobs',
			'parent_item'				 => 'Parent Job Type',
			'parent_item_colon'			 => 'Parent Job Type:',
			'new_item_name'				 => 'New Job Type Name',
			'add_new_item'				 => 'Add New Job Type',
			'edit_item'					 => 'Edit Job Type',
			'update_item'				 => 'Update Job Type',
			'view_item'					 => 'View Job Type',
			'separate_items_with_commas' => 'Separate items with commas',
			'add_or_remove_items'		 => 'Add or remove job types',
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
		register_taxonomy(self::$taxonomy, array(self::$cpt), $args);
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
			return 'Title/Position';

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
		$meta_boxes = self::get_meta_boxes();
		foreach ($meta_boxes as $position => $meta_fields) {
			if (!empty($position)) {
				if ($position != "side") {
					foreach ($meta_fields as $key => $data) {
						$data['own_box'] = true;
						add_meta_box(
								self::$cpt . '_meta_' . $key, $data['label'], array(__CLASS__, 'display_meta_boxes'), self::$cpt, $position, '', array('meta_fields' => array($key => $data))
						);
					}
				} else {
					add_meta_box(
							self::$cpt . '_meta_' . $position, self::$cpt_name . " Extras", array(__CLASS__, 'display_meta_boxes'), self::$cpt, $position, '', array('meta_fields' => $meta_fields)
					);
				}
			}
		}
	}

	function display_meta_boxes($post, $fields) {
		$meta_fields = $fields['args']['meta_fields'];
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

		foreach (self::$custom_meta_fields as $field => $properties) {

			$field_name	 = self::$cpt . '_' . $field;
			$plug		 = '';
			/*
			 * Because the date field is displayed on the front end in multiple boxes
			 * here on the back end we can't just check if one field is empty thus the extra check
			 */
			if ($properties['type'] == 'date' || !empty($_POST[$field_name])) {
				$plug = trim(self::post($field_name));
				switch ($properties['type']) {
					case 'link':
						$plug	 = esc_url_raw($plug);
						break;
					case 'date':
						$mm		 = (int) self::post($field_name . '_mm'); //.'04';
						$jj		 = (int) self::post($field_name . '_jj'); //.'07';
						$aa		 = (int) self::post($field_name . '_aa'); //.'2015';
						$hh		 = (int) self::post($field_name . '_hh'); //.'22';
						$mn		 = (int) self::post($field_name . '_mn'); //.'16';
						$ss		 = (int) self::post($field_name . '_ss'); //.'13';

						$date	 = strtotime(zeroise($aa, 4) . '-' . zeroise($mm, 2) . '-' . zeroise($jj, 2) . ' ' . zeroise($hh, 2) . ':' . zeroise($mn, 2) . ':' . zeroise($ss, 2));
						if ($date)
							$plug	 = date('Y-m-d H:i:s', $date);
						else
							$plug	 = "";
						break;
					case 'custom_owner':
						$plug	 = (int) $plug;
						break;
					case 'wysiwyg':
						$plug	 = wp_kses_post($plug);
						break;
				}
			}
			delete_post_meta($id, $field_name);
			if ($plug) {
				add_post_meta($id, $field_name, $plug);
				update_post_meta($id, $field_name, $plug);
			}
		}
		//die(get_post_meta($id, self::$cpt . '_' . 'to_apply'));
		//die('check logs');
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

	function disable_updates($value) {
		if (isset($value->response[plugin_basename(__FILE__)]))
			unset($value->response[plugin_basename(__FILE__)]);
		return $value;
	}

}
