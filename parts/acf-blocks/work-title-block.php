<?php
// Get the current post's 'title' ACF field

$work_title = get_post_meta(get_the_ID(), 'title', true);

if ($work_title) {
    echo '<p>' . esc_html($work_title) . '</p>';
} else {
    echo '<p>No title available.</p>';
}

?>
