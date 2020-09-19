<?php
	$properties						= array();

	$text_color_title 	= $script->get_parent()->get_header_content_title_color();
	if($text_color_title){
		$properties['color']		= $setting->prepare_css_property($text_color_title,'rgba(',')');
	}

	echo $_s->build_css(
		'.sv100_sv_header_content h1',
		array_merge(
			$properties,
			$script->get_parent()->get_setting('font_title')->get_css_data('font-family'),
			$script->get_parent()->get_setting('font_size_title')->get_css_data('font-size','','px'),
			$script->get_parent()->get_setting('line_height_title')->get_css_data('line-height'),
			$script->get_parent()->get_setting('text_align_title')->get_css_data('text-align')
		)
	);