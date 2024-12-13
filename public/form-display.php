<?php
function hyplancer_payout_calculator_form() {
    $total_income = get_option( 'hyplancer_total_income', 0 );
    $total_blakcoin = get_option( 'hyplancer_total_blakcoin', 0 );
    ob_start();
    ?>
    <div class="hyplancer-form">
        <h2>Payout Calculator</h2>
        <form id="hyplancer-payout-form">
            <label for="blakcoin">Your $Blak Coin Share</label>
            <input type="number" id="blakcoin" name="blakcoin" required />
            <button type="submit">Calculate Payout</button>
        </form>
        <div id="payout-result"></div>
        <p>Total Income: $<?php echo $total_income; ?></p>
        <p>Total Blak Coin: <?php echo $total_blakcoin; ?></p>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'hyplancer_payout_calculator', 'hyplancer_payout_calculator_form' );
?>
