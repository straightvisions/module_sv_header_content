<?php if ( current_user_can( 'activate_plugins' ) ) { ?>
	<div class="sv_setting_subpage">
		<h2><?php _e('General', 'sv100'); ?></h2>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'show_header' )->form();
				echo $module->get_setting( 'show_featured_image' )->form();
			?>
		</div>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'order_title' )->form();
				echo $module->get_setting( 'order_excerpt' )->form();
				echo $module->get_setting( 'order_meta' )->form();
			?>
		</div>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'header_effect' )->form();
				echo $module->get_setting( 'mix_blend_mode' )->form();
				echo $module->get_setting( 'background_blur' )->form();
			?>
		</div>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'outer_wrapper_max_width' )->form();
				echo $module->get_setting( 'inner_wrapper_max_width' )->form();
				echo $module->get_setting( 'content_max_width' )->form();
			?>
		</div>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'align' )->form();
				echo $module->get_setting( 'min_height' )->form();
			?>
		</div>
		<h3 class="divider"><?php _e( 'Colors', 'sv100' ); ?></h3>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'bg_color' )->form();
				echo $module->get_setting( 'header_content_overlay_color' )->form();
			?>
		</div>
	</div>
<?php } ?>