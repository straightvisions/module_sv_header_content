<?php
	if ( $module->show_part('header') ) {
		if ($module->show_part('show_featured_image') && $module->has_featured_image()) {
			require_once($module->get_path('lib/css/config/featured_image.php'));
		}

		require_once($module->get_path('lib/css/config/meta.php'));

		if ($module->show_part('title')) {
			require_once($module->get_path('lib/css/config/title.php'));
		}
		if ($module->show_part('excerpt')) {
			require_once($module->get_path('lib/css/config/excerpt.php'));
		}

		require_once($module->get_path('lib/css/config/general.php'));
	}