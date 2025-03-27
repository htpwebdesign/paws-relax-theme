<?php
function paws_enqueues()
{

	// Load normalize.css
	wp_enqueue_style(
		'paw-normalize',
		get_theme_file_uri('/assets/css/normalize.css'),
		array(),
		'8.0.1'
	);

	// Load style.css on the front-end
	// Parameters: Unique handle, Source, Dependencies, Version number, Media
	wp_enqueue_style(
		'paw-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get('Version'),
		'all'
	);

    // Load the custom JavaScript file
    wp_enqueue_script(
        'team-details-modal',
        get_template_directory_uri() . '/assets/js/team-details-modal.js',
        array(), // No dependencies
        null, // No versioning
        false // Load in the footer
    );

    // Localize the script with the AJAX URL
    wp_localize_script(
        'team-details-modal',
        'myAjax',
        array(
            'ajaxurl' => admin_url('admin-ajax.php') // Add the admin AJAX URL
        )
    );

}

add_action('wp_enqueue_scripts', 'paws_enqueues');


function paws_setup()
{
    add_editor_style(get_stylesheet_uri());
    // Crop images to 300px by 200px
    add_image_size('300x200', 300, 200, true);
}
add_action('after_setup_theme', 'paws_setup');


// Make custom sizes selectable from WordPress admin.
function paws_add_custom_image_sizes($size_names)
{
    $new_sizes = array(
        '300x200' => __('300x200', 'paws-theme'),
    );
    return array_merge($size_names, $new_sizes);
}
add_filter('image_size_names_choose', 'paws_add_custom_image_sizes');


// Custom Post Types & Custom Taxonomies
require get_template_directory() . '/inc/post-types-taxonomies.php';

// Load custom blocks
require get_theme_file_path() . '/paws-blocks/paws-blocks.php';



// Custom ACF blocks
add_action('acf/init', 'register_acf_blocks');
function register_acf_blocks() {
    // Work Title Block
    acf_register_block_type(array(
        'name'              => 'work-title-block',
        'title'             => __('Work Title Block'),
        'description'       => __('Displays the work title dynamically for the queried team member.'),
        'render_template'   => 'parts/acf-blocks/work-title-block.php',
        'category'          => 'layout',
        'icon'              => 'admin-generic',
        'keywords'          => array('work', 'title', 'team'),
        'supports'          => array(
            'align' => false,
            'jsx'   => false,
        ),
    ));

    // More Info Block
    acf_register_block_type(array(
        'name'              => 'more-info-block',
        'title'             => __('More Info Block'),
        'description'       => __('Displays a button to show detailed therapist information in an overlay.'),
        'render_template'   => 'parts/acf-blocks/more-info-block.php',
        'category'          => 'layout',
        'icon'              => 'admin-links',
        'keywords'          => array('info', 'button', 'overlay'),
        'supports'          => array(
            'align' => false,
            'jsx'   => false,
        ),
    ));
}

function enqueue_overlay_script_for_template() {
    if (is_page_template('archive-paws-team.html')) { // Replace with your template filename
        wp_enqueue_script(
            'therapist-overlay-script',
            get_template_directory_uri() . '/assets/js/therapist-overlay.js',
            array('jquery'),
            null,
            true
        );

        wp_localize_script('therapist-overlay-script', 'pawsAjax', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'enqueue_overlay_script_for_template');




add_action('wp_ajax_load_therapist_details', 'load_therapist_details');
add_action('wp_ajax_nopriv_load_therapist_details', 'load_therapist_details');

function load_therapist_details() {
    $post_id = intval($_POST['post_id']); // Get the post ID from the request

    // Fetch data (ACF + CPT)
    $name = get_the_title($post_id); // Post title
    $work_title = get_post_meta($post_id, 'title', true); // ACF field
    $bio = get_field('bio', $post_id); // Another ACF field
    $availability = get_field('availability', $post_id); // Another ACF field
    $email = get_field('email', $post_id); // Another ACF field

    // Output details as HTML
    if ($name) {
        echo '<h2>' . esc_html($name) . '</h2>';
        echo '<p><strong>Work Title:</strong> ' . esc_html($work_title) . '</p>';
        echo '<p><strong>Bio:</strong> ' . esc_html($bio) . '</p>';
        echo '<p><strong>Availability:</strong> ' . esc_html($availability) . '</p>';
        echo '<p><strong>Email:</strong> ' . esc_html($email) . '</p>';

    } else {
        echo '<p>Details not found.</p>';
    }

    wp_die(); // Terminate AJAX request
}








// The AJAX handler function to fetch and return ACF data
add_action('wp_ajax_fetch_team_member_details', 'fetch_team_member_details');
add_action('wp_ajax_nopriv_fetch_team_member_details', 'fetch_team_member_details');

function fetch_team_member_details() {
    $post_id = intval($_POST['post_id']);
    if (!$post_id) {
        wp_send_json_error('Invalid post ID.');
        return;
    }

    // Fetch ACF fields
    $team_member_name = get_field('name', $post_id);
    $team_member_title = get_field('title', $post_id);
    $team_member_bio = get_field('bio', $post_id);
    $team_member_availability = get_field('availability', $post_id);
    $team_member_email = get_field('email', $post_id);

    // Prepare HTML output
    ob_start();
    ?>
    <div class="team-member-details">
        <h2><?php echo esc_html($team_member_name); ?></h2>
        <p><strong>Title:</strong> <?php echo esc_html($team_member_title); ?></p>
        <?php if (!empty($team_member_bio)): ?>
            <p><?php echo esc_html($team_member_bio); ?></p>
        <?php endif; ?>
        <?php if (!empty($team_member_availability)): ?>
            <p>Availability: <?php echo esc_html($team_member_availability); ?></p>
        <?php endif; ?>
        <?php if (!empty($team_member_email)): ?>
            <p><a href="mailto:<?php echo esc_attr($team_member_email); ?>"><?php echo esc_html($team_member_email); ?></a></p>
        <?php else: ?>
            <p>Email not available.</p>
        <?php endif; ?>
    </div>
    <?php
    $html = ob_get_clean();
    wp_send_json_success($html);
}

    




// Google map ACF
function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyBa9euB1dlKXPfiGp28_9jtTF2OXWDglfI');
}
add_action('acf/init', 'my_acf_init');