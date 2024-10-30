<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
function msh_marketing_submissions() {
		add_menu_page( 
			'MS Header Bar',
			'MS Header Bar',
			'manage_options',
			'edit.php?post_type=msh-header-bar'
		);
}
add_action( 'admin_menu', 'msh_marketing_submissions' );

function add_msh_meta_box() {
    add_meta_box(
        'ms_header_donate',
        __( 'Donate to this Plugin', 'msheader' ),
        'msh_donate_metabox_callback',
        'msh-header-bar',
        'side',
        'low'
    );
}
add_action( 'add_meta_boxes', 'add_msh_meta_box' );

function msh_donate_metabox_callback(  ) {
	$style = '<style>
				.msh-don-meta{
					padding-bottom: 10px;
   					background: #eee;
					text-align: center;
				}
				.msh-button{
					box-shadow: 0px 0px 9px grey;
				    margin: 0px 10px;
				    padding: 20px;
				    background: #efc606;
				    border-radius: 5px;
				}
				.msh-button a{
					text-decoration: none;
				    display: block;
				    font-size: 20px;
				    font-weight: bold;
				    color : #000;
				}
				.msh-heading{
					padding: 10px;
				}
				.msh-cont{
					text-align:left;
				}
				.msh-don-meta a{
					box-shadow : unset;
				}

			</style>';
    $html = '<div class="msh-don-meta">
    			<div class="msh-heading">
    				<div class="msh-cont">
					Help us to impove our Plugin with these new options in next update. Donate at least of 1 dollar will help us to create these new options and more and more new plugins
    				
					Features : 
					<ol>
					<li>Share to see coupon code</li>
					<li>Atomically Download file or video or anything after share or callback or email submit(use form)</li>
					<li>Custom Audience (Show Header Bar for perticular usersnames, emails and ip address)</li>
					<li>Email Verification for Header Bar</li>
					<li>Send email for call back and email submit(use form)</li>
					<li>Scroll to see Header Bar</li>
					<li>Leave page to see Header Bar</li>
					<li>Lot more new settings</li>
					<li>Contact us here for feedback or anything through mail ncteam19@gmail.com</li>
					</ol>
					Donations are highly appreciate for further development
					</div>
    			</div>
    			<div class="msh-button"><a target="_blank" href="https://paypal.me/wbasha?locale.x=en_GB">Donate</a></div>		
    		</div>';
    echo $style.$html;

}