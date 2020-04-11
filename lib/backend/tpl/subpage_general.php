<?php if ( current_user_can( 'activate_plugins' ) ) { ?>
	<div class="sv_setting_subpage">
		<h2><?php _e('General', 'sv100'); ?></h2>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'content_header_wrapper_max_width' )->form();
				echo $module->get_setting( 'content_header_max_width' )->form();
				echo $module->get_setting( 'content_header_align' )->form();
			?>
		</div>
		<h3 class="divider"><?php _e( 'Colors', 'sv100' ); ?></h3>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'bg_color' )->form();
				echo $module->get_setting( 'image_overlay_color' )->form();
				echo $module->get_setting( 'header_content_overlay_color' )->form();
			?>
		</div>
	</div>
<?php } ?>