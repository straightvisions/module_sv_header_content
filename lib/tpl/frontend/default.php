<div class="<?php echo $this->get_prefix(); ?> <?php echo $this->has_featured_image() ? $this->get_prefix('featured_image') : ''; ?>">
	<div class="<?php echo $this->get_prefix( 'wrapper' ); ?>">
		<div class="<?php echo $this->get_prefix( 'content' ); ?>">
			<?php the_category(); ?>
			<?php require( $this->get_path( 'lib/tpl/frontend/title.php' ) ); ?>
			<?php require( $this->get_path( 'lib/tpl/frontend/excerpt.php' ) ); ?>
			<?php require( $this->get_path( 'lib/tpl/frontend/meta.php' ) ); ?>
		</div>
	</div>
	<?php require( $this->get_path( 'lib/tpl/frontend/featured_image.php' ) ); ?>
</div>