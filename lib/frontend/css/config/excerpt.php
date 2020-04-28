<?php
	echo $_s->build_css(
		'.sv100_sv_header_content_excerpt',
		array_merge(
			$script->get_parent()->get_setting('font_family_excerpt')->get_css_data('font-family'),
			$script->get_parent()->get_setting('font_size_excerpt')->get_css_data('font-size','','px'),
			$script->get_parent()->get_setting('line_height_excerpt')->get_css_data('line-height'),
			$script->get_parent()->get_setting('padding_excerpt')->get_css_data('padding'),
			$script->get_parent()->get_setting('margin_excerpt')->get_css_data(),
			$script->get_parent()->get_setting('border_excerpt')->get_css_data()
		)
	);

	$properties						= array();

	$text_color_excerpt = $script->get_parent()->get_header_content_excerpt_color();

	if($text_color_excerpt){
		$properties['color']		= $setting->prepare_css_property($text_color_excerpt,'rgba(',')');
	}

	$block_align_excerpt				= $script->get_parent()->get_setting('border_excerpt')->get_data();
	if($block_align_excerpt){
		switch ( $block_align_excerpt ) {
			case 'left':
				$properties['align-items']		= $setting->prepare_css_property('flex-start','','');
				break;
			case 'center':
				$properties['align-items']		= $setting->prepare_css_property('center','','');
				break;
			case 'right':
				$properties['align-items']		= $setting->prepare_css_property('flex-end','','');
		};
	}

	echo $_s->build_css(
		'.sv100_sv_header_content_excerpt *',
		$properties
	);