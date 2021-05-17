<?php
	namespace sv100;
	
	/**
	 * @version		 4.000
	 * @author			straightvisions GmbH
	 * @package			sv100
	 * @copyright		2019 straightvisions GmbH
	 * @link			https://straightvisions.com
	 * @since			1.000
	 * @license			See license.txt or https://straightvisions.com
	 */
	
	class sv_header_content_metabox extends sv_header_content {
		protected $post_type		= '';

		public function init() {
			if ( is_admin() ) {
				add_action( 'current_screen', array( $this, 'admin_post_type' ) );
			} else {
				add_action( 'wp', array( $this, 'wp_init' ) );
			}
		}
		public function admin_post_type(): sv_header_content{
			if(is_object(get_current_screen()) && isset(get_current_screen()->post_type)){
				$this->post_type		= get_current_screen()->post_type;
			}
			$this->load_settings()->load_metabox();
			
			return $this;
		}
		public function wp_init(){
			$this->load_settings()->load_metabox();
		}
		public function load_settings(): sv_header_content{
			$states = array(
				''				=> __('Default', 'sv100'),
				'hidden'		=> __('Hidden', 'sv100'),
				'show'			=> __('Show', 'sv100')
			);

			$this->get_setting( 'show_date' )
				 ->set_title( __( 'Show date', 'sv100' ) )
				 ->load_type( 'radio' )
				->set_options($states);

			$this->get_setting( 'show_date_modified' )
				->set_title( __( 'Show modified date', 'sv100' ) )
				->load_type( 'radio' )
				->set_options($states);

			$this->get_setting( 'show_author' )
				 ->set_title( __( 'Show author', 'sv100' ) )
				->load_type( 'radio' )
				->set_options($states);

			$this->get_setting( 'header_content_override' )
				->set_title( __( 'Override Default Header Content Settings', 'sv100' ) )
				->set_default_value(0)
				->load_type( 'radio' )
				->set_options(array(__('no','sv100'), __('yes','sv100')));

			$this->get_setting( 'header_content_overlay_color' )
				->set_title( $this->get_parent()->get_setting('header_content_overlay_color')->get_title() )
				->set_description( $this->get_parent()->get_setting('header_content_overlay_color')->get_description() )
				->set_default_value($this->get_parent()->get_setting('header_content_overlay_color')->get_data())
				->load_type( 'color' );

			$this->get_setting( 'text_color_title' )
				->set_title( __('Header Title: ','sv100').$this->get_parent()->get_setting('text_color_title')->get_title() )
				->set_description( $this->get_parent()->get_setting('text_color_title')->get_description() )
				->set_default_value($this->get_parent()->get_setting('text_color_title')->get_data())
				->load_type( 'color' );

			$this->get_setting( 'text_color_excerpt' )
				->set_title( __('Header Excerpt: ','sv100').$this->get_parent()->get_setting('text_color_excerpt')->get_title() )
				->set_description( $this->get_parent()->get_setting('text_color_excerpt')->get_description() )
				->set_default_value($this->get_parent()->get_setting('text_color_excerpt')->get_data())
				->load_type( 'color' );

			$this->get_setting( 'text_color_meta' )
				->set_title( $this->get_parent()->get_setting('text_color_meta')->get_title() )
				->set_description( $this->get_parent()->get_setting('text_color_meta')->get_description() )
				->set_default_value($this->get_parent()->get_setting('text_color_meta')->get_data())
				->load_type( 'color' );
			
			$this->get_setting( 'hide_header' )
				 ->set_title( __('Hide Header', 'sv100') )
				 ->set_description( __('No Content Header will be shown on this post.', 'sv100') )
				 ->load_type( 'checkbox' );

			$this->get_setting( 'hide_featured_image' )
				->set_title( __('Hide Featured Image', 'sv100') )
				->set_description( __('No Featured Image will be shown on this post.', 'sv100') )
				->load_type( 'checkbox' );

			$this->get_setting( 'hide_title' )
				->set_title( __('Hide Title', 'sv100') )
				->set_description( __('No Title will be shown on this post.', 'sv100') )
				->load_type( 'checkbox' );

			$this->get_setting( 'hide_excerpt' )
				->set_title( __('Hide Excerpt', 'sv100') )
				->set_description( __('No Excerpt will be shown on this post.', 'sv100') )
				->load_type( 'checkbox' );
			
			return $this;
		}
		public function load_metabox(): sv_header_content{
			static::$metabox
				->create( $this )
				->set_title( __('SV100', 'sv100') );
			
			return $this;
		}
	}