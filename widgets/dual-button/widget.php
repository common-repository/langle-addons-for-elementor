<?php
/**
 * Dual Button widget class
 *
 * @package Langle_Addons
 */
namespace Langle_Addons\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;


defined( 'ABSPATH' ) || die();

class Dual_Button extends Base {

    /**
     * Get widget title.
     *
     * @since 0.1
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Dual Button', 'langle-addons' );
    }

    /**
     * Get widget icon.
     *
     * @since 0.1
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-dual-button';
    }

    public function get_keywords() {
        return [ 'button', 'btn', 'dual', 'advance', 'link' ];
    }

	/**
     * Register widget content controls
     */
    protected function register_content_controls() {

        $this->start_controls_section(
            '_section_button',
            [
                'label' => __( 'Dual Buttons', 'langle-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->start_controls_tabs( '_tabs_buttons' );

        $this->start_controls_tab(
            '_tab_button_primary',
            [
                'label' => __( 'Primary', 'langle-addons' ),
            ]
        );

        $this->add_control(
            'left_button_text',
            [
                'label' => __( 'Text', 'langle-addons' ),
                'label_block'=> true,
                'type' => Controls_Manager::TEXT,
                'default' => 'Button Text',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'left_button_link',
            [
                'label' => __( 'Link', 'langle-addons' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://example.com',
                'dynamic' => [
                    'active' => true,
				],
				'default' => [
					'url' => '#',
				],
            ]
        );

        if ( langle_addons_is_elementor_version( '<', '2.6.0' ) ) {
            $this->add_control(
                'left_button_icon',
                [
                    'label' => __( 'Icon', 'langle-addons' ),
                    'type' => Controls_Manager::ICON,
                ]
            );

            $condition = ['left_button_icon!' => ''];
        } else {
            $this->add_control(
                'left_button_selected_icon',
                [
                    'label' => __( 'Icon', 'langle-addons' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'left_button_icon',
                ]
            );
            $condition = ['left_button_selected_icon[value]!' => ''];
        }

        $this->add_control(
            'left_button_icon_position',
            [
                'label' => __( 'Icon Position', 'langle-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => __( 'Before', 'langle-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __( 'After', 'langle-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'toggle' => false,
                'default' => 'before',
                'condition' => $condition,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'left_button_icon_spacing',
            [
                'label' => __( 'Icon Spacing', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'condition' => $condition,
                'selectors' => [
                    '{{WRAPPER}} .la-dual-btn--left .la-dual-btn-icon--before' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .la-dual-btn--left .la-dual-btn-icon--after' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_connector',
            [
                'label' => __( 'Connector', 'langle-addons' ),
            ]
        );

        $this->add_control(
            'button_connector_hide',
            [
                'label' => __( 'Hide Connector?', 'langle-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Hide', 'langle-addons' ),
                'label_off' => __( 'Show', 'langle-addons' ),
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'button_connector_type',
            [
                'label' => __( 'Connector Type', 'langle-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'text' => [
                        'title' => __( 'Text', 'langle-addons' ),
                        'icon' => 'eicon-t-letter-bold',
                    ],
                    'icon' => [
                        'title' => __( 'Icon', 'langle-addons' ),
                        'icon' => 'eicon-star',
                    ]
                ],
                'toggle' => false,
                'default' => 'text',
                'condition' => [
                    'button_connector_hide!' => 'yes',
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'button_connector_text',
            [
                'label' => __( 'Text', 'langle-addons' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Or', 'langle-addons' ),
                'condition' => [
                    'button_connector_hide!' => 'yes',
                    'button_connector_type' => 'text',
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        if ( langle_addons_is_elementor_version( '<', '2.6.0' ) ) {
            $this->add_control(
                'button_connector_icon',
                [
                    'label' => __( 'Icon', 'langle-addons' ),
                    'type' => Controls_Manager::ICON,
                    'condition' => [
                        'button_connector_hide!' => 'yes',
                        'button_connector_type' => 'icon',
                    ]
                ]
            );
        } else {
            $this->add_control(
                'button_connector_selected_icon',
                [
                    'label' => __( 'Icon', 'langle-addons' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'button_connector_icon',
                    'default' => [
                        'library' => '',
                        'value' => '',
                    ],
                    'condition' => [
                        'button_connector_hide!' => 'yes',
                        'button_connector_type' => 'icon',
                    ]
                ]
            );
        }

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_secondary',
            [
                'label' => __( 'Secondary', 'langle-addons' ),
            ]
        );

        $this->add_control(
            'right_button_text',
            [
                'label' => __( 'Text', 'langle-addons' ),
                'label_block'=> true,
                'type' => Controls_Manager::TEXT,
                'default' => 'Button Text',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'right_button_link',
            [
                'label' => __( 'Link', 'langle-addons' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://example.com',
                'dynamic' => [
                    'active' => true,
				],
				'default' => [
					'url' => '#',
				],
            ]
        );

        if ( langle_addons_is_elementor_version( '<', '2.6.0' ) ) {
            $this->add_control(
                'right_button_icon',
                [
                    'label' => __( 'Icon', 'langle-addons' ),
                    'type' => Controls_Manager::ICON,
                ]
            );

            $condition = ['right_button_icon!' => ''];
        } else {
            $this->add_control(
                'right_button_selected_icon',
                [
                    'label' => __( 'Icon', 'langle-addons' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'right_button_icon',
                ]
            );

            $condition = ['right_button_selected_icon[value]!' => ''];
        }

        $this->add_control(
            'right_button_icon_position',
            [
                'label' => __( 'Icon Position', 'langle-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => __( 'Before', 'langle-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __( 'After', 'langle-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'toggle' => false,
                'default' => 'after',
                'condition' => $condition,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'right_button_icon_spacing',
            [
                'label' => __( 'Icon Spacing', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'condition' => $condition,
                'selectors' => [
                    '{{WRAPPER}} .la-dual-btn--right .la-dual-btn-icon--before' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .la-dual-btn--right .la-dual-btn-icon--after' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'buttons_layout',
            [
                'label' => __( 'Layout', 'langle-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'queue' => [
                        'title' => __( 'Queue', 'langle-addons' ),
                        'icon' => 'eicon-navigation-horizontal',
                    ],
                    'stack' => [
                        'title' => __( 'Stack', 'langle-addons' ),
                        'icon' => 'eicon-navigation-vertical',
                    ]
                ],
                'toggle' => false,
                'desktop_default' => 'queue',
                'tablet_default' => 'queue',
                'mobile_default' => 'queue',
                'separator' => 'before',
                'prefix_class' => 'la-dual-button-%s-layout-',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Register widget style controls
     */
    protected function register_style_controls() {

		$this->__common_style_controls();
		$this->__primary_btn_style_controls();
		$this->__connector_style_controls();
		$this->__secondary_btn_style_controls();

	}

    protected function __common_style_controls() {

        $this->start_controls_section(
            '_section_style_common',
            [
                'label' => __( 'Common', 'langle-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
		);

		$this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'langle-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .la-dual-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);

		$this->add_responsive_control(
            'button_gap',
            [
                'label' => __( 'Space Between Buttons', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '(desktop+){{WRAPPER}}.la-dual-button--layout-queue .la-dual-btn--left' => 'margin-right: calc({{button_gap.SIZE}}{{UNIT}}/2);',
                    '(desktop+){{WRAPPER}}.la-dual-button--layout-stack .la-dual-btn--left' => 'margin-bottom: calc({{button_gap.SIZE}}{{UNIT}}/2);',
                    '(desktop+){{WRAPPER}}.la-dual-button--layout-queue .la-dual-btn--right' => 'margin-left: calc({{button_gap.SIZE}}{{UNIT}}/2);',
                    '(desktop+){{WRAPPER}}.la-dual-button--layout-stack .la-dual-btn--right' => 'margin-top: calc({{button_gap.SIZE}}{{UNIT}}/2);',

                    '(tablet){{WRAPPER}}.la-dual-button--tablet-layout-queue .la-dual-btn--left' => 'margin-right: calc({{button_gap_tablet.SIZE || button_gap.SIZE}}{{UNIT}}/2); margin-bottom: 0;',
                    '(tablet){{WRAPPER}}.la-dual-button--tablet-layout-stack .la-dual-btn--left' => 'margin-bottom: calc({{button_gap_tablet.SIZE || button_gap.SIZE}}{{UNIT}}/2); margin-right: 0;',
                    '(tablet){{WRAPPER}}.la-dual-button--tablet-layout-queue .la-dual-btn--right' => 'margin-left: calc({{button_gap_tablet.SIZE || button_gap.SIZE}}{{UNIT}}/2); margin-top: 0;',
                    '(tablet){{WRAPPER}}.la-dual-button--tablet-layout-stack .la-dual-btn--right' => 'margin-top: calc({{button_gap_tablet.SIZE || button_gap.SIZE}}{{UNIT}}/2); margin-left: 0;',

                    '(mobile){{WRAPPER}}.la-dual-button--mobile-layout-queue .la-dual-btn--left' => 'margin-right: calc({{button_gap_mobile.SIZE || button_gap_tablet.SIZE || button_gap.SIZE}}{{UNIT}}/2); margin-bottom: 0;',
                    '(mobile){{WRAPPER}}.la-dual-button--mobile-layout-stack .la-dual-btn--left' => 'margin-bottom: calc({{button_gap_mobile.SIZE || button_gap_tablet.SIZE || button_gap.SIZE}}{{UNIT}}/2); margin-right: 0;',
                    '(mobile){{WRAPPER}}.la-dual-button--mobile-layout-queue .la-dual-btn--right' => 'margin-left: calc({{button_gap_mobile.SIZE || button_gap_tablet.SIZE || button_gap.SIZE}}{{UNIT}}/2); margin-top: 0;',
                    '(mobile){{WRAPPER}}.la-dual-button--mobile-layout-stack .la-dual-btn--right' => 'margin-top: calc({{button_gap_mobile.SIZE || button_gap_tablet.SIZE || button_gap.SIZE}}{{UNIT}}/2); margin-left: 0;',
                ],
            ]
		);

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __( 'Typography', 'langle-addons' ),
                'selector' => '{{WRAPPER}} .la-dual-btn',
                'scheme' => Typography::TYPOGRAPHY_4,
            ]
		);

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .la-dual-btn'
            ]
		);

        $this->add_responsive_control(
            'button_align_x',
            [
                'label' => __( 'Alignment', 'langle-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'langle-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'langle-addons' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'langle-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'toggle' => true,
                'prefix_class' => 'la-dual-button-%s-align-'
            ]
        );

		$this->end_controls_section();
    
	}

    protected function __primary_btn_style_controls() {
        
        $this->start_controls_section(
			'_section_style_left_button',
            [
                'label' => __( 'Primary Button', 'langle-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
		);

        $this->add_responsive_control(
            'left_button_padding',
            [
                'label'        => __( 'Padding', 'langle-addons' ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => ['px', 'em', '%'],
                'default'      => [
                    'unit'     => 'px',
                    'top'      => 19,
                    'right'    => 33,
                    'bottom'   => 19,
                    'left'     => 33,
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-dual-btn--left' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'left_button_border',
                'selector' => '{{WRAPPER}} .la-dual-btn--left'
            ]
		);

        $this->add_responsive_control(
            'left_button_border_radius',
            [
                'label' => __( 'Border Radius', 'langle-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .la-dual-btn--left' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'left_button_typography',
                'label' => __( 'Typography', 'langle-addons' ),
                'selector' => '{{WRAPPER}} .la-dual-btn--left',
                'scheme' => Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'left_button_box_shadow',
                'selector' => '{{WRAPPER}} .la-dual-btn--left'
            ]
        );

		$this->start_controls_tabs( '_tabs_left_button' );

        $this->start_controls_tab(
            '_tab_left_button_normal',
            [
                'label' => __( 'Normal', 'langle-addons' ),
            ]
		);

        $this->add_control(
            'left_button_text_color',
            [
                'label' => __( 'Text Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-dual-btn--left' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
            'left_button_bg_color',
            [
                'label'     => __( 'Background Color', 'langle-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-dual-btn--left' => 'background-color: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
            '_tabs_left_button_hover',
            [
                'label' => __( 'Hover', 'langle-addons' ),
            ]
		);

		$this->add_control(
            'left_button_hover_text_color',
            [
                'label' => __( 'Text Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-dual-btn--left:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'left_button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-dual-btn--left:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'left_button_hover_border_color',
            [
                'label' => __( 'Border Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-dual-btn--left:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'left_button_border_border!' => ''
                ]
            ]
        );

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	
	}

    protected function __connector_style_controls() {

        $this->start_controls_section(
			'_section_style_connector',
            [
                'label' => __( 'Connector', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
            ]
		);

        $this->add_control(
            'connector_notice',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __( 'Connector is hidden now, please enable connector from Content > Connector tab.', 'langle-addons' ),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition' => [
                    'button_connector_hide' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'connector_text_color',
            [
                'label' => __( 'Text Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-dual-btn-connector' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
            'connector_bg_color',
            [
                'label' => __( 'Background Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-dual-btn-connector' => 'background-color: {{VALUE}}',
                ],
            ]
        );

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'connector_typography',
                'label' => __( 'Typography', 'langle-addons' ),
                'selector' => '{{WRAPPER}} .la-dual-btn-connector',
                'scheme' => Typography::TYPOGRAPHY_3
            ]
		);

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'connector_box_shadow',
                'selector' => '{{WRAPPER}} .la-dual-btn-connector'
            ]
		);

		$this->end_controls_section();
	
	}

    protected function __secondary_btn_style_controls() {

        $this->start_controls_section(
            '_section_style_right_button',
            [
                'label' => __( 'Secondary Button', 'langle-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'right_button_padding',
            [
                'label' => __( 'Padding', 'langle-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default'      => [
                    'unit'     => 'px',
                    'top'      => 19,
                    'right'    => 33,
                    'bottom'   => 19,
                    'left'     => 33,
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .la-dual-btn--right' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'right_button_border',
                'selector' => '{{WRAPPER}} .la-dual-btn--right'
            ]
        );

        $this->add_responsive_control(
            'right_button_border_radius',
            [
                'label' => __( 'Border Radius', 'langle-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .la-dual-btn--right' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'right_button_typography',
                'label' => __( 'Typography', 'langle-addons' ),
                'selector' => '{{WRAPPER}} .la-dual-btn--right',
                'scheme' => Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'right_button_box_shadow',
                'selector' => '{{WRAPPER}} .la-dual-btn--right'
            ]
        );

        $this->start_controls_tabs( '_tabs_right_button' );

        $this->start_controls_tab(
            '_tab_right_button_normal',
            [
                'label' => __( 'Normal', 'langle-addons' ),
            ]
        );

        $this->add_control(
            'right_button_text_color',
            [
                'label' => __( 'Text Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-dual-btn--right' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'right_button_bg_color',
            [
                'label' => __( 'Background Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-dual-btn--right' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tabs_right_button_hover',
            [
                'label' => __( 'Hover', 'langle-addons' ),
            ]
        );

        $this->add_control(
            'right_button_hover_text_color',
            [
                'label' => __( 'Text Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-dual-btn--right:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'right_button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-dual-btn--right:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'right_button_hover_border_color',
            [
                'label' => __( 'Border Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-dual-btn--right:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'right_button_border_border!' => ''
                ]
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Left button
        $this->add_render_attribute( 'left_button', 'class', 'la-dual-btn la-dual-btn--left' );
        $this->add_link_attributes( 'left_button', $settings['left_button_link'] );
        $this->add_inline_editing_attributes( 'left_button_text', 'none' );

        if ( ! empty( $settings['left_button_icon'] ) || ! empty( $settings['left_button_selected_icon'] ) ) {
            $this->add_render_attribute( 'left_button_icon', 'class', [
                'la-dual-btn-icon',
                'la-dual-btn-icon--' . esc_attr( $settings['left_button_icon_position'] )
            ] );
        }

        // Button connector
        $this->add_render_attribute( 'button_connector_text', 'class', 'la-dual-btn-connector' );
        if ( $settings['button_connector_type'] === 'icon' && ( ! empty( $settings['button_connector_icon'] ) || ! empty( $settings['button_connector_selected_icon'] ) ) ) {
            $this->add_render_attribute( 'button_connector_text', 'class', 'la-dual-btn-connector--icon' );
        } else {
            $this->add_render_attribute( 'button_connector_text', 'class', 'la-dual-btn-connector--text' );
            $this->add_inline_editing_attributes( 'button_connector_text', 'none' );
        }

        // Right button
        $this->add_render_attribute( 'right_button', 'class', 'la-dual-btn la-dual-btn--right' );
        $this->add_link_attributes( 'right_button', $settings['right_button_link'] );
        $this->add_inline_editing_attributes( 'right_button_text', 'none' );

        if ( ! empty( $settings['right_button_icon'] ) || ! empty( $settings['right_button_selected_icon'] ) ) {
            $this->add_render_attribute( 'right_button_icon', 'class', [
                'la-dual-btn-icon',
                'la-dual-btn-icon--' . esc_attr( $settings['right_button_icon_position'] )
            ] );
        }
        ?>
        <div class="la-dual-btn-wrapper">
            <a <?php $this->print_render_attribute_string( 'left_button' ); ?>>
                <?php if ( $settings['left_button_icon_position'] === 'before' && ( ! empty( $settings['left_button_icon'] ) || ! empty( $settings['left_button_selected_icon'] ) ) ) : ?>
                    <span <?php $this->print_render_attribute_string( 'left_button_icon' ); ?>>
                        <?php langle_addons_render_icon( $settings, 'left_button_icon', 'left_button_selected_icon' ); ?>
                    </span>
                <?php endif; ?>
                <?php if ( $settings['left_button_text'] ) : ?>
                    <span <?php $this->print_render_attribute_string( 'left_button_text' ); ?>><?php echo esc_html( $settings['left_button_text'] ); ?></span>
                <?php endif; ?>
                <?php if ( $settings['left_button_icon_position'] === 'after' && ( ! empty( $settings['left_button_icon'] ) || ! empty( $settings['left_button_selected_icon'] ) ) ) : ?>
                    <span <?php $this->print_render_attribute_string( 'left_button_icon' ); ?>>
                        <?php langle_addons_render_icon( $settings, 'left_button_icon', 'left_button_selected_icon' ); ?>
                    </span>
                <?php endif; ?>
            </a>
            <?php if ( $settings['button_connector_hide'] !== 'yes' ) : ?>
                <span <?php $this->print_render_attribute_string( 'button_connector_text' ); ?>>
                    <?php if ( $settings['button_connector_type'] === 'icon' && ( ! empty( $settings['button_connector_icon'] ) || ! empty( $settings['button_connector_selected_icon'] ) ) ) : ?>
                        <?php langle_addons_render_icon( $settings, 'button_connector_icon', 'button_connector_selected_icon' ); ?>
                    <?php else :
                        echo esc_html( $settings['button_connector_text'] );
                    endif; ?>
                </span>
            <?php endif; ?>
        </div>
        <div class="la-dual-btn-wrapper">
            <a <?php $this->print_render_attribute_string( 'right_button' ); ?>>
                <?php if ( $settings['right_button_icon_position'] === 'before' && ( ! empty( $settings['right_button_icon'] ) || ! empty( $settings['right_button_selected_icon'] ) ) ) : ?>
                    <span <?php $this->print_render_attribute_string( 'right_button_icon' ); ?>>
                        <?php langle_addons_render_icon( $settings, 'right_button_icon', 'right_button_selected_icon' ); ?>
                    </span>
                <?php endif; ?>
                <?php if ( $settings['right_button_text'] ) : ?>
                    <span <?php $this->print_render_attribute_string( 'right_button_text' ); ?>><?php echo esc_html( $settings['right_button_text'] ); ?></span>
                <?php endif; ?>
                <?php if ( $settings['right_button_icon_position'] === 'after' && ( ! empty( $settings['right_button_icon'] ) || ! empty( $settings['right_button_selected_icon'] ) ) ) : ?>
                    <span <?php $this->print_render_attribute_string( 'right_button_icon' ); ?>>
                        <?php langle_addons_render_icon( $settings, 'right_button_icon', 'right_button_selected_icon' ); ?>
                    </span>
                <?php endif; ?>
            </a>
        </div>
        <?php
    }

}