<?php
	if($script->get_parent()->has_featured_image()){
		require_once( $script->get_parent()->get_path( 'lib/css/config/featured_image.php' ) );
	}

	if ( $script->get_parent()->show_meta() ) {
		require_once( $script->get_parent()->get_path( 'lib/css/config/meta.php' ) );
	}

	require_once( $script->get_parent()->get_path( 'lib/css/config/title.php' ) );
	require_once( $script->get_parent()->get_path( 'lib/css/config/excerpt.php' ) );

	require_once( $script->get_parent()->get_path( 'lib/css/config/general.php' ) );