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
        'item_revereted_to_draft'  => __('Team reverted to draft.', 'paws-relax-theme'),
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
        'rewrite'                 => array('slug' => 'Team'),
        'capability_type'         => 'post',
        'has_archive'             => false,
        'hierarchical'            => false,
        'menu_position'           => 5,
        'menu_icon'               => 'dashicons-groups',
        'supports'                => array('title', 'editor', 'thumbnail'),
        'template'                => array(

            array('core/paragraph', array(
                'placeholder'     => 'Enter name here...',
                'lock'            => array('move' => true, 'remove' => true),
            )),
            array('core/paragraph', array(
                'placeholder'     => 'Enter title here...',
                'lock'            => array('move' => true, 'remove' => true),
            )),
        ),
        'template_lock'           => 'all',
    );
    register_post_type('paws-relax-theme', $args);

// Testimonials CPT
    $labels = array(
        'name'                  => _x( 'Testimonials', 'post type general name', 'paws-relax-theme' ),
        'singular_name'         => _x( 'Testimonial', 'post type singular name', 'paws-relax-theme' ),
        'menu_name'             => _x( 'Testimonials', 'admin menu', 'paws-relax-theme' ),
        'add_new'               => _x( 'Add New', 'testimonial', 'paws-relax-theme' ),
        'add_new_item'          => __( 'Add New Testimonial', 'paws-relax-theme' ),
        'new_item'              => __( 'New Testimonial', 'paws-relax-theme' ),
        'edit_item'             => __( 'Edit Testimonial', 'paws-relax-theme' ),
        'view_item'             => __( 'View Testimonial', 'paws-relax-theme'  ),
        'all_items'             => __( 'All Testimonials', 'paws-relax-theme' ),
        'search_items'          => __( 'Search Testimonials', 'paws-relax-theme' ),
        'parent_item_colon'     => __( 'Parent Testimonials:', 'paws-relax-theme' ),
        'not_found'             => __( 'No testimonials found.', 'paws-relax-theme' ),
        'not_found_in_trash'    => __( 'No testimonials found in Trash.', 'paws-relax-theme' ),
        'item_link'             => __( 'Testimonial link.', 'paws-relax-theme' ),
        'item_link_description' => __( 'A link to a testimonial.', 'paws-relax-theme' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonials' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-heart',
        'supports'           => array( 'title', 'editor' ),
        'template'           => array( array( 'core/pullquote' ) ),
        'template_lock'      => 'all'
    );

    register_post_type( 'paws-relax-testimonial', $args );



}