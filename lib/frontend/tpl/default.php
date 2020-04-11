<div class="<?php echo $this->get_prefix(); ?> <?php echo $this->has_featured_image() ? $this->get_prefix('featured_image') : ''; ?>">
	<div class="<?php echo $this->get_prefix( 'wrapper' ); ?>">
		<div class="<?php echo $this->get_prefix( 'content' ); ?>">
			<h1><?php the_title()?></h1>
			<div class="<?php echo $this->get_prefix( 'excerpt' ); ?>"><?php the_excerpt(); ?></div>
			<?php require( $this->get_path( 'lib/frontend/tpl/meta.php' ) ); ?>
		</div>
	</div>
	<?php require( $this->get_path( 'lib/frontend/tpl/featured_image.php' ) ); ?>
</div>