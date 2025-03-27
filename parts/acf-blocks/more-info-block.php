<?php
$post_id = get_the_ID(); // Current post ID
?>
<button class="more-info-button" data-id="<?php echo esc_attr($post_id); ?>">More Info</button>
