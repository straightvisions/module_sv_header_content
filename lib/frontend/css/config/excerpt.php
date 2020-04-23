<?php
	$font_excerpt 		= $font_family_excerpt ? $script->get_parent()->get_module( 'sv_webfontloader' )->get_font_by_label( $font_family_excerpt ) : false;
	$text_color_excerpt = $script->get_parent()->get_header_content_excerpt_color();

	$properties						= array();

	if($font_size_excerpt) {
		$properties['font-size']	= $setting->prepare_css_property_responsive($font_size_excerpt,'','px');
	}

	if($line_height_excerpt) {
		$properties['line-height']	= $setting->prepare_css_property_responsive($line_height_excerpt);
	}

	if($text_color_excerpt){
		$properties['color']		= $setting->prepare_css_property($text_color_excerpt,'rgba(',')');
	}

	if(isset($font_excerpt['family'])){
		$properties['font-family']	= $setting->prepare_css_property($font_excerpt['family'],'',', sans-serif;');
		$properties['font-weight']	= $setting->prepare_css_property($font_excerpt['weight'],'','');
	}

	if($block_align_excerpt){
		switch ( $block_align_excerpt ) {
			case 'left':
				$align					= 'flex-start';
				break;
			case 'center':
				$align					= 'center';
				break;
			case 'right':
				$align					= 'flex-end';
		};

		$properties['align-items']		= $setting->prepare_css_property($align,'','');
	}

	// Margin
	if($margin_excerpt) {
		$imploded		= false;
		foreach($margin_excerpt as $breakpoint => $val) {
			$top = (isset($val['top']) && strlen($val['top']) > 0) ? $val['top'] : false;
			$right = (isset($val['right']) && strlen($val['right']) > 0) ? $val['right'] : false;
			$bottom = (isset($val['bottom']) && strlen($val['bottom']) > 0) ? $val['bottom'] : false;
			$left = (isset($val['left']) && strlen($val['left']) > 0) ? $val['left'] : false;

			if($top !== false || $right !== false || $bottom !== false || $left !== false) {
				$imploded[$breakpoint] = $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
			}
		}
		if($imploded) {
			$properties['margin'] = $setting->prepare_css_property_responsive($imploded, '', '');
		}
	}

	// Padding
	// @todo: same as margin, refactor to avoid doubled code
	if($padding_excerpt) {
		$imploded		= false;
		foreach($padding_excerpt as $breakpoint => $val) {
			$top = (isset($val['top']) && strlen($val['top']) > 0) ? $val['top'] : false;
			$right = (isset($val['right']) && strlen($val['right']) > 0) ? $val['right'] : false;
			$bottom = (isset($val['bottom']) && strlen($val['bottom']) > 0) ? $val['bottom'] : false;
			$left = (isset($val['left']) && strlen($val['left']) > 0) ? $val['left'] : false;

			if($top !== false || $right !== false || $bottom !== false || $left !== false) {
				$imploded[$breakpoint] = $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
			}
		}
		if($imploded) {
			$properties['padding'] = $setting->prepare_css_property_responsive($imploded, '', '');
		}
	}

	// border
	if($border_excerpt) {
		$border = $border_excerpt;
		if($border['top_width']){
			$val		= $border['top_width'].' '.$border['top_style'].' rgba('.$border['color'].')';
			$properties['border-top'] = $setting->prepare_css_property_responsive($val, '', '');
		}
		if($border['right_width']){
			$val		= $border['right_width'].' '.$border['right_style'].' rgba('.$border['color'].')';
			$properties['border-right'] = $setting->prepare_css_property_responsive($val, '', '');
		}
		if($border['bottom_width']){
			$val		= $border['bottom_width'].' '.$border['bottom_style'].' rgba('.$border['color'].')';
			$properties['border-bottom'] = $setting->prepare_css_property_responsive($val, '', '');
		}
		if($border['left_width']){
			$val		= $border['left_width'].' '.$border['left_style'].' rgba('.$border['color'].')';
			$properties['border-left'] = $setting->prepare_css_property_responsive($val, '', '');
		}

		if($border['top_left_radius']+$border['top_right_radius']+$border['bottom_right_radius']+$border['bottom_left_radius']!==0) {
			$border_radius = $border['top_left_radius'] . ' ' . $border['top_right_radius'] . ' ' . $border['bottom_right_radius'] . ' ' . $border['bottom_left_radius'];
			$properties['border-radius'] = $setting->prepare_css_property_responsive($border_radius, '', '');
		}
	}

	echo $setting->build_css(
		'.sv100_sv_header_content_excerpt *',
		$properties
	);