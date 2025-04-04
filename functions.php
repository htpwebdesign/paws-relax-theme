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

    // Single Page Product Button JavaScript File
    wp_enqueue_script(
        'single-product-button',
        get_template_directory_uri() . '/assets/js/single-product-button.js',
        array(), // No dependencies
        null, // No versioning
        false // Load in the footer
    );


    // Team Modal JavaScript file
    wp_enqueue_script(
        'team-details-modal',
        get_template_directory_uri() . '/assets/js/team-details-modal.js',
        array(), // No dependencies
        null, // No versioning
        false // Load in the footer
    );

    // AJAX URL for team details
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
function register_acf_blocks()
{
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


// The AJAX handler function to fetch and return ACF data
add_action('wp_ajax_fetch_team_member_details', 'fetch_team_member_details');
add_action('wp_ajax_nopriv_fetch_team_member_details', 'fetch_team_member_details');

function fetch_team_member_details()
{
    $post_id = intval($_POST['post_id']); // Sanitize the POST data
    if (!$post_id) {
        wp_send_json_error('Invalid post ID.'); // Return error if ID is missing
        return;
    }

    // Fetch ACF fields for team member details
    $team_member_name = get_field('name', $post_id);
    $team_member_title = get_field('title', $post_id);
    $team_member_bio = get_field('bio', $post_id);
    $team_member_availability = get_field('availability', $post_id);
    $team_member_email = get_field('email', $post_id);

    // Fetch the Featured Image (if available)
    $featured_image = '';
    if (has_post_thumbnail($post_id)) {
        $featured_image = get_the_post_thumbnail($post_id, 'medium'); // Adjust the size ('thumbnail', 'medium', 'full', etc.)
    }

    // Fetch Testimonials (from taxonomy linked to team member name)
    $args = array(
        'post_type'      => 'paws-testimonial', // Your testimonial CPT
        'posts_per_page' => -1,
        'tax_query'      => array(
            array(
                'taxonomy' => 'paws-testimonial-types', // Your taxonomy for testimonial types
                'field'    => 'name', // Match taxonomy terms by name
                'terms'    => $team_member_name, // Use the team member's name as the term
            ),
        ),
    );

    $testimonial_query = new WP_Query($args); // Query testimonials

    $testimonials_html = '';
    if ($testimonial_query->have_posts()) {
        $testimonials_html = '<ul>'; // Start a list for testimonials
        while ($testimonial_query->have_posts()) {
            $testimonial_query->the_post();

            // Render testimonial content
            $testimonial_content = do_blocks(get_the_content()); // Render blocks in the testimonial content

            $testimonials_html .= '<li>
                <blockquote>
                    <p>' . $testimonial_content . '</p>
                </blockquote>
            </li>';
        }
        $testimonials_html .= '</ul>'; // Close the list
        wp_reset_postdata(); // Reset query
    }


    // Prepare HTML output
    ob_start();
?>
    <div class="team-member-details">
        <h1>Meet <?php echo esc_html($team_member_name); ?></h1>

        <div class="team-row">
            <?php if (!empty($featured_image)): ?>
                <div class="team-member-image">
                    <?php echo $featured_image; ?>
                </div>
            <?php endif; ?>
            <div class="team-details">
                <h2 class="team-title"><?php echo esc_html($team_member_title); ?></h2>
                <?php if (!empty($team_member_bio)): ?>
                    <p><?php echo esc_html($team_member_bio); ?></p>
                <?php endif; ?>
                <?php if (!empty($team_member_availability)): ?>
                    <div class="availability-container">
                        <p><span class="team-availability">Availability: </span><?php echo esc_html($team_member_availability); ?></p>
                        <a href=<?php echo site_url('/services/'); ?>>Book Now</a>

                    </div>
                <?php endif; ?>
                <?php if (!empty($team_member_email)): ?>
                    <p><span class="team-email">Email: </span><a href="mailto:<?php echo esc_attr($team_member_email); ?>"><?php echo esc_html($team_member_email); ?></a></p>
                <?php else: ?>
                    <p>Email not available.</p>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($testimonials_html)): ?>
            <div class="team-member-testimonials">
                <h3>What People Say About <?php echo esc_html($team_member_name); ?>:</h3>
                <?php echo $testimonials_html; ?>
            </div>
        <?php endif; ?>

    </div>
<?php
    $html = ob_get_clean();
    wp_send_json_success($html); // Send back the HTML as a response
}


// Teams Page custom link re-direct to Services Page
add_filter('term_link', 'custom_taxonomy_link', 10, 3);
function custom_taxonomy_link($url, $term, $taxonomy)
{
    if ($taxonomy === 'paws-specialty-types') {
        $url = site_url('/services/');
    }
    return $url;
}

// Custom Login
function custom_login_logo_url()
{
    return home_url();
}
add_filter('login_headerurl', 'custom_login_logo_url');

function custom_login_logo_title()
{
    return 'Back to ' . get_bloginfo('name');
}
add_filter('login_headertext', 'custom_login_logo_title');

function custom_login_styles()
{
    wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/custom-login.css');
}
add_action('login_enqueue_scripts', 'custom_login_styles');


// Customizing admin menu for shop manager
function custom_menu_order_for_shop_manager($menu_ord)
{
    if (!is_admin()) return $menu_ord;

    if (current_user_can('shop_manager')) {
        return array(
            'index.php',                 //dashboard
            'woocommerce',               // WooCommerce
            'edit.php?post_type=product', // product
            'edit.php?post_type=shop_order', // orders
            'edit.php?post_type=paws-team',       // Team CPT
            'edit.php?post_type=paws-testimonial',// Testimonial CPT
            'edit.php?post_type=paws-faq',       // FAQs CPT
            'upload.php',                // media
            'edit.php?post_type=page',   // pages
            'edit.php',                  // posts
            'separator1',
            'users.php',                 // users
            'options-general.php'        // settings
        );
    }

    return $menu_ord;
}
add_filter('custom_menu_order', '__return_true');
add_filter('menu_order', 'custom_menu_order_for_shop_manager');

function customize_admin_menu_for_shop_manager()
{
    if (current_user_can('shop_manager')) {
        remove_menu_page('themes.php');
        remove_menu_page('plugins.php');
        remove_menu_page('tools.php');
    }
}
add_action('admin_menu', 'customize_admin_menu_for_shop_manager');


/**
 * Enqueue AOS (Animate On Scroll) library
 */
function paws_enqueue_aos()
{
    // Enqueue AOS CSS
    wp_enqueue_style(
        'aos-css',
        'https://unpkg.com/aos@2.3.1/dist/aos.css',
        array(),
        '2.3.1'
    );

    // Enqueue AOS JS
    wp_enqueue_script(
        'aos-js',
        'https://unpkg.com/aos@2.3.1/dist/aos.js',
        array(),
        '2.3.1',
        true
    );

    // Enqueue AOS initialization
    wp_enqueue_script(
        'aos-init',
        get_theme_file_uri('/assets/js/aos-init.js'),
        array('aos-js'),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'paws_enqueue_aos');


// custom dashboard for shop manager

// Hook to setup all custom dashboard widgets
add_action('wp_dashboard_setup', 'setup_shop_manager_dashboard_widgets');

function setup_shop_manager_dashboard_widgets()
{
    // Only show to Shop Managers (not Admins)
    if (current_user_can('shop_manager') && !current_user_can('manage_options')) {
        wp_add_dashboard_widget(
            'shop_manager_guide_video',
            '🎥 Shop Manager Guide',
            'render_custom_guide_video_widget'
        );

        wp_add_dashboard_widget(
            'shop_manager_sales_summary',
            '📊 Sales Summary (This Month)',
            'render_sales_summary_widget'
        );

        wp_add_dashboard_widget(
            'shop_manager_booking_overview',
            '📅 Today\'s Bookings',
            'render_booking_overview_widget'
        );

        wp_add_dashboard_widget(
            'shop_manager_admin_notices',
            '📢 Admin Notices',
            'render_admin_notices_widget'
        );
    }
}

function render_custom_guide_video_widget()
{
?>
    <p>Welcome! Here's a short video to guide you through the basics:</p>

    <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;">
        <iframe
            src="https://www.youtube.com/embed/영상_ID"
            frameborder="0"
            allowfullscreen
            style="position:absolute;top:0;left:0;width:100%;height:100%;">
        </iframe>
    </div>

    <p style="margin-top: 15px;">
        👉 <a href="/shop-manager-guide.pdf" target="_blank">Download PDF Guide</a><br>
        👉 <a href="/help-center" target="_blank">Visit Help Center</a>
    </p>
<?php
}

function render_sales_summary_widget()
{
    if (!class_exists('WooCommerce')) {
        echo '<p>WooCommerce not active.</p>';
        return;
    }

    $start = strtotime(date('Y-m-01'));
    $end = strtotime(date('Y-m-t') . ' 23:59:59');

    $orders = wc_get_orders(array(
        'limit' => -1,
        'status' => array('wc-processing', 'wc-completed'),
        'date_paid' => $start . '...' . $end,
    ));

    $total_sales = 0;
    foreach ($orders as $order) {
        $total_sales += $order->get_total();
    }

    $order_count = count($orders);
    $avg_order = $order_count ? $total_sales / $order_count : 0;

    echo "<ul>
        <li><strong>Total Orders:</strong> {$order_count}</li>
        <li><strong>Total Sales:</strong> " . wc_price($total_sales) . "</li>
        <li><strong>Average Order:</strong> " . wc_price($avg_order) . "</li>
    </ul>";
}

function render_booking_overview_widget()
{
    if (!function_exists('get_wc_booking_statuses')) {
        echo '<p>WooCommerce Bookings is not active.</p>';
        return;
    }

    $today_start = date('Y-m-d 00:00:00');
    $today_end = date('Y-m-d 23:59:59');

    $args = array(
        'post_type' => 'wc_booking',
        'posts_per_page' => 5,
        'post_status' => array_keys(get_wc_booking_statuses()),
        'meta_query' => array(
            array(
                'key'     => '_booking_start',
                'value'   => array(strtotime($today_start), strtotime($today_end)),
                'compare' => 'BETWEEN',
                'type'    => 'NUMERIC',
            ),
        ),
    );

    $bookings = get_posts($args);

    if (!empty($bookings)) {
        echo '<ul>';
        foreach ($bookings as $booking_post) {
            $booking = new WC_Booking($booking_post->ID);
            $start = $booking->get_start_date(null, 'H:i');
            $end = $booking->get_end_date(null, 'H:i');
            $status = get_post_status($booking_post->ID);
            $product = $booking->get_product();
            $service_name = $product ? $product->get_title() : 'Unknown Service';

            $customer = $booking->get_customer();
            $name = $customer ? $customer->get_first_name() . ' ' . $customer->get_last_name() : 'Unknown';
            $email = $customer ? $customer->get_email() : 'N/A';

            echo '<li style="margin-bottom: 10px;">';
            echo "<strong>$start - $end</strong><br>";
            echo "👤 $name ($email)<br>";
            echo "🛠️ Service: $service_name<br>";
            echo "📌 Status: $status";
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No bookings for today.</p>';
    }
}

function render_admin_notices_widget()
{
?>
    <ul style="padding-left: 20px; list-style-type: disc;">
        <li><strong>Weekly restock</strong> due by Friday.</li>
        <li>New pricing update scheduled for <strong>April 15</strong>.</li>
        <li>Check customer reviews weekly and reply if needed.</li>
    </ul>
    <p style="margin-top: 10px;">
        ✏️ <em>To update this list, please contact your site administrator.</em>
    </p>
<?php
}

// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

    global $wp_version;
    if ( $wp_version !== '4.7.1' ) {
       return $data;
    }
  
    $filetype = wp_check_filetype( $filename, $mimes );
  
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
  
  }, 10, 4 );
  
  function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
  add_filter( 'upload_mimes', 'cc_mime_types' );
  
  function fix_svg() {
    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
  }
  add_action( 'admin_head', 'fix_svg' );

  function yoast_to_bottom(){
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoast_to_bottom' );
