<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
global $wpdb;
$table_name = esc_sql($wpdb->prefix . BOOSTRZ_TABLE_NAME);
$current_token = get_option( 'boostrz_api_token' );

// Create a unique cache key based on the token
$cache_key = 'boostrz_website_list_html_' . md5($current_token);

// Try to retrieve the cached result
$website_list_cache = wp_cache_get($cache_key, 'boostrz_cache_website_list_html_group');

if ($website_list_cache === false) {

    $website_list = $wpdb->get_results( $wpdb->prepare(
        "SELECT * FROM $table_name WHERE token = %s", 
        $current_token
    ) );

    // Store the result in cache for 5 minutes (300 seconds)
    wp_cache_set($cache_key, $website_list, 'boostrz_cache_website_list_html_group', BOOSTRZ_CACHE_SET_TIME);



}

// Retrieve the current values
$current_website_selected = get_option( 'boostrz_current_website_selected' );

?>

<div class="wrap">
    <h1>Select Website to Generate Tag</h1>
    <form method="post" action="" style="display: flex; align-items: center;">
        <?php wp_nonce_field( 'boostrz_website_tag_settings', 'boostrz_website_nonce_field' ); ?>

        <label for="boostrz_username" style="margin-right: 10px;">Website to generate the tag for</label>
        <!-- <input type="text" name="boostrz_username" value="" class="regular-text" style="margin-right: 20px;"/> -->

        <label for="boostrz_website_list" style="margin-right: 10px;"></label>
        <select name="boostrz_website_list" class="regular-text" style="margin-right: 20px;">
        <?php
            if(!empty($website_list)){
                echo '<option value="">Select Website</option>';
                foreach($website_list as $w_list){
                    echo '<option value="'.esc_html($w_list->base_url).'" '. selected( $current_website_selected, esc_html($w_list->base_url) ).'>'.esc_html($w_list->base_url).'</option>';
                }

            }else{
                echo '<option value="">Not Found.</option>';
            }
        ?>
        </select>
        <input type="submit" name="submit_boostrz_website_tag" id="submit" class="button button-primary" value="Use This Website">
    </form>
</div>
