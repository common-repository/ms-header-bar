<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<iframe id="ms-header-form-iframe" name="ms_header_form_iframe" no-referrer></iframe>
<form class="ms-header-form" id="ms-header-form-<?=$header_bar_id;?>"  action="" method="post" autocomplete="off" target="ms_header_form_iframe" validate>
	<div class="ms-header-form-input">
		<input type="email" name="header_form_email" placeholder="Your Email" />
	</div>
	<div class="ms-header-form-input">
		<input type="Submit" name="header_form_submit" value="Submit" />
	</div>
</form>
<?php if(get_field('ms_header_enable_coupon_code', $header_bar_id)) : ?>
			<div class="ms-header-coupon" style="display: none;">
				<span><?php echo  get_field('ms_header_the_coupon_code', $header_bar_id);?></span>
			</div>
<?php endif; ?>
<?php

if ( isset( $_POST['header_form_submit'] ) ){
	$user_email = sanitize_email($_POST['header_form_email']);
	 global $wpdb;
	 $header_subscribers = $wpdb->prefix . 'ms_header_form';
	  $ms_header_data=array(
            'ms_header_form_email' => $user_email,
            'ms_header_ref'	=> 'msh-header-bar',
            'ms_header_post_id'	=>$header_bar_id,
            'ms_header_form_time' => current_time( mysql )
        );
      $wpdb->insert( $header_subscribers, $ms_header_data);

      $extract_header_email = explode("@", $user_email);
	  $header_username = $extract_header_email[0];
      $header_email_to = $user_email;
      $header_email_subject = "Promotion Offer";

       $header_email_body = "Hi {$header_username}, Thank you for subscribing.";

        $headers = array("Content-Type: text/html; charset = utf-8");
        wp_mail( $header_email_to, $header_email_subject, $header_email_body, $headers );
}

/*function ms_header_form_sub(){
	$user_email = $_POST['email'];
	 global $wpdb;
	 $header_subscribers = $wpdb->prefix . 'ms_popup_submit';
	  $ms_header_data=array(
            'ms_popup_email' => $user_email,
            'ms_popup_ref'	=> 'header-bar',
            'ms_popup_time' => current_time( mysql );
        );
        $wpdb->insert( $header_subscribers, $ms_header_data);
        return true;
}


add_action( 'wp_ajax_ms_header_form_sub', 'ms_header_form_sub' );
add_action( 'wp_ajax_nopriv_ms_header_form_sub', 'ms_header_form_sub' );

*/
?>