<?php



if ( ! defined( 'ABSPATH' ) ) {

	exit; // Exit if accessed directly.

}
global $ms_header_version;
$ms_header_version = '1.0';

function ms_header_mail_list_database() {
	global $wpdb;
	global $ms_header_version;
	$header_form_subscribers = $wpdb->prefix . 'ms_header_form';
	$header_callback = $wpdb->prefix . 'ms_header_callback';
	$header_charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $header_form_subscribers (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		ms_header_form_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		ms_header_form_email varchar(100) NOT NULL,
		ms_header_form_mailto varchar(100) DEFAULT '' NOT NULL,
		ms_header_post_id mediumint(9)  NOT NULL,
		ms_header_ref varchar(100) DEFAULT '' ,
		PRIMARY KEY  (id)
	)$header_charset_collate;";
	$sql2 = "CREATE TABLE $header_callback (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		ms_header_cb_sub_time  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		ms_header_cb_time varchar(100)  NOT NULL,
		ms_header_cb_date varchar(100) NOT NULL,
		ms_header_cb_phone varchar(100) NOT NULL,
		ms_header_post_id mediumint(9)  NOT NULL,
		ms_header_cb_ref varchar(500) ,
		PRIMARY KEY  (id)

	)$header_charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	dbDelta( $sql2 );
	add_option( 'ms_header_version', $ms_header_version );
}

function ms_header_deactivation() {
    global $wpdb;
    $header_form_subscribers = $wpdb->prefix . 'ms_header_form';
	$header_callback = $wpdb->prefix . 'ms_header_callback';
     $sql = "DROP TABLE IF EXISTS $header_form_subscribers";
     $sql2 = "DROP TABLE IF EXISTS $header_callback";
     $wpdb->query($sql);
     $wpdb->query($sql2);

}