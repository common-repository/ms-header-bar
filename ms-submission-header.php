<?php   

function msh_acf_header_callback_submission_field( $field ) {
    if ( is_admin() ) :
?>

<?php
global $wpdb;
$header_callback_count = 1;
$table_name = $wpdb->prefix . "ms_header_callback";
$post_id = get_the_ID();
$retrieve_data = $wpdb->get_results( "SELECT * FROM $table_name WHERE ms_header_cb_ref = 'msh-header-bar' AND ms_header_post_id = $post_id ORDER BY id DESC" );

?>

<table id="msh-header-callback-elist" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
    <tr>
        <th>ID</th>
        <th>Submit Time</th>
        <th>Phone Number</th>
        <th>Callback Date</th>
        <th>Callback Time</th>
    </tr>
</thead>
<tfoot>
    <tr>
        <th>ID</th>
        <th>Submit Time</th>
        <th>Phone Number</th>
        <th>Callback Date</th>
        <th>Callback Time</th>
    </tr>
</tfoot>
<tbody>
<?php foreach ($retrieve_data as $retrieved_data){ ?>
    <tr>
        <td><?= $header_callback_count++;?></td>
        <td><?= $retrieved_data->ms_header_cb_sub_time;?></td>
        <td><?= $retrieved_data->ms_header_cb_phone;?></td>
        <td><?= $retrieved_data->ms_header_cb_date;?></td>
        <td><?= $retrieved_data->ms_header_cb_time;?></td>
    </tr>
<?php 
}
?>
</tbody>
</table>
<?php
    endif;
    return $field;
}

add_filter('acf/prepare_field/key=field_mshdheadersub006', 'msh_acf_header_callback_submission_field');


function msh_acf_header_form_submission_field( $field ) {
    if ( is_admin() ) :
?>

<?php
global $wpdb;

$table_name = $wpdb->prefix . "ms_header_form";
$post_id = get_the_ID();
$count = 1;
$retrieve_data = $wpdb->get_results( "SELECT * FROM $table_name WHERE ms_header_ref = 'msh-header-bar' AND ms_header_post_id = $post_id  ORDER BY id DESC" );

?>
<table id="msh-popup-elist" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Time</th>
    </tr>
</thead>
<tfoot>
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Time</th>
    </tr>
</tfoot>
<tbody>
<?php foreach ($retrieve_data as $retrieved_data){ ?>
    <tr>
        <td><?= $count++;?></td>
        <td><?= $retrieved_data->ms_header_form_email;?></td>
        <td><?= $retrieved_data->ms_header_form_time;?></td>
    </tr>
<?php 
}
?>
</tbody>
</table>
<?php
    endif;
    return $field;
}

add_filter('acf/prepare_field/key=field_mshdheadersub004', 'msh_acf_header_form_submission_field');
?>