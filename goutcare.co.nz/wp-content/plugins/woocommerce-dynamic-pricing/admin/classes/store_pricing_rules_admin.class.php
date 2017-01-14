<?php
class woocommerce_store_pricing_rules_admin {
	public $category_admin;
	public $membership_admin;
	public $totals_admin;
	public $group_admin;

	public function __construct() {

		$this->category_admin = new woocommerce_category_pricing_rules_admin();
		$this->membership_admin = new woocommerce_membership_pricing_rules_admin();
		$this->group_admin = new woocommerce_group_pricing_rules_admin();
		$this->totals_admin = new woocommerce_totals_pricing_rules_admin();


		if (is_admin()) {
			add_action('admin_enqueue_scripts', array(&$this, 'enqueue'));
			add_action('admin_init', array(&$this, 'register_settings'));
			add_action('admin_menu', array(&$this, 'on_admin_menu'), 99);
		}
	}

	public function enqueue($hook) {
		global $post, $woocommerce;
		if ($hook == 'woocommerce_page_wc_dynamic_pricing'|| ( $post && $post->post_type == 'product') ) {
			if (floatval($woocommerce->version) >= 2.0) {
				wp_enqueue_style('woocommerce-pricing-admin', WC_Dynamic_Pricing::plugin_url() . '/assets/admin/admin.css');
				wp_enqueue_script('woocommerce-pricing-admin', WC_Dynamic_Pricing::plugin_url() . '/assets/admin/admin.js', array('jquery'));
			} else {
				wp_enqueue_style('woocommerce-pricing-admin', WC_Dynamic_Pricing::plugin_url() . '/assets/legacy/admin/admin.css');
				wp_enqueue_script('woocommerce-pricing-admin', WC_Dynamic_Pricing::plugin_url() . '/assets/legacy/admin/admin.js', array('jquery'));
			}
		}
	}

	public function on_admin_menu() {
		$show_in_menu = current_user_can('manage_woocommerce') ? 'woocommerce' : false;
		$slug = add_submenu_page($show_in_menu, __('Dynamic Pricing'), __('Dynamic Pricing'), 'manage_woocommerce', 'wc_dynamic_pricing', array(&$this, 'on_admin_page'));
	}

	public function on_admin_page() {
		$current_tab = (isset($_GET['tab'])) ? $_GET['tab'] : 'order totals';
		$current_view = (isset($_GET['view'])) ? $_GET['view'] : 0;
		?>
		<div class="wrap woocommerce">
			<div class="icon32 woocommerce-dynamic-pricing" id="icon-woocommerce"><br></div><h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
				<?php
				$tabs = apply_filters('woocommerce_dynamic_pricing_tabs', array(
				    'order totals' => array(
					array(
					    'title' => __('Order Totals Pricing', 'wc_pricing'),
					    'description' => 'Order Totals pricing allows you to configure price adjustments for the entire store based on the total order amount.  This is the last discount rule that will be applied.  If other discounts have been applied to cart items, these rules will not be applied to the cart.',
					    'function' => 'totals_tab'
					)
				    ),
				    'roles' => array(
					array(
					    'title' => __('Role Pricing', 'wc_pricing'),
					    'description' => 'Role pricing allows you to configure price adjustments for the entire store based on a users role.',
					    'function' => 'membership_tab'
					)
				    ),
				    'category' => array(
					array(
					    'title' => __('Category Pricing', 'wc_pricing'),
					    'description' => 'Use bulk category pricing to configure bulk price adjustments based on a product\'s category.  Bulk category pricing will take precedence over role pricing.',
					    'function' => 'basic_category_tab'
					),
					array(
					    'title' => __('Advanced Category Pricing', 'wc_pricing'),
					    'description' => 'Use advanced category pricing to configure price adjustemnts on items in a customers cart based on quantities.  Adjustments are calculated when the rule matches the configured quantities and will be applied to all items in the cart matching the selected category / categories.   
					     Advanced category adjustments take precedence over bulk category adjustments.',
					    'function' => 'advanced_category_tab'
					)
				    )
				));

				if (wc_dynamic_pricing_is_groups_active()) {
					$tabs['groups'] = array(
					    array(
						'title' => __('Group Pricing', 'wc_pricing'),
						'description' => 'Group pricing allows you to configure price adjustments for the entire store based on a users groups.',
						'function' => 'group_tab'
					    )
					);
				}

				foreach ($tabs as $name => $value) :
					echo '<a href="' . admin_url('admin.php?page=wc_dynamic_pricing&tab=' . $name) . '" class="nav-tab ';
					if ($current_tab == $name)
						echo 'nav-tab-active';
					echo '">' . ucfirst($name) . '</a>';
				endforeach;
				?>
			</h2>

			<?php if (sizeof($tabs[$current_tab]) > 0) : ?><ul class="subsubsub"><li><?php
				$links = array();
				foreach ($tabs[$current_tab] as $key => $tab) :
					$link = '<a href="admin.php?page=wc_dynamic_pricing&tab=' . $current_tab . '&amp;view=' . $key . '" class="';
					if ($key == $current_view)
						$link .= 'current';
					$link .= '">' . $tab['title'] . '</a>';
					$links[] = $link;
				endforeach;
				echo implode(' | </li><li>', $links);
				?></li></ul><br class="clear" /><?php endif; ?>

			<?php if (isset($tabs[$current_tab][$current_view])) : ?> 
				<?php if (!isset($tabs[$current_tab][$current_view]['hide_title']) || $tabs[$current_tab][$current_view]['hide_title'] != true) : ?>
					<div class="tab_top"><h3 class="has-help"><?php echo $tabs[$current_tab][$current_view]['title']; ?></h3>
						<?php if ($tabs[$current_tab][$current_view]['description']) : ?>
							<p class="help"><?php echo $tabs[$current_tab][$current_view]['description']; ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<?php
				$func = $tabs[$current_tab][$current_view]['function'];
				if ($func && method_exists($this, $func)) {
					$this->$func();
				}
				?>
			<?php endif; ?>
		</div>
		<?php
	}

	public function membership_tab() {
		$this->membership_admin->basic_meta_box();
	}

	public function group_tab() {
		$this->group_admin->basic_meta_box();
	}

	public function basic_category_tab() {
		$this->category_admin->basic_meta_box();
	}

	public function advanced_category_tab() {
		$this->category_admin->advanced_meta_box();
	}

	public function totals_tab() {
		$this->totals_admin->advanced_metabox();
	}

	public function register_settings() {
		register_setting('_s_membership_pricing_rules', '_s_membership_pricing_rules', array(&$this, 'on_store_settings_validation'));
		register_setting('_s_group_pricing_rules', '_s_group_pricing_rules', array(&$this, 'on_store_settings_validation'));

		register_setting('_a_category_pricing_rules', '_a_category_pricing_rules', array(&$this, 'on_category_settings_validation'));
		register_setting('_s_category_pricing_rules', '_s_category_pricing_rules', array(&$this, 'on_store_settings_validation'));

		register_setting('_a_totals_pricing_rules', '_a_totals_pricing_rules', array(&$this, 'on_totals_settings_validation'));
	}

	public function on_store_settings_validation($data) {
		$pricing_rules = array();
		$rules = array();
		if (isset($_POST['pricing_rules'])) {
			$pricing_rule_sets = $_POST['pricing_rules'];
			foreach ($pricing_rule_sets as $key => $rule_set) {
				$rules[$key] = $rule_set;
			}
			$data = $rules;
		} else {
			$data = array();
		}

		return $data;
	}

	public function on_store_category_settings_validation($data) {

		if (!isset($data['free_shipping'])) {
			$data['free_shipping'] = 'no';
		}

		return $data;
	}

	public function on_category_settings_validation($data) {
		$pricing_rules = array();
		$rules = array();
		if (isset($_POST['pricing_rules'])) {
			$pricing_rule_sets = $_POST['pricing_rules'];
			foreach ($pricing_rule_sets as $key => $rule_set) {
				$rules[$key] = $rule_set;
			}
			$data = $rules;
		} else {
			$data = array();
		}

		return $data;


		$pricing_rules = array();
		$rules = array();
		$message = '';


		if (isset($_POST['pricing_rules'])) {
			$pricing_rule_sets = $_POST['pricing_rules'];
			foreach ($pricing_rule_sets as $key => $rule_set) {

				if ($rule_set['rules_type'] == 'block') {
					$valid = true;
					$rules[$key] = $rule_set;
					$data = $rules;
				} else {
					$valid = true;
					foreach ($rule_set['rules'] as $rule) {
						if (isset($rule['adjust']) && !empty($rule['adjust']) && isset($rule['from']) && isset($rule['amount']) && !empty($rule['from']) && !empty($rule['amount'])) {

							if ($rule['from'] != '*' && $rule['adjust'] != '*' && intval($rule['adjust']) < intval($rule['from'])) {
								$valid = $valid & false;
								$message .= 'Invalid quantities configured';
							} else {
								$valid = $valid & true;
							}
						} else {
							$valid = $valid & false;
							$message .= 'You must enter values for all quantity and amount fields';
						}
					}

					if ($valid) {

						if (isset($rule_set['invalid'])) {
							unset($rules_set['invalid']);
						}

						$rules[$key] = $rule_set;
					} else {
						$rule_set['invalid'] = $message;
						$rules[$key] = $rule_set;

						add_settings_error('_a_category_pricing_rules', 'category-rule-invalid', $rule_set['invalid']);
					}

					$data = $rules;
				}
			}
		} else {

			$data = array();
		}

		return $data;
	}

	public function on_totals_settings_validation($data) {
		$pricing_rules = array();
		$rules = array();
		$message = '';

		if (isset($_POST['pricing_rules'])) {
			$pricing_rule_sets = $_POST['pricing_rules'];
			foreach ($pricing_rule_sets as $key => $rule_set) {
				$valid = true;

				foreach ($rule_set['rules'] as $rule) {
					if (isset($rule['to']) && !empty($rule['to']) && isset($rule['from']) && isset($rule['amount']) && !empty($rule['from']) && !empty($rule['amount'])) {

						if ($rule['from'] != '*' && $rule['to'] != '*' && intval($rule['to']) < intval($rule['from'])) {
							$valid = $valid & false;
							$message .= 'Invalid totals configured';
						} else {
							$valid = $valid & true;
						}
					} else {
						$valid = $valid & false;
						$message .= 'You must enter values for all total and amount fields';
					}
				}

				if ($valid) {

					if (isset($rule_set['invalid'])) {
						unset($rules_set['invalid']);
					}

					$rules[$key] = $rule_set;
				} else {
					$rule_set['invalid'] = $message;
					$rules[$key] = $rule_set;

					add_settings_error('_a_totals_pricing_rules', 'totals-rule-invalid', $rule_set['invalid']);
				}
			}

			$data = $rules;
		} else {

			$data = array();
		}

		return $data;
	}

	private function selected($value, $compare, $arg = true) {
		if (!$arg) {
			echo '';
		} else if ((string) $value == (string) $compare) {
			echo 'selected="selected"';
		}
	}

}
?>