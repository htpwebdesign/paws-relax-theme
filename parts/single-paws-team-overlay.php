<?php
$args = array('post_type' => 'team_members', 'posts_per_page' => -1);
$team_members = new WP_Query($args);

if ($team_members->have_posts()):
    echo '<div class="team-members">';
    while ($team_members->have_posts()): $team_members->the_post();
        $photo = get_field('photo');
        $title = get_field('title');
        $bio = get_field('bio');
        $email = get_field('email');
        $specialties = wp_get_post_terms(get_the_ID(), 'specialties');
        ?>
        <div class="team-member">
            <img src="<?php echo esc_url($photo['url']); ?>" alt="<?php the_title(); ?>">
            <h3><?php the_title(); ?></h3>
            <p><?php echo esc_html($title); ?></p>
            <p><?php echo esc_html($bio); ?></p>
            <p><strong>Email:</strong> <a href="mailto:<?php echo esc_html($email); ?>"><?php echo esc_html($email); ?></a></p>
            <ul>
                <?php foreach ($specialties as $specialty): ?>
                    <li><?php echo esc_html($specialty->name); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
    endwhile;
    echo '</div>';
    wp_reset_postdata();
endif;
?>
