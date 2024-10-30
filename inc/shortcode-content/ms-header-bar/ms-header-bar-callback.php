<?php  
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$tStart = strtotime('00:00');
$tEnd = strtotime('23:00');
$tNow = $tStart;
$time = '';
while($tNow <= $tEnd){
  $time .= '<option>'.date("H:i a",$tNow).'</option>';
  $tNow = strtotime('+60 minutes',$tNow);
}
?>
<iframe id="ms-header-form-iframe" name="ms_header_callback_iframe" no-referrer></iframe>
<form class="ms-header-callback" id="ms-header-callback-<?=$header_bar_id;?>" action="" method="post" autocomplete="off" target="ms_header_callback_iframe" validate>
	<div class="ms-header-callback-input callback-input-select">
		<select name="ms_header_callback_date" id="callbackcalendar" required="">
  					<option value="<?php echo date('jS F', strtotime("today")); ?>" >Today</option>
  					<option value="<?php echo date('jS F', strtotime("tomorrow")); ?>">Tommorow</option>
  					<option><?php echo date('jS F ', strtotime("+ 2 days")); ?></option>
  					<option><?php echo date('jS F ', strtotime("+ 3 days")); ?></option>
  					<option><?php echo date('jS F ', strtotime("+ 4 days")); ?></option>
  					<option><?php echo date('jS F ', strtotime("+ 5 days")); ?></option>
  					<option><?php echo date('jS F ', strtotime("+ 6 days")); ?></option>
  					<option><?php echo date('jS F ', strtotime("+ 7 days")); ?></option>
			</select>
	</div>
	<div class="ms-header-callback-input callback-input-select">
		<select name="ms_header_callback_time">
				<?php echo $time ; ?>
		</select>
	</div>
	<div class="ms-header-callback-input callback-input-input">
		<input type="text" name="header_callback_phone" placeholder="Your Phone Number" />
	</div>
	<div class="ms-header-callback-input callback-input-input">
		<input type="submit" name="header_callback_submit" value="Call Me" />
	</div>
</form>

<?php
 if ( isset( $_POST['header_callback_submit'] ) ){
 	global $wpdb;
 	$header_callback = $wpdb->prefix . 'ms_header_callback';
        $msh_callback_data=array(
            'ms_header_post_id' => $header_bar_id,
          	'ms_header_cb_time'    => $_POST['ms_header_callback_time'],
            'ms_header_cb_date'    => $_POST['ms_header_callback_date'],
            'ms_header_cb_phone'      => $_POST['header_callback_phone'],
            'ms_header_cb_ref'     => 'msh-header-bar'
        );
       $wpdb->insert( $header_callback, $msh_callback_data);
}
?>