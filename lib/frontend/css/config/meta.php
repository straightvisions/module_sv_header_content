<?php

	$font_meta 						= $font_family_meta ? $script->get_parent()->get_module( 'sv_webfontloader' )->get_font_by_label( $font_family_meta ) : false;
	$text_color_meta 				= $script->get_parent()->get_header_content_info_color();

	$properties						= array();

	if($font_size_meta) {
		$properties['font-size']	= $setting->prepare_css_property_responsive($font_size_meta,'','px');
	}

	if($line_height_meta) {
		$properties['line-height']	= $setting->prepare_css_property_responsive($line_height_meta);
	}

	if($text_color_meta){
		$properties['color']		= $setting->prepare_css_property($text_color_meta,'rgba(',')');
	}

	if(isset($font_meta['family'])){
		$properties['font-family']	= $setting->prepare_css_property($font_meta['family'],'',', sans-serif;');
		$properties['font-weight']	= $setting->prepare_css_property($font_meta['weight'],'','');
	}

	echo $setting->build_css(
		'.sv100_sv_header_content_meta *',
		$properties
	);