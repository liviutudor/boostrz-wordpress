<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
global $wpdb;
$table_name = $wpdb->prefix . BOOSTRZ_TABLE_NAME;
$website_list = $wpdb->get_results("SELECT * FROM $table_name");
// Retrieve the current values
$current_website_selected = get_option( 'boostrz_current_website_selected' );

?>

<div class="wrap">
    <h1>Boostrz Website Generate</h1>
    <form method="post" action="" style="display: flex; align-items: center;">
        <?php wp_nonce_field( 'boostrz_save_settings', 'boostrz_nonce_field' ); ?>

        <label for="boostrz_username" style="margin-right: 10px;">Website to generate the tag for</label>
        <!-- <input type="text" name="boostrz_username" value="" class="regular-text" style="margin-right: 20px;"/> -->

        <label for="boostrz_website_list" style="margin-right: 10px;"></label>
        <select name="boostrz_website_list" class="regular-text" style="margin-right: 20px;">
        <?php
            if(!empty($website_list)){
                echo '<option value="">Select Website</option>';
                foreach($website_list as $w_list){
                    echo '<option value="'.$w_list->base_url.'" '. selected( $current_website_selected, $w_list->base_url ).'>'.$w_list->base_url.'</option>';
                }

            }else{
                echo '<option value="">Not Found.</option>';
            }
        ?>
        </select>
        <input type="submit" name="submit_boostrz_website_tag" id="submit" class="button button-primary" value="Select Website">
    </form>
</div>
