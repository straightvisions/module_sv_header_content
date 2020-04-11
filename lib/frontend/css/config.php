<?php
	// ##### SETTINGS #####

	// Fetches all settings and creates new variables with the setting ID as name and setting data as value.
	// This reduces the lines of code for the needed setting values.
	foreach ( $script->get_parent()->get_settings() as $setting ) {
		if ( $setting->get_type() !== false ) {
			${ $setting->get_ID() } = $setting->get_data();

			// If setting is color, it gets the value in the RGB-Format
			if ( $setting->get_type() === 'setting_color' ) {
				${ $setting->get_ID() } = $setting->get_rgb( ${ $setting->get_ID() } );
			}
		}
	}

	if($script->get_parent()->has_featured_image()){
		require_once( $script->get_parent()->get_path( 'lib/frontend/css/config/featured_image.php' ) );
	}

	if ( $script->get_parent()->show_meta() ) {
		require_once( $script->get_parent()->get_path( 'lib/frontend/css/config/meta.php' ) );
	}

	require_once( $script->get_parent()->get_path( 'lib/frontend/css/config/title.php' ) );
	require_once( $script->get_parent()->get_path( 'lib/frontend/css/config/excerpt.php' ) );


	// Those can be overwritten by metabox settings
	$header_content_overlay_color = $script->get_parent()->get_header_content_overlay_color();
?>

.sv100_sv_header_content {
    background-color: rgba(<?php echo $bg_color; ?>);
}

.sv100_sv_header_content_content {
    background-color: rgba(<?php echo $header_content_overlay_color; ?>);
	align-items:
	<?php
		switch ( $block_align_title ) {
			case 'left':
				echo 'flex-start';
				break;
			case 'center':
				echo 'center';
				break;
			case 'right':
				echo 'flex-end';
		};
	?>;
	margin: <?php echo $content_header_align; ?>;
	max-width: <?php echo $content_header_max_width; ?>;
}

.sv100_sv_content_header .sv100_sv_content_header_content_wrapper {
	max-width: <?php echo $content_header_wrapper_max_width; ?>;
}