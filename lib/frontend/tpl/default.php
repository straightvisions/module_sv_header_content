<div class="<?php echo $this->get_prefix(); ?> <?php echo $this->has_featured_image() ? $this->get_prefix('featured_image') : ''; ?>">
	<div class="<?php echo $this->get_prefix( 'wrapper' ); ?>">
		<div class="<?php echo $this->get_prefix( 'content' ); ?>">
			<?php the_category(); ?>
			<h1><?php the_title()?></h1>
			<?php if($this->show_excerpt_single_post() && get_the_excerpt()){ ?>
			<div class="<?php echo $this->get_prefix( 'excerpt' ); ?>"><?php the_excerpt(); ?></div>
			<?php } ?>
			<?php require( $this->get_path( 'lib/frontend/tpl/meta.php' ) ); ?>
		</div>
	</div>
	<?php require( $this->get_path( 'lib/frontend/tpl/featured_image.php' ) ); ?>
</div>