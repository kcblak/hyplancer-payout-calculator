<?php
function hyplancer_register_settings() {
    add_option( 'hyplancer_total_income', 0 );
    add_option( 'hyplancer_total_blakcoin', 0 );
    register_setting( 'hyplancer_options_group', 'hyplancer_total_income' );
    register_setting( 'hyplancer_options_group', 'hyplancer_total_blakcoin' );
}
add_action( 'admin_init', 'hyplancer_register_settings' );

function hyplancer_register_options_page() {
    add_options_page( 'Hyplancer Settings', 'Hyplancer', 'manage_options', 'hyplancer-settings', 'hyplancer_options_page' );
}
add_action( 'admin_menu', 'hyplancer_register_options_page' );

function hyplancer_options_page() {
?>
    <div>
    <h2>Hyplancer Payout Settings</h2>
    <form method="post" action="options.php">
        <?php settings_fields( 'hyplancer_options_group' ); ?>
        <?php do_settings_sections( 'hyplancer_options_group' ); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="hyplancer_total_income">Total Income ($)</label></th>
                <td><input type="number" id="hyplancer_total_income" name="hyplancer_total_income" value="<?php echo get_option('hyplancer_total_income'); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="hyplancer_total_blakcoin">Total Blak Coin</label></th>
                <td><input type="number" id="hyplancer_total_blakcoin" name="hyplancer_total_blakcoin" value="<?php echo get_option('hyplancer_total_blakcoin'); ?>" /></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
    <h3>Test Email Functionality</h3>
    <form method="post" action="">
        <input type="hidden" name="hyplancer_test_email" value="1" />
        <button type="submit" class="button button-primary">Send Test Email</button>
    </form>
    </div>
<?php
}

// Handle test email sending
function hyplancer_handle_test_email() {
    if (isset($_POST['hyplancer_test_email']) && $_POST['hyplancer_test_email'] == '1') {
        hyplancer_send_test_email();
    }
}
add_action('admin_init', 'hyplancer_handle_test_email');

function hyplancer_send_test_email() {
    $total_income = get_option( 'hyplancer_total_income', 0 );
    $total_blakcoin = get_option( 'hyplancer_total_blakcoin', 0 );
    $to = 'dinotech123@gmail.com';
    $subject = 'Test Email: Update Total Income and Total Blakcoin';
    $message = 'Hi Hyplancer admin, This is a test email.<br>' .
               'The current Total Income is: $' . $total_income . '<br>' .
               'The current Total Blakcoin is: ' . $total_blakcoin . '<br>' .
               '<a href="' . admin_url('options-general.php?page=hyplancer-settings') . '">Update Now</a>';
    $headers = array('Content-Type: text/html; charset=UTF-8');

    wp_mail( $to, $subject, $message, $headers );
    echo '<div class="notice notice-success is-dismissible"><p>Test email sent successfully!</p></div>';
}
?>
