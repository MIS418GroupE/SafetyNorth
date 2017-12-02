<?php
/**
 * WCFM plugin controllers
 *
 * Plugin Vendors Controller
 *
 * @author 		WC Lovers
 * @package 	wcfm/vendors/controllers
 * @version   3.2.1
 */

class WCFM_Vendors_Controller {
	
	public function __construct() {
		global $WCFM;
		
		$this->processing();
	}
	
	public function processing() {
		global $WCFM, $wpdb, $_POST;
		
		$length = $_POST['length'];
		$offset = $_POST['start'];
		
		$search = '';
		if( isset( $_POST['search'] ) && !empty( $_POST['search']['value'] )) $search = $_POST['search']['value'];
		
		$report_for = '7day';
		if( isset($_POST['report_for']) && !empty($_POST['report_for']) ) {
			$report_for = $_POST['report_for'];
		}
		
		$wcfm_vendors_array = $WCFM->wcfm_vendor_support->wcfm_get_vendor_list( true, $offset, $length, $search );
		unset($wcfm_vendors_array[0]);
		
		// Get Vendor Count
		$wcfm_all_vendors = $WCFM->wcfm_vendor_support->wcfm_get_vendor_list( true, '', '', $search );
		unset($wcfm_all_vendors[0]);
		
		$admin_fee_mode = apply_filters( 'wcfm_is_admin_fee_mode', false );
		
		// Generate Vendors JSON
		$wcfm_vendors_json = '';
		$wcfm_vendors_json = '{
															"draw": ' . $_POST['draw'] . ',
															"recordsTotal": ' . count( $wcfm_all_vendors ) . ',
															"recordsFiltered": ' . count( $wcfm_vendors_array ) . ',
															"data": ';
		if(!empty($wcfm_vendors_array)) {
			$index = 0;
			$wcfm_vendors_json_arr = array();
			foreach($wcfm_vendors_array as $wcfm_vendors_id => $wcfm_vendors_name ) {
				
				// Name
				$wcfm_vendors_json_arr[$index][] =  '<span class="wcfm_dashboard_item_title">' . $wcfm_vendors_name . '</span>';
				
				// Shop Name
				$wcfm_vendors_json_arr[$index][] =  '<span class="wcfm_vendor_store">' . $WCFM->wcfm_vendor_support->wcfm_get_vendor_store_by_vendor( $wcfm_vendors_id ) . '</span>';
				
				// Gross Sales
				$gross_sales = $WCFM->wcfm_vendor_support->wcfm_get_gross_sales_by_vendor( $wcfm_vendors_id, $report_for );
				$wcfm_vendors_json_arr[$index][] = wc_price( $gross_sales );
				
				// Earned Commission
				$earned = $WCFM->wcfm_vendor_support->wcfm_get_commission_by_vendor( $wcfm_vendors_id, $report_for );
				if( $admin_fee_mode ) {
					$earned = $gross_sales - $earned;
				}
				$wcfm_vendors_json_arr[$index][] = wc_price( $earned );

				// Received Commission
				$received_commission = $WCFM->wcfm_vendor_support->wcfm_get_commission_by_vendor( $wcfm_vendors_id, $report_for, true );
				if( $admin_fee_mode ) {
					$net_paid_sales = $WCFM->wcfm_vendor_support->wcfm_get_gross_sales_by_vendor( $wcfm_vendors_id, $report_for, true );
					$received_commission = $net_paid_sales - $received_commission;
				}
				$wcfm_vendors_json_arr[$index][] = wc_price( $received_commission );

				// Action
				/*$actions = '';
				if( $wcfm_vendors_single->post_status == 'publish' ) {
				  $actions .= ( current_user_can( 'edit_published_shop_vendors' ) ) ? '<a class="wcfm-action-icon" href="' . get_wcfm_vendors_manage_url($wcfm_vendors_single->ID) . '"><span class="fa fa-edit text_tip" data-tip="' . esc_attr__( 'Edit', 'wc-frontend-manager' ) . '"></span></a>' : '';
				} else {
					$actions .= ( current_user_can( 'edit_shop_vendors' ) ) ? '<a class="wcfm-action-icon" href="' . get_wcfm_vendors_manage_url($wcfm_vendors_single->ID) . '"><span class="fa fa-edit text_tip" data-tip="' . esc_attr__( 'Edit', 'wc-frontend-manager' ) . '"></span></a>' : '';
				}
				$wcfm_vendors_json_arr[$index][] = apply_filters ( 'wcfm_vendors_actions', $actions, $wcfm_vendors_single );*/
				
				$index++;
			}												
		}
		if( !empty($wcfm_vendors_json_arr) ) $wcfm_vendors_json .= json_encode($wcfm_vendors_json_arr);
		else $wcfm_vendors_json .= '[]';
		$wcfm_vendors_json .= '
													}';
													
		echo $wcfm_vendors_json;
	}
}