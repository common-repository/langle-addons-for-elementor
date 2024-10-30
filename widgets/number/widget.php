<?php
/**
 * Number widget class
 *
 * @package Langle_Addons
 */
namespace Langle_Addons\Elementor\Widget;

use Elementor\Core\Schemes\Typography;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;

defined( 'ABSPATH' ) || die();

class Number extends Base {
    
	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Number', 'langle-addons' );
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
		return 'eicon-number-field';
	}

	public function get_keywords() {
		return [ 'number', 'animate', 'text' ];
	}

    /**
    * Register widget content controls
    */
    protected function register_content_controls() {
        $this->start_controls_section(
			'_section_number',
			[
				'label' => __( 'Number', 'langle-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'number_text',
			[
				'label' => __( 'Text', 'langle-addons' ),
				'label_block' => false,
				'type' => Controls_Manager::TEXT,
				'default' => 100,
                'dynamic' => [
                    'active' => true,
                ]
			]
		);

        $this->add_control(
            'animate_number',
            [
                'label' => __( 'Animate', 'langle-addons' ),
                'description' => __( 'Only number is animatable' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'langle-addons' ),
                'label_off' => __( 'No', 'langle-addons' ),
                'return_value' => 'yes',
                'separator' => 'before',
                'default'   => 'label_on',
            ]
        );

        $this->add_control(
            'animate_duration',
            [
                'label' => __( 'Duration', 'langle-addons' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'max' => 10000,
                'step' => 10,
                'default' => 1000,
                'condition' => [
                    'animate_number!' => ''
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
    * Register widget style controls
    */
    protected function register_style_controls() {
        $this->__number_bg_style_controls();
		$this->__text_style_controls();
    }

    protected function __number_bg_style_controls() {

		$this->start_controls_section(
			'number_background_style',
			[
				'label' => __( 'General', 'langle-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'number_width_height',
			[
				'label' => __( 'Size', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
                'default'   => [
                    'unit'  => 'px',
                    'size'  => 70,
                ],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .la-number-body' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'number_padding',
            [
                'label' => __( 'Padding', 'langle-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .la-number-body ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'number_border',
                'label' => __( 'Border', 'langle-addons' ),
                'selector' => '{{WRAPPER}} .la-number-body',
            ]
        );

        $this->add_control(
            'number_border_radius',
            [
                'label' => __( 'Border Radius', 'langle-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .la-number-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'number_box_shadow',
				'label' => __( 'Box Shadow', 'langle-addons' ),
				'selector' => '{{WRAPPER}} .la-number-body',
			]
		);

		$this->add_responsive_control(
			'number_align',
			[
				'label' => __( 'Alignment', 'langle-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'langle-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'langle-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'langle-addons' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .la-number-body'  => '{{VALUE}};'
				],
                'selectors_dictionary' => [
                    'left' => 'float: left',
                    'center' => 'margin: 0 auto',
                    'right' => 'float:right'
                ],
			]
		);

        $this->add_control(
            '_heading_bg',
            [
                'label'     => __( 'Background', 'langle-addons' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'number_background_color',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .la-number-body',
            ]
        );

        $this->add_control(
                '_heading_bg_overlay',
                [
                    'label' => __( 'Background Overaly', 'langle-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'number_background_overlay_color',
                'label' => __( 'Background', 'langle-addons' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .la-number-overlay',
            ]
        );

        $this->add_control(
            'number_background_overlay_blend_mode',
            [
                'label' => __( 'Blend Mood', 'langle-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => langle_addons_get_css_blend_modes(),
                'selectors' => [
                    '{{WRAPPER}} .la-number-overlay' => 'mix-blend-mode: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'number_background_overlay_blend_mode_opacity',
            [
                'label' => __( 'Opacity', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => .1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-number-overlay' => 'opacity: {{SIZE}};',
                ],
            ]
        );

		$this->end_controls_section();
	}
    protected function __text_style_controls() {

        $this->start_controls_section(
            '_section_style_text',
            [
                'label' => __( 'Text', 'langle-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'number_text_color',
            [
                'label' => __( 'Text Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-number-body' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_text_typography',
                'label' => __( 'Typography', 'langle-addons' ),
                'selector' => '{{WRAPPER}} .la-number-text',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'number_text_shadow',
                'label' => __( 'Text Shadow', 'langle-addons' ),
                'selector' => '{{WRAPPER}} .la-number-text',
            ]
        );

        $this->add_control(
            'number_text_rotate',
            [
                'label' => __( 'Text Rotate', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-number-text' => '-webkit-transform: rotate({{SIZE}}deg);-ms-transform: rotate({{SIZE}}deg);transform: rotate({{SIZE}}deg);'
                ],
            ]
        );

        $this->end_controls_section();
	}

    protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'number_text', 'class', 'la-number-text' );
		$number = $settings['number_text'];

		if ( $settings['animate_number'] ) {
		    $data = [
		        'toValue' => intval( $settings['number_text'] ),
                'duration' => intval( $settings['animate_duration'] ),
            ];
		    $this->add_render_attribute( 'number_text', 'data-animation', wp_json_encode( $data ) );
            $number = 0;
        }
        ?>

		<div class="la-number-body">
			<div class="la-number-overlay"></div>
			<span <?php $this->print_render_attribute_string( 'number_text' ); ?>><?php echo esc_html( $number ); ?></span>
		</div>

		<?php
	}
}
