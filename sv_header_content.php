<?php
	namespace sv100;

	class sv_header_content extends init {
		public function init() {
			$this->set_module_title( __( 'SV Header Content', 'sv100' ) )
				->set_module_desc( __( 'Content Header Settings', 'sv100' ) )
				->load_child_modules()
				->set_css_cache_active()
				->set_section_title( $this->get_module_title() )
				->set_section_desc( $this->get_module_desc() )
				->set_section_icon('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 8h24v16h-24v-16zm0-8v6h24v-6h-24z"/></svg>')
				->set_section_template_path()
				->set_section_order(2300)
				->get_root()
				->add_section( $this );

			add_filter( 'body_class', function( $classes ) {
				$header_content_hidden = $this->hide_header() ? 'no_sv_header_content' : 'has_sv_header_content';

				return array_merge( $classes, array( $header_content_hidden ) );
			} );
		}
		// Loads required child modules
		protected function load_child_modules(): sv_header_content {
			require_once( $this->get_path('lib/modules/metabox.php') );
			$this->content_metabox = new sv_header_content_metabox();
			$this->content_metabox
				->set_root( $this->get_root() )
				->set_parent( $this )
				->init();

			return $this;
		}

		// Returns a child module of sv_content
		public function get_child_module( string $child ) {
			$child = 'content_' . $child;

			return $this->get_module( 'sv_header_content' )->$child;
		}
		protected function load_settings(): sv_header_content {
			// ### Content Header Settings ###
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

			/*
			 * @todo: reimplment when title has a max width setting
			$this->get_setting( 'block_align_title' )
				->set_title( __( 'Block Alignment', 'sv100' ) )
				->set_description( __( 'Defines the alignment of the title block inside the content header.', 'sv100' ) )
				->set_options( array(
					'left'	  => __( 'Left', 'sv100' ),
					'center'	=> __( 'Center', 'sv100' ),
					'right'	 => __( 'Right', 'sv100' )
				) )
				->set_default_value( 'center' )
				->load_type( 'select' );
			*/

			$this->get_setting( 'excerpt_show_single' )
				->set_title( __( 'Show Excerpt on single post', 'sv100' ) )
				->set_default_value( '1' )
				->load_type( 'checkbox' );

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


			// Color Settings
			$this->get_setting( 'bg_color' )
				->set_title( __( 'Background Color', 'sv100' ) )
				->set_default_value( '#f5f5f5' )
				->set_is_responsive(true)
				->load_type( 'color' );

			// Overlay Settings
			$this->get_setting('image_overlay_color')
				->set_title( __( 'Image Overlay Color', 'sv100' ) )
				->set_default_value( '0,0,0,0.3' )
				->load_type( 'color' );

			// Header Content Overlay
			$this->get_setting( 'header_content_overlay_color' )
				->set_title( __( 'Header Content Overlay Color', 'sv100' ) )
				->set_default_value( '0,0,0,0.3' )
				->load_type( 'color' );

			// ### Date Settings ###
			// Post
			$this->get_setting( 'show_date_post' )
				->set_title( __( 'Date on Posts', 'sv100' ) )
				->set_description( __( 'Show date on posts', 'sv100' ) )
				->set_default_value( 1 )
				->load_type( 'checkbox' );

			// Page
			$this->get_setting( 'show_date_page' )
				->set_title( __( 'Date on Pages', 'sv100' ) )
				->set_description( __( 'Show date on pages', 'sv100' ) )
				->set_default_value( 0 )
				->load_type( 'checkbox' );

			// Post
			$this->get_setting( 'show_date_modified_post' )
				->set_title( __( 'Modified Date on Posts', 'sv100' ) )
				->set_description( __( 'Show modified date on posts', 'sv100' ) )
				->set_default_value( 0 )
				->load_type( 'checkbox' );

			// Page
			$this->get_setting( 'show_date_modified_page' )
				->set_title( __( 'Modified Date on Pages', 'sv100' ) )
				->set_description( __( 'Show modified date on pages', 'sv100' ) )
				->set_default_value( 0 )
				->load_type( 'checkbox' );

			// ### Author Settings ###
			// Post
			$this->get_setting( 'show_author_post' )
				->set_title( __( 'Author on Posts', 'sv100' ) )
				->set_description( __( 'Show author on posts', 'sv100' ) )
				->set_default_value( 1 )
				->load_type( 'checkbox' );

			// Page
			$this->get_setting( 'show_author_page' )
				->set_title( __( 'Author on Pages', 'sv100' ) )
				->set_description( __( 'Show author on pages', 'sv100' ) )
				->set_default_value( 0 )
				->load_type( 'checkbox' );

			return $this;
		}

		protected function register_scripts(): sv_header_content {
			parent::register_scripts();

			$this->get_script( 'config' )->set_is_gutenberg(false);

			$this->get_script( 'featured_image' )
				->set_path( 'lib/css/common/featured_image.css' )
				->set_inline( true );

			return $this;
		}

		public function load( $settings = array() ): string {
			if($this->hide_header()){
				return '';
			}

			if(!is_admin()){
				$this->load_settings()->register_scripts();

				foreach($this->get_scripts() as $script){
					$script->set_is_enqueued();
				}
			}

			ob_start();

			require_once($this->get_path('lib/tpl/frontend/default.php' ));

			$output									= ob_get_contents();
			ob_end_clean();

			return $output;
		}

		public function get_header_content_overlay_color(): string{
			global $post;

			$setting 			= $this->get_setting( 'header_content_overlay_color' );
			$data 				= $setting->get_data();

			if(!$post){
				return $data;
			}

			$override_settings 	= get_post_meta(
				$post->ID,
				$this->get_child_module('metabox')
					->get_setting( 'header_content_override' )
					->get_prefix( $this->get_setting( 'header_content_override' )->get_ID() ),
				true
			);

			if ( is_single() || is_page() || is_front_page() ) {
				if ( $override_settings ) {
					if ( $post ) {
						$metabox_data = get_post_meta(
							$post->ID,
							$this->get_child_module('metabox')
								->get_setting( 'header_content_overlay_color' )
								->get_prefix( $this->get_setting( 'header_content_overlay_color' )->get_ID() ),
							true
						);

						if ( $metabox_data ) {
							$data = $metabox_data;
						}
					}
				}
			}

			$color = $setting->get_rgb( $data );

			return $color;
		}

		public function get_header_content_title_color(): string{
			global $post;

			$setting 			= $this->get_setting( 'text_color_title' );
			$data 				= $setting->get_data();

			if(!$post){
				return $data;
			}

			$override_settings 	= get_post_meta(
				$post->ID,
				$this->get_child_module('metabox')
					->get_setting( 'header_content_override' )
					->get_prefix( $this->get_setting( 'header_content_override' )->get_ID() ),
				true
			);

			if ( is_single() || is_page() || is_front_page() ) {
				if ( $override_settings ) {
					if ( $post ) {
						$metabox_data = get_post_meta(
							$post->ID,
							$this->get_child_module('metabox')
								->get_setting( 'text_color_title' )
								->get_prefix( $this->get_setting( 'text_color_title' )->get_ID() ),
							true
						);

						if ( $metabox_data ) {
							$data = $metabox_data;
						}
					}
				}
			}

			$color = $setting->get_rgb( $data );

			return $color;
		}

		public function get_header_content_excerpt_color(): string{
			global $post;

			$setting 			= $this->get_setting( 'text_color_excerpt' );
			$data 				= $setting->get_data();

			if(!$post){
				return $data;
			}

			$override_settings 	= get_post_meta(
				$post->ID,
				$this->get_child_module('metabox')
					->get_setting( 'header_content_override' )
					->get_prefix( $this->get_setting( 'header_content_override' )->get_ID() ),
				true
			);

			if ( is_single() || is_page() || is_front_page() ) {
				if ( $override_settings ) {
					if ( $post ) {
						$metabox_data = get_post_meta(
							$post->ID,
							$this->get_child_module('metabox')
								->get_setting('text_color_excerpt')
								->get_prefix($this->get_setting('text_color_excerpt')->get_ID()),
							true
						);

						if ( $metabox_data ) {
							$data = $metabox_data;
						}
					}
				}
			}

			$color = $setting->get_rgb( $data );

			return $color;
		}

		public function get_header_content_info_color(): string{
			global $post;

			$setting 			= $this->get_setting( 'text_color_meta' );
			$data 				= $setting->get_data();

			if(!$post){
				return $data;
			}

			$override_settings 	= get_post_meta(
				$post->ID,
				$this->get_child_module('metabox')
					->get_setting( 'header_content_override' )
					->get_prefix( $this->get_setting( 'header_content_override' )->get_ID() ),
				true
			);

			if ( $override_settings ) {
				if ( $post ) {
					$metabox_data = get_post_meta(
						$post->ID,
						$this->get_child_module('metabox')
							->get_setting('text_color_meta')
							->get_prefix( $this->get_setting('text_color_meta')->get_ID() ),
						true
					);

					if ( $metabox_data ) {
						$data = $metabox_data;
					}
				}
			}

			$color = $setting->get_rgb( $data );

			return $color;
		}

		public function hide_header(): bool {
			global $post;

			if(!$post){
				return false;
			}

			if ( get_post_meta(
					$post->ID,
					$this->get_child_module( 'metabox' )
						->get_setting( 'hide_header' )
						->get_prefix( $this->get_setting( 'hide_header' )->get_ID() ),
					true
				) == 1 ) {
				return true;
			}else{
				return false;
			}
		}

		public function hide_featured_image(): bool {
			global $post;

			if(!$post){
				return false;
			}

			if ( get_post_meta(
					$post->ID,
					$this->get_child_module( 'metabox' )
						->get_setting( 'hide_featured_image' )
						->get_prefix( $this->get_setting( 'hide_featured_image' )->get_ID() ),
					true
				) == 1 ) {
				return true;
			}else{
				return false;
			}
		}

		public function hide_title(): bool {
			global $post;

			if(!$post){
				return false;
			}

			if ( get_post_meta(
					$post->ID,
					$this->get_child_module( 'metabox' )
						->get_setting( 'hide_title' )
						->get_prefix( $this->get_setting( 'hide_title' )->get_ID() ),
					true
				) == 1 ) {
				return true;
			}else{
				return false;
			}
		}

		public function hide_excerpt(): bool {
			global $post;

			if(!$post){
				return false;
			}

			if ( get_post_meta(
					$post->ID,
					$this->get_child_module( 'metabox' )
						->get_setting( 'hide_excerpt' )
						->get_prefix( $this->get_setting( 'hide_excerpt' )->get_ID() ),
					true
				) == 1 ) {
				return true;
			}else{
				return !boolval($this->get_setting( 'excerpt_show_single' )->get_data());
			}
		}

		public function show_date(): bool {
			global $post;

			if(!$post){
				return false;
			}

			if ( get_post_meta(
					$post->ID,
					$this->get_child_module( 'metabox' )
						->get_setting( 'show_date' )
						->get_prefix( $this->get_setting( 'show_date' )->get_ID() ),
					true
				) == 1 ) {
				return true;
			}else{
				$post_type = get_post_type() == 'page' ? 'page' : 'post';
				return $this->get_setting( 'show_date_'.$post_type )->get_data() == 1 ? true : false;
			}
		}

		public function show_date_modified(): bool{
			global $post;

			if(!$post){
				return false;
			}

			if ( get_post_meta(
					$post->ID,
					$this->get_child_module( 'metabox' )
						->get_setting( 'show_date_modified' )
						->get_prefix( $this->get_setting( 'show_date_modified' )->get_ID() ),
					true
				) == 1 ) {
				return true;
			}else{
				$post_type = get_post_type() == 'page' ? 'page' : 'post';
				return $this->get_setting( 'show_date_modified_'.$post_type )->get_data() == 1 ? true : false;
			}
		}

		public function show_author(): bool{
			global $post;

			if(!$post){
				return false;
			}

			if ( get_post_meta(
					$post->ID,
					$this->get_child_module( 'metabox' )
						->get_setting( 'show_author' )
						->get_prefix( $this->get_setting( 'show_author' )->get_ID() ),
					true
				) == 1 ) {
				return true;
			}else{
				$post_type = get_post_type() == 'page' ? 'page' : 'post';
				return $this->get_setting( 'show_author_'.$post_type )->get_data() == 1 ? true : false;
			}
		}
		public function show_meta(): bool{
			if ( $this->show_author() || $this->show_date() || $this->show_date_modified() ) {
				return true;
			}

			return false;
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
		public function get_visibility(string $field): bool{
			$status = $this->get_setting( 'show_'.$field.'_' . get_post_type() )->get_data();

			return $status;
		}
	}