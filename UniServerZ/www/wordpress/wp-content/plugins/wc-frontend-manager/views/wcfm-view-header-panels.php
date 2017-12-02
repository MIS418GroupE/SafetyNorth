<?php
/**
 * WCFM plugin view
 *
 * WCFM Header Panels View
 *
 * @author 		WC Lovers
 * @package 	wcfm/view
 * @since     2.3.2
 */

global $WCFM, $wpdb, $wp;

$wcfm_options = get_option('wcfm_options');

$is_headpanel_disabled = isset( $wcfm_options['headpanel_disabled'] ) ? $wcfm_options['headpanel_disabled'] : 'no';
if( $is_headpanel_disabled == 'yes' ) return;

$wcfm_is_allow_headpanels = apply_filters( 'wcfm_is_allow_headpanels', true );
if( !$wcfm_is_allow_headpanels ) {
	return;
}

$unread_notice = $WCFM->frontend->wcfm_direct_message_count( 'notice' );
$unread_message = $WCFM->frontend->wcfm_direct_message_count( 'message' ); 
$unread_enquiry = $WCFM->frontend->wcfm_direct_message_count( 'enquiry' );

?>

<div class="wcfm_header_panel">
  <?php do_action( 'wcfm_before_header_panel_item' ); ?>
  
  <?php if( apply_filters( 'wcfm_is_pref_notice', true ) && apply_filters( 'wcfm_is_allow_notice', true ) ) { ?>
    <a href="<?php echo get_wcfm_notices_url( ); ?>" class="fa fa-bullhorn text_tip <?php if( isset( $wp->query_vars['wcfm-notices'] ) || isset( $wp->query_vars['wcfm-notice-manage'] ) || isset( $wp->query_vars['wcfm-notice-view'] ) ) echo 'active'; ?>" data-tip="<?php _e( 'Notice Board', 'wc-frontend-manager' ); ?>"><?php if( wcfm_is_vendor() ) { ?><span class="unread_notification_count notice_count"><?php echo $unread_notice; ?></span><?php } ?></a>
  <?php } ?>
  
  <?php 
   if( apply_filters( 'wcfm_is_pref_direct_message', true ) && apply_filters( 'wcfm_is_allow_direct_message', true ) ) {
   	 if( WCFM_Dependencies::wcfmu_plugin_active_check() ) {
  ?>
    <a href="<?php echo get_wcfm_messages_url( ); ?>" class="fa fa-send-o text_tip <?php if( isset( $wp->query_vars['wcfm-messages'] ) ) echo 'active'; ?>" data-tip="<?php _e( 'Message Board', 'wc-frontend-manager' ); ?>"><span class="unread_notification_count message_count"><?php echo $unread_message; ?></span></a>
  <?php 
  	 } else {
				if( $is_wcfmu_inactive_notice_show = apply_filters( 'is_wcfmu_inactive_notice_show', true ) ) {
					?>
					<span class="fa fa-send-o text_tip" data-tip="<?php wcfmu_feature_help_text_show( __( 'Message Board', 'wc-frontend-manager' ), false, true ); ?>"></span>
					<?php
				}
			}
    }
  ?>
  
  <?php if( apply_filters( 'wcfm_is_pref_enquiry', true ) && apply_filters( 'wcfm_is_allow_enquiry', true ) ) { ?>
    <a href="<?php echo get_wcfm_enquiry_url(); ?>" class="fa fa-question-circle-o text_tip <?php if( isset( $wp->query_vars['wcfm-enquiry'] ) || isset( $wp->query_vars['wcfm-enquiry-manage'] ) ) echo 'active'; ?>" data-tip="<?php _e( 'Enquiry Board', 'wc-frontend-manager' ); ?>"><span class="unread_notification_count enquiry_count"><?php echo $unread_enquiry; ?></span></a>
  <?php } ?>
  
  <?php if( apply_filters( 'wcfm_is_pref_knowledgebase', true ) && apply_filters( 'wcfm_is_allow_knowledgebase', true ) ) { ?>
    <a href="<?php echo get_wcfm_knowledgebase_url(); ?>" class="fa fa-book text_tip <?php if( isset( $wp->query_vars['wcfm-knowledgebase'] ) || isset( $wp->query_vars['wcfm-knowledgebase-manage'] ) ) echo 'active'; ?>" data-tip="<?php _e( 'Knowledgebase', 'wc-frontend-manager' ); ?>"></a>
  <?php } ?>
  
  <?php if( apply_filters( 'wcfm_is_pref_profile', true ) && apply_filters( 'wcfm_is_allow_profile', true ) ) { ?>
    <a href="<?php echo get_wcfm_profile_url(); ?>" class="fa fa-user fa-user-circle-o text_tip <?php if( isset( $wp->query_vars['wcfm-profile'] ) ) echo 'active'; ?>" data-tip="<?php _e( 'Profile', 'wc-frontend-manager' ); ?>"></a>
  <?php } ?>
  
  <?php do_action( 'wcfm_after_header_panel_item' ); ?>
  
  <a href="<?php echo esc_url(wp_logout_url( apply_filters( 'wcfm_logout_url', get_wcfm_url() ) ) ); ?>" class="fa fa-power-off text_tip" data-tip="<?php _e( 'Logout', 'wc-frontend-manager' ); ?>"></a>
</div>