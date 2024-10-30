<?php

/**
 * Content Switcher widget class
 *
 * @package Langle_Addons
 */

namespace Langle_Addons\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Repeater;

defined( 'ABSPATH' ) || die();

class Content_Switcher extends Base {

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Content Switcher', 'langle-addons' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-sync';
	}

	public function get_keywords() {
		return ['content', 'switcher', 'toggle'];
	}

	public function select_elementor_page( $type ) {
		$args  = [
			'tax_query'      => [
				[
					'taxonomy' => 'elementor_library_type',
					'field'    => 'slug',
					'terms'    => $type,
				],
			],
			'post_type'      => 'elementor_library',
			'posts_per_page' => -1,
		];
		$query = new \WP_Query( $args );

		$posts = $query->posts;
		foreach ( $posts as $post ) {
			$items[ $post->ID ] = $post->post_title;
		}

		if ( empty( $items ) ) {
			$items = [];
		}

		return $items;
	}

	/**
	 * Register widget content controls
	 */
	protected function register_content_controls() {

		$this->__switcher_content_controls();
		$this->__settings_content_controls();
	}

    protected function __switcher_content_controls() {

        $this->start_controls_section(
			'_section_content',
			[
				'label' => __( 'Content Switcher', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'select_design',
			[
				'label'   => __( 'Choose Design', 'langle-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'round'    => __( 'Round', 'langle-addons' ),
					'round-2'  => __( 'Round 2', 'langle-addons' ),
					'square'   => __( 'Square', 'langle-addons' ),
					'square-2' => __( 'Square 2', 'langle-addons' ),
					'button'   => __( 'Button', 'langle-addons' ),
					'tabbed'   => __( 'Tabbed', 'langle-addons' ),
				],
				'default' => 'round',
			]
		);

		$this->add_control(
			'design_warning_message',
			[
				'raw'             => '<strong>' . esc_html__( 'Please note!', 'langle-addons' ) . '</strong> ' . esc_html__( 'This design requires only two items. Only the first two items will be used.', 'langle-addons' ),
				'type'            => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'render_type'     => 'ui',
				'condition'       => [
					'select_design' => ['round', 'round-2', 'square', 'square-2'],
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label'   => __( 'Title', 'langle-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Content', 'langle-addons' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'content_type',
			[
				'label'   => __( 'Type', 'langle-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'plain_content' => __( 'Plain/ HTML Text', 'langle-addons' ),
					'saved_section' => __( 'Saved Section', 'langle-addons' ),
					'saved_page'    => __( 'Saved Page', 'langle-addons' ),
				],
				'default' => 'plain_content',
			]
		);
		$repeater->add_control(
			'plain_content',
			[
				'label'       => __( 'Plain/ HTML Text', 'langle-addons' ),
				'type'        => Controls_Manager::TEXTAREA,
				'description' => langle_addons_get_allowed_html_desc( 'intermediate' ),
				'rows'        => 20,
				'condition'   => [
					'content_type' => 'plain_content',
				],
				'dynamic'     => [
					'active' => true,
				],
				'default'     => __( 'Add some content here.', 'langle-addons' ),
			]
		);

		$saved_sections = ['0' => __( '--- Select Section ---', 'langle-addons' )];
		$saved_sections = $saved_sections + $this->select_elementor_page( 'section' );

		$repeater->add_control(
			'saved_section',
			[
				'label'     => __( 'Sections', 'langle-addons' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $saved_sections,
				'default'   => '0',
				'condition' => [
					'content_type' => 'saved_section',
				],
			]
		);

		$saved_page = ['0' => __( '--- Select Page ---', 'langle-addons' )];
		$saved_page = $saved_page + $this->select_elementor_page( 'page' );

		$repeater->add_control(
			'saved_pages',
			[
				'label'     => __( 'Pages', 'langle-addons' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $saved_page,
				'default'   => '0',
				'condition' => [
					'content_type' => 'saved_page',
				],
			]
		);

		$repeater->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'langle-addons' ),
				'type'  => Controls_Manager::ICONS,
			]
		);

		$repeater->add_control(
			'icon_align',
			[
				'label'   => __( 'Icon Position', 'langle-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'  => __( 'Left', 'langle-addons' ),
					'right' => __( 'Right', 'langle-addons' ),
				],
			]
		);

		$repeater->add_control(
			'active',
			[
				'label'        => __( 'Active', 'langle-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => __( 'Active on Load', 'langle-addons' ),
				'label_on'     => __( 'Yes', 'langle-addons' ),
				'label_off'    => __( 'No', 'langle-addons' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'content_list',
			[
				'label'         => __( 'Contents', 'langle-addons' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
				'prevent_empty' => true,
				'default'       => [
					[
						'title'         => __( 'Primary', 'langle-addons' ),
						'content_type'  => 'plain_content',
						'plain_content' => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.' ),
						'active'        => 'yes',
					],
					[
						'title'         => __( 'Secondary', 'langle-addons' ),
						'content_type'  => 'plain_content',
						'plain_content' => __( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'langle-addons' ),
					],
					[
						'title'         => __( 'Others', 'langle-addons' ),
						'content_type'  => 'plain_content',
						'plain_content' => __( 'Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'langle-addons' ),
					],
				],
				'title_field'   => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

    }

    protected function __settings_content_controls() {

        $this->start_controls_section(
			'_section_display_settings',
			[
				'label' => __( 'Display Settings', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'switch_direction',
			[
				'label'   => __( 'Switch Direction', 'langle-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'horizontal' => [
						'title' => __( 'Horizontal', 'langle-addons' ),
						'icon'  => 'eicon-navigation-horizontal',
					],
					'vertical'   => [
						'title' => __( 'Vertical', 'langle-addons' ),
						'icon'  => 'eicon-navigation-vertical',
					],					
				],			
				'default' => 'horizontal',
				'toggle'  => false,
				'prefix_class' => 'la-cs-layout-%s-',
				'style_transfer' => true,
				'condition' => [
					'select_design' => ['tabbed']
				],
			]
		);

		$this->add_responsive_control(
			'switch_align',
			[
				'label'     => __( 'Switch Alignment', 'langle-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left' => [
						'title' => __( 'Left', 'langle-addons' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'     => [
						'title' => __( 'Center', 'langle-addons' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => __( 'Right', 'langle-addons' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'center',
				'toggle'    => false,
				'prefix_class' => 'la-cs-tab-align-%s-',
				'style_transfer' => true,
			]
		);
		
		$this->add_responsive_control(
			'content_align',
			[
				'label'     => __( 'Content Alignment', 'langle-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left' => [
						'title' => __( 'Left', 'langle-addons' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'     => [
						'title' => __( 'Center', 'langle-addons' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => __( 'Right', 'langle-addons' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .la-cs-content-section' => 'text-align: {{VALUE}}',
				],
				'default'   => 'center',
				'toggle'    => false,
			]
		);

		$this->add_responsive_control(
			'space_between',
			[
				'label'       => __( 'Space', 'langle-addons' ),
				'description' => __( 'Set Space between switcher and content section', 'langle-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => ['px', '%'],
				'range'       => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'     => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors'   => [
					'{{WRAPPER}} .la-cs-switch-container' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'anim_duration',
			[
				'label'       => __( 'Animation Speed', 'langle-addons' ),
				'type'        => Controls_Manager::NUMBER,
				'description' => __( 'Set Animation Duration in Millisecond', 'langle-addons' ),
				'min'         => 100,
				'max'         => 3000,
				'step'        => 100,
				'default'     => 400,
				'selectors'   => [
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-slider:before' => 'transition-duration: {{VALUE}}ms',
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-button' => 'transition-duration: {{VALUE}}ms',
					'{{WRAPPER}} .la-cs-content-wrapper .la-cs-content-section' => 'transition: transform calc( {{VALUE}}ms / 2 ) ease-in;',
					'{{WRAPPER}} .la-cs-content-wrapper .la-cs-content-section' => 'transition: transform calc( {{VALUE}}ms / 2 ) ease-out;',
				],
			]
		);

		$this->end_controls_section();

    }

    /**
	 * Register widget style controls
	 */
	protected function register_style_controls() {

		$this->__switch_style_controls();
		$this->__switcher_control_style_controls();
		$this->__switch_bar_style_controls();
		$this->__content_style_controls();

	}
    protected function __switch_style_controls() {

        $this->start_controls_section(
			'_section_style_switch',
			[
				'label' => __( 'Switch/Button/Tabs', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'typography',
				'fields_options' => [
					'typography'  => ['default' => 'yes'],
					'font_family' => [
						'default' => 'Nunito',
					],
					'font_weight' => [
						'default' => 'Bold',
					],
				],
				'selector'       => '{{WRAPPER}} .la-cs-switch-wrapper .la-cs-button span, {{WRAPPER}} .la-cs-switch-wrapper .la-cs-switch',

			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label'      => __( 'Icon Spacing', 'langle-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors'  => [
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-button.la-cs-icon-left i' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-button.la-cs-icon-right i' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-switch.la-cs-icon-left i' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-switch.la-cs-icon-right i' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'label_spacing',
			[
				'label'      => __( 'Title Spacing', 'langle-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors'  => [
					'{{WRAPPER}} .la-cs-switch-wrapper.horizontal .la-cs-switch.primary' => 'margin-right: {{SIZE}}{{UNIT}}; margin-bottom: unset;',
					'body[data-elementor-device-mode="widescreen"] {{WRAPPER}} .la-cs-switch-wrapper.widescreen-horizontal .la-cs-switch.primary' => 'margin-right: {{SIZE}}{{UNIT}}; margin-bottom: unset;',
					'body[data-elementor-device-mode="desktop"] {{WRAPPER}} .la-cs-switch-wrapper.desktop-horizontal .la-cs-switch.primary' => 'margin-right: {{SIZE}}{{UNIT}}; margin-bottom: unset;',
					'body[data-elementor-device-mode="laptop"] {{WRAPPER}} .la-cs-switch-wrapper.laptop-horizontal .la-cs-switch.primary' => 'margin-right: {{SIZE}}{{UNIT}}; margin-bottom: unset;',
					'body[data-elementor-device-mode="tablet_extra"] {{WRAPPER}} .la-cs-switch-wrapper.tablet-extra-horizontal .la-cs-switch.primary' => 'margin-right: {{SIZE}}{{UNIT}}; margin-bottom: unset;',
					'body[data-elementor-device-mode="tablet"] {{WRAPPER}} .la-cs-switch-wrapper.tablet-horizontal .la-cs-switch.primary' => 'margin-right: {{SIZE}}{{UNIT}}; margin-bottom: unset;',
					'body[data-elementor-device-mode="mobile_extra"] {{WRAPPER}} .la-cs-switch-wrapper.mobile-extra-horizontal .la-cs-switch.primary' => 'margin-right: {{SIZE}}{{UNIT}}; margin-bottom: unset;',
					'body[data-elementor-device-mode="mobile"] {{WRAPPER}} .la-cs-switch-wrapper.mobile-horizontal .la-cs-switch.primary' => 'margin-right: {{SIZE}}{{UNIT}}; margin-bottom: unset;',

					'{{WRAPPER}} .la-cs-switch-wrapper.horizontal .la-cs-switch.secondary' => 'margin-left: {{SIZE}}{{UNIT}}; margin-top: unset;',
					'body[data-elementor-device-mode="widescreen"] {{WRAPPER}} .la-cs-switch-wrapper.widescreen-horizontal .la-cs-switch.secondary' => 'margin-left: {{SIZE}}{{UNIT}}; margin-top: unset;',
					'body[data-elementor-device-mode="desktop"] {{WRAPPER}} .la-cs-switch-wrapper.desktop-horizontal .la-cs-switch.secondary' => 'margin-left: {{SIZE}}{{UNIT}}; margin-top: unset;',
					'body[data-elementor-device-mode="laptop"] {{WRAPPER}} .la-cs-switch-wrapper.laptop-horizontal .la-cs-switch.secondary' => 'margin-left: {{SIZE}}{{UNIT}}; margin-top: unset;',
					'body[data-elementor-device-mode="tablet_extra"] {{WRAPPER}} .la-cs-switch-wrapper.tablet-extra-horizontal .la-cs-switch.secondary' => 'margin-left: {{SIZE}}{{UNIT}}; margin-top: unset;',
					'body[data-elementor-device-mode="tablet"] {{WRAPPER}} .la-cs-switch-wrapper.tablet-horizontal .la-cs-switch.secondary' => 'margin-left: {{SIZE}}{{UNIT}}; margin-top: unset;',
					'body[data-elementor-device-mode="mobile_extra"] {{WRAPPER}} .la-cs-switch-wrapper.mobile-extra-horizontal .la-cs-switch.secondary' => 'margin-left: {{SIZE}}{{UNIT}}; margin-top: unset;',
					'body[data-elementor-device-mode="mobile"] {{WRAPPER}} .la-cs-switch-wrapper.mobile-horizontal .la-cs-switch.secondary' => 'margin-left: {{SIZE}}{{UNIT}}; margin-top: unset;',

					'{{WRAPPER}} .la-cs-switch-wrapper.horizontal .la-cs-switch .primary' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-right: unset;',
					'body[data-elementor-device-mode="widescreen"] {{WRAPPER}} .la-cs-switch-wrapper.widescreen-vertical .la-cs-switch.primary' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-right: unset;',
					'body[data-elementor-device-mode="desktop"] {{WRAPPER}} .la-cs-switch-wrapper.desktop-vertical .la-cs-switch.primary' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-right: unset;',
					'body[data-elementor-device-mode="laptop"] {{WRAPPER}} .la-cs-switch-wrapper.laptop-vertical .la-cs-switch.primary' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-right: unset;',
					'body[data-elementor-device-mode="tablet_extra"] {{WRAPPER}} .la-cs-switch-wrapper.tablet-extra-vertical .la-cs-switch.primary' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-right: unset;',
					'body[data-elementor-device-mode="tablet"] {{WRAPPER}} .la-cs-switch-wrapper.tablet-vertical .la-cs-switch.primary' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-right: unset;',
					'body[data-elementor-device-mode="mobile_extra"] {{WRAPPER}} .la-cs-switch-wrapper.mobile-extra-vertical .la-cs-switch.primary' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-right: unset;',
					'body[data-elementor-device-mode="mobile"] {{WRAPPER}} .la-cs-switch-wrapper.mobile-vertical .la-cs-switch.primary' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-right: unset;',

					'{{WRAPPER}} .la-cs-switch-wrapper.vertical .la-cs-switch.secondary' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left: unset;',
					'body[data-elementor-device-mode="widescreen"] {{WRAPPER}} .la-cs-switch-wrapper.widescreen-vertical .la-cs-switch.secondary' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left: unset;',
					'body[data-elementor-device-mode="desktop"] {{WRAPPER}} .la-cs-switch-wrapper.desktop-vertical .la-cs-switch.secondary' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left: unset;',
					'body[data-elementor-device-mode="laptop"] {{WRAPPER}} .la-cs-switch-wrapper.laptop-vertical .la-cs-switch.secondary' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left: unset;',
					'body[data-elementor-device-mode="tablet_extra"] {{WRAPPER}} .la-cs-switch-wrapper.tablet-extra-vertical .la-cs-switch.secondary' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left: unset;',
					'body[data-elementor-device-mode="tablet"] {{WRAPPER}} .la-cs-switch-wrapper.tablet-vertical .la-cs-switch.secondary' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left: unset;',
					'body[data-elementor-device-mode="mobile_extra"] {{WRAPPER}} .la-cs-switch-wrapper.mobile-extra-vertical .la-cs-switch.secondary' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left: unset;',
					'body[data-elementor-device-mode="mobile"] {{WRAPPER}} .la-cs-switch-wrapper.mobile-vertical .la-cs-switch.secondary' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left: unset;',
				],
				'condition'  => [
					'select_design' => ['round', 'round-2', 'square', 'square-2'],
				],
			]
		);

		$this->start_controls_tabs(
			'label_tabs'
		);

		$this->start_controls_tab(
			'label_style_normal',
			[
				'label' => __( 'Normal', 'langle-addons' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-button:not(.active) span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-switch:not(.active) span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => __( 'Background Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-button:not(.active)' => 'background-color: {{VALUE}}',

				],
				'condition' => [
					'select_design' => ['button', 'tabbed'],
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Icon Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-button:not(.active) div > i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-switch:not(.active) div > i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-button:not(.active) div > svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-switch:not(.active) div > svg' => 'fill: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'title_border_normal',
				'label'     => __( 'Border', 'langle-addons' ),
				'selector'  => '{{WRAPPER}} .la-cs-switch-wrapper .la-cs-button',
				'condition' => [
					'select_design' => ['button'],
				],
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'      => __( 'Border Radius', 'langle-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'      => '30',
					'right'    => '30',
					'bottom'   => '30',
					'left'     => '30',
					'unit'     => 'px',
					'isLinked' => 'true',
				],
				'selectors'  => [
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'select_design' => ['button'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'title_box_shadow',
				'label'     => __( 'Box Shadow', 'langle-addons' ),
				'selector'  => '{{WRAPPER}} .la-cs-switch-wrapper .la-cs-button',
				'condition' => [
					'select_design' => ['button'],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'label_style_active',
			[
				'label' => __( 'Active', 'langle-addons' ),
			]
		);

		$this->add_control(
			'title_color_active',
			[
				'label'     => __( 'Title Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-button.active span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-switch.active span' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_control(
			'background_color_active',
			[
				'label'     => __( 'Background Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-button.active' => 'background-color: {{VALUE}}',

				],
				'condition' => [
					'select_design' => ['button', 'tabbed'],
				],
			]
		);

		$this->add_control(
			'icon_color_active',
			[
				'label'     => __( 'Icon Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-button.active i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-switch.active i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-button.active svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-switch.active svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'title_border_active',
				'label'     => __( 'Border', 'langle-addons' ),
				'selector'  => '{{WRAPPER}} .la-cs-switch-wrapper .la-cs-button.active',
				'condition' => [
					'select_design' => ['button'],
				],
			]
		);

		$this->add_control(
			'button_border_radius_active',
			[
				'label'      => __( 'Border Radius', 'langle-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'      => '30',
					'right'    => '30',
					'bottom'   => '30',
					'left'     => '30',
					'unit'     => 'px',
					'isLinked' => 'true',
				],
				'selectors'  => [
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-button.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'select_design' => ['button'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'title_box_shadow_active',
				'label'     => __( 'Box Shadow', 'langle-addons' ),
				'selector'  => '{{WRAPPER}} .la-cs-switch-wrapper .la-cs-button.active',
				'condition' => [
					'select_design' => ['button'],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => __( 'Padding', 'langle-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'    => [
					'top'      => '10',
					'right'    => '20',
					'bottom'   => '10',
					'left'     => '20',
					'unit'     => 'px',
					'isLinked' => '',
				],
				'selectors'  => [
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'select_design' => ['button'],
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label'      => __( 'Margin', 'langle-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'    => [
					'top'      => '5',
					'right'    => '5',
					'bottom'   => '5',
					'left'     => '5',
					'unit'     => 'px',
					'isLinked' => 'true',
				],
				'selectors'  => [
					'{{WRAPPER}} .la-cs-switch-wrapper .la-cs-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'select_design' => ['button'],
				],
			]
		);

		$this->add_control(
			'box_style',
			[
				'label'     => __( 'Box Style', 'langle-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'select_design' => ['button'],
				],
			]
		);

		$this->add_control(
			'title_box_bg_color',
			[
				'label'     => __( 'Box Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFF',
				'selectors' => [
					'{{WRAPPER}} .la-cs-switch-wrapper' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'select_design' => ['button'],
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __( 'Box Padding', 'langle-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'    => [
					'top'      => '5',
					'right'    => '5',
					'bottom'   => '5',
					'left'     => '5',
					'unit'     => 'px',
					'isLinked' => 'true',
				],
				'selectors'  => [
					'{{WRAPPER}} .la-cs-switch-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'select_design' => ['button'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'box_border',
				'label'     => __( 'Border', 'langle-addons' ),
				'selector'  => '{{WRAPPER}} .la-cs-switch-wrapper',
				'condition' => [
					'select_design' => ['button'],
				],
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label'      => __( 'Border Radius', 'langle-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'      => '50',
					'right'    => '50',
					'bottom'   => '50',
					'left'     => '50',
					'unit'     => 'px',
					'isLinked' => 'true',
				],
				'selectors'  => [
					'{{WRAPPER}} .la-cs-switch-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'select_design' => ['button'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_box_shadow',
				'label'    => __( 'Box Shadow', 'langle-addons' ),
				'selector' => '{{WRAPPER}} .la-cs-switch-wrapper',
			]
		);

		$this->end_controls_section();

    }

    protected function __switcher_control_style_controls() {

        $this->start_controls_section(
			'_section_style_switcher_control',
			[
				'label'     => __( 'Switcher Control', 'langle-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'select_design' => ['round', 'round-2', 'square', 'square-2'],
				],
			]
		);

		$this->add_control(
			'switch_style_size',
			[
				'label'      => __( 'Switch Size (px)', 'langle-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 200,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 12,
				],
				'selectors'  => [
					'{{WRAPPER}} .la-cs-switch-container .la-cs-switch.la-input-label' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'switch_style_tabs'
		);

		$this->start_controls_tab(
			'switch_style_normal_tab',
			[
				'label' => __( 'Normal', 'langle-addons' ),
			]
		);

		$this->add_control(
			'switch_color',
			[
				'label'     => __( 'Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-input-label .la-cs-slider:before' => 'background-color : {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'switch_background_color',
			[
				'label'     => __( 'Background Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-input-label .la-cs-slider' => 'background-color : {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'switch_style_active_tab',
			[
				'label' => __( 'Active', 'langle-addons' ),
			]
		);

		$this->add_control(
			'switch_color_active',
			[
				'label'     => __( 'Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-input-label input:checked+.la-cs-slider:before' => 'background-color : {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'switch_background_color_active',
			[
				'label'     => __( 'Background Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-input-label input:checked+.la-cs-slider' => 'background-color : {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

    }

    protected function __switch_bar_style_controls() {

        $this->start_controls_section(
			'_section_style_switch_bar',
			[
				'label' => __( 'Switch Bar', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'title_section_padding',
			[
				'label'      => __( 'Section Padding', 'langle-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .la-content-switcher-wrapper .la-cs-switch-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'title_section_bg_color',
				'label'    => __( 'Background', 'langle-addons' ),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .la-content-switcher-wrapper .la-cs-switch-container',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'title_section_border',
				'label'    => __( 'Border', 'langle-addons' ),
				'selector' => '{{WRAPPER}} .la-content-switcher-wrapper .la-cs-switch-container',
			]
		);

		$this->add_control(
			'title_section_border_radius',
			[
				'label'      => __( 'Border Radius', 'langle-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .la-content-switcher-wrapper .la-cs-switch-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'title_section_shadow',
				'label'    => __( 'Box Shadow', 'langle-addons' ),
				'selector' => '{{WRAPPER}} .la-content-switcher-wrapper .la-cs-switch-container',
			]
		);

		$this->end_controls_section();

    }
    protected function __content_style_controls() {

        $this->start_controls_section(
			'_section_style_content',
			[
				'label' => __( 'Content', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => __( 'Padding', 'langle-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .la-content-switcher-wrapper .la-cs-content-container .la-cs-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'content_typography',
				'fields_options' => [
					'typography'  => [
						'default' => 'yes',
					],
					'font_family' => [
						'default' => 'Nunito',
					],
					'font_weight' => [
						'default' => '600',
					],
				],
				'selector'       => '{{WRAPPER}} .la-content-switcher-wrapper .la-cs-content-section',
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => __( 'Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-cs-content-container .la-cs-content-wrapper .la-cs-content-section' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'content_box_bg_color',
				'label'    => __( 'Background', 'langle-addons' ),
				'types'    => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .la-content-switcher-wrapper .la-cs-content-container .la-cs-content-wrapper',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'content_box',
				'label'    => __( 'Border', 'langle-addons' ),
				'selector' => '{{WRAPPER}} .la-content-switcher-wrapper .la-cs-content-container .la-cs-content-wrapper',

			]
		);
		$this->add_control(
			'content_border_radius',
			[
				'label'      => __( 'Border Radius', 'langle-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .la-content-switcher-wrapper .la-cs-content-container .la-cs-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'content_box_shadow',
				'label'    => __( 'Box Shadow', 'langle-addons' ),
				'selector' => '{{WRAPPER}} .la-content-switcher-wrapper .la-cs-content-container .la-cs-content-wrapper',

			]
		);

		$this->end_controls_section();

    }

    protected function render() {
		$settings  = $this->get_settings_for_display();
		$primary   = ( isset( $settings['content_list'][0] ) ? $settings['content_list'][0] : '' );
		$secondary = ( isset( $settings['content_list'][1] ) ? $settings['content_list'][1] : '' );

		$class_for_direction  = (!empty($settings['switch_direction_widescreen']))? 'widescreen-' . $settings['switch_direction_widescreen']: '';
		$class_for_direction .= (!empty($settings['switch_direction']))? ' desktop-' . $settings['switch_direction']: '';
		$class_for_direction .= (!empty($settings['switch_direction']))? ' ' . $settings['switch_direction']: '';
		$class_for_direction .= (!empty($settings['switch_direction_laptop']))? ' laptop-' . $settings['switch_direction_laptop']: '';
		$class_for_direction .= (!empty($settings['switch_direction_tablet_extra']))? ' tablet-extra-' . $settings['switch_direction_tablet_extra']: '';
		$class_for_direction .= (!empty($settings['switch_direction_tablet']))? ' tablet-' . $settings['switch_direction_tablet']: '';
		$class_for_direction .= (!empty($settings['switch_direction_mobile_extra']))? ' mobile-extra-' . $settings['switch_direction_mobile_extra']: '';
		$class_for_direction .= (!empty($settings['switch_direction_mobile']))? ' mobile-' . $settings['switch_direction_mobile']: '';

		?>
		<div class="la-content-switcher-wrapper la-cs-design-<?php echo esc_attr( $settings['select_design'] ); ?>" data-design-type="<?php echo esc_attr( $settings['select_design'] ); ?>">
			<div class="la-cs-switch-container">
				<div class="la-cs-switch-wrapper">
					<?php if ( in_array( $settings['select_design'], [ 'button', 'tabbed'] ) ) : ?>
						<?php foreach ( $settings['content_list'] as $i => $item ) : ?>
							<button class="la-cs-button <?php echo esc_attr( ( $item['active'] == 'yes' ) ? 'active' : '' ); ?> la-cs-icon-<?php echo esc_attr( $item['icon_align'] ); ?>" data-content-id="<?php echo esc_attr( $item['_id'] ); ?>">
								<?php if ( ! empty( $item['icon']['value'] ) ) : ?>
									<div class="la-cs-icon-wrapper"><?php langle_addons_render_icon( $item, null, 'icon' ); ?></div>
								<?php endif; ?>
								<span><?php echo esc_html( $item['title'] ); ?></span>
							</button>
						<?php endforeach; ?>
					<?php else : ?>
						<div class="la-cs-switch primary <?php echo esc_attr( ( $primary['active'] == 'yes' ) ? 'active' : '' ); ?> la-cs-icon-<?php echo esc_attr( $primary['icon_align'] ); ?>" data-content-id="<?php echo esc_attr( $primary['_id'] ); ?>">
							<?php if ( ! empty( $primary['icon']['value'] ) ) : ?>
								<div class="la-cs-icon-wrapper"><?php langle_addons_render_icon( $primary, null, 'icon' ); ?></div>
							<?php endif; ?>
							<span><?php echo esc_html( $primary['title'] ); ?></span>
						</div>

						<label class="la-cs-switch la-input-label">
							<input class="la-cs-toggle-switch" type="checkbox" <?php echo esc_attr( ( $secondary['active'] == 'yes' ) ? 'checked' : '' ); ?>>
							<span class="la-cs-slider la-cs-<?php echo esc_attr( $settings['select_design'] ); ?>"></span>
						</label>

						<div class="la-cs-switch secondary <?php echo esc_attr( ( $secondary['active'] == 'yes' ) ? 'active' : '' ); ?> la-cs-icon-<?php echo esc_attr( $secondary['icon_align'] ); ?>" data-content-id="<?php echo esc_attr( $secondary['_id'] ); ?>">
							<?php if ( ! empty( $secondary['icon']['value'] ) ) : ?>
								<div class="la-cs-icon-wrapper"><?php langle_addons_render_icon( $secondary, null, 'icon' ); ?></div>
							<?php endif; ?>
							<span><?php echo esc_html( $secondary['title'] ); ?></span>
						</div>

					<?php endif; ?>
				</div>
			</div>
			<div class="la-cs-content-container">
				<div class="la-cs-content-wrapper">
					<?php if ( in_array( $settings['select_design'], [ 'button', 'tabbed'] ) ) : ?>
						<?php foreach ( $settings['content_list'] as $i => $item ) : ?>
							<div id="<?php echo esc_attr( $item['_id'] ); ?>" class="la-cs-content-section <?php echo esc_attr( ( $item['active'] == 'yes' ) ? 'active' : '' ); ?>">
								<?php
								if ( $item['content_type'] == 'plain_content' ) {
									echo langle_addons_kses_intermediate( $item['plain_content'] );
								} elseif ( $item['content_type'] == 'saved_section' ) {
									echo la_elementor()->frontend->get_builder_content_for_display( $item['saved_section'] );
								} elseif ( $item['content_type'] == 'saved_page' ) {
									echo la_elementor()->frontend->get_builder_content_for_display( $item['saved_pages'] );
								}
								?>
							</div>
						<?php endforeach; ?>
						<?php
					else :
						?>
						<div id="<?php echo esc_attr( $primary['_id'] ); ?>" class="la-cs-content-section primary <?php echo esc_attr( ( $primary['active'] == 'yes' ) ? 'active' : '' ); ?>">
							<?php
							if ( $primary['content_type'] == 'plain_content' ) {
								echo langle_addons_kses_intermediate( $primary['plain_content'] );
							} elseif ( $primary['content_type'] == 'saved_section' ) {
								echo la_elementor()->frontend->get_builder_content_for_display( $primary['saved_section'] );
							} elseif ( $primary['content_type'] == 'saved_page' ) {
								echo la_elementor()->frontend->get_builder_content_for_display( $primary['saved_pages'] );
							}
							?>
						</div>

						<div id="<?php echo esc_attr( $secondary['_id'] ); ?>" class="la-cs-content-section secondary <?php echo esc_attr( ( $secondary['active'] == 'yes' ) ? 'active' : '' ); ?>">
							<?php
							if ( $secondary['content_type'] == 'plain_content' ) {
								echo langle_addons_kses_intermediate( $secondary['plain_content'] );
							} elseif ( $secondary['content_type'] == 'saved_section' ) {
								echo la_elementor()->frontend->get_builder_content_for_display( $secondary['saved_section'] );
							} elseif ( $secondary['content_type'] == 'saved_page' ) {
								echo la_elementor()->frontend->get_builder_content_for_display( $secondary['saved_pages'] );
							}
							?>
						</div>

					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
	}

}