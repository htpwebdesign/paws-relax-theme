/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from "@wordpress/i18n";

/**
 * Provides utilities to interact with block props and render block content.
 * - useBlockProps: Handles block wrapper attributes like className and styles.
 * - RichText: A component for rich text editing within blocks.
 * - InspectorControls: Allows adding custom controls to the block editor sidebar.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/
 */
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from "@wordpress/block-editor";

/**
 * Enables interaction with WordPress entities (e.g., posts, users) using the core data store.
 * - useEntityProp: Allows easy access to WordPress custom fields.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-core-data/#useentityprop
 */
import { useEntityProp } from "@wordpress/core-data";

/**
 * Provides pre-built UI components for creating block settings in the editor.
 * - PanelBody: Groups settings into collapsible panels.
 * - PanelRow: Lays out content or controls in rows within a panel.
 * - ToggleControl: A toggle switch control for boolean settings.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/components/panel/
 * @see https://developer.wordpress.org/block-editor/reference-guides/components/toggle-control/
 */
import { PanelBody, PanelRow, ToggleControl } from "@wordpress/components";

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {
	// Set the post ID of your Contact Page
	const postID = 324;

	// Fetch meta data as an object and the setMeta function
	const [meta, setMeta] = useEntityProp("postType", "page", "meta", postID);

	// Destructure all our meta data for ease of use
	const { company_address } = meta;

	// Flexible helper for setting a single meta value w/o mutating state
	const updateMeta = (key, value) => {
		setMeta({ ...meta, [key]: value });
	};

	const { svgIcon } = attributes;

	return (
		<>
			<address {...useBlockProps()}>
				{svgIcon && (
					<svg
						xmlns="http://www.w3.org/2000/svg"
						width="24"
						height="24"
						viewBox="0 0 24 24"
						role="img"
						aria-label="Location Icon"
					>
						<path d="M12 0c-3.148 0-6 2.553-6 5.702 0 3.148 2.602 6.907 6 12.298 3.398-5.391 6-9.15 6-12.298 0-3.149-2.851-5.702-6-5.702zm0 8c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2zm4 14.5c0 .828-1.79 1.5-4 1.5s-4-.672-4-1.5 1.79-1.5 4-1.5 4 .672 4 1.5z" />
					</svg>
				)}
				<RichText
					placeholder={__("Enter address here...", "paws-blocks")}
					tagName="p"
					value={company_address}
					onChange={(nextValue) => updateMeta("company_address", nextValue)}
				/>
			</address>
			<InspectorControls>
				<PanelBody title={__("Settings", "paws-blocks")}>
					<PanelRow>
						<ToggleControl
							label={__("Show SVG Icon", "paws-blocks")}
							checked={svgIcon}
							onChange={(value) => setAttributes({ svgIcon: value })}
							help={__(
								"Display an SVG icon next to the address.",
								"paws-blocks",
							)}
						/>
					</PanelRow>
				</PanelBody>
			</InspectorControls>
		</>
	);
}
