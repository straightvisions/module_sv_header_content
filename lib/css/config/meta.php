<?php
	$properties						= array();

	$text_color_meta 				= $module->get_header_content_color('text_color_meta');

	if($text_color_meta){
		$properties['color']		= $_s->prepare_css_property($text_color_meta,'rgba(',')');
	}

	$block_align_meta				= $module->get_setting('block_align_meta')->get_data();
	if($block_align_meta){
		switch ( $block_align_meta ) {
			case 'left':
				$properties['justify-content']		= $_s->prepare_css_property('flex-start','','');
				break;
			case 'center':
				$properties['justify-content']		= $_s->prepare_css_property('center','','');
				break;
			case 'right':
				$properties['justify-content']		= $_s->prepare_css_property('flex-end','','');
		};
	}

	echo $_s->build_css(
		'.sv100_sv_header_content_meta, .sv100_sv_header_content_meta a',
		array_merge(
			$properties,
			$module->get_setting('font_meta')->get_css_data('font-family'),
			$module->get_setting('font_size_meta')->get_css_data('font-size','','px'),
			$module->get_setting('line_height_meta')->get_css_data('line-height'),
			$module->get_setting('text_align_meta')->get_css_data('text-align')
		)
	);