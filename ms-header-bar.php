<?php

/*

Plugin Name:  MS Header Bar
Plugin URI:   https://profiles.wordpress.org/ncteam/
Description:  Create Beautiful Header Bars for your website to attract, show important notifications or collect leads
Version:      1.0

Author:       NC Team

Author URI:   https://profiles.wordpress.org/ncteam/

License:      GPL2

License URI:  https://www.gnu.org/licenses/gpl-2.0.html

Text Domain:  msheader

*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}



if( !class_exists( 'acf_pro' ) ||  !class_exists( 'ACF' )) {
   /* $result = activate_plugin( 'plugin-dir/plugin-file.php' );
    if ( is_wp_error( $result ) ) {
        // Process Error
    } */
      require( 'libs/advanced-custom-fields/acf.php' );

}

if( class_exists( 'acf_pro' ) ||  class_exists( 'ACF' )) {
    require_once ( 'acf-import.php' );
}



require_once( 'ms-header-dashboard.php' );
require_once( 'ms-submission-header.php' );
require_once ( 'shortcodes-header.php' );
require( dirname(__FILE__) . '/ms-header-activation.php' );
register_activation_hook( __FILE__, 'ms_header_mail_list_database' );
register_deactivation_hook( __FILE__, 'ms_header_deactivation' );
$plugin_url = WP_PLUGIN_URL . 'ms-simple-popup';


add_action( 'init', 'msh_header_bar' );
function msh_header_bar() {

    $labels = array(

        'name'               => _x( 'Edit', 'post type general name', 'ms-header-bar' ),

        'singular_name'      => _x( 'MS Header Bar', 'post type singular name', 'msh-header-bar' ),

        'menu_name'          => _x( 'MS Header Bar', 'admin menu', 'msh-header-bar' ),

        'name_admin_bar'     => _x( 'MS Header Bar', 'add popup on admin bar', 'msh-header-bar' ),

        'add_new'            => _x( 'Add New Header Bar', 'Popup', 'msh-header-bar' ),

        'add_new_item'       => __( 'Add New Header Bar', 'msh-header-bar' ),

        'new_item'           => __( 'New Header Bar', 'msh-header-bar' ),

        'edit_item'          => __( 'Edit Header Bar', 'msh-header-bar' ),

        'view_item'          => __( 'View Header Bar', 'msh-header-bar' ),

        'all_items'          => __( 'All Header Bars', 'msh-header-bar' ),

        'search_items'       => __( 'Search Header Bar', 'msh-header-bar' ),

        'parent_item_colon'  => __( 'Parent Headers:', 'msh-header-bar' ),

        'not_found'          => __( 'No Header Bar found.', 'msh-header-bar' ),

        'not_found_in_trash' => __( 'No Header Bar in Trash.', 'msh-header-bar' )

    );



    $args = array(

        'labels'             => $labels,

        'description'        => __( 'Description.', 'msh-header-bar' ),

        'public'             => true,

        'publicly_queryable' => true,

        'show_ui'            => true,

        'show_in_menu'       => false,

        'query_var'          => true,

        'rewrite'            => array( 'slug' => 'msh-header-bar' ),

        'capability_type'    => 'post',

        'has_archive'        => true,

        'hierarchical'       => false,

        'menu_position'      => null,

    );
    register_post_type( 'msh-header-bar', $args );
}





function ms_heaader_enqueue_admin_styles() {

    wp_enqueue_style( 'ms_header_admin_bootstrap', plugins_url( 'assets/css/bootstrap.min.css', __FILE__  ) );

    wp_enqueue_style( 'ms_header_admin_datatables_css', 'https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css' );

    wp_enqueue_style( 'ms_header_admin_datatables_buttons_css', 'https://cdn.datatables.net/buttons/1.2.2/css/buttons.bootstrap.min.css' );

    wp_enqueue_style( 'ms_header_admin_css', plugins_url('ms-simple-popup/assets/css/admin.css') );

    

    wp_enqueue_style( 'data_header_table_datatable_css', '//cdn.datatables.net/1.10.17/css/jquery.dataTables.min.css' );

}

add_action( 'admin_head', 'ms_heaader_enqueue_admin_styles' );



function ms_header_enqueue_admin_js() {


    wp_enqueue_script( 'ms_header_admin_font_awesome_js', 'https://use.fontawesome.com/releases/v5.0.7/js/all.js' );


    wp_enqueue_script( 'ms_header_admin_data_tables', 'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js', array( 'jquery' ), '', true );

    wp_enqueue_script( 'ms_header_admin_data_tables_buttons', 'https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js', array( 'jquery' ), '', true );

    wp_enqueue_script( 'ms_header_admin_data_tables_colVis', 'https://cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.min.js', array( 'jquery' ), '', true );

    wp_enqueue_script( 'ms_header_admin_data_tables_html5_buttons', 'https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js', array( 'jquery' ), '', true );

    wp_enqueue_script( 'ms_header_admin_data_tables_buttons_print', 'https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js', array( 'jquery' ), '', true );

    wp_enqueue_script( 'ms_header_admin_data_tables_bootstrap', 'https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js', array( 'jquery' ), '', true );

    wp_enqueue_script( 'ms_header_admin_data_tables_buttons_bootstrap', 'https://cdn.datatables.net/buttons/1.5.1/js/buttons.bootstrap4.min.js', array( 'jquery' ), '', true );

    wp_enqueue_script( 'ms_header_admin_data_tables_jszip', 'https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js', array( 'jquery' ), '', true );

    wp_enqueue_script( 'ms_header_admin_js', plugin_dir_url( __FILE__ ) . 'assets/js/admin.js', array( 'jquery' ), '', true );

}

add_action( 'admin_enqueue_scripts', 'ms_header_enqueue_admin_js' );



function ms_header_enqueue_styles() {

    wp_enqueue_style( 'ms_header_bootstrap', plugins_url( 'assets/css/ms-bootstrap.css', __FILE__  ) );

    wp_enqueue_style( 'ms_header_ionicons', 'https://unpkg.com/ionicons@4.3.0/dist/css/ionicons.min.css' );

    wp_enqueue_style( 'ms_header_fontfesto', 'https://cdn.jsdelivr.net/npm/fontisto@v3.0.4/css/fontisto/fontisto.min.css' );

    wp_enqueue_style( 'ms_header_animate', plugins_url( 'assets/css/animate.css' , __FILE__ ) );

    wp_enqueue_style( 'ms_header_font_awesome_css', plugins_url( 'assets/css/fontawesome-all.css', __FILE__  ) );

    wp_enqueue_style( 'ms_header_fontawesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );

    wp_enqueue_style( 'ms_header_flipclock_css', plugins_url( 'assets/css/flipclock.css', __FILE__  ) );

    wp_enqueue_style( 'ms_header_style', plugins_url( 'assets/css/style.css', __FILE__  ) );

    wp_enqueue_style( 'ms_header_dashicons' );

    

}

add_action( 'wp_enqueue_scripts', 'ms_header_enqueue_styles', 23428346, 1 );


function ms_header_enqueue_js() {

    wp_enqueue_script( 'ms_header_jquery_validate_js', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.validate.1.15.0.min.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'ms_header_flipclock_js', plugin_dir_url( __FILE__ ) . 'assets/js/flipclock.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'ms-header-main_js', plugin_dir_url( __FILE__ ) . 'assets/js/ms-header.js', array( 'jquery' ), '', true );
}

add_action( 'wp_enqueue_scripts', 'ms_header_enqueue_js');




