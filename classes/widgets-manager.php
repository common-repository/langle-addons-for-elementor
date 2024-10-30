<?php

namespace Langle_Addons\Elementor;

defined('ABSPATH') || die();

class Widgets_Manager {
    /**
	 * Initialize
	 */
	public static function init() {
		// original hook for register widgets
		add_action('elementor/widgets/register', [__CLASS__, 'register']);
	}

    /**
	 * Get the free widgets map
	 *
	 * @todo add doc link
	 * @return array
	 */
	public static function get_local_widgets_map() {
        return [
			'card' 			=> [
				'cat'       => 'creative',
				'is_active' => false,
				'demo'      => 'https://langleaddons.com/element/demo-card',
				'title'     => __('Card', 'langle-addons'),
				'icon'      => 'fa fa-id-card',
				'css'       => ['card', 'button'],
				'js'        => [],
				'vendor'    => [
					'css' => [],
					'js'  => [],
				],
			],
			'content-switcher'	  => [
				'cat'       => 'creative',
				'is_active' => false,
				'demo'      => 'https://langleaddons.com/element/demo-content-switcher',
				'title'     => __('Content Switcher', 'langle-addons'),
				'icon'      => 'eicon-wordpress',
				'css'       => ['content-switcher'],
				'js'        => [],
				'vendor'    => [
					'css' => [],
					'js'  => [],
				],
			],
			'creative-button'	  => [
				'cat'       => 'creative',
				'is_active' => false,
				'demo'      => 'https://langleaddons.com/element/demo-creative-button',
				'title'     => __('Creative Button', 'langle-addons'),
				'icon'      => 'eicon-number-field',
				'css'       => ['creative-button'],
				'js'        => [],
				'vendor'    => [
					'css' => [],
					'js'  => [],
				],
			],
			'dual-button'	  => [
				'cat'       => 'creative',
				'is_active' => false,
				'demo'      => 'https://langleaddons.com/element/demo-dual-button',
				'title'     => __('Dual Button', 'langle-addons'),
				'icon'      => 'eicon-number-field',
				'css'       => ['dual-button'],
				'js'        => [],
				'vendor'    => [
					'css' => [],
					'js'  => [],
				],
			],
			'flip-box'	  => [
				'cat'       => 'creative',
				'is_active' => false,
				'demo'      => 'https://langleaddons.com/element/demo-flip-box',
				'title'     => __('Flip Box', 'langle-addons'),
				'icon'      => 'eicon-number-field',
				'css'       => ['flip-box'],
				'js'        => [],
				'vendor'    => [
					'css' => [],
					'js'  => [],
				],
			],
			'gradient-heading'	  => [
				'cat'       => 'creative',
				'is_active' => false,
				'demo'      => 'https://langleaddons.com/element/demo-gradient-heading',
				'title'     => __('Gradient Heading', 'langle-addons'),
				'icon'      => 'eicon-number-field',
				'css'       => ['gradient-heading'],
				'js'        => [],
				'vendor'    => [
					'css' => [],
					'js'  => [],
				],
			],
			'image-compare'	=> [
				'cat'       => 'creative',
				'is_active' => false,
				'demo'      => 'https://langleaddons.com/element/demo-image-compare',
				'title'     => __('Logo Grid', 'langle-addons'),
				'icon'      => 'eicon-number-field',
				'css' 		=> ['image-compare'],
				'js'        => [],
				'vendor'    => [
					'css' => ['twentytwenty'],
					'js'  => ['jquery-event-move', 'jquery-twentytwenty', 'imagesloaded'],
				],
			],
			
			'infobox'		=> [
				'cat'       => 'creative',
				'is_active' => false,
				'demo'      => 'https://langleaddons.com/element/demo-card',
				'title'     => __('Info Box', 'langle-addons'),
				'icon'      => 'fa fa-id-card',
				'css'       => ['infobox', 'button'],
				'js'        => [],
				'vendor'    => [
					'css' => [],
					'js'  => [],
				],
			],
			'logo-grid'		=> [
				'cat'       => 'creative',
				'is_active' => false,
				'demo'      => 'https://langleaddons.com/element/demo-number',
				'title'     => __('Logo Grid', 'langle-addons'),
				'icon'      => 'eicon-number-field',
				'css'       => ['logo-grid'],
				'js'        => [],
				'vendor'    => [
					'css' => [],
					'js'  => [],
				],
			],
			'number'		=> [
				'cat'       => 'creative',
				'is_active' => false,
				'demo'      => 'https://langleaddons.com/element/demo-number',
				'title'     => __('Number', 'langle-addons'),
				'icon'      => 'eicon-number-field',
				'css'       => ['number'],
				'js'        => [],
				'vendor'    => [
					'css' => [],
					'js'  => ['jquery-numerator'],
				],
			],
			'photo-stack'	  => [
				'cat'       => 'creative',
				'is_active' => false,
				'demo'      => 'https://langleaddons.com/element/demo-photo-stack',
				'title'     => __('Photo Stack', 'langle-addons'),
				'icon'      => 'eicon-image',
				'css'       => ['photo-stack'],
				'js'        => [],
				'vendor'    => [
					'css' => [],
					'js'  => [],
				],
			],
			'pricing-table'	  => [
				'cat'       => 'creative',
				'is_active' => false,
				'demo'      => 'https://langleaddons.com/element/demo-pricing-table',
				'title'     => __('Pricing Table', 'langle-addons'),
				'icon'      => 'eicon-price-table',
				'css'       => ['pricing-table'],
				'js'        => [],
				'vendor'    => [
					'css' => [],
					'js'  => [],
				],
			],
			'review'	  => [
				'cat'       => 'creative',
				'is_active' => false,
				'demo'      => 'https://langleaddons.com/element/demo-review',
				'title'     => __('Review', 'langle-addons'),
				'icon'      => 'eicon-number-field',
				'css'       => ['review'],
				'js'        => [],
				'vendor'    => [
					'css' => [],
					'js'  => ['jquery-numerator'],
				],
			],
			'skill-bars'	=> [
				'cat'       => 'creative',
				'is_active' => false,
				'demo'      => 'https://langleaddons.com/element/demo-skill-bars',
				'title'     => __('SKill Bars', 'langle-addons'),
				'icon'      => 'eicon-number-field',
				'css'       => ['skill-bars'],
				'js'        => [],
				'vendor'    => [
					'css' => [],
					'js'  => ['jquery-numerator'],
				],
			],
			'step-flow'	  => [
				'cat'       => 'creative',
				'is_active' => false,
				'demo'      => 'https://langleaddons.com/element/demo-step-flow',
				'title'     => __('Step Flow', 'langle-addons'),
				'icon'      => 'eicon-flow',
				'css'       => ['step-flow'],
				'js'        => [],
				'vendor'    => [
					'css' => [],
					'js'  => [],
				],
			],
			'team-member'	=> [
				'cat'       => 'creative',
				'is_active' => false,
				'demo'      => 'https://langleaddons.com/element/demo-team-member',
				'title'     => __('Team Member', 'langle-addons'),
				'icon'      => 'eicon-number-field',
				'css'       => ['team-member'],
				'js'        => [],
				'vendor'    => [
					'css' => [],
					'js'  => [],
				],
			],			
			'testimonial'	  => [
				'cat'       => 'creative',
				'is_active' => false,
				'demo'      => 'https://langleaddons.com/element/demo-testimonial',
				'title'     => __('Testimonial', 'langle-addons'),
				'icon'      => 'eicon-number-field',
				'css'       => ['testimonial'],
				'js'        => [],
				'vendor'    => [
					'css' => [],
					'js'  => [],
				],
			],			
        ];
    }

    /**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public static function register( $widgets_manager = null) {
		include_once LANGLE_ADDONS_DIR_PATH . 'base/widget-base.php';
		include_once LANGLE_ADDONS_DIR_PATH . 'traits/button-trait.php';

		// using only for team member
		// @todo need to replace with button-trait
		include_once LANGLE_ADDONS_DIR_PATH . 'traits/button-renderer.php';
		include_once LANGLE_ADDONS_DIR_PATH . 'traits/creative-button-markup.php';

		// $inactive_widgets = self::get_inactive_widgets();

		foreach (self::get_local_widgets_map() as $widget_key => $data) {
			// if (!in_array($widget_key, $inactive_widgets)) {
				self::register_widget($widget_key, $widgets_manager);
			// }
		}

		/**
		 * After widgets registered.
		 *
		 * Fires after Langle Addons widgets are registered.
		 *
		 * @since 1.0.0
		 *
		 * @param Widgets_Manager $widgets_manager The widgets manager.
		 */
		do_action('langle_addons/widgets/register', $widgets_manager);
	}

    protected static function register_widget($widget_key, $widgets_manager = null) {
		$widget_file = LANGLE_ADDONS_DIR_PATH . 'widgets/' . $widget_key . '/widget.php';

		if (is_readable($widget_file)) {

			include_once $widget_file;

			$widget_class = '\Langle_Addons\Elementor\Widget\\' . str_replace('-', '_', $widget_key);
			if (class_exists($widget_class)) {
				$widgets_manager->register(new $widget_class());
			}
		}
	}
}

Widgets_Manager::init();