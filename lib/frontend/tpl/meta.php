<?php if ( $this->show_meta() ) { ?>
	<div class="<?php echo $this->get_prefix( 'meta' ); ?>">
		<?php

		$meta = array();
		if($this->show_author()){
			$meta[]		= '<span class="'.$this->get_prefix('author').'">'.get_the_author().'</span>';
		}
		if($this->show_date()){
			$meta[]		= '<span class="'.$this->get_prefix('date').'">'.get_the_date().'</span>';
		}
		if($this->show_date_modified()){
			$meta[]		= '<span class="'.$this->get_prefix('date_modified').'">'.get_the_modified_date().'</span>';
		}

		echo implode(' - ', $meta);

		?>
	</div>
<?php } ?>