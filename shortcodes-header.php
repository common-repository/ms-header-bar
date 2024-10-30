<?php



if ( ! defined( 'ABSPATH' ) ) {

	exit; // Exit if accessed directly.

}
global $post;
function msh_header_bar_init() {
	$msh_header_ids = get_field( 'msh_header_select_to_use', $post->ID );
	if(is_array($msh_header_ids)){
	$msh_header_data = array();
	foreach ($msh_header_ids as $key => $ms_header_id) {
		echo do_shortcode ('[msh-header-bar id = '. $ms_header_id  .' enable="true"]');
		$msh_header_data[$ms_header_id] = array(
						'position' => get_field('ms_header_position', $ms_header_id),
						'screen_size' => get_field( 'ms_header_screen_size_to_display', $ms_header_id ),
						'time' => get_field( 'ms_header_delay_to_show', $ms_header_id ),
						'expire_year' => get_field('ms_header_countdown_expire_year', $ms_header_id),
						'expire_month' => get_field('ms_header_countdown_expire_month', $ms_header_id),
						'expire_days' => get_field('ms_header_countdown_expire_days', $ms_header_id),
						'expire_hours' => get_field('ms_header_countdown_expire_hours', $ms_header_id),
						'expire_min' => get_field('ms_header_countdown_expire_min', $ms_header_id),
						'expire_sec' => get_field('ms_header_countdown_expire_sec', $ms_header_id)
		);
	}
	 wp_localize_script( 'ms-header-main_js', 'msh_header_data', $msh_header_data );	
	}

}
add_action( 'wp_footer', 'msh_header_bar_init' );

function msh_header_shortcode( $atts, $content ) {    
	ob_start();
	$msh_header_atts = shortcode_atts( array(
		'id'   => '',
		'enable' => ''
	), $atts );
	if($atts['enable']){
		
		include( dirname(__FILE__) . '/inc/shortcode-content/ms-header-bar/ms-header-bar.php' );

	}
	$ms_feedback_atts = ob_get_clean();
	return $ms_feedback_atts;
}
add_shortcode( 'msh-header-bar', 'msh_header_shortcode' );