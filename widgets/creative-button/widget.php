<?php
/**
 * Creative Button widget class
 *
 * @package Langle_Addons
 */
namespace Langle_Addons\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Langle_Addons\Elementor\Traits\Creative_Button_Markup;

defined( 'ABSPATH' ) || die();

class Creative_Button extends Base {
	use Creative_Button_Markup;
	/**
	 * Get widget title.
	 */
	public function get_title() {
		return __( 'Creative Button', 'langle-addons' );
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon() {
		return 'eicon-button';
	}

	public function get_keywords() {
		return [ 'button', 'btn', 'advance', 'link', 'creative', 'creative-utton' ];
	}

	/**
	 * Register widget content controls
	 */
	protected function register_content_controls() {

        $this->start_controls_section(
			'_section_button',
			[
				'label' => __( 'Creative Button', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'btn_style',
			[
				'label'   => __( 'Style', 'langle-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'sodales',
				'options' => [
					'sodales'  => __( 'Sodales', 'langle-addons' ),
					'posuere'  => __( 'Posuere', 'langle-addons' ),
					'iconic'  => __( 'Iconic', 'langle-addons' ),
					'symbolic' => __( 'Symbolic', 'langle-addons' ),
					'tellus'   => __( 'Tellus', 'langle-addons' ),
				],
			]
		);

		$this->add_control(
			'tellus_effect',
			[
				'label'     => __( 'Effects', 'langle-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'dissolve',
				'options'   => [
					'dissolve'     => __( 'Dissolve', 'langle-addons' ),
					'slide-down'   => __( 'Slide In Down', 'langle-addons' ),
					'slide-right'  => __( 'Slide In Right', 'langle-addons' ),
					'slide-x'      => __( 'Slide Out X', 'langle-addons' ),
					'cross-slider' => __( 'Cross Slider', 'langle-addons' ),
					'slide-y'      => __( 'Slide Out Y', 'langle-addons' ),
				],
				'condition' => [
					'btn_style' => 'tellus',
				],
			]
		);

		$this->add_control(
			'symbolic_effect',
			[
				'label'     => __( 'Effects', 'langle-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'back-in-right',
				'options'   => [
					'back-in-right'  => __( 'Back In Right', 'langle-addons' ),
					'back-in-left'   => __( 'Back In Left', 'langle-addons' ),
					'back-out-right' => __( 'Back Out Right', 'langle-addons' ),
					'back-out-left'  => __( 'Back Out Left', 'langle-addons' ),
				],
				'condition' => [
					'btn_style' => 'symbolic',
				],
			]
		);

		$this->add_control(
			'iconic_effect',
			[
				'label'     => __( 'Effects', 'langle-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'slide-in-down',
				'options'   => [
					'slide-in-down'  => __( 'Slide In Down', 'langle-addons' ),
					'slide-in-top'   => __( 'Slide In Top', 'langle-addons' ),
					'slide-in-right' => __( 'Slide In Right', 'langle-addons' ),
					'slide-in-left'  => __( 'Slide In Left', 'langle-addons' ),
				],
				'condition' => [
					'btn_style' => 'iconic',
				],
			]
		);

		$this->add_control(
			'posuere_effect',
			[
				'label'     => __( 'Effects', 'langle-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'aliquet',
				'options'   => [
					'aliquet'  => __( 'Aliquet', 'langle-addons' ),
					'massa'   => __( 'Massa', 'langle-addons' ),
					'urna'   => __( 'Urna', 'langle-addons' ),
					'tortor' => __( 'Tortor', 'langle-addons' ),
					'metus'    => __( 'Metus', 'langle-addons' ),
					'proin' => __( 'Proin', 'langle-addons' ),
					'sagittis' => __( 'Sagittis', 'langle-addons' ),
				],
				'condition' => [
					'btn_style' => 'posuere',
				],
			]
		);

		$this->add_control(
			'sodales_effect',
			[
				'label'     => __( 'Effects', 'langle-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'	=> 'render',
				'options'   => [
					'exploit'    => __( 'Exploit', 'langle-addons' ),
					'upward'     => __( 'Upward', 'langle-addons' ),
					'newbie'     => __( 'Newbie', 'langle-addons' ),
					'render'     => __( 'Render', 'langle-addons' ),
					'reshape'    => __( 'Reshape', 'langle-addons' ),
					'expandable' => __( 'Expandable', 'langle-addons' ),
					'bloom'      => __( 'Bloom', 'langle-addons' ),
				],
				'condition' => [
					'btn_style' => 'sodales',
				],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'       => __( 'Text', 'langle-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Button Text',
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'button_link',
			array(
				'label'         => __( 'Link', 'langle-addons' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'langle-addons' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => true,
				),
				'dynamic'       => [
					'active' => true,
				],
			)
		);

		$this->add_control(
			'icon',
			[
				'label'                  => __( 'Icon', 'langle-addons' ),
				'description'            => __( 'Please set an icon for the button.', 'langle-addons' ),
				'label_block'            => false,
				'type'                   => Controls_Manager::ICONS,
				'skin'                   => 'inline',
				'exclude_inline_options' => [ 'svg' ],
				'default'			     => [
					'library' => '',
                    'value' => 'far fa-arrow-alt-circle-right',
				],
				'conditions'             => [
					'relation' => 'or',
					'terms'    => [
						[
							'relation' => 'or',
							'terms'    => [
								[
									'name'     => 'btn_style',
									'operator' => '==',
									'value'    => 'symbolic',
								],
								[
									'name'     => 'btn_style',
									'operator' => '==',
									'value'    => 'iconic',
								],
							],
						],
						[
							'relation' => 'and',
							'terms'    => [
								[
									'name'     => 'btn_style',
									'operator' => '==',
									'value'    => 'sodales',
								],
								[
									'name'     => 'sodales_effect',
									'operator' => '==',
									'value'    => 'expandable',
								],
							],
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'align_x',
			[
				'label'       => __( 'Alignment', 'langle-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'left'   => [
						'title' => __( 'Left', 'langle-addons' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'langle-addons' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'langle-addons' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'toggle'      => true,
				'selectors'   => [
					'{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'magnetic_enable',
			[
				'label'        => __( 'Magnetic Effect', 'langle-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_block'  => false,
				'return_value' => 'yes',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'threshold',
			[
				'label'     => __( 'Threshold', 'langle-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 100,
				'step'      => 1,
				'default'   => 30,
				'condition' => [
					'magnetic_enable' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .la-creative-btn' => 'margin: {{VALUE}}px;',
				],
			]
		);

		$this->end_controls_section();

    }

    /**
	 * Register widget style controls
	 */
	protected function register_style_controls() {

		$this->__common_style_controls();

	}

    protected function _color_template() {

		$this->start_controls_section(
			'_button_style_color',
			[
				'label' => __( 'Color Tamplate', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'white_color',
			[
				'label'     => __( 'White', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .la-creative-btn-wrap' => '--la-ctv-btn-clr-white: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'offwhite_color',
			[
				'label'     => __( 'Off White', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f0f0f0',
				'selectors' => [
					'{{WRAPPER}} .la-creative-btn-wrap' => '--la-ctv-btn-clr-offwhite: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'black_color',
			[
				'label'     => __( 'Black', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .la-creative-btn-wrap' => '--la-ctv-btn-clr-black: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'cranberry_color',
			[
				'label'     => __( 'Cranberry', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e2498a',
				'selectors' => [
					'{{WRAPPER}} .la-creative-btn-wrap' => '--la-ctv-btn-clr-cranberry: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'purple_color',
			[
				'label'     => __( 'Purple', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#562dd4',
				'selectors' => [
					'{{WRAPPER}} .la-creative-btn-wrap' => '--la-ctv-btn-clr-purple: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

	}

    /**
	 * Style section for Tellus, Symbolic, Iconic
	 *
	 * @return void
	 */
	protected function __common_style_controls() {

		$this->start_controls_section(
			'_tellus_symbolic_iconic_style_section',
			[
				'label' => __( 'Common', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'button_item_width',
			[
				'label'      => __( 'Size', 'langle-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .la-creative-btn.la-eft--downhill' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .la-creative-btn.la-eft--roundup' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .la-creative-btn.la-eft--roundup .progress' => 'width: calc({{SIZE}}{{UNIT}} - (({{SIZE}}{{UNIT}} / 100) * 20) ); height:auto;',
				],
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms'    => [
								[
									'name'     => 'sodales_effect',
									'operator' => '==',
									'value'    => 'roundup',
								],
								[
									'name'     => 'sodales_effect',
									'operator' => '==',
									'value'    => 'downhill',
								],
							],
						],
						[
							'terms' => [
								[
									'name'     => 'btn_style',
									'operator' => '==',
									'value'    => 'sodales',
								],
							],
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'button_icon_size',
			[
				'label'      => __( 'Icon Size', 'langle-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors'  => [
					'{{WRAPPER}} .la-creative-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms'    => [
						[
							'relation' => 'or',
							'terms'    => [
								[
									'name'     => 'btn_style',
									'operator' => '==',
									'value'    => 'symbolic',
								],
								[
									'name'     => 'btn_style',
									'operator' => '==',
									'value'    => 'iconic',
								],
							],
						],
						[
							'relation' => 'and',
							'terms'    => [
								[
									'name'     => 'btn_style',
									'operator' => '==',
									'value'    => 'sodales',
								],
								[
									'name'     => 'sodales_effect',
									'operator' => '==',
									'value'    => 'expandable',
								],
							],
						],
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'label'    => __( 'Typography', 'langle-addons' ),
				'selector' => '{{WRAPPER}} .la-creative-btn',
				'scheme'   => Typography::TYPOGRAPHY_4,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'       => 'button_border',
				'exclude'    => ['color'],
				'selector'   => '{{WRAPPER}} .la-creative-btn, {{WRAPPER}} .la-creative-btn.la-eft--bloom div',
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms'    => [
								[
									'name'     => 'sodales_effect',
									'operator' => '!=',
									'value'    => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name'     => 'btn_style',
									'operator' => '!=',
									'value'    => '',
								],
							],
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label'      => __( 'Border Radius', 'langle-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .la-creative-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .la-creative-btn.la-stl--sodales.la-eft--bloom div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_sodales_roundup_stroke_width',
			[
				'label'      => __( 'Stroke Width', 'langle-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .la-creative-btn.la-eft--roundup' => '--la-ctv-btn-stroke-width: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms'    => [
								[
									'name'     => 'sodales_effect',
									'operator' => '==',
									'value'    => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name'     => 'btn_style',
									'operator' => '==',
									'value'    => 'sodales',
								],
							],
						],
					],
				],
			]
		);

		$this->__btn_tab_style_controls();

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => __( 'Padding', 'langle-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .la-creative-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'{{WRAPPER}} .la-creative-btn.la-stl--iconic > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'{{WRAPPER}} .la-creative-btn.la-stl--posuere.la-eft--aliquet > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .la-creative-btn.la-stl--posuere.la-eft--aliquet::after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'{{WRAPPER}} .la-creative-btn.la-stl--posuere.la-eft--massa > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .la-creative-btn.la-stl--posuere.la-eft--massa::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'{{WRAPPER}} .la-creative-btn.la-stl--posuere.la-eft--metus' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .la-creative-btn.la-stl--posuere.la-eft--metus::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'{{WRAPPER}} .la-creative-btn.la-stl--sodales.la-eft--bloom span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();
	}

    protected function __btn_tab_style_controls() {

		$conditions = [
			'terms' => [
				[
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'sodales_effect',
							'operator' => '!=',
							'value'    => 'roundup',
						],
					],
				],
				[
					'terms' => [
						[
							'name'     => 'btn_style',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
			],
		];

		$this->start_controls_tabs( '_tabs_button' );
		$this->start_controls_tab(
			'_tab_button_normal',
			[
				'label' => __( 'Normal', 'langle-addons' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => __( 'Text Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-creative-btn-wrap .la-creative-btn' => '--la-ctv-btn-txt-clr: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label'      => __( 'Background Color', 'langle-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .la-creative-btn-wrap .la-creative-btn' => '--la-ctv-btn-bg-clr: {{VALUE}}',
				],
				'conditions' => $conditions,
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label'      => __( 'Border Color', 'langle-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .la-creative-btn-wrap .la-creative-btn' => '--la-ctv-btn-border-clr: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms'    => [
								[
									'name'     => 'sodales_effect',
									'operator' => '!=',
									'value'    => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name'     => 'btn_style',
									'operator' => '!=',
									'value'    => '',
								],
								[
									'name'     => 'button_border_border',
									'operator' => '!=',
									'value'    => '',
								],
							],
						],
					],
				],
			]
		);

		$this->add_control(
			'button_roundup_circle_color',
			[
				'label'      => __( 'Circle Color', 'langle-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .la-creative-btn-wrap .la-creative-btn.la-eft--roundup' => '--la-ctv-btn-border-clr: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms'    => [
								[
									'name'     => 'sodales_effect',
									'operator' => '==',
									'value'    => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name'     => 'btn_style',
									'operator' => '==',
									'value'    => 'sodales',
								],
							],
						],
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .la-creative-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tabs_button_hover',
			[
				'label' => __( 'Hover', 'langle-addons' ),
			]
		);

		$this->add_control(
			'button_hover_text_color',
			[
				'label'     => __( 'Text Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-creative-btn-wrap .la-creative-btn' => '--la-ctv-btn-txt-hvr-clr: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label'      => __( 'Background Color', 'langle-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .la-creative-btn-wrap .la-creative-btn' => '--la-ctv-btn-bg-hvr-clr: {{VALUE}}',
				],
				'conditions' => $conditions,
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'      => __( 'Border Color', 'langle-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .la-creative-btn-wrap .la-creative-btn' => '--la-ctv-btn-border-hvr-clr: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms'    => [
								[
									'name'     => 'sodales_effect',
									'operator' => '!=',
									'value'    => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name'     => 'btn_style',
									'operator' => '!=',
									'value'    => '',
								],
								[
									'name'     => 'button_border_border',
									'operator' => '!=',
									'value'    => '',
								],
							],
						],
					],
				],
			]
		);

		$this->add_control(
			'button_hover_roundup_circle_color',
			[
				'label'      => __( 'Circle Color', 'langle-addons' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} .la-creative-btn-wrap .la-creative-btn.la-eft--roundup' => '--la-ctv-btn-border-hvr-clr: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms'    => [
								[
									'name'     => 'sodales_effect',
									'operator' => '==',
									'value'    => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name'     => 'btn_style',
									'operator' => '==',
									'value'    => 'sodales',
								],
							],
						],
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .la-creative-btn:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
	}

    protected function render() {

		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'wrap', 'data-magnetic', $settings['magnetic_enable'] ? $settings['magnetic_enable'] : 'no' );
		$this->{'render_' . $settings['btn_style'] . '_markup'}( $settings );

	}


}