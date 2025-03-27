<?php

/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<address <?php echo get_block_wrapper_attributes(); ?>>
	<?php if ($attributes['svgIcon']): ?>
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" role="img"
			aria-label="Phone Icon">
			<path
				d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.27 1.12.36 2.33.55 3.57.55.55 0 1 .45 1 1V21c0 .55-.45 1-1 1-10.39 0-19-8.61-19-19 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.24.19 2.45.55 3.57.09.35 0 .74-.27 1.02l-2.2 2.2z" />
		</svg>
	<?php endif; ?>
	<p><?php echo wp_kses_post(get_post_meta(101, 'company_phonenumber', true)); ?></p>
</address>