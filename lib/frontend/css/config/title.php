<?php
	$font_title			= $font_family_title ? $script->get_parent()->get_module( 'sv_webfontloader' )->get_font_by_label( $font_family_title ) : false;
	$text_color_title 	= $script->get_parent()->get_header_content_title_color();

	$properties						= array();

	if($font_size_title) {
		$properties['font-size']	= $setting->prepare_css_property_responsive($font_size_title,'','px');
	}

	if($line_height_title) {
		$properties['line-height']	= $setting->prepare_css_property_responsive($line_height_title);
	}

	if($text_color_title){
		$properties['color']		= $setting->prepare_css_property($text_color_title,'rgba(',')');
	}

	if(isset($font_title['family'])){
		$properties['font-family']	= $setting->prepare_css_property($font_title['family'],'',', sans-serif;');
		$properties['font-weight']	= $setting->prepare_css_property($font_title['weight'],'','');
	}

	if($text_align_title){
		$properties['text-align']		= $setting->prepare_css_property($text_align_title,'','');
	}

	echo $setting->build_css(
		'.sv100_sv_header_content h1',
		$properties
	);
