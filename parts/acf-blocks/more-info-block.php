<?php
$post_id = get_the_ID();
$team_member_name = get_the_title($post_id);
?>
<button class="more-info-button"
data-id="<?php echo esc_attr($post_id); ?>"
data-name="<?php echo esc_attr($team_member_name); ?>">
More Info
</button>
