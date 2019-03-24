<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>
<section class="woocommerce-customer-details">
<!-- MAPEAMENTO DO ORDER DETAILS CUSTOMER > SECTION WOOCOMMERCE-CUSTOMER-DETAILS - INÍCIO -->
<?php echo '<h3 style="background-color:#f3f3f3;color:red">Início da abertura da 1a tag section, (linha 24), classe woocommerce-customer-details.</h3><p style="background-color:#f3f3f3;color:red;">order-details-customer.php</p><hr/>▽'; ?>

	<?php if ( $show_shipping ) : ?>

	<section class="woocommerce-columns woocommerce-columns--2 woocommerce-columns--addresses col2-set addresses">
	<!-- MAPEAMENTO DO ORDER DETAILS CUSTOMER > SECTION ADRESSES - INÍCIO -->
	<?php echo '<h3 style="background-color:#f3f3f3;color:red">Início da abertura da 2a tag section, (linha 31), classe addresses.</h3><p style="background-color:#f3f3f3;color:red;">order-details-customer.php</p>▽<hr/>'; ?>

		<div class="woocommerce-column woocommerce-column--1 woocommerce-column--billing-address col-1">

	<?php endif; ?>

	<h2 class="woocommerce-column__title"><?php esc_html_e( 'Billing address', 'woocommerce' ); ?></h2>

	<address>
		<?php echo wp_kses_post( $order->get_formatted_billing_address( __( 'N/A', 'woocommerce' ) ) ); ?>

		<?php if ( $order->get_billing_phone() ) { ?>
			<p class="woocommerce-customer-details--phone"><b>Telefone:</b> <?php echo esc_html( $order->get_billing_phone() ); ?>
		<?php }; ?>

		<?php if ( $order->get_billing_email() ) { ?>
			<!-- <p class="woocommerce-customer-details--email"> --></br><b>email:</b> <?php echo esc_html( $order->get_billing_email() ); ?></p>
		<?php } else { ?>
			</p>
		<?php }; ?>
	</address>

	<?php if ( $show_shipping ) : ?>

		</div><!-- /.col-1 -->

		<div class="woocommerce-column woocommerce-column--2 woocommerce-column--shipping-address col-2">
			<h2 class="woocommerce-column__title"><?php esc_html_e( 'Shipping address', 'woocommerce' ); ?></h2>
			<address>
				<?php echo wp_kses_post( $order->get_formatted_shipping_address( __( 'N/A', 'woocommerce' ) ) ); ?>
			</address>
		</div><!-- /.col-2 -->

	<?php echo '<h3 style="background-color:#f3f3f3;color:red">Final da abertura da 2a tag section, (linha 31), classe addresses.</h3><p style="background-color:#f3f3f3;color:red;">order-details-customer.php</p>△<hr/>' ?>
	<!-- MAPEAMENTO DO ORDER DETAILS CUSTOMER > SECTION ADRESSES - FINAL -->
	</section><!-- /.col2-set -->

	<?php endif; ?>

	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

<?php echo '<h3 style="background-color:#f3f3f3;color:red">Final da 1a tag section, (linha 69), classe woocommerce-customer-details.</h3><p style="background-color:#f3f3f3;color:red;">order-details-customer.php</p><hr/>△' ?>
<!-- MAPEAMENTO DO ORDER DETAILS CUSTOMER > SECTION WOOCOMMERCE-CUSTOMER-DETAILS - FINAL -->
</section>
