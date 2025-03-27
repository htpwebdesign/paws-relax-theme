<?php
function paws_relax_register_custom_post_types()
{
    // Team CPT
    $labels = array(
        'name'                     => _x('Team', 'post type general name', 'paws-relax-theme'),
        'singular_name'            => _x('Team member', 'post type singular name', 'paws-relax-theme'),
        'add_new'                  => _x('Add New', 'Team member', 'paws-relax-theme'),
        'add_new_item'             => __('Add New Team member', 'paws-relax-theme'),
        'edit_item'                => __('Edit Team', 'paws-relax-theme'),
        'new_item'                 => __('New Team member', 'paws-relax-theme'),
        'view_item'                => __('View Team', 'paws-relax-theme'),
        'view_items'               => __('View Team', 'paws-relax-theme'),
        'search_items'             => __('Search Team', 'paws-relax-theme'),
        'not_found'                => __('No Team found.', 'paws-relax-theme'),
        'not_found_in_trash'       => __('No Team found in Trash.', 'paws-relax-theme'),
        'parent_item_colon'        => __('Parent Team:', 'paws-relax-theme'),
        'all_items'                => __('All Team', 'paws-relax-theme'),
        'archives'                 => __('Team Archives', 'paws-relax-theme'),
        'attributes'               => __('Team Attributes', 'paws-relax-theme'),
        'insert_into_item'         => __('Insert into Team', 'paws-relax-theme'),
        'uploaded_to_this_item'    => __('Uploaded to this Team', 'paws-relax-theme'),
        'featured_image'           => __('Team featured image', 'paws-relax-theme'),
        'set_featured_image'       => __('Set Team featured image', 'paws-relax-theme'),
        'remove_featured_image'    => __('Remove Team featured image', 'paws-relax-theme'),
        'use_featured_image'       => __('Use as featured image', 'paws-relax-theme'),
        'menu_name'                => _x('Team', 'admin menu', 'paws-relax-theme'),
        'filter_items_list'        => __('Filter Team list', 'paws-relax-theme'),
        'items_list_navigation'    => __('Team list navigation', 'paws-relax-theme'),
        'items_list'               => __('Team list', 'paws-relax-theme'),
        'item_published'           => __('Team published.', 'paws-relax-theme'),
        'item_published_privately' => __('Team published privately.', 'paws-relax-theme'),
        'item_reverted_to_draft'  => __('Team reverted to draft.', 'paws-relax-theme'),
        'item_trashed'             => __('Team trashed.', 'paws-relax-theme'),
        'item_scheduled'           => __('Team scheduled.', 'paws-relax-theme'),
        'item_updated'             => __('Team updated.', 'paws-relax-theme'),
        'item_link'                => __('Team link.', 'paws-relax-theme'),
        'item_link_description'    => __('A link to a Team.', 'paws-relax-theme'),
    );

    $args = array(
        'labels'                  => $labels,
        'public'                  => true,
        'publicly_queryable'      => true,
        'show_ui'                 => true,
        'show_in_menu'            => true,
        'show_in_nav_menus'       => true,
        'show_in_admin_bar'       => true,
        'show_in_rest'            => true,
        'query_var'               => true,
        'rewrite'                 => array('slug' => 'our-team'),
        'capability_type'         => 'post',
        'has_archive'             => false,
        'hierarchical'            => false,
        'menu_position'           => 5,
        'menu_icon'               => 'dashicons-groups',
        'supports'                => array('title', 'editor', 'thumbnail'),
    );
    register_post_type('paws-team', $args);

    // Testimonials CPT
    $labels = array(
        'name'                  => _x('Testimonials', 'post type general name', 'paws-relax-theme'),
        'singular_name'         => _x('Testimonial', 'post type singular name', 'paws-relax-theme'),
        'menu_name'             => _x('Testimonials', 'admin menu', 'paws-relax-theme'),
        'add_new'               => _x('Add New', 'testimonial', 'paws-relax-theme'),
        'add_new_item'          => __('Add New Testimonial', 'paws-relax-theme'),
        'new_item'              => __('New Testimonial', 'paws-relax-theme'),
        'edit_item'             => __('Edit Testimonial', 'paws-relax-theme'),
        'view_item'             => __('View Testimonial', 'paws-relax-theme'),
        'all_items'             => __('All Testimonials', 'paws-relax-theme'),
        'search_items'          => __('Search Testimonials', 'paws-relax-theme'),
        'parent_item_colon'     => __('Parent Testimonials:', 'paws-relax-theme'),
        'not_found'             => __('No testimonials found.', 'paws-relax-theme'),
        'not_found_in_trash'    => __('No testimonials found in Trash.', 'paws-relax-theme'),
        'item_link'             => __('Testimonial link.', 'paws-relax-theme'),
        'item_link_description' => __('A link to a testimonial.', 'paws-relax-theme'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'our-testimonials'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-heart',
        'supports'           => array('title', 'editor'),
        'template'           => array(array('core/pullquote')),
        'template_lock'      => 'all'
    );

    register_post_type('paws-testimonial', $args);

    // FAQ CPT
    $labels = array(
        'name'                  => _x('FAQ', 'post type general name', 'paws-relax-theme'),
        'singular_name'         => _x('FAQ', 'post type singular name', 'paws-relax-theme'),
        'menu_name'             => _x('FAQs', 'admin menu', 'paws-relax-theme'),
        'add_new'               => _x('Add New', 'FAQ', 'paws-relax-theme'),
        'add_new_item'          => __('Add New FAQ', 'paws-relax-theme'),
        'new_item'              => __('New FAQ', 'paws-relax-theme'),
        'edit_item'             => __('Edit FAQ', 'paws-relax-theme'),
        'view_item'             => __('View FAQ', 'paws-relax-theme'),
        'all_items'             => __('All FAQs', 'paws-relax-theme'),
        'search_items'          => __('Search FAQs', 'paws-relax-theme'),
        'parent_item_colon'     => __('Parent FAQs:', 'paws-relax-theme'),
        'not_found'             => __('No FAQs found.', 'paws-relax-theme'),
        'not_found_in_trash'    => __('No FAQs found in Trash.', 'paws-relax-theme'),
        'item_link'             => __('FAQ link.', 'paws-relax-theme'),
        'item_link_description' => __('A link to a FAQ.', 'paws-relax-theme'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'paws-faq'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-pets',
        'supports'           => array('title', 'editor'),
        'template' => array(
            array('core/paragraph', array())
        ),
        'template_lock'      => 'all'
    );

    register_post_type('paws-faq', $args);
}

add_action('init', 'paws_relax_register_custom_post_types');


function paws_relax_register_taxonomies()
{

    // Add Testimonial Type taxonomy
    $labels = array(
        'name'                  => _x('Testimonial Types', 'taxonomy general name', 'paws-relax-theme'),
        'singular_name'         => _x('Testimonial Types', 'taxonomy singular name', 'paws-relax-theme'),
        'search_items'          => __('Search Testimonial Types', 'paws-relax-theme'),
        'all_items'             => __('All Testimonial Types', 'paws-relax-theme'),
        'parent_item'           => __('Parent Testimonial Types', 'paws-relax-theme'),
        'parent_item_colon'     => __('Parent Testimonial Types:', 'paws-relax-theme'),
        'edit_item'             => __('Edit Testimonial Types', 'paws-relax-theme'),
        'view_item'             => __('View Testimonial Types', 'paws-relax-theme'),
        'update_item'           => __('Update Testimonial Types', 'paws-relax-theme'),
        'add_new_item'          => __('Add New Testimonial Type', 'paws-relax-theme'),
        'new_item_name'         => __('New Work Testimonial Types', 'paws-relax-theme'),
        'menu_name'             => __('Testimonial Types', 'paws-relax-theme'),
        'template_name'         => __('Testimonial Types Archives', 'paws-relax-theme'),
        'not_found'             => __('No Testimonial types found.', 'paws-relax-theme'),
        'no_terms'              => __('No Testimonial types', 'paws-relax-theme'),
        'items_list_navigation' => __('Testimonial Types list navigation', 'paws-relax-theme'),
        'items_list'            => __('Testimonial Types list', 'paws-relax-theme'),
        'item_link'             => __('Testimonial Types Link', 'paws-relax-theme'),
        'item_link_description' => __('A link to a Testimonial types.', 'paws-relax-theme'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'testimonial-types'),
    );

    register_taxonomy('paws-testimonial-types', array('paws-testimonial'), $args);

    // Add Team Specialties taxonomy
    $labels = array(
        'name'                  => _x('Specialty Types', 'taxonomy general name', 'paws-relax-theme'),
        'singular_name'         => _x('Specialty Types', 'taxonomy singular name', 'paws-relax-theme'),
        'search_items'          => __('Search Specialty Types', 'paws-relax-theme'),
        'all_items'             => __('All Specialty Types', 'paws-relax-theme'),
        'parent_item'           => __('Parent Specialty Types', 'paws-relax-theme'),
        'parent_item_colon'     => __('Parent Specialty Types:', 'paws-relax-theme'),
        'edit_item'             => __('Edit Specialty Types', 'paws-relax-theme'),
        'view_item'             => __('View Specialty Types', 'paws-relax-theme'),
        'update_item'           => __('Update Specialty Types', 'paws-relax-theme'),
        'add_new_item'          => __('Add New Specialty Type', 'paws-relax-theme'),
        'new_item_name'         => __('New Work Specialty Types', 'paws-relax-theme'),
        'menu_name'             => __('Specialty Types', 'paws-relax-theme'),
        'template_name'         => __('Specialty Types Archives', 'paws-relax-theme'),
        'not_found'             => __('No Specialty types found.', 'paws-relax-theme'),
        'no_terms'              => __('No Specialty types', 'paws-relax-theme'),
        'items_list_navigation' => __('Specialty Types list navigation', 'paws-relax-theme'),
        'items_list'            => __('Specialty Types list', 'paws-relax-theme'),
        'item_link'             => __('Specialty Types Link', 'paws-relax-theme'),
        'item_link_description' => __('A link to a Specialty types.', 'paws-relax-theme'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'specialty-types'),
    );

    register_taxonomy('paws-specialty-types', array('paws-team'), $args);
}


add_action('init', 'paws_relax_register_taxonomies');


function paws_relax_rewrite_flush()
{
    paws_relax_register_custom_post_types();
    paws_relax_register_taxonomies();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'paws_relax_rewrite_flush');
