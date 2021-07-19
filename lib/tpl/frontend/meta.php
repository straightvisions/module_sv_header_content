<?php if ( $this->show_part('meta') ) { ?>
	<div class="<?php echo $this->get_prefix( 'meta' ); ?>">
		<?php
			if($this->show_part('author')){
				echo '<span class="'.$this->get_prefix('author').'">'.get_the_author().'</span>';
			}
			if($this->show_part('date')){
				echo '<span class="'.$this->get_prefix('date').'">'.get_the_date().'</span>';
			}
			if($this->show_part('date_modified')){
				echo '<span class="'.$this->get_prefix('date_modified').'">'.get_the_modified_date().'</span>';
			}
		?>
	</div>
<?php } ?>