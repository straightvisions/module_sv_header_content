<?php
	$properties						= array();

	$text_color_meta 				= $script->get_parent()->get_header_content_info_color();

	if($text_color_meta){
		$properties['color']		= $setting->prepare_css_property($text_color_meta,'rgba(',')');
	}

	echo $_s->build_css(
		'.sv100_sv_header_content_meta',
		array_merge(
			$properties,
			$script->get_parent()->get_setting('font_meta')->get_css_data('font-family'),
			$script->get_parent()->get_setting('font_size_meta')->get_css_data('font-size','','px'),
			$script->get_parent()->get_setting('line_height_meta')->get_css_data('line-height')
		)
	);