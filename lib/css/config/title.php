<?php
	$properties						= array();

	$text_color_title 	= $module->get_header_content_color('text_color_title');
	if($text_color_title){
		$properties['color']		= $_s->prepare_css_property($text_color_title,'rgba(',')');
	}

	$text_align_title 	= $module->get_setting('text_align_title')->get_data();
	if($text_align_title){
		$properties['text-align']		= $module->get_setting('text_align_title')->get_data();
	}

	echo $_s->build_css(
		'.sv100_sv_header_content h1, .editor-styles-wrapper h1.wp-block-post-title',
		array_merge(
			$properties,
			$module->get_setting('font_title')->get_css_data('font-family'),
			$module->get_setting('font_size_title')->get_css_data('font-size','','px'),
			$module->get_setting('line_height_title')->get_css_data('line-height')
		)
	);