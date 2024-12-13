<?php
function hyplancer_enqueue_scripts() {
    wp_enqueue_style( 'hyplancer-styles', plugin_dir_url( __FILE__ ) . '../css/hyplancer-styles.css' );
    wp_enqueue_script( 'hyplancer-scripts', plugin_dir_url( __FILE__ ) . '../js/hyplancer-scripts.js', array('jquery'), null, true );
    wp_localize_script( 'hyplancer-scripts', 'hyplancer_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ));
}
add_action( 'wp_enqueue_scripts', 'hyplancer_enqueue_scripts' );
?>
