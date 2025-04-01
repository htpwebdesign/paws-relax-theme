<?php
// This file is generated. Do not modify it manually.
return array(
	'aos-block' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'paws-blocks/aos-block',
		'version' => '0.1.0',
		'title' => 'Animate On Scroll',
		'category' => 'design',
		'icon' => 'slides',
		'description' => 'Wrap blocks with animation effects when scrolled into view',
		'supports' => array(
			'html' => false,
			'anchor' => true
		),
		'attributes' => array(
			'animation' => array(
				'type' => 'string',
				'default' => 'fade-up'
			)
		),
		'textdomain' => 'paws-blocks',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css'
	),
	'company-address' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'paws-blocks/company-address',
		'version' => '1.0.0',
		'title' => 'Company Address',
		'category' => 'text',
		'icon' => 'location',
		'description' => 'Output the company address with an optional icon.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false,
			'spacing' => array(
				'margin' => true,
				'padding' => true,
				'blockGap' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'textAlign' => true
			),
			'color' => array(
				'textColor' => true
			)
		),
		'attributes' => array(
			'svgIcon' => array(
				'type' => 'boolean',
				'default' => false
			)
		),
		'textdomain' => 'paws-blocks',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php'
	),
	'company-email' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'paws-blocks/company-email',
		'version' => '0.1.0',
		'title' => 'Company Email',
		'category' => 'text',
		'icon' => 'email',
		'description' => 'Output the company email with an optional icon.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false,
			'spacing' => array(
				'margin' => true,
				'padding' => true,
				'blockGap' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'textAlign' => true
			),
			'color' => array(
				'textColor' => true
			)
		),
		'attributes' => array(
			'svgIcon' => array(
				'type' => 'boolean',
				'default' => false
			)
		),
		'textdomain' => 'mindset-blocks',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php'
	),
	'company-phonenumber' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'paws-blocks/company-phonenumber',
		'version' => '0.1.0',
		'title' => 'Company Phonenumber',
		'category' => 'text',
		'icon' => 'phone',
		'description' => 'Company Phonenumber',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false,
			'spacing' => array(
				'margin' => true,
				'padding' => true,
				'blockGap' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'textAlign' => true
			),
			'color' => array(
				'textColor' => true
			)
		),
		'attributes' => array(
			'svgIcon' => array(
				'type' => 'boolean',
				'default' => false
			)
		),
		'textdomain' => 'paws-blocks',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScript' => 'file:./view.js'
	),
	'copyright' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'paws-blocks/copyright',
		'version' => '0.1.0',
		'title' => 'Copyright',
		'category' => 'text',
		'icon' => 'calendar',
		'description' => 'Copyright',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false,
			'align' => true,
			'fontSize' => true
		),
		'attributes' => array(
			'startingYear' => array(
				'type' => 'string',
				'default' => 2020
			)
		),
		'textdomain' => 'paws-blocks',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php'
	)
);
