import { __ } from "@wordpress/i18n";
import {
	useBlockProps,
	InnerBlocks,
	InspectorControls,
} from "@wordpress/block-editor";
import { PanelBody, SelectControl } from "@wordpress/components";
import "./editor.scss";

export default function Edit({ attributes, setAttributes }) {
	const { animation } = attributes;

	const blockProps = useBlockProps({
		className: "aos-wrapper",
		"data-aos": animation,
	});

	const animationOptions = [
		{ value: "fade-up", label: __("Fade Up", "paws-blocks") },
		{ value: "fade-down", label: __("Fade Down", "paws-blocks") },
		{ value: "fade-left", label: __("Fade Left", "paws-blocks") },
		{ value: "fade-right", label: __("Fade Right", "paws-blocks") },
		{ value: "zoom-in", label: __("Zoom In", "paws-blocks") },
		{ value: "zoom-out", label: __("Zoom Out", "paws-blocks") },
		{ value: "flip-up", label: __("Flip Up", "paws-blocks") },
		{ value: "flip-down", label: __("Flip Down", "paws-blocks") },
	];

	return (
		<>
			<InspectorControls>
				<PanelBody title={__("Animation Settings", "paws-blocks")}>
					<SelectControl
						label={__("Animation Type", "paws-blocks")}
						value={animation}
						options={animationOptions}
						onChange={(value) => setAttributes({ animation: value })}
					/>
				</PanelBody>
			</InspectorControls>

			<div {...blockProps}>
				<InnerBlocks />
			</div>
		</>
	);
}
