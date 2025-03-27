<?php

/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<address <?php echo get_block_wrapper_attributes(); ?>>
	<?php if ($attributes['svgIcon']) : ?>
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" role="img"
			aria-label="Email Icon">
			<path
				d="M0 4c0-1.104.896-2 2-2h20c1.104 0 2 .896 2 2v16c0 1.104-.896 2-2 2H2c-1.104 0-2-.896-2-2V4zm22 0H2v1.586l10 6.414 10-6.414V4zm-10 9L2 7v11h20V7l-10 6z" />
		</svg>
	<?php endif; ?>
	<p><?php echo wp_kses_post(get_post_meta(324, 'company_email', true)); ?></p>
</address>