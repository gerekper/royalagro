<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<h2 id="start-conversation"><?php _e( 'Need Help?', 'woocommerce-help-scout' ); ?></h2>

<p><?php echo apply_filters( 'woocommerce_help_scout_conversation_form_description', __( 'Do you have a query about your order, or need a hand with getting your products set up? If so, please fill in the form below.', 'woocommerce-help-scout' ) ); ?></p>

<form method="post" id="order_conversation_form_1" class="wc-helpscout-order-conversation-form" enctype="multipart/form-data" data-inc="1">
	<?php do_action( 'woocommerce_help_scout_conversation_form_start' ); ?>

	<p class="form-row form-row-wide">
		<label for="conversation-subject"><?php _e( 'Subject', 'woocommerce-help-scout' ); ?> <span class="required">*</span></label>
		<input type="text" class="input-text conversation-field" name="conversation_subject" id="conversation-subject" required="required" />
	</p>

	<p class="form-row form-row-wide">
		<label for="conversation-description"><?php _e( 'Description', 'woocommerce-help-scout' ); ?> <span class="required">*</span></label>
		<textarea name="conversation_description" class="conversation-field" id="conversation-description" rows="10" cols="50" required="required"></textarea>
	</p>
	<div id="order-conversation-file-1" class="pluploder-ui-input">
			<p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
		</div>
		<br>

	<?php do_action( 'woocommerce_help_scout_conversation_form' ); ?>

	<p class="form-row">
		<input type="hidden" name="uploaded_files" id="order_conversation_uploaded_files_1" value="" >
		<input type="hidden" class="conversation-field" name="conversation_order_id" id="conversation-order-id" value="<?php echo intval( $order_id ); ?>" />
		<input type="submit" class="button" name="conversation_send" value="<?php _e( 'Send', 'woocommerce-help-scout' ); ?>" />
	</p>

	<?php do_action( 'woocommerce_help_scout_conversation_form_end' ); ?>
</form>
