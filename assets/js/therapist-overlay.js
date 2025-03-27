jQuery(document).ready(function($) {
    $('.more-info-button').on('click', function() {
        const postId = $(this).data('id');

        // AJAX request to load therapist details
        $.ajax({
            url: pawsAjax.ajaxurl,
            type: 'POST',
            data: {
                action: 'load_therapist_details',
                post_id: postId
            },
            success: function(response) {
                $('#therapist-details').html(response); // Populate modal with response
                $('#therapist-overlay').removeClass('hidden'); // Show overlay
            },
            error: function() {
                $('#therapist-details').html('<p>Sorry, something went wrong.</p>');
            }
        });
    });

    // Close the overlay
    $('#close-overlay').on('click', function() {
        $('#therapist-overlay').addClass('hidden');
    });
});
