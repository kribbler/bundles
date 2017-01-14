<?php
/**
 * Logic related to displaying CRM page.
 *
 * @author   Actuality Extensions
 * @package  WooCommerce_Customer_Relationship_Manager
 * @since    1.0
 */

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once( 'classes/wc_crm_customers_table.php' );
require_once( 'classes/wc_crm_email_handling.php' );

function wc_customer_relationship_manager_add_options() {
	global $wc_crm_customers_table;
	$option = 'per_page';
	$args = array(
		'label' => __( 'Customers', 'wc_customer_relationship_manager' ),
		'default' => 20,
		'option' => 'customers_per_page'
	);
	add_screen_option( $option, $args );
	$wc_crm_customers_table = new WC_Crm_Customers_Table();
}

/**
 * Gets template for emailing customers.
 *
 * @param $template_name
 * @param array $args
 */
function wc_crm_custom_woocommerce_get_template( $template_name, $args = array() ) {

	if ( $args && is_array( $args ) )
		extract( $args );

	$located = dirname( __FILE__ ) . '/templates/' . $template_name;

	do_action( 'woocommerce_before_template_part', $template_name, '', $located, $args );

	include( $located );

	do_action( 'woocommerce_after_template_part', $template_name, '', $located, $args );

}

/**
 * Renders CRM page.
 */
function wc_customer_relationship_manager_render_list_page() {
	global $wc_crm_customers_table;
	echo '<div class="wrap" id="wc-crm-page"><div class="icon32"><img src="' . plugins_url( 'assets/img/customers-icons.png', dirname( __FILE__ ) ) . '" width="29" height="29" /></div><h2>' . __( 'Customer Relationship Manager', 'wc_customer_relationship_manager' ) . '</h2>';
	?>
	<form method="post">
		<input type="hidden" name="page" value="wc-customer-relationship-manager">
		<?php
		if ( isset( $_POST['send'] ) && isset( $_POST['recipients'] ) && isset( $_POST['emaileditor'] ) && isset( $_POST['subject'] ) ) {
			WC_Crm_Email_Handling::process_form();
		} else if ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'email' ) {
			WC_Crm_Email_Handling::display_form();
		} else {
			$wc_crm_customers_table->prepare_items();
			$wc_crm_customers_table->display();
		}
		?>
	</form></div>
<?php
}
