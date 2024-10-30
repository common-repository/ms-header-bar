<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<style>
	.ms-header-bar .flip-clock-wrapper ul{
		width: 20px;
		height: 25px;
		border-radius: 3px;
		margin:1px;
	}
	.ms-header-bar .flip-clock-wrapper ul li a div div.inn{
		font-size: 15px;
	}
	.ms-header-bar .flip-clock-wrapper ul li{
		line-height: 27px;
	}
	.ms-header-bar .flip-clock-divider{
		height: unset;
	}
	.ms-header-bar .flip-clock-dot.top{
		top:-10px;
	}
	.ms-header-bar .flip-clock-dot.bottom{
		bottom: 15px;
	}
	.ms-header-bar .flip-clock-dot{
		width: 5px;
		height: 5px;
		left :8px;
	}
	.ms-header-bar .flip-clock-divider .flip-clock-label{
		right: -39px;
		font-weight :400px;
		color: #fff;
		font-size: 13px;
	}
	.ms-header-bar .flip-clock-divider.seconds .flip-clock-label{
		right: -45px;
	}
	.ms-header-bar .flip-clock-divider.minutes .flip-clock-label{
		right: -45px;
	}
	.ms-header-bar iframe{    
		display: none;
	}
	.ms-header-bar div{
		vertical-align: middle;
		display: inline-block;
	}
	#ms-header-<?php echo $header_bar_id; ?>.ms-header-bar:hover #ms-header-<?php echo $header_bar_id; ?>.z-times-thin{
		display: table-cell;
	}
	.ms-header-close{
		position: absolute;
		right: 1%;
		top:30%;
		cursor: pointer;
		transition: all 1s;
		display: none;
	}
	#ms-header-<?php echo $header_bar_id; ?>.z-times-thin{
		display: none;
		vertical-align: middle;
	}
	#ms-header-<?php echo $header_bar_id; ?>.z-times-thin:before{
		content: '\00d7';
		font-size: xx-large;
	}
	.ms-header-bar{
		text-align: center;
		padding: 1%;
		width: 100%;
		display: flex;
		position: fixed;
		justify-content: center;
	}
	.ms-header-cont-sec{
		padding: 3px;
	}
	.ms-header-bar p{
		margin: 0;
	}
	.ms-header-btn a{
		padding: 5px 15px;
	    border-radius: 3px;
	    background: #FFFF00;
	    font-size: 16px;
	    color: #272727;
	    font-weight: 600;
	    vertical-align: middle;
	    text-decoration: none;
	    white-space: nowrap;
	    margin-left: 5px;
	}
	.ms-header-bar input, .ms-header-bar select{
		padding: 4px;
		border-radius: 5px;
		border : none;
	}
	.ms-header-bar input[type="submit"]{
		padding: 8px 32px;
	}
	.ms-header-social-icon a{
		color: #fff;
	}
	.ms-header-whole, .ms-top-header-bar-whole{
		display: none;
	}
	.ms-header-bar-content form{
		vertical-align: middle;
	}

	#ms-header-<?php echo $header_bar_id; ?>{
		background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
		border : <?=get_field('ms_header_border_size', $header_bar_id)?> <?=get_field('ms_popup_border_style', $header_bar_id)?> <?=get_field('ms_popup_border_color', $header_bar_id)?>;
		padding: <?=get_field('ms_header_padding', $header_bar_id)?>;
		<?php if(get_field('ms_header_position', $header_bar_id)=='top'):?>
			top:0;
		<?php endif; ?>
		<?php if(get_field('ms_header_position', $header_bar_id)=='bottom'):?>
			bottom: 0;
		<?php endif; ?>
		<?php if(get_field('ms_header_background_image', $header_bar_id)):?>
			background-image: url(<?=get_field('ms_header_background_image', $header_bar_id)?>);
		<?php endif; ?>
		<?php if(get_field('ms_header_background_color', $header_bar_id)):?>
			background-color: <?=get_field('ms_header_background_color', $header_bar_id)?>;
		<?php endif; ?>

	}

/* MS Header Button Style */

	#ms-header-<?php echo $header_bar_id; ?> .ms-header-btn a{
		color: <?php echo get_field('ms_header_btn_text_color', $header_bar_id); ?>;
		background: <?php echo get_field('ms_header_btn_back_color', $header_bar_id); ?>;
	}
/*  End  */

/* MS Header Social Icon Style */
	#ms-header-<?php echo $header_bar_id; ?> .ms-header-social-icon i{
		<?php if(get_field('ms_header_social_sharing_button_styles', $header_bar_id)=='border_radius'): ?>
		border-radius: 5px;
		<?php elseif(get_field('ms_header_social_sharing_button_styles', $header_bar_id)=='circle'): ?>
			border-radius: 50%;
		<?php else : ?>
			border-radius: 0;
		<?php endif; ?>
	}
/* End */

/* MS Header Form Style */
	#ms-header-form-<?php echo $header_bar_id; ?> .ms-header-form-input input,
	#ms-header-form-<?php echo $header_bar_id; ?> .ms-header-form-input input::placeholder {
		color: <?php echo get_field('ms_header_form_input_color', $header_bar_id); ?>;
		background:  <?php echo get_field('ms_header_form_input_back_color', $header_bar_id); ?>;
	}
	#ms-header-form-<?php echo $header_bar_id; ?> .ms-header-form-input input[type="submit"]{
		color: <?php echo get_field('ms_header_form_submit_text_color', $header_bar_id); ?>;
		background:  <?php echo get_field('ms_header_form_submit_background_color', $header_bar_id); ?>;
	}
/* End */

/* MS Header Callback Style */
	#ms-header-<?php echo $header_bar_id; ?> .ms-header-callback-input input,
	#ms-header-<?php echo $header_bar_id; ?> .ms-header-callback-input input::placeholder,
	#ms-header-<?php echo $header_bar_id; ?> .ms-header-callback-input select,
	#ms-header-<?php echo $header_bar_id; ?> .ms-header-callback-input select::placeholder {
		color: <?php echo get_field('ms_header_callback_input_color', $header_bar_id); ?>;
		background:  <?php echo get_field('ms_header_callback_input_background_color', $header_bar_id); ?>;
	}
	#ms-header-<?php echo $header_bar_id; ?> .ms-header-callback-input input[type="submit"]{
		color: <?php echo get_field('ms_header_callback_submit_text_color', $header_bar_id); ?>;
		background:  <?php echo get_field('ms_header_callback_submit_background_color', $header_bar_id); ?>;
	}
/* End */

@media only screen and (max-width: 600px) {
	.ms-header-social-icon i{
		padding: 9px 10px;
	}
	.callback-input-select{
		width: 45%
	}
	.callback-input-input{
		padding: 1px;
		width: 92%;
	}
	.callback-input-input input{
		width: 100%
	}
	.ms-header-bar .flip-clock-divider{
		margin: 1px;
	}
	.ms-header-bar .flip-clock-divider .flip-clock-label{
		top:30px;
	}
	.ms-header-bar .flip-clock-divider.seconds .flip-clock-label{
		right: -100px;
	}
	.ms-header-bar .flip-clock-divider.minutes .flip-clock-label{
		right: -100px;
	}
	.ms-header-bar .flip-clock-dot.top {
    top: 15px;
	}
	.ms-header-bar .flip-clock-dot.bottom {
    bottom: -10px;
	}
	#ms-header-<?php echo $header_bar_id; ?>.ms-header-bar.z-times-thin{
		display: table-cell;
	}
}

</style>