<?php
/*
Plugin Name: Hyplancer Payout Calculator
Plugin URI: https://www.linkedin.com/in/kingsley-james-hart-93679b184/?originalSubdomain=ng
Description: Calculate Hyplancer estimated payouts based on their $Blak Coin share.
Version: 1.0
Author: James-Hart Kingsley
Author URI: https://www.linkedin.com/in/kingsley-james-hart-93679b184/?originalSubdomain=ng
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Include necessary files
include_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
include_once plugin_dir_path( __FILE__ ) . 'includes/enqueue-scripts.php';
include_once plugin_dir_path( __FILE__ ) . 'public/form-display.php';

// Activation hook to set up default values
function hyplancer_activation() {
    if ( ! get_option( 'hyplancer_total_income' ) ) {
        update_option( 'hyplancer_total_income', 0 );
    }
    if ( ! get_option( 'hyplancer_total_blakcoin' ) ) {
        update_option( 'hyplancer_total_blakcoin', 0 );
    }
}
register_activation_hook( __FILE__, 'hyplancer_activation' );

// Schedule the monthly email reminder
function hyplancer_schedule_email() {
    if ( ! wp_next_scheduled( 'hyplancer_monthly_email_event' ) ) {
        wp_schedule_event( strtotime( '28th of this month midnight' ), 'monthly', 'hyplancer_monthly_email_event' );
    }
}
add_action( 'wp', 'hyplancer_schedule_email' );

function hyplancer_send_monthly_email() {
    $total_income = get_option( 'hyplancer_total_income', 0 );
    $total_blakcoin = get_option( 'hyplancer_total_blakcoin', 0 );
    $to = 'dinotech123@gmail.com';
    $subject = 'Update Total Income and Total Blakcoin';
    $message = 'Hi Hyplancer admin, Its 28th of ' . date('F') . ' Already!<br>' .
               'Update the current Total Income and Total Blakcoin for this month\'s payout.<br>' .
               'The current Total Income is: $' . $total_income . '<br>' .
               'The current Total Blakcoin is: ' . $total_blakcoin . '<br>' .
               '<a href="' . admin_url('options-general.php?page=hyplancer-settings') . '">Update Now</a>';
    $headers = array('Content-Type: text/html; charset=UTF-8');

    wp_mail( $to, $subject, $message, $headers );
}
add_action( 'hyplancer_monthly_email_event', 'hyplancer_send_monthly_email' );

// Add AJAX action for calculating payout
function hyplancer_calculate_payout() {
    if ( isset( $_POST['blakcoin'] ) ) {
        $blakcoin = floatval( $_POST['blakcoin'] );
        $total_income = get_option( 'hyplancer_total_income', 0 );
        $total_blakcoin = get_option( 'hyplancer_total_blakcoin', 0 );

        if ( $total_blakcoin > 0 ) {
            $payout = ( $blakcoin / $total_blakcoin ) * $total_income;
            wp_send_json_success( array( 'payout' => round( $payout, 2 ) ) );
        } else {
            wp_send_json_error( array( 'error' => 'Total Blak Coin must be greater than zero.' ) );
        }
    } else {
        wp_send_json_error( array( 'error' => 'Invalid request.' ) );
    }
}
add_action( 'wp_ajax_hyplancer_calculate_payout', 'hyplancer_calculate_payout' );
add_action( 'wp_ajax_nopriv_hyplancer_calculate_payout', 'hyplancer_calculate_payout' );
?>
