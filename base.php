<?php
/**
 * Plugin base class
 *
 * @package Langle_Addons
 */
namespace Langle_Addons\Elementor;

use Elementor\Controls_Manager;
use Elementor\Elements_Manager;

defined( 'ABSPATH' ) || die();

class Base {
    private static $instance = null;
    public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->init();
		}
		return self::$instance;
	}

    private function __construct() {
		add_action( 'init', [ $this, 'i18n' ] );
	}

    public function i18n() {
		load_plugin_textdomain(
			'langle-addons',
			false,
			dirname( plugin_basename( LANGLE_ADDONS__FILE__ ) ) . '/languages/'
		);
	}

    public function init() {
		$this->include_files();

		// Register custom category
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );

		// Register custom controls
		add_action( 'elementor/controls/controls_registered', [ $this, 'register_controls' ] );

		// add_action( 'init', [ $this, 'include_on_init' ] );

		do_action( 'langle_addons_loaded' );
	}

    public function include_files() {
		include_once( LANGLE_ADDONS_DIR_PATH . 'classes/widgets-manager.php' );
		include_once( LANGLE_ADDONS_DIR_PATH . 'classes/assets-manager.php' );
	}

    public function include_on_init() {}

    /**
	 * Add custom category.
	 *
	 * @param $elements_manager
	 */
	public function add_category( Elements_Manager $elements_manager ) {
		$elements_manager->add_category(
			'langle_addons_category',
			[
				'title' => __( 'Langle Addons', 'langle-addons' ),
				'icon' => 'fa fa-smile-o',
			]
		);
	}

    /**
	 * Register controls
	 *
	 * @param Controls_Manager $controls_Manager
	 */
	public function register_controls( Controls_Manager $controls_Manager ) {
		include_once( LANGLE_ADDONS_DIR_PATH . 'controls/foreground.php' );
		include_once( LANGLE_ADDONS_DIR_PATH . 'controls/select2.php' );
		include_once( LANGLE_ADDONS_DIR_PATH . 'controls/widget-list.php' );
		include_once( LANGLE_ADDONS_DIR_PATH . 'controls/text-stroke.php' );

		$Foreground = __NAMESPACE__ . '\Controls\Group_Control_Foreground';
		$controls_Manager->add_group_control( $Foreground::get_type(), new $Foreground() );

		$Select2 = __NAMESPACE__ . '\Controls\Select2';
		$Widget_List = __NAMESPACE__ . '\Controls\Widget_List';
		
		la_elementor()->controls_manager->register( new $Select2() );
		la_elementor()->controls_manager->register( new $Widget_List() );

		$Text_Stroke = __NAMESPACE__ . '\Controls\Group_Control_Text_Stroke';
		$controls_Manager->add_group_control( $Text_Stroke::get_type(), new $Text_Stroke() );
	}
}