<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$header_bar_id = $msh_header_atts['id'];
if(get_field('ms_header_use_target_countries', $header_bar_id )){
			if (!empty($_SERVER['HTTP_CLIENT_IP'])){  //check ip from share internet
		      $ip=$_SERVER['HTTP_CLIENT_IP'];
		    }
		    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){  //to check ip is pass from proxy		    {
		      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		    }
		    else{
		      $ip=$_SERVER['REMOTE_ADDR'];
		    }
		    $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
			$coun_code = $details->country;
			$is_country = false;
		    $ms_popup_target_coun = get_field('ms_header_target_countries', $header_bar_id );
		    foreach ($ms_popup_target_coun as $key => $country) {
		    	if($country==$coun_code){
		    		$is_country = true;
		    		break;
		    	}
		    }
		   if(!$is_country){
		    	exit; // Exit if accessed directly.
		    }
}

include( dirname(__FILE__) . '/ms-header-bar-style.php' );
	
 
	$ms_header_data[$header_bar_id] = array(
						'position' => get_field('ms_header_position', $header_bar_id),
						'screen_size' => get_field( 'ms_header_screen_size_to_display', $header_bar_id ),
						'time' => get_field( 'ms_header_delay_to_show', $header_bar_id ),
						'expire_year' => get_field('ms_header_countdown_expire_year', $header_bar_id),
						'expire_month' => get_field('ms_header_countdown_expire_month', $header_bar_id),
						'expire_days' => get_field('ms_header_countdown_expire_days', $header_bar_id),
						'expire_hours' => get_field('ms_header_countdown_expire_hours', $header_bar_id),
						'expire_min' => get_field('ms_header_countdown_expire_min', $header_bar_id),
						'expire_sec' => get_field('ms_header_countdown_expire_sec', $header_bar_id)
					);
	 wp_localize_script( 'ms-header-main_js', 'ms_header_data', $ms_header_data );

?>

<div class="ms-header-bar ms-header-whole" id="ms-header-<?php echo $header_bar_id; ?>" data-postid="<?php echo $header_bar_id; ?>">
	<div class="ms-header-bar-content">

		<?php if(get_field('ms_header_title', $header_bar_id)): ?>
			<div class="ms-header-bar-title ms-header-cont-sec">
				<?php echo get_field('ms_header_title', $header_bar_id); ?>
			</div>
		<?php endif; ?>

		<?php if(!get_field('ms_header_use_form_or_anything_custom', $header_bar_id) && !get_field('ms_header_use_call_back_form', $header_bar_id)) : ?>
			<div class="ms-header-btn ms-header-cont-sec">
				<a href="<?php echo get_field('ms_haeder_button_redirect_url', $header_bar_id); ?>" class="ms-header-btn-link">
					<?php echo get_field('ms_header_button_text', $header_bar_id); ?>
				</a>
			</div>
		<?php endif; ?>

		<?php if(get_field('ms_header_use_form_or_anything_custom', $header_bar_id)): ?>
			<div class="ms-header-custom-form ms-header-cont-sec">
				<?php include( dirname(__FILE__) . '/ms-header-bar-form.php' ); ?>
			</div>
		<?php endif; ?>

		<?php if(get_field('ms_header_use_call_back_form', $header_bar_id)): ?>
			<div class="ms-header-callback-form ms-header-cont-sec">
				<?php include( dirname(__FILE__) . '/ms-header-bar-callback.php' ); ?>
			</div>
		<?php endif; ?>

		<?php if(get_field('ms_header_social_sharing_option', $header_bar_id)):
			$social_sharing_buttons = get_field('ms_header_sharing_buttons', $header_bar_id);
			$social_sharing_btn_type = get_field('ms_header_social_button_type', $header_bar_id);
			$social_sharing_page_url = get_field('ms_header_social_page_url', $header_bar_id);
			?>
			<div class="ms-header-social-icon ms-header-cont-sec">
				<?php if( in_array('facebook', $social_sharing_buttons ) ): ?>
					<a href="<?php if( $social_sharing_btn_type == 'share' ): ?>https://www.facebook.com/sharer/sharer.php?u=<?php if( $social_sharing_page_url ) { echo $social_sharing_page_url; } ?>%2F&src=sdkpreparse<?php endif; ?><?php if( ( $social_sharing_btn_type == 'follow' ) && (get_field('ms_header_social_page_follow_fb', $header_bar_id ) ) ){ echo get_field('ms_header_social_page_follow_fb', $header_bar_id ); }?>" target="_blank" class= "ms-popup-sharing-icon">
				  <i class="ms-fab ms-fa-facebook ms-popup-social-facebook"></i></a>
				<?php endif; ?>
				<?php if( in_array('google_p', $social_sharing_buttons ) ): ?>
					<a href="<?php if( $social_sharing_btn_type == 'share' ): ?>https://plus.google.com/share?app=110&url=<?php if( $social_sharing_page_url ) { echo $social_sharing_page_url; } ?>%2F&src=sdkpreparse<?php endif; ?><?php if( ( $social_sharing_btn_type == 'follow' ) && (get_field('ms_header_social_page_follow_google_plus', $header_bar_id ) ) ){ echo get_field('ms_header_social_page_follow_google_plus', $header_bar_id ); }?>" target="_blank" class= "ms-popup-sharing-icon">
				  <i class="ms-fab ms-fa-google-plus-g ms-popup-social-google-plus"></i></a>
				<?php endif; ?>
				<?php if( in_array('twitter', $social_sharing_buttons ) ): ?>
					<a href="<?php if( $social_sharing_btn_type == 'share' ): ?>https://twitter.com/intent/tweet?text=<?php if( $social_sharing_page_url ) { echo $social_sharing_page_url; } ?>%2F&src=sdkpreparse<?php endif; ?><?php if( ( $social_sharing_btn_type == 'follow' ) && (get_field('ms_header_social_page_follow_twitter', $header_bar_id ) ) ){ echo get_field('ms_header_social_page_follow_twitter', $header_bar_id ); }?>" target="_blank" class= "ms-popup-sharing-icon">
				  <i class="ms-fab ms-fa-twitter ms-popup-social-twitter"></i></a>
				<?php endif; ?>
				<?php if( in_array('pinterest', $social_sharing_buttons ) ): ?>
					<a href="<?php if( $social_sharing_btn_type == 'share' ): ?>https://www.pinterest.com/pin/create/button/?url=<?php if( $social_sharing_page_url ) { echo $social_sharing_page_url; } ?>%2F&src=sdkpreparse<?php endif; ?><?php if( ( $social_sharing_btn_type == 'follow' ) && (get_field('ms_header_social_page_follow_pinterest', $header_bar_id ) ) ){ echo get_field('ms_header_social_page_follow_pinterest', $header_bar_id ); }?>" target="_blank" class= "ms-popup-sharing-icon">
				 <i class="ms-fab ms-fa-pinterest-p ms-popup-social-pinterest"></i></a>
				<?php endif; ?>
				<?php if( in_array('blogger', $social_sharing_buttons ) ): ?>
					<a href="<?php if( $social_sharing_btn_type == 'share' ): ?>https://www.blogger.com/blog-this.g?u=<?php if( $social_sharing_page_url ) { echo $social_sharing_page_url; } ?>%2F&src=sdkpreparse<?php endif; ?><?php if( ( $social_sharing_btn_type == 'follow' ) && (get_field('ms_header_social_page_follow_blogger', $header_bar_id ) ) ){ echo get_field('ms_header_social_page_follow_blogger', $header_bar_id ); }?>" target="_blank" class= "ms-popup-sharing-icon">
				  <i class="ms-fab ms-fa-blogger-b ms-popup-social-blogger"></i></a>
				<?php endif; ?>
				<?php if( in_array('tumblr', $social_sharing_buttons ) ): ?>
					<a href="<?php if( $social_sharing_btn_type == 'share' ): ?>https://www.tumblr.com/widgets/share/tool?posttype=link&canonicalUrl=<?php if( $social_sharing_page_url ) { echo $social_sharing_page_url; } ?>%2F&src=sdkpreparse<?php endif; ?><?php if( ( $social_sharing_btn_type == 'follow' ) && (get_field('ms_popup_social_page_follow_tumblr', $header_bar_id ) ) ){ echo get_field('ms_popup_social_page_follow_tumblr', $header_bar_id ); }?>" target="_blank" class= "ms-popup-sharing-icon">
				  <i class="ms-fab ms-fa-tumblr ms-popup-social-tumblr"></i></a>
				<?php endif; ?>
				<?php if( in_array('linkedin', $social_sharing_buttons ) ): ?>
					<a href="<?php if( $social_sharing_btn_type == 'share' ): ?>https://www.linkedin.com/uas/connect/user-signin?session_redirect=https%3A%2F%2Fwww%2Elinkedin%2Ecom%2Fcws%2Fshare%3Fxd_origin_host%3D<?php esc_url( home_url() ); ?>%26original_referer%3D<?php the_permalink(); ?>%26url%3D<?php if( $social_sharing_page_url ) { echo $social_sharing_page_url; } ?>%2F&src=sdkpreparse<?php endif; ?><?php if( ( $social_sharing_btn_type == 'follow' ) && (get_field('ms_header_social_page_follow_linkedin', $header_bar_id ) ) ){ echo get_field('ms_header_social_page_follow_linkedin', $header_bar_id ); }?>" target="_blank" class= "ms-popup-sharing-icon">
				  <i class="ms-fab ms-fa-linkedin-in ms-popup-social-linkedin"></i></a>
				<?php endif; ?>
				<?php if( in_array('reddit', $social_sharing_buttons ) ): ?>
					<a href="<?php if( $social_sharing_btn_type == 'share' ): ?>https://www.reddit.com/submit?url=<?php if( $social_sharing_page_url ) { echo $social_sharing_page_url; } ?>%2F&src=sdkpreparse<?php endif; ?><?php if( ( $social_sharing_btn_type == 'follow' ) && (get_field('ms_haeder_social_page_follow_reddit', $header_bar_id ) ) ){ echo get_field('ms_haeder_social_page_follow_reddit', $header_bar_id ); }?>" target="_blank" class= "ms-popup-sharing-icon">
				  <i class="ms-fab ms-fa-reddit ms-popup-social-reddit"></i></a>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if(get_field('ms_header_countdown_timer_options', $header_bar_id)): ?>
			<div class="ms-header-counter ms-header-cont-sec">
				<div class="ms-header-clock-<?php echo $header_bar_id; ?>" ></div>
			</div>
		<?php endif; ?>

		



	</div>
	<?php if(get_field('ms_header_callback_success', $header_bar_id)) : ?>
			<div class="ms-header-callback-success ms-header-cont-sec" style="display: none;">
				<span><?php echo  get_field('ms_header_callback_success', $header_bar_id);?></span>
			</div>
		<?php endif; ?>
	<?php if(get_field('ms_header_enable_coupon_code', $header_bar_id)) : ?>
			<div class="ms-header-form-success ms-header-cont-sec" style="display: none;">
				<span><?php echo  get_field('ms_header_the_coupon_code', $header_bar_id);?></span>
			</div>
		<?php elseif (get_field('ms_header_form_success_message', $header_bar_id)) :?>
			<div class="ms-header-form-success ms-header-cont-sec" style="display: none;">
				<span><?php echo  get_field('ms_header_form_success_message', $header_bar_id);?></span>
			</div>
		<?php endif ?>
		<div class="ms-header-close">
			<span class="z-times-thin"></span>
		</div>
</div>
