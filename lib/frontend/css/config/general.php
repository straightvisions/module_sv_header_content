<?php
	echo $_s->build_css(
		'.sv100_sv_header_content',
		array_merge(
			$script->get_parent()->get_setting('padding')->get_css_data('padding'),
			$script->get_parent()->get_setting('margin')->get_css_data(),
			$script->get_parent()->get_setting('border')->get_css_data(),
			$script->get_parent()->get_setting('bg_color')->get_css_data('background-color'),
			$script->get_parent()->get_setting('outer_wrapper_max_width')->get_css_data('max-width')
		)
	);

	echo $_s->build_css(
		'.sv100_sv_header_content_wrapper',
		$script->get_parent()->get_setting('inner_wrapper_max_width')->get_css_data('max-width')
	);

	echo $_s->build_css(
		'.sv100_sv_header_content_content',
		array_merge(
			$script->get_parent()->get_setting('align')->get_css_data('margin'),
			$script->get_parent()->get_setting('content_max_width')->get_css_data('max-width'),
			$script->get_parent()->get_setting('min_height')->get_css_data('min-height')
		)
	);
?>

.sv100_sv_header_content_content{
	background-color: rgba(<?php echo $script->get_parent()->get_header_content_overlay_color(); ?>);
}