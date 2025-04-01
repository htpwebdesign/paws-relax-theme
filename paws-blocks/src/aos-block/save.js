import { useBlockProps, InnerBlocks } from "@wordpress/block-editor";

export default function save({ attributes }) {
	const { animation } = attributes;

	const blockProps = useBlockProps.save({
		className: "aos-wrapper",
		"data-aos": animation,
	});

	return (
		<div {...blockProps}>
			<InnerBlocks.Content />
		</div>
	);
}
