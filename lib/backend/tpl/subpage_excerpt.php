<?php if ( current_user_can( 'activate_plugins' ) ) { ?>
	<div class="sv_setting_subpage">
		<h2><?php _e('Excerpt', 'sv100'); ?></h2>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'font_family_excerpt' )->form();
				echo $module->get_setting( 'font_size_excerpt' )->form();
				echo $module->get_setting( 'text_color_excerpt' )->form();
				echo $module->get_setting( 'line_height_excerpt' )->form();
			?>
		</div>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'text_align_excerpt' )->form();
				echo $module->get_setting( 'block_align_excerpt' )->form();
			?>
		</div>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'margin_excerpt' )->form();
				echo $module->get_setting( 'padding_excerpt' )->form();
			?>
		</div>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'border_excerpt' )->form();
			?>
		</div>
	</div>
<?php } ?>