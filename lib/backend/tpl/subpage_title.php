<?php if ( current_user_can( 'activate_plugins' ) ) { ?>
	<div class="sv_setting_subpage">
		<h2><?php _e('Title', 'sv100'); ?></h2>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'font_family_title' )->form();
				echo $module->get_setting( 'font_size_title' )->form();
				echo $module->get_setting( 'text_color_title' )->form();
				echo $module->get_setting( 'line_height_title' )->form();
			?>
		</div>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'text_align_title' )->form();
				//echo $module->get_setting( 'block_align_title' )->form();
			?>
		</div>
	</div>
<?php } ?>