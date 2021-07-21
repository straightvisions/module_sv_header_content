<?php
	$properties								= array();

	$header_content_overlay_color			= $module->get_header_content_color('header_content_overlay_color');

	if($header_content_overlay_color){
		$properties['background-color']		= $_s->prepare_css_property($header_content_overlay_color,'rgba(',')');
	}

	echo $_s->build_css(
		'.sv100_sv_header_content_background::before',
		$properties
	);