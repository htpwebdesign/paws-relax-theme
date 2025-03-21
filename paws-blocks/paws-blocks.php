<?php

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function paws_blocks_paws_blocks_block_init()
{
	if (function_exists('wp_register_block_types_from_metadata_collection')) { // Function introduced in WordPress 6.8.
		wp_register_block_types_from_metadata_collection(__DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php');
	} else {
		if (function_exists('wp_register_block_metadata_collection')) { // Function introduced in WordPress 6.7.
			wp_register_block_metadata_collection(__DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php');
		}
		$manifest_data = require __DIR__ . '/build/blocks-manifest.php';
		foreach (array_keys($manifest_data) as $block_type) {
			register_block_type(__DIR__ . "/build/{$block_type}");
		}
	}
}
add_action('init', 'paws_blocks_paws_blocks_block_init');