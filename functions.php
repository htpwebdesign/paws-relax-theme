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
}

// Custom Post Types & Custom Taxonomies
require get_template_directory() . '/inc/post-types-taxonomies.php';

// Load custom blocks
require get_theme_file_path() . '/paws-blocks/paws-blocks.php';







