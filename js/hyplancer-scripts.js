jQuery(document).ready(function($) {
    $('#hyplancer-payout-form').on('submit', function(e) {
        e.preventDefault();
        var blakcoin = $('#blakcoin').val();
        $.ajax({
            url: hyplancer_ajax.ajax_url,
            type: 'post',
            data: {
                action: 'hyplancer_calculate_payout',
                blakcoin: blakcoin
            },
            success: function(response) {
                if (response.success) {
                    $('#payout-result').html('Estimated Payout: $' + response.data.payout);
                } else {
                    $('#payout-result').html('Error: ' + response.data.error);
                }
            }
        });
    });
});
