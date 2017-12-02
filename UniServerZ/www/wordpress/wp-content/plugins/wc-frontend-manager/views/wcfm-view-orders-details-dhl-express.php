<?php
/**
 * WCFM plugin view
 *
 * WCFM Order Details DHL Express View
 *
 * @author 		WC Lovers
 * @package 	wcfm/view
 * @version   3.3.3
 */

$wcfm_is_allow_orders = apply_filters( 'wcfm_is_allow_orders', true );
if( !$wcfm_is_allow_orders ) {
	return;
}

global $WCFM, $woodhlwrapperadmin;

if( WCFM_Dependencies::wcfm_wc_dhl_shipping_active_check() ) {
	if ( ! class_exists( 'wcfm_dhl_woocommerce_shipping_admin' ) ) {
		include_once $WCFM->plugin_path . 'includes/libs/dhl-express/class-wcfm-dhl-woocommerce-shipping-admin.php';
	
		$woodhlwrapperadmin = new wcfm_dhl_woocommerce_shipping_admin();
		//$packages	=	$woodhlwrapperadmin->wf_dhl_generate_packages();
	}
}

add_action( 'end_wcfm_orders_details', 'wcfm_orders_details_dhl_express', 9 );

function wcfm_orders_details_dhl_express() { 
	global $wp, $WCFM, $woodhlwrapperadmin;
	
	$order_id = 0;
	if( isset( $wp->query_vars['wcfm-orders-details'] ) && !empty( $wp->query_vars['wcfm-orders-details'] ) ) {
		$order_id = $wp->query_vars['wcfm-orders-details'];
	}
	if( !$order_id ) return;
	
	$theorder = wc_get_order( $order_id );
	
	?>
	
	<div class="wcfm-clearfix"></div><br />
	<!-- collapsible -->
	<div class="page_collapsible wc_dhl_shipping" id="wcfm_wc_dhl_shipping_options"><?php _e('DHL Express', 'wc-frontend-manager'); ?><span></span></div>
	<div class="wcfm-container">
		<div id="wc_dhl_shipping_expander" class="wcfm-content">
			<?php
			if( $woodhlwrapperadmin )
				$woodhlwrapperadmin->wf_dhl_metabox_content( $order_id );
			?>
			<div class="wcfm-clearfix"></div>
		</div>
	</div>
	
	<?php
}