<?php
	echo $_s->build_css(
		'.sv100_sv_header_content_background::before',
		array_merge(
			$script->get_parent()->get_setting('image_overlay_color')->get_css_data('background-color')
		)
	);