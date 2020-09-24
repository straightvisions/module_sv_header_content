<?php

	if($module->has_featured_image()){
		require_once( $module->get_path( 'lib/css/config/featured_image.php' ) );
	}

	if ( $module->show_meta() ) {
		require_once( $module->get_path( 'lib/css/config/meta.php' ) );
	}

	require_once( $module->get_path( 'lib/css/config/title.php' ) );
	require_once( $module->get_path( 'lib/css/config/excerpt.php' ) );
	require_once( $module->get_path( 'lib/css/config/general.php' ) );