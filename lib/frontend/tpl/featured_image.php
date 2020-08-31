<?php if($this->has_featured_image() && !$this->hide_featured_image()){ ?>
<div class="<?php echo $this->get_prefix( 'background' ); ?>">
	<?php echo $this->get_featured_image(); ?>
</div>
<?php } ?>