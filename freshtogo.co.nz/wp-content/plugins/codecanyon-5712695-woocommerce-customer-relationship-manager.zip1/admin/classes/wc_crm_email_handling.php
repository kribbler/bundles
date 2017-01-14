<?php
/**
 * Class for E-mail handling.
 *
 * @author   Actuality Extensions
 * @package  WooCommerce_Customer_Relationship_Manager
 * @since    1.0
 */

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WC_Crm_Email_Handling {

	/**
	 * Displays form with e-mail editor.
	 */
	public static function display_form() {
		$recipients = array();
		$orders = array();
		if ( isset( $_REQUEST['order_id'] ) && !is_array( $_REQUEST['order_id'] ) ) { // if we have only one element, make it as array
			array_push( $orders, $_REQUEST['order_id'] );
		} else if ( isset( $_REQUEST['order_id'] ) ) {
			$orders = $_REQUEST['order_id'];
		}
		foreach ( $orders as $item ) {
			$o = new WC_Order( $item );
			array_push( $recipients, $o->billing_email );
		}
		?>
		<label for="recipients"><?php _e( 'Recipients', 'wc_customer_relationship_manager' ); ?></label><input
			type="text"
			name="recipients"
			value="<?php echo implode( ',', $recipients ); ?>"
			id="recipients"
			autocomplete="off"/>
		<br/>
		<label for="subject"><?php _e( 'Subject', 'wc_customer_relationship_manager' ); ?></label><input type="text"
		                                                                                                 name="subject"
		                                                                                                 value=""
		                                                                                                 id="subject"
		                                                                                                 autocomplete="on"/>
		<br/>
		<p>
			<?php
			global $woocommerce;
			$mailer = $woocommerce->mailer();
			echo sprintf( __( 'Email "From" name: <strong>%s (%s)</strong>', 'wc_customer_relationship_manager' ), $mailer->get_from_name(), $mailer->get_from_address() );
			?>
			&nbsp;<?php _e( sprintf( '<i>You can change the email address by clicking <a href="%s">here</a>.</i>', '?page=woocommerce_settings&tab=email' ), 'wc_customer_relationship_manager' ); ?></i>
		</p>
		<br/>
		<br/>
		<?php wp_editor( '', 'emaileditor' ); ?>
		<div id="emaileditor">
		</div>
		<input name="send" type="submit" class="button button-primary button-large" id="send" accesskey="p" value="Send"
		       style="margin-top: 10px;">
	<?php

	}

	/**
	 * Processes the form data.
	 */
	public static function process_form() {
		global $woocommerce, $wc_customer_relationship_manager;
		$recipients = explode( ',', $_POST['recipients'] );
		$text = $_POST['emaileditor'];
		$subject = $_POST['subject'];
		$mailer = $woocommerce->mailer();
		ob_start();
		wc_crm_custom_woocommerce_get_template( 'emails/customer-send-email.php', array(
			'email_heading' => $subject,
			'email_message' => $text
		) );
		$message = ob_get_clean();
		foreach ( $recipients as $r ) {
			if ( $mailer->send( $r, $subject, $message ) ) ;
		}
		echo __( 'Your email has been successfully sent.', 'wc_customer_relationship_manager' );
		echo "<br /><br /><a href='" . admin_url( 'admin.php?page=wc-customer-relationship-manager' ) . "'>" . __( 'Back', 'wc_customer_relationship_manager' ) . "</a>";
	}


}
