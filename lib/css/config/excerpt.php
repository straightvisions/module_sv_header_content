<?php
	echo $_s->build_css(
		'.sv100_sv_header_content_excerpt',
		array_merge(
			$module->get_setting('font_excerpt')->get_css_data('font-family'),
			$module->get_setting('font_size_excerpt')->get_css_data('font-size','','px'),
			$module->get_setting('line_height_excerpt')->get_css_data('line-height'),
			$module->get_setting('text_align_excerpt')->get_css_data('text-align'),
			$module->get_setting('padding_excerpt')->get_css_data('padding'),
			$module->get_setting('margin_excerpt')->get_css_data('margin'),
			$module->get_setting('border_excerpt')->get_css_data(),
			$module->get_setting('order_excerpt')->get_css_data('order')
		)
	);

	$properties						= array();

	$text_color_excerpt = $module->get_header_content_color('text_color_excerpt');

	if($text_color_excerpt){
		$properties['color']		= $_s->prepare_css_property($text_color_excerpt,'rgba(',')');
	}
	
	$properties['justify-content']  = $_s->prepare_css_property_responsive($module->get_setting('block_align_excerpt')->get_data());

	echo $_s->build_css(
		'.sv100_sv_header_content_excerpt',
		$properties
	);
	