<?php
	echo $_s->build_css(
		'.sv100_sv_header_content',
		array_merge(
			$module->get_setting('padding')->get_css_data('padding'),
			$module->get_setting('margin')->get_css_data(),
			$module->get_setting('border')->get_css_data(),
			$module->get_setting('bg_color')->get_css_data('background-color'),
			$module->get_setting('outer_wrapper_max_width')->get_css_data('max-width')
		)
	);

	echo $_s->build_css(
		'.sv100_sv_header_content_wrapper',
		$module->get_setting('inner_wrapper_max_width')->get_css_data('max-width')
	);

	echo $_s->build_css(
		'.sv100_sv_header_content_content',
		array_merge(
			$module->get_setting('align')->get_css_data('margin'),
			$module->get_setting('content_max_width')->get_css_data('max-width'),
			$module->get_setting('min_height')->get_css_data('min-height')
		)
	);
?>

.sv100_sv_header_content_wrapper {
background-color: rgba(<?php echo $module->get_header_content_overlay_color(); ?>);
}