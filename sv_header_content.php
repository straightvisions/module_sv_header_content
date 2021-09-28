<?php
	namespace sv100;

	class sv_header_content extends init {
		protected static $header_effects = array();
		protected static $mix_blend_mode = array();

		public function init() {
			static::$header_effects = array(
				''					=> __('Default', 'sv100'),
				'aurora'			=> __('Aurora', 'sv100'),
				'coalesce'			=> __('Coalesce', 'sv100'),
				'pipeline'			=> __('Pipeline', 'sv100'),
				'shift'				=> __('Shift', 'sv100'),
				'swirl'				=> __('Swirl', 'sv100')
			);

			static::$mix_blend_mode = array(
				''					=> __('Default', 'sv100'),
				'color'				=> __('Color', 'sv100'),
				'color-burn'		=> __('Color Burn', 'sv100'),
				'color-dodge'		=> __('Color Dodge', 'sv100'),
				'darken'			=> __('Darken', 'sv100'),
				'difference'		=> __('Difference', 'sv100'),
				'exclusion'			=> __('Exclusion', 'sv100'),
				'hard-light'		=> __('Hard Light', 'sv100'),
				'hue'				=> __('Hue', 'sv100'),
				'lighten'			=> __('Lighten', 'sv100'),
				'luminosity'		=> __('Luminosity', 'sv100'),
				'multiply'			=> __('Multiply', 'sv100'),
				'overlay'			=> __('Overlay', 'sv100'),
				'saturation'		=> __('Saturation', 'sv100'),
				'screen'			=> __('Screen', 'sv100'),
				'soft-light'		=> __('Soft Light', 'sv100')

			);

			$this->set_module_title( __( 'SV Header Content', 'sv100' ) )
				->set_module_desc( __( 'Content Header Settings', 'sv100' ) )
				//->set_css_cache_active() // CSS cache deactivated due to use of metaboxes in this module
				->set_section_title( $this->get_module_title() )
				->set_section_desc( $this->get_module_desc() )
				->set_section_icon('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 8h24v16h-24v-16zm0-8v6h24v-6h-24z"/></svg>')
				->set_section_template_path()
				->set_section_order(2300)
				->get_root()
				->add_section( $this );

			add_action('init', function(){
				$this->load_settings()->add_metaboxes();
			});

			add_filter( 'body_class', function( $classes ) {
				$header_content_hidden = $this->show_part('header') ? 'has_sv_header_content' : 'no_sv_header_content';

				return array_merge( $classes, array( $header_content_hidden ) );
			} );
		}
		protected function load_settings(): sv_header_content {
			// ### Content Header Settings ###

			$this->get_setting( 'show_header' )
				->set_title( __( 'Show Header', 'sv100' ) )
				->set_description( __( 'Select Post Types on which header should be shown.', 'sv100' ) )
				->set_options(get_post_types(array('public' => true)))
				->set_default_value( 1 )
				->load_type( 'checkbox' );

			$this->get_setting( 'show_featured_image' )
				->set_title( __( 'Show Featured Image', 'sv100' ) )
				->set_description( __( 'Select Post Types on which Featured Image should be shown.', 'sv100' ) )
				->set_options(get_post_types(array('public' => true)))
				->set_default_value( 1 )
				->load_type( 'checkbox' );

			$this->get_setting( 'show_title' )
				->set_title( __( 'Show Title', 'sv100' ) )
				->set_description( __( 'Select Post Types on which title should be shown.', 'sv100' ) )
				->set_options(get_post_types(array('public' => true)))
				->set_default_value( 1 )
				->load_type( 'checkbox' );

			$this->get_setting( 'show_excerpt' )
				->set_title( __( 'Show Excerpt', 'sv100' ) )
				->set_description( __( 'Select Post Types on which excerpt should be shown.', 'sv100' ) )
				->set_options(get_post_types(array('public' => true)))
				->set_default_value( 1 )
				->load_type( 'checkbox' );

			$this->get_setting( 'show_date' )
				->set_title( __( 'Show Date', 'sv100' ) )
				->set_description( __( 'Select Post Types on which date should be shown.', 'sv100' ) )
				->set_options(get_post_types(array('public' => true)))
				->set_default_value( 1 )
				->load_type( 'checkbox' );

			$this->get_setting( 'show_date_modified' )
				->set_title( __( 'Show Date Modified', 'sv100' ) )
				->set_description( __( 'Select Post Types on which modified date should be shown.', 'sv100' ) )
				->set_options(get_post_types(array('public' => true)))
				->set_default_value( 0 )
				->load_type( 'checkbox' );

			$this->get_setting( 'show_author' )
				->set_title( __( 'Show Author', 'sv100' ) )
				->set_description( __( 'Select Post Types on which title should be shown.', 'sv100' ) )
				->set_options(get_post_types(array('public' => true)))
				->set_default_value( 1 )
				->load_type( 'checkbox' );

			$this->get_setting( 'show_category' )
				->set_title( __( 'Show Category', 'sv100' ) )
				->set_description( __( 'Select Post Types on which category should be shown.', 'sv100' ) )
				->set_options(get_post_types(array('public' => true)))
				->set_default_value( 1 )
				->load_type( 'checkbox' );

			$this->get_setting( 'header_effect' )
				->set_title( __( 'Header Effect', 'sv100' ) )
				->set_description( __( 'Select default header effect.', 'sv100' ) )
				->set_options(static::$header_effects)
				->load_type( 'select' );

			$this->get_setting( 'mix_blend_mode' )
				->set_title( __( 'Mix Blend Mode', 'sv100' ) )
				->set_description( __( 'Select blend mix mode for header effect.', 'sv100' ) )
				->set_options(static::$mix_blend_mode)
				->load_type( 'select' );

			$this->get_setting( 'background_blur' )
				->set_title( __( 'Background Blur', 'sv100' ) )
				->set_description( __( 'Set Blur Effect in Pixel', 'sv100' ) )
				->set_default_value(10)
				->load_type( 'number' );

			// Max Width
			$this->get_setting( 'outer_wrapper_max_width' )
				->set_title( __( 'Outer Wrapper Max Width', 'sv100' ) )
				->set_description( __( 'Set the max width of the wrapper for the content within the Content-Header', 'sv100' ) )
				->set_options( $this->get_module('sv_common') ? $this->get_module('sv_common')->get_max_width_options() : array('' => __('Please activate module SV Common for this Feature.', 'sv100')) )
				->set_default_value( '100%' )
				->set_is_responsive(true)
				->load_type( 'select' );

			$this->get_setting( 'inner_wrapper_max_width' )
				->set_title( __( 'Inner Wrapper Max Width', 'sv100' ) )
				->set_description( __( 'Set the max width of the wrapper for the content within the Content-Header', 'sv100' ) )
				->set_options( $this->get_module('sv_common') ? $this->get_module('sv_common')->get_max_width_options() : array('' => __('Please activate module SV Common for this Feature.', 'sv100')) )
				->set_default_value( '100%' )
				->set_is_responsive(true)
				->load_type( 'select' );

			$this->get_setting( 'content_max_width' )
				->set_title( __( 'Content Max Width', 'sv100' ) )
				->set_description( __( 'Set the max width of the content within the Content-Header', 'sv100' ) )
				->set_options( $this->get_module('sv_common') ? $this->get_module('sv_common')->get_max_width_options() : array('' => __('Please activate module SV Common for this Feature.', 'sv100')) )
				->set_default_value( '100%' )
				->set_is_responsive(true)
				->load_type( 'select' );

			$this->get_setting( 'align' )
				->set_title( __( 'Alignment', 'sv100' ) )
				->set_description( __( 'Set the alignment of the Content-Header', 'sv100' ) )
				->set_options( array(
					'0 auto'									=> __( 'center', 'sv100' ),
					'0 auto 0 0'								=> __( 'left', 'sv100' ),
					'0 0 0 auto'								=> __( 'right', 'sv100' )
				) )
				->set_default_value( '10px auto' )
				->set_is_responsive(true)
				->load_type( 'select' );

			$this->get_setting( 'min_height' )
				->set_title( __( 'Minimum Height', 'sv100' ) )
				->set_description( __( 'Set minimum height for Content-Header', 'sv100' ) )
				->set_default_value( '60vh' )
				->set_is_responsive(true)
				->load_type( 'text' );

			// Spacing
			$this->get_setting( 'margin' )
				->set_title( __( 'Margin', 'sv100' ) )
				->set_is_responsive(true)
				->set_default_value(
					array(
						'top'		=> '0px',
						'right'		=> 'auto',
						'bottom'	=> '0px',
						'left'		=> 'auto'
					)
				)
				->load_type( 'margin' );

			$this->get_setting( 'padding' )
				->set_title( __( 'Padding', 'sv100' ) )
				->set_is_responsive(true)
				->load_type( 'margin' );

			$this->get_setting( 'border' )
				->set_title( __( 'Border', 'sv100' ) )
				->set_is_responsive(true)
				->load_type( 'border' );

			// Alignment
			$this->get_setting( 'text_align_title' )
				->set_title( __( 'Text Alignment', 'sv100' ) )
				->set_description( __( 'Defines the alignment of the title inside the content header.', 'sv100' ) )
				->set_options( array(
					'left'	  => __( 'Left', 'sv100' ),
					'center'	=> __( 'Center', 'sv100' ),
					'right'	 => __( 'Right', 'sv100' )
				) )
				->set_default_value( 'center' )
				->load_type( 'select' );

			$this->get_setting( 'text_align_excerpt' )
				->set_title( __( 'Text Alignment', 'sv100' ) )
				->set_description( __( 'Defines the alignment of the excerpt inside the content header.', 'sv100' ) )
				->set_options( array(
					'left'	  => __( 'Left', 'sv100' ),
					'center'	=> __( 'Center', 'sv100' ),
					'right'	 => __( 'Right', 'sv100' )
				) )
				->set_default_value( 'left' )
				->set_is_responsive(true)
				->load_type( 'select' );

			$this->get_setting( 'block_align_excerpt' )
				->set_title( __( 'Block Alignment', 'sv100' ) )
				->set_description( __( 'Defines the alignment of the excerpt block inside the content header.', 'sv100' ) )
				->set_options( array(
					'left'	  => __( 'Left', 'sv100' ),
					'center'	=> __( 'Center', 'sv100' ),
					'right'	 => __( 'Right', 'sv100' )
				) )
				->set_default_value( 'center' )
				->load_type( 'select' );

			$this->get_setting( 'margin_excerpt' )
				->set_title( __( 'Margin', 'sv100' ) )
				->set_is_responsive(true)
				->set_default_value(array(
					'top'		=> '0',
					'right'		=> 'auto',
					'bottom'	=> '0',
					'left'		=> 'auto'
				))
				->load_type( 'margin' );

			$this->get_setting( 'padding_excerpt' )
				->set_title( __( 'Padding', 'sv100' ) )
				->set_is_responsive(true)
				->load_type( 'margin' );

			$this->get_setting( 'border_excerpt' )
				->set_title( __( 'Border', 'sv100' ) )
				->set_is_responsive(true)
				->load_type( 'border' );


			// Title
			$this->get_setting( 'font_title' )
				->set_title( __( 'Font Family', 'sv100' ) )
				->set_description( __( 'Choose a font for your text.', 'sv100' ) )
				->set_is_responsive(true)
				->set_options( $this->get_module( 'sv_webfontloader' ) ? $this->get_module( 'sv_webfontloader' )->get_font_options() : array('' => __('Please activate module SV Webfontloader for this Feature.', 'sv100')) )
				->load_type( 'select' );

			$this->get_setting( 'font_size_title' )
				->set_title( __( 'Font Size', 'sv100' ) )
				->set_description( __( 'Font Size in pixel.', 'sv100' ) )
				->set_default_value( 48 )
				->set_is_responsive(true)
				->load_type( 'number' );

			$this->get_setting( 'line_height_title' )
				->set_title( __( 'Line Height', 'sv100' ) )
				->set_description( __( 'Set line height as multiplier or with a unit.', 'sv100' ) )
				->set_default_value( '1.3' )
				->set_is_responsive(true)
				->load_type( 'text' );

			$this->get_setting( 'text_color_title' )
				->set_title( __( 'Text Color', 'sv100' ) )
				->set_default_value( '#1e1e1e' )
				->load_type( 'color' );

			// Excerpt
			$this->get_setting( 'font_excerpt' )
				->set_title( __( 'Font Family', 'sv100' ) )
				->set_description( __( 'Choose a font for your text.', 'sv100' ) )
				->set_options( $this->get_module( 'sv_webfontloader' ) ? $this->get_module( 'sv_webfontloader' )->get_font_options() : array('' => __('Please activate module SV Webfontloader for this Feature.', 'sv100')) )
				->set_is_responsive(true)
				->load_type( 'select' );

			$this->get_setting( 'font_size_excerpt' )
				->set_title( __( 'Font Size', 'sv100' ) )
				->set_description( __( 'Font Size in pixel.', 'sv100' ) )
				->set_default_value( 16 )
				->set_is_responsive(true)
				->load_type( 'number' );

			$this->get_setting( 'line_height_excerpt' )
				->set_title( __( 'Line Height', 'sv100' ) )
				->set_description( __( 'Set line height as multiplier or with a unit.', 'sv100' ) )
				->set_default_value( '1.3' )
				->set_is_responsive(true)
				->load_type( 'text' );

			$this->get_setting( 'text_color_excerpt' )
				->set_title( __( 'Text Color', 'sv100' ) )
				->set_default_value( '#828282' )
				->load_type( 'color' );

			// META
			$this->get_setting( 'font_meta' )
				->set_title( __( 'Font Family', 'sv100' ) )
				->set_description( __( 'Choose a font for your text.', 'sv100' ) )
				->set_options( $this->get_module( 'sv_webfontloader' ) ? $this->get_module( 'sv_webfontloader' )->get_font_options() : array('' => __('Please activate module SV Webfontloader for this Feature.', 'sv100')) )
				->set_is_responsive(true)
				->load_type( 'select' );

			$this->get_setting( 'font_size_meta' )
				->set_title( __( 'Font Size', 'sv100' ) )
				->set_description( __( 'Font Size in pixel.', 'sv100' ) )
				->set_default_value( 14 )
				->set_is_responsive(true)
				->load_type( 'number' );

			$this->get_setting( 'line_height_meta' )
				->set_title( __( 'Line Height', 'sv100' ) )
				->set_description( __( 'Set line height as multiplier or with a unit.', 'sv100' ) )
				->set_default_value( '1.3' )
				->set_is_responsive(true)
				->load_type( 'text' );

			$this->get_setting( 'text_color_meta' )
				->set_title( __( 'Text Color', 'sv100' ) )
				->set_description( __( 'Color for the post author and date in the header.', 'sv100' ) )
				->set_default_value( '#828282' )
				->load_type( 'color' );

			$this->get_setting( 'text_align_meta' )
				->set_title( __( 'Text Alignment', 'sv100' ) )
				->set_description( __( 'Defines the alignment of the meta inside the content header.', 'sv100' ) )
				->set_options( array(
					'left'	  => __( 'Left', 'sv100' ),
					'center'	=> __( 'Center', 'sv100' ),
					'right'	 => __( 'Right', 'sv100' )
				) )
				->set_default_value( 'left' )
				->set_is_responsive(true)
				->load_type( 'select' );

			$this->get_setting( 'block_align_meta' )
				->set_title( __( 'Block Alignment', 'sv100' ) )
				->set_description( __( 'Defines the alignment of the meta block inside the content header.', 'sv100' ) )
				->set_options( array(
					'left'	  => __( 'Left', 'sv100' ),
					'center'	=> __( 'Center', 'sv100' ),
					'right'	 => __( 'Right', 'sv100' )
				) )
				->set_default_value( 'center' )
				->load_type( 'select' );


			// Color Settings
			$this->get_setting( 'bg_color' )
				->set_title( __( 'Background Color', 'sv100' ) )
				->set_default_value( '#f5f5f5' )
				->set_is_responsive(true)
				->load_type( 'color' );

			// Header Content Overlay
			$this->get_setting( 'header_content_overlay_color' )
				->set_title( __( 'Header Content Overlay Color', 'sv100' ) )
				->set_default_value( '0,0,0,0' )
				->load_type( 'color' );
			return $this;
		}

		protected function register_scripts(): sv_header_content {
			parent::register_scripts();

			$this->get_script('config')
				->set_path('lib/css/config/init.php')
				->set_is_gutenberg()
				->set_inline(true);

			$this->get_script('common')
				->set_path('lib/css/common/common.css')
				->set_inline(true);

			$this->get_script( 'featured_image' )
				->set_path( 'lib/css/common/featured_image.css' )
				->set_inline( true );

			return $this;
		}

		public function load( $settings = array() ): string {
			if(!$this->show_part('header')){
				return '';
			}

			if(!is_admin()){
				$this->register_scripts();

				foreach($this->get_scripts() as $script){
					$script->set_is_enqueued();
				}

				$this->load_header_effect();
			}

			ob_start();

			require_once($this->get_path('lib/tpl/frontend/default.php' ));

			$output									= ob_get_contents();
			ob_end_clean();

			return $output;
		}

		public function has_color_override(): bool{
			global $post;

			if(!$post){
				return false;
			}

			$override_settings = $this->metaboxes->get_data( $post->ID, $this->get_prefix('header_content_override') );

			return boolval($override_settings);
		}

		public function get_header_content_color(string $field): string{
			global $post;

			if ( $this->has_color_override() ) {
				$data = $this->metaboxes->get_data( $post->ID, $this->get_prefix($field), $this->get_setting( $field )->get_data() );
			}else{
				$data = $this->get_setting( $field )->get_data();
			}

			$color = $this->get_setting( $field )->get_rgb( $data );

			return $color;
		}

		public function get_header_content_mix_blend_mode(): string{
			global $post;

			if(!$post){
				return false;
			}

			$setting = $this->metaboxes->get_data( $post->ID, $this->get_prefix('mix_blend_mode'), $this->get_setting( 'mix_blend_mode' )->get_data() );

			// global settings allow post type based selection and are arrays
			if(is_array($setting)){
				// check for current post type
				if(isset($setting[get_post_type()])){
					$value = strval($setting[get_post_type()]);
				}else{
					$value = strval($setting['post']); // post type not found in settings, use post-setting instead as fallback
				}
			}else{
				$value = strval($setting);
			}

			return $value;
		}

		public function get_header_content_background_blur(): string{
			global $post;

			if(!$post){
				return false;
			}

			$setting = $this->metaboxes->get_data( $post->ID, $this->get_prefix('background_blur'), $this->get_setting( 'background_blur' )->get_data() );

			// global settings allow post type based selection and are arrays
			if(is_array($setting)){
				// check for current post type
				if(isset($setting[get_post_type()])){
					$value = intval($setting[get_post_type()]);
				}else{
					$value = intval($setting['post']); // post type not found in settings, use post-setting instead as fallback
				}
			}else{
				$value = intval($setting);
			}

			return $value;
		}

		public function has_header_effect(): bool{
			$value = $this->get_header_effect();

			if(strlen($value) === '' || !array_key_exists($value, static::$header_effects)){
				return false;
			}

			return true;
		}

		public function get_header_effect(): string{
			global $post;

			if(!$post){
				return $this;
			}

			$setting = $this->metaboxes->get_data( $post->ID, $this->get_prefix('header_effect'), $this->get_setting( 'header_effect' )->get_data() );

			// global settings allow post type based selection and are arrays
			if(is_array($setting)){
				// check for current post type
				if(isset($setting[get_post_type()])){
					$value = strval($setting[get_post_type()]);
				}else{
					$value = strval($setting['post']); // post type not found in settings, use post-setting instead as fallback
				}
			}else{
				$value = strval($setting);
			}

			return $value;
		}

		public function load_header_effect(): sv_header_content {
			if(!$this->has_header_effect()){
				return $this;
			}

			$value = $this->get_header_effect();

			$this->get_script('header_effect_noise_js')
				->set_type('js')
				->set_path('lib/ambient_canvas_backgrounds/js/noise.min.js')
				->set_is_enqueued();

			$this->get_script('header_effect_util_js')
				->set_type('js')
				->set_path('lib/ambient_canvas_backgrounds/js/util.js')
				->set_is_enqueued();

			$this->get_script('header_effect_js')
				->set_type('js')
				->set_path('lib/ambient_canvas_backgrounds/js/'.$value.'.js')
				->set_is_enqueued();

			return $this;
		}

		public function get_featured_image(): string{
			if ( $this->get_module( 'sv_featured_image' ) && ! empty( $this->get_module( 'sv_featured_image' )->load() ) ) {
				return $this->get_module( 'sv_featured_image' )->load( array( 'size' => 'full' ) );
			}
			if ( has_post_thumbnail() && strlen(  get_the_post_thumbnail( null, 'full' ) ) > 0 ) {
				return get_the_post_thumbnail( null, 'full' );
			}

			return  '';
		}
		public function has_featured_image(): bool{
			if(strlen($this->get_featured_image()) > 0){
				return true;
			}

			return false;
		}
		private function add_metaboxes(): sv_header_content{
			$this->metaboxes			= $this->get_root()->get_module('sv_metabox');

			$states = array(
				''				=> __('Default', 'sv100'),
				'0'				=> __('Hidden', 'sv100'),
				'1'				=> __('Show', 'sv100')
			);

			$this->metaboxes->get_setting( $this->get_prefix('show_header') )
				->set_title( __('Show Header', 'sv100') )
				->set_description( __('Show Content Header at all', 'sv100') )
				->load_type( 'select' )
				->set_options($states);

			$this->metaboxes->get_setting( $this->get_prefix('show_featured_image') )
				->set_title( __('Show Featured Image', 'sv100') )
				->set_description( __('Visibility of this element.', 'sv100') )
				->load_type( 'select' )
				->set_options($states);

			$this->metaboxes->get_setting( $this->get_prefix('show_title') )
				->set_title( __('Show Title', 'sv100') )
				->set_description( __('Visibility of this element.', 'sv100') )
				->load_type( 'select' )
				->set_options($states);

			$this->metaboxes->get_setting( $this->get_prefix('show_excerpt') )
				->set_title( __('Show Excerpt', 'sv100') )
				->set_description( __('Visibility of this element.', 'sv100') )
				->load_type( 'select' )
				->set_options($states);

			$this->metaboxes->get_setting( $this->get_prefix('show_date') )
				->set_title( __( 'Show Date', 'sv100' ) )
				->set_description( __('Visibility of this element.', 'sv100') )
				->load_type( 'select' )
				->set_options($states);

			$this->metaboxes->get_setting( $this->get_prefix('show_date_modified') )
				->set_title( __( 'Show Modified Date', 'sv100' ) )
				->set_description( __('Visibility of this element.', 'sv100') )
				->load_type( 'select' )
				->set_options($states);

			$this->metaboxes->get_setting( $this->get_prefix('show_author') )
				->set_title( __( 'Show Author', 'sv100' ) )
				->set_description( __('Visibility of this element.', 'sv100') )
				->load_type( 'select' )
				->set_options($states);

			$this->metaboxes->get_setting( $this->get_prefix('show_category') )
				->set_title( __( 'Show Category', 'sv100' ) )
				->set_description( __('Visibility of this element.', 'sv100') )
				->load_type( 'select' )
				->set_options($states);

			$this->metaboxes->get_setting( $this->get_prefix('header_effect') )
				->set_title( __( 'Header Effect', 'sv100' ) )
				->set_description( __( 'Select header effect.', 'sv100' ) )
				->set_options(array_merge(
					static::$header_effects,
					array('nothing' => __('Nothing', 'sv100'))
				))
				->load_type( 'select' );

			$this->metaboxes->get_setting( $this->get_prefix('mix_blend_mode') )
				->set_title( __( 'Mix Blend Mode', 'sv100' ) )
				->set_description( __( 'Select blend mix mode for header effect.', 'sv100' ) )
				->set_options(array_merge(
					static::$mix_blend_mode,
					array('nothing' => __('Nothing', 'sv100'))
				))
				->load_type( 'select' );

			$this->metaboxes->get_setting( $this->get_prefix('background_blur') )
				->set_title( __( 'Background Blur', 'sv100' ) )
				->set_description( __( 'Set Blur Effect in Pixel', 'sv100' ) )
				->load_type( 'number' );

			$this->metaboxes->get_setting( $this->get_prefix('header_content_override') )
				->set_title( __( 'Override Default Header Content Settings', 'sv100' ) )
				->set_default_value(0)
				->load_type( 'checkbox' );

			$this->metaboxes->get_setting( $this->get_prefix('header_content_overlay_color') )
				->set_title( $this->get_setting('header_content_overlay_color')->get_title() )
				->set_description( $this->get_setting('header_content_overlay_color')->get_description() )
				->load_type( 'color' );

			$this->metaboxes->get_setting( $this->get_prefix('text_color_title') )
				->set_title( __('Header Title: ','sv100').$this->get_setting('text_color_title')->get_title() )
				->set_description( $this->get_setting('text_color_title')->get_description() )
				->load_type( 'color' );

			$this->metaboxes->get_setting( $this->get_prefix('text_color_excerpt') )
				->set_title( __('Header Excerpt: ','sv100').$this->get_setting('text_color_excerpt')->get_title() )
				->set_description( $this->get_setting('text_color_excerpt')->get_description() )
				->load_type( 'color' );

			$this->metaboxes->get_setting( $this->get_prefix('text_color_meta') )
				->set_title( __('Header Meta: ','sv100').$this->get_setting('text_color_meta')->get_title() )
				->set_description( $this->get_setting('text_color_meta')->get_description() )
				->load_type( 'color' );

			return $this;
		}
	}