<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Retrieve the current values
//$current_username = get_option( 'boostrz_username' );
$current_username = '';
$current_password = '';
//$current_password = get_option( 'boostrz_password' );

?>

<div class="wrap">
    <img src="<?php echo esc_url(BOOSTRZ_PLUGIN_URL . 'img/svg_logo.svg'); ?>" alt="Boostrz Logo" style="margin-bottom: 20px;"/>
    <h1>Authenticate with Boostrz</h1>
    <p>Use your Boostrz username and password to authenticate with Boostrz to be able to retrieve the tag for your website</p>
    <form method="post" action="" style="display: flex; align-items: center;">
        <?php wp_nonce_field( 'boostrz_save_settings', 'boostrz_nonce_field' ); ?>

        <label for="boostrz_username" style="margin-right: 10px;">Boostrz Username</label>
        <input type="text" name="boostrz_username" value="<?php echo esc_attr( $current_username ); ?>" class="regular-text" style="margin-right: 20px;" autocomplete="off"/>

        <label for="boostrz_password" style="margin-right: 10px;">Password</label>
        <input type="password" name="boostrz_password" value="<?php echo esc_attr( $current_password ); ?>" class="regular-text" style="margin-right: 20px;" autocomplete="off"/>

        <input type="submit" name="submit_boostrz_settings" id="submit" class="button button-primary" value="Authenticate">
    </form>
</div>
