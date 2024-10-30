<?php

namespace Langle_Addons\Elementor;

use \Langle_Addons\Elementor\Widgets_Manager;

defined('ABSPATH') || die();

class Assets_Manager {

	public $_widget_data = null;
	public $active_widgets = [];
	public $active_langle_widgets = [];
    /**
	 * Bind hook and run internal methods here
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ __CLASS__, 'frontend_register'], 100 );
		add_action( 'wp_enqueue_scripts', [ $this , 'frontend_enqueue'], 100 );
		
		// Enqueue editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ __CLASS__, 'editor_enqueue' ] );
	}

    /**
	 * Register frontend assets.
	 *
	 * @return void
	 */
	public static function frontend_register() {
		wp_register_style( 'langle-addons-button', LANGLE_ADDONS_DIR_URL . 'assets/css/button.css', [ 'elementor-frontend' ], LANGLE_ADDONS_VERSION );

		wp_register_style( 'langle-addons-card', LANGLE_ADDONS_DIR_URL . 'widgets/card/style.css', [ 'elementor-frontend' ], LANGLE_ADDONS_VERSION );
		wp_register_style( 'langle-addons-infobox', LANGLE_ADDONS_DIR_URL . 'widgets/infobox/style.css', [ 'elementor-frontend' ], LANGLE_ADDONS_VERSION );
		wp_register_style( 'langle-addons-number', LANGLE_ADDONS_DIR_URL . 'widgets/number/style.css', [ 'elementor-frontend' ], LANGLE_ADDONS_VERSION );

		wp_register_style( 'langle-addons-logo-grid', LANGLE_ADDONS_DIR_URL . 'widgets/logo-grid/style.css', [ 'elementor-frontend' ], LANGLE_ADDONS_VERSION );
		wp_register_style( 'langle-addons-image-compare', LANGLE_ADDONS_DIR_URL . 'widgets/image-compare/style.css', [ 'elementor-frontend' ], LANGLE_ADDONS_VERSION );
		wp_register_style( 'langle-addons-skill-bars', LANGLE_ADDONS_DIR_URL . 'widgets/skill-bars/style.css', [ 'elementor-frontend' ], LANGLE_ADDONS_VERSION );

		wp_register_style( 'langle-addons-team-member', LANGLE_ADDONS_DIR_URL . 'widgets/team-member/style.css', [ 'elementor-frontend' ], LANGLE_ADDONS_VERSION );

		wp_register_style( 'langle-addons-review', LANGLE_ADDONS_DIR_URL . 'widgets/review/style.css', [ 'elementor-frontend' ], LANGLE_ADDONS_VERSION );
		wp_register_style( 'langle-addons-dual-button', LANGLE_ADDONS_DIR_URL . 'widgets/dual-button/style.css', [ 'elementor-frontend' ], LANGLE_ADDONS_VERSION );
		wp_register_style( 'langle-addons-gradient-heading', LANGLE_ADDONS_DIR_URL . 'widgets/gradient-heading/style.css', [ 'elementor-frontend' ], LANGLE_ADDONS_VERSION );

		wp_register_style( 'langle-addons-testimonial', LANGLE_ADDONS_DIR_URL . 'widgets/testimonial/style.css', [ 'elementor-frontend' ], LANGLE_ADDONS_VERSION );
		wp_register_style( 'langle-addons-flip-box', LANGLE_ADDONS_DIR_URL . 'widgets/flip-box/style.css', [ 'elementor-frontend' ], LANGLE_ADDONS_VERSION );
		wp_register_style( 'langle-addons-creative-button', LANGLE_ADDONS_DIR_URL . 'widgets/creative-button/style.css', [ 'elementor-frontend' ], LANGLE_ADDONS_VERSION );

		wp_register_style( 'langle-addons-photo-stack', LANGLE_ADDONS_DIR_URL . 'widgets/photo-stack/style.css', [ 'elementor-frontend' ], LANGLE_ADDONS_VERSION );
		wp_register_style( 'langle-addons-content-switcher', LANGLE_ADDONS_DIR_URL . 'widgets/content-switcher/style.css', [ 'elementor-frontend' ], LANGLE_ADDONS_VERSION );

		wp_register_style( 'langle-addons-step-flow', LANGLE_ADDONS_DIR_URL . 'widgets/step-flow/style.css', [ 'elementor-frontend' ], LANGLE_ADDONS_VERSION );
		wp_register_style( 'langle-addons-pricing-table', LANGLE_ADDONS_DIR_URL . 'widgets/pricing-table/style.css', [ 'elementor-frontend' ], LANGLE_ADDONS_VERSION );
		

		// Image comparasion
		wp_register_style(
			'twentytwenty',
			LANGLE_ADDONS_ASSETS . 'vendor/twentytwenty/css/twentytwenty.css',
			null,
			LANGLE_ADDONS_VERSION
		);

		wp_register_script(
			'jquery-event-move',
			LANGLE_ADDONS_ASSETS . 'vendor/twentytwenty/js/jquery.event.move.js',
			['jquery'],
			LANGLE_ADDONS_VERSION,
			true
		);

		wp_register_script(
			'jquery-twentytwenty',
			LANGLE_ADDONS_ASSETS . 'vendor/twentytwenty/js/jquery.twentytwenty.js',
			['jquery-event-move'],
			LANGLE_ADDONS_VERSION,
			true
		);

		// Number animation
		wp_register_script(
			'jquery-numerator',
			LANGLE_ADDONS_ASSETS . 'vendor/jquery-numerator/jquery-numerator.min.js',
			['jquery'],
			LANGLE_ADDONS_VERSION,
			true
		);

    }

	public function frontend_enqueue() {
		if ( ! is_singular() ) {
			return;
		}

		$this->enqueue( get_the_ID() );
	}

	public function enqueue( $post_id ) {
		$widgets_map = Widgets_Manager::get_local_widgets_map();
		$this->_widget_data = \Elementor\Plugin::$instance->documents->get( get_the_ID() )->get_elements_data();

		if ( self::should_enqueue( $post_id ) ) {

			// Get all langle Elements
			$all_widgets = array_keys( $widgets_map );

			// Find all active langle widgets
			if ( null != $this->array_value_recursive('widgetType', $this->_widget_data ) ) {

				$this->active_widgets = $this->array_value_recursive('widgetType', $this->_widget_data);

				if ( ! is_array( $this->active_widgets ) ) {
					$arr = [];
					$arr[] = $this->active_widgets;
					$this->active_widgets = $arr;
				}

				if ( is_array( $this->active_widgets ) ){
					// Loop in langle Elements
					foreach( $all_widgets as $la_widget ){
					
						// Check if there is any langle Elements active in the current page 
						if ( in_array( 'la-' . $la_widget, $this->active_widgets ) ) {
							$this->active_langle_widgets[] = $la_widget;
						}
			
					}
				}
			}

			// Enqueue all active widget's css
			if ( empty( $this->active_widgets ) || ! is_array( $this->active_widgets ) ) {
				return;
			}
	
			foreach ( $this->active_langle_widgets as $widget_key ) {
				
				if ( ! isset( $widgets_map[ $widget_key ], $widgets_map[ $widget_key ]['vendor'] ) ) {
					continue;
				}


				// Vendor CSS/JS
				$vendor = $widgets_map[ $widget_key ]['vendor'];
	
				if ( isset( $vendor['css'] ) && is_array( $vendor['css'] ) ) {
					foreach ( $vendor['css'] as $vendor_css_handle ) {
						wp_enqueue_style( $vendor_css_handle );
					}
				}
	
				if ( isset( $vendor['js'] ) && is_array( $vendor['js'] ) ) {
					foreach ( $vendor['js'] as $vendor_js_handle ) {
						wp_enqueue_script( $vendor_js_handle );
					}
				}

				// Widget CSS/JS
				$widget_css_handles = $widgets_map[ $widget_key ]['css'];
				if ( is_array( $widget_css_handles ) && count( $widget_css_handles ) > 0 ) {
					foreach ( $widget_css_handles as $widget_css_handle ) {
						wp_enqueue_style( 'langle-addons-' . $widget_css_handle );
					}
				}
	
				$widget_js_handles = $widgets_map[ $widget_key ]['js'];
				if ( is_array( $widget_js_handles ) && count( $widget_js_handles ) > 0 ) {
					foreach ( $widget_js_handles as $widget_js_handle ) {
						wp_enqueue_style( 'langle-addons-' . $widget_js_handle );
					}
				}
			}
		}

		// Enqueue all vendor for elementor editing screen
		if ( self::should_enqueue_raw( $post_id ) ) {

			foreach( $widgets_map as $data ) {

				$vendor = $data['vendor'];
				if ( isset( $vendor['css'] ) && is_array( $vendor['css'] ) ) {
					foreach ( $vendor['css'] as $vendor_css_handle ) {
						wp_enqueue_style( $vendor_css_handle );
					}
				}

				if ( isset( $vendor['js'] ) && is_array( $vendor['js'] ) ) {
					foreach ( $vendor['js'] as $vendor_js_handle ) {
						wp_enqueue_script( $vendor_js_handle );
					}
				}

				$widget_css_handles = $data['css'];
				if ( is_array( $widget_css_handles ) && count( $widget_css_handles ) > 0 ) {
					foreach ( $widget_css_handles as $widget_css_handle ) {
						wp_enqueue_style( 'langle-addons-' . $widget_css_handle );
					}
				}

				$widget_js_handles = $data['js'];
				if ( is_array( $widget_js_handles ) && count( $widget_js_handles ) > 0 ) {
					foreach ( $widget_js_handles as $widget_js_handle ) {
						wp_enqueue_style( 'langle-addons-' . $widget_js_handle );
					}
				}


			}
		}


		// All time this should be loaded
		wp_enqueue_script(
			'langle-addons-main',
			LANGLE_ADDONS_ASSETS . 'js/main.js',
			['jquery'],
			LANGLE_ADDONS_VERSION,
			true
		);
		
	}
	
	public static function editor_enqueue() {
		
		wp_enqueue_script(
			'langle-addons-editor',
			LANGLE_ADDONS_ASSETS . 'admin/js/editor.js',
			['elementor-editor', 'jquery'],
			LANGLE_ADDONS_VERSION,
			true
		);
	}

	public function array_value_recursive($key, array $arr)
	{
		$val = array();
		array_walk_recursive($arr, function ($v, $k) use ($key, &$val) {
			if ($k == $key) array_push($val, $v);
		});
		return count($val) > 1 ? $val : array_pop($val);
	}

	public static function is_built_with_elementor( $post_id ) {
		return la_elementor()->documents->get( $post_id )->is_built_with_elementor();
	}

	public static function should_enqueue_raw( $post_id ) {
		return (
			self::is_built_with_elementor( $post_id ) && ( ! self::is_published( $post_id ) || self::is_editing_mode() )
		);
	}

	public static function should_enqueue( $post_id ) {
		return (
			self::is_built_with_elementor( $post_id ) &&
			self::is_published( $post_id ) &&
			! self::is_editing_mode()
		);
	}

	public static function is_published( $post_id ) {
		return get_post_status( $post_id ) === 'publish';
	}

	public static function is_editing_mode() {
		return (
			la_elementor()->editor->is_edit_mode() ||
			la_elementor()->preview->is_preview_mode() ||
			is_preview()
		);
	}
}

new Assets_Manager;