<?php if($this->show_part('excerpt') && get_the_excerpt()){ ?>
	<div class="<?php echo $this->get_prefix( 'excerpt' ); ?>"><?php the_excerpt(); ?></div>
<?php } ?>