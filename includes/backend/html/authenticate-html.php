<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Retrieve the current values
$current_username = get_option( 'boostrz_username' );
$current_password = get_option( 'boostrz_password' );

?>

<div class="wrap">
    <h1>Boostrz Settings</h1>
    <form method="post" action="" style="display: flex; align-items: center;">
        <?php wp_nonce_field( 'boostrz_save_settings', 'boostrz_nonce_field' ); ?>

        <label for="boostrz_username" style="margin-right: 10px;">Boostrz Username</label>
        <input type="text" name="boostrz_username" value="<?php echo esc_attr( $current_username ); ?>" class="regular-text" style="margin-right: 20px;" autocomplete="off"/>

        <label for="boostrz_password" style="margin-right: 10px;">Password</label>
        <input type="password" name="boostrz_password" value="<?php echo esc_attr( $current_password ); ?>" class="regular-text" style="margin-right: 20px;" autocomplete="off"/>

        <input type="submit" name="submit_boostrz_settings" id="submit" class="button button-primary" value="Authenticate">
    </form>
</div>
