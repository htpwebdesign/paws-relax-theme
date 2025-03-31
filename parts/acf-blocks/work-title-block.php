<?php
// Get the current post's 'title' ACF field

$work_title = get_post_meta(get_the_ID(), 'title', true);

if ($work_title) {
    echo '<p class="acf-work-title-block">' . esc_html($work_title) . '</p>';
} else {
    echo '<p class="acf-work-title-block">No title available.</p>';
}

?>
