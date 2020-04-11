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
		$properties['margin-left']		= $setting->prepare_css_property((($block_align_excerpt == 'left') ? '0' : ''),'','');
		$properties['margin-right']		= $setting->prepare_css_property((($block_align_excerpt == 'right') ? '0' : ''),'','');
	}

	echo $setting->build_css(
		'.sv100_sv_header_content_excerpt *',
		$properties
	);