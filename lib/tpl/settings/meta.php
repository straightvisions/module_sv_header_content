<?php if ( current_user_can( 'activate_plugins' ) ) { ?>
<div class="sv_setting_subpage">
	<h2><?php _e('Meta', 'sv100'); ?></h2>
	<div class="sv_setting_flex">
		<?php
			echo $module->get_setting( 'font_meta' )->form();
			echo $module->get_setting( 'font_size_meta' )->form();
		?>
	</div>
	<div class="sv_setting_flex">
		<?php
			echo $module->get_setting( 'text_color_meta' )->form();
			echo $module->get_setting( 'line_height_meta' )->form();
			echo $module->get_setting( 'text_align_meta' )->form();
			echo $module->get_setting( 'block_align_meta' )->form();
			echo $module->get_setting( 'show_category' )->form();
		?>
	</div>
	<h3 class="divider"><?php _e( 'Date', 'sv100' ); ?></h3>
	<p><?php _e('You can override this within each post or page.', 'sv100'); ?></p>
	<div class="sv_setting_flex">
		<?php
			echo $module->get_setting( 'show_date' )->form();
			echo $module->get_setting( 'show_date_modified' )->form();
		?>
	</div>

	<h3 class="divider"><?php _e( 'Author', 'sv100' ); ?></h3>
	<p><?php _e('You can override this within each post or page.', 'sv100'); ?></p>
	<div class="sv_setting_flex">
		<?php
			echo $module->get_setting( 'show_author' )->form();
		?>
	</div>
</div>
<?php } ?>