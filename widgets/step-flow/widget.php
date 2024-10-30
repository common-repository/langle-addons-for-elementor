<?php
/**
 * Step Flow widget class
 *
 * @package Langle_Addons
 */
namespace Langle_Addons\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Schemes\Typography;

defined( 'ABSPATH' ) || die();

class Step_Flow extends Base {
	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Step Flow', 'langle-addons' );
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
		return 'eicon-flow';
	}

	public function get_keywords() {
		return [ 'step', 'flow' ];
	}

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {

        $this->start_controls_section(
			'_section_step',
			[
				'label' => __( 'Step Flow', 'langle-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		if ( langle_addons_is_elementor_version( '<', '2.6.0' ) ) {
			$this->add_control(
				'icon',
				[
					'label' => __( 'Icon', 'langle-addons' ),
					'type' => Controls_Manager::ICON,
					'label_block' => true,
					'default' => 'fa fa-arrow-right',
				]
			);
		} else {
			$this->add_control(
				'selected_icon',
				[
					'label' => __( 'Icon', 'langle-addons' ),
					'type' => Controls_Manager::ICONS,
					'fa4compatibility' => 'icon',
					'label_block' => true,
					'default' => [
						'value' => 'fa fa-arrow-right',
						'library' => 'fa-regular',
					]
				]
			);
		}

		$this->add_control(
			'badge',
			[
				'label' => __( 'Badge', 'langle-addons' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Badge', 'langle-addons' ),
				'description' => __( 'Keep it blank, if you want to remove the Badge', 'langle-addons' ),
				'default' => __( '01', 'langle-addons' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'langle-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'Title', 'langle-addons' ),
				'default' => __( 'Start Marketing', 'langle-addons' ),
				'separator' => 'before',
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'description',
			[
				'label' => __( 'Description', 'langle-addons' ),
				'description' => langle_addons_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Description', 'langle-addons' ),
				'default' => 'consectetur adipiscing elit, sed do<br>eiusmod Lorem ipsum dolor sit amet,<br> consectetur.',
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'langle-addons' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://example.com',
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label' => __( 'Title HTML Tag', 'langle-addons' ),
				'type' => Controls_Manager::SELECT,
				'separator' => 'before',
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
			]
		);

		$this->add_control(
			'content_alignment',
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
					'justify' => [
						'title' => __( 'Justify', 'langle-addons' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'show_indicator',
			[
				'label' => __( 'Show Direction', 'langle-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'langle-addons' ),
				'label_off' => __( 'No', 'langle-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'style_transfer' => true,
			]
		);

		$this->end_controls_section();

    }

    /**
     * Register widget style controls
     */
	protected function register_style_controls() {
		$this->__icon_style_controls();
		$this->__badge_style_controls();
		$this->__title_desc_style_controls();
		$this->__direction_style_controls();
	}

    protected function __icon_style_controls() {

        $this->start_controls_section(
			'_section_icon_style',
			[
				'label' => __( 'Icon', 'langle-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
					'em' => [
						'min' => 6,
						'max' => 300,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .la-steps-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}' => '--la-stepflow-icon-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => __( 'Padding', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .la-steps-icon' => 'padding: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}' => '--la-stepflow-icon-padding: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => __( 'Bottom Spacing', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .la-steps-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'label' => __( 'Border', 'langle-addons' ),
				'selector' => '{{WRAPPER}} .la-steps-icon',
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => __( 'Border Radius', 'langle-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .la-steps-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .la-steps-icon',
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-steps-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_background_color',
			[
				'label' => __( 'Background Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-steps-icon' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

    }

    protected function __badge_style_controls() {

        $this->start_controls_section(
			'_section_badge_style',
			[
				'label' => __('Badge', 'langle-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'badge!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'badge_padding',
			[
				'label' 	=> __( 'Padding', 'langle-addons' ),
				'type' 		=> Controls_Manager::DIMENSIONS,
				'default' 	=> [
					'unit'	   => 'px',
					'top'	   => '10',
					'right'	   => '10',
					'bottom'   => '10',
					'left'	   => '10',
				],
				'size_units' => [ 'px', '%' ],
				'condition' => [
					'badge!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .la-steps-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'badge_border',
				'label' => __( 'Border', 'langle-addons' ),
				'selector' => '{{WRAPPER}} .la-steps-label',
				'condition' => [
					'badge!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'badge_border_radius',
			[
				'label' => __( 'Border Radius', 'langle-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'default' 	=> [
					'unit'	   => 'px',
					'top'	   => '10',
					'right'	   => '10',
					'bottom'   => '10',
					'left'	   => '10',
				],
				'size_units' => [ 'px', '%' ],
				'condition' => [
					'badge!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .la-steps-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'badge_color',
			[
				'label' => __( 'Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'badge!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .la-steps-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'badge_background_color',
			[
				'label' => __( 'Background Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'badge!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .la-steps-label' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'badge_typography',
				'selector' => '{{WRAPPER}} .la-steps-label',
				'scheme' => Typography::TYPOGRAPHY_4,
				'condition' => [
					'badge!' => '',
				],
			]
		);

		$this->end_controls_section();

    }

    protected function __title_desc_style_controls() {

        $this->start_controls_section(
			'_section_title_style',
			[
				'label' => __( 'Title & Description', 'langle-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'_heading_title',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Title', 'langle-addons' ),
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => __( 'Bottom Spacing', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .la-steps-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-steps-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_link_color',
			[
				'label' => __( 'Link Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-steps-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Hover Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'link[url]!' => ''
				],
				'selectors' => [
					'{{WRAPPER}} .la-steps-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .la-steps-title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .la-steps-title',
				'scheme' => Typography::TYPOGRAPHY_2,
			]
		);

		$this->add_control(
			'_heading_description',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Description', 'langle-addons' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-step-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'description_shadow',
				'selector' => '{{WRAPPER}} .la-step-description',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .la-step-description',
				'scheme' => Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();

    }

    protected function __direction_style_controls() {

        $this->start_controls_section(
			'_section_direction_style',
			[
				'label' => __( 'Direction', 'langle-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'direction_style',
			[
				'label' => __( 'Style', 'langle-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'solid' => __( 'Solid', 'langle-addons' ),
					'dotted' => __( 'Dotted', 'langle-addons' ),
					'dashed' => __( 'Dashed', 'langle-addons' ),
				],
				'default' => 'solid',
				'selectors' => [
					'{{WRAPPER}} .la-step-arrow, {{WRAPPER}} .la-step-arrow:after' => 'border-top-style: {{VALUE}};',
					'{{WRAPPER}} .la-step-arrow:after' => 'border-right-style: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'direction_width',
			[
				'label' => __( 'Width', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .la-step-arrow' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'direction_angle',
			[
				'label' => __( 'Angle', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['deg'],
				'default' => [
					'unit' => 'deg',
				],
				'tablet_default' => [
					'unit' => 'deg',
				],
				'mobile_default' => [
					'unit' => 'deg',
				],
				'range' => [
					'deg' => [
						'min' => 0,
						'max' => 360,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--la-stepflow-direction-angle: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'direction_offset_toggle',
			[
				'label' => __( 'Offset', 'langle-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'None', 'langle-addons' ),
				'label_on' => __( 'Custom', 'langle-addons' ),
				'return_value' => 'yes',
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'direction_offset_y',
			[
				'label' => __( 'Offset Top', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 500,
					]
				],
				'condition' => [
					'direction_offset_toggle' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .la-step-arrow' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'direction_offset_x',
			[
				'label' => __( 'Offset Left', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 500,
					]
				],
				'condition' => [
					'direction_offset_toggle' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .la-step-arrow' => 'left: calc( 100% + {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}}' => '--la-stepflow-direction-offset-x: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_popover();

		$this->add_control(
			'direction_color',
			[
				'label' 	=> __( 'Color', 'langle-addons' ),
				'type' 		=> Controls_Manager::COLOR,
				'default'	=> '#B6B6B6',
				'selectors' => [
					'{{WRAPPER}} .la-step-arrow' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .la-step-arrow:after' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

    }

    protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'title', 'class', 'la-steps-title' );

		$this->add_inline_editing_attributes( 'description', 'advanced' );
		$this->add_render_attribute( 'description', 'class', 'la-step-description' );

		$this->add_render_attribute( 'badge', 'class', 'la-steps-label' );
		$this->add_inline_editing_attributes( 'badge', 'none' );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'link', $settings['link'] );
			$this->add_inline_editing_attributes( 'link', 'basic', 'title' );

			$title = sprintf( '<a %s>%s</a>',
				$this->get_render_attribute_string( 'link' ),
				langle_addons_kses_basic( $settings['title'] )
			);
		} else {
			$this->add_inline_editing_attributes( 'title', 'basic' );
			$title = langle_addons_kses_basic( $settings['title'] );
		}
		?>

		<div class="la-steps-icon">
			<?php if ( $settings['show_indicator'] === 'yes' ) : ?>
				<span class="la-step-arrow"></span>
			<?php endif; ?>

			<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) :
				langle_addons_render_icon( $settings, 'icon', 'selected_icon' );
			endif; ?>

			<?php if ( $settings['badge'] ) : ?>
				<span <?php $this->print_render_attribute_string( 'badge' ); ?>><?php echo esc_html( $settings['badge'] ); ?></span>
			<?php endif; ?>
		</div>

		<?php
		printf( '<%1$s %2$s>%3$s</%1$s>',
			langle_addons_escape_tags( $settings['title_tag'], 'h2' ),
			$this->get_render_attribute_string( 'title' ),
			$title
		);
		?>

		<?php if ( $settings['description'] ) : ?>
			<p <?php $this->print_render_attribute_string( 'description' ); ?>><?php echo langle_addons_kses_intermediate( $settings['description'] ); ?></p>
		<?php endif; ?>

		<?php
	}

}