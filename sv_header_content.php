<?php
	namespace sv100;

	/**
	 * @version         4.150
	 * @author			straightvisions GmbH
	 * @package			sv100
	 * @copyright		2019 straightvisions GmbH
	 * @link			https://straightvisions.com
	 * @since			1.000
	 * @license			See license.txt or https://straightvisions.com
	 */

	class sv_header_content extends init {
		public function init() {
			$this->set_module_title( __( 'SV Header Content', 'sv100' ) )
				->set_module_desc( __( 'Content Header Settings', 'sv100' ) )
				->load_child_modules()
				->load_settings()
				->register_scripts()
				->set_section_title( __( 'Header Content', 'sv100' ) )
				->set_section_desc( $this->get_module_desc() )
				->set_section_type( 'settings' )
				->set_section_template_path( $this->get_path( 'lib/backend/tpl/settings.php' ) )
				->set_section_order(23)
				->get_root()
				->add_section( $this );
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
			$this->get_setting( 'wrapper_max_width' )
				->set_title( __( 'Wrapper Max Width', 'sv100' ) )
				->set_description( __( 'Set the max width of the wrapper for the content within the Content-Header', 'sv100' ) )
				->set_options( array(
					'100%'										=> __( 'Full', 'sv100' ),
					'var( --sv100_sv_common-max-width-lg )'	=> __( 'Wide', 'sv100' ),
					'var( --sv100_sv_common-max-width-txt )'	=> __( 'Normal', 'sv100' )
				) )
				->set_default_value( '100%' )
				->load_type( 'select' );

			$this->get_setting( 'max_width' )
				->set_title( __( 'Max Width', 'sv100' ) )
				->set_description( __( 'Set the max width of the content within the Content-Header', 'sv100' ) )
				->set_options( array(
					'100%'										=> __( 'Full', 'sv100' ),
					'var( --sv100_sv_common-max-width-lg )'	=> __( 'Wide', 'sv100' ),
					'var( --sv100_sv_common-max-width-txt )'	=> __( 'Normal', 'sv100' )
				) )
				->set_default_value( '100%' )
				->load_type( 'select' );

			$this->get_setting( 'align' )
				->set_title( __( 'Alignment', 'sv100' ) )
				->set_description( __( 'Set the alignment of the Content-Header', 'sv100' ) )
				->set_options( array(
					'10px auto'									=> __( 'center', 'sv100' ),
					'10px auto 10px 0'								=> __( 'left', 'sv100' ),
					'10px 0 10px auto'								=> __( 'right', 'sv100' )
				) )
				->set_default_value( '10px auto' )
				->load_type( 'select' );

			$this->get_setting( 'min_height' )
				->set_title( __( 'Minimum Height', 'sv100' ) )
				->set_description( __( 'Set minimum height for Content-Header', 'sv100' ) )
				->set_default_value( '60vh' )
				->load_type( 'text' );

			// Alignment
			$this->get_setting( 'text_align_title' )
				->set_title( __( 'Text Alignment', 'sv100' ) )
				->set_description( __( 'Defines the alignment of the title inside the content header.', 'sv100' ) )
				->set_options( array(
					'left'      => __( 'Left', 'sv100' ),
					'center'    => __( 'Center', 'sv100' ),
					'right'     => __( 'Right', 'sv100' )
				) )
				->set_default_value( 'center' )
				->load_type( 'select' );

			/*
			 * @todo: reimplment when title has a max width setting
			$this->get_setting( 'block_align_title' )
				->set_title( __( 'Block Alignment', 'sv100' ) )
				->set_description( __( 'Defines the alignment of the title block inside the content header.', 'sv100' ) )
				->set_options( array(
					'left'      => __( 'Left', 'sv100' ),
					'center'    => __( 'Center', 'sv100' ),
					'right'     => __( 'Right', 'sv100' )
				) )
				->set_default_value( 'center' )
				->load_type( 'select' );
			*/

			$this->get_setting( 'text_align_excerpt' )
				->set_title( __( 'Text Alignment', 'sv100' ) )
				->set_description( __( 'Defines the alignment of the excerpt inside the content header.', 'sv100' ) )
				->set_options( array(
					'left'      => __( 'Left', 'sv100' ),
					'center'    => __( 'Center', 'sv100' ),
					'right'     => __( 'Right', 'sv100' )
				) )
				->set_default_value( 'left' )
				->load_type( 'select' );

			$this->get_setting( 'block_align_excerpt' )
				->set_title( __( 'Block Alignment', 'sv100' ) )
				->set_description( __( 'Defines the alignment of the excerpt block inside the content header.', 'sv100' ) )
				->set_options( array(
					'left'      => __( 'Left', 'sv100' ),
					'center'    => __( 'Center', 'sv100' ),
					'right'     => __( 'Right', 'sv100' )
				) )
				->set_default_value( 'center' )
				->load_type( 'select' );

			$this->get_setting( 'margin_excerpt' )
				->set_title( __( 'Margin', 'sv100' ) )
				->set_is_responsive(true)
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
			$this->get_setting( 'font_family_title' )
				->set_title( __( 'Font Family', 'sv100' ) )
				->set_description( __( 'Choose a font for your text.', 'sv100' ) )
				->set_options( $this->get_module( 'sv_webfontloader' )->get_font_options() )
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
			$this->get_setting( 'font_family_excerpt' )
				->set_title( __( 'Font Family', 'sv100' ) )
				->set_description( __( 'Choose a font for your text.', 'sv100' ) )
				->set_options( $this->get_module( 'sv_webfontloader' )->get_font_options() )
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
			$this->get_setting( 'font_family_meta' )
				->set_title( __( 'Font Family', 'sv100' ) )
				->set_description( __( 'Choose a font for your text.', 'sv100' ) )
				->set_options( $this->get_module( 'sv_webfontloader' )->get_font_options() )
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
			$this->get_script( 'common' )
				->set_path( 'lib/frontend/css/common.css' )
				->set_inline( true );

			$this->get_script( 'featured_image' )
				->set_path( 'lib/frontend/css/featured_image.css' )
				->set_inline( true );

			$this->get_script( 'config' )
				->set_path( 'lib/frontend/css/config.php' )
				->set_inline( true );

			return $this;
		}

		public function load( $settings = array() ): string {
			$settings								= shortcode_atts(
				array(
					'inline'						=> true,
					'template'                      => false,
				),
				$settings,
				$this->get_module_name()
			);

			ob_start();

			$this->get_script( 'common' )->set_inline( $settings['inline'] )->set_is_enqueued();
			$this->get_script( 'config' )->set_inline( $settings['inline'] )->set_is_enqueued();

			if($this->has_featured_image()){
				$this->get_script( 'featured_image' )->set_inline( $settings['inline'] )->set_is_enqueued();
			}

			require ($this->get_path('lib/frontend/tpl/default.php' ));

			$output							        = ob_get_contents();
			ob_end_clean();

			return $output;
		}

		public function get_header_content_overlay_color(): string{
			global $post;

			$setting 			= $this->get_setting( 'header_content_overlay_color' );
			$data 				= $this->get_setting( 'header_content_overlay_color' )->get_data();
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

			$color = $setting->get_rgb( $data, $this->get_header_content_overlay_opacity() );

			return $color;
		}

		public function get_header_content_overlay_opacity(): string{
			global $post;

			$data = $this->get_setting( 'header_content_overlay_opacity' )->get_data();
			if ( is_single() || is_page() || is_front_page() ) {
				if ( get_post_meta(
						$post->ID,
						$this->get_child_module('metabox')
							->get_setting( 'header_content_override' )
							->get_prefix( $this->get_setting( 'header_content_override' )->get_ID() ),
						true
					) == 1 ) {
					if ( $post ) {
						$metabox_data = get_post_meta(
							$post->ID,
							$this->get_child_module('metabox')
								->get_setting( 'header_content_overlay_opacity' )
								->get_prefix( $this->get_setting( 'header_content_overlay_opacity' )->get_ID() ),
							true
						);

						if ( $metabox_data !== false && $metabox_data !== '') {
							$data = $metabox_data;
						}
					}
				}
			}

			return $data;
		}

		public function get_header_content_title_color(): string{
			global $post;

			$setting 			= $this->get_setting( 'text_color_title' );
			$data 				= $this->get_setting( 'text_color_title' )->get_data();
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
			$data 				= $this->get_setting( 'text_color_excerpt' )->get_data();
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
			$data 				= $this->get_setting( 'text_color_meta' )->get_data();
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

		public function show_date(): bool{
			return $this->get_visibility('date');
		}

		public function show_date_modified(): bool{
			return $this->get_visibility('date_modified');
		}

		public function show_author(): bool{
			return $this->get_visibility('author');
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
	}