<?php
/**
 * Testimonial widget class
 *
 * @package Langle_Addons
 */
namespace Langle_Addons\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Testimonial extends Base {

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Testimonial', 'langle-addons' );
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
		return 'eicon-testimonial';
	}

	public function get_keywords() {
		return [ 'testimonial', 'review', 'feedback' ];
	}

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {

		$this->__testimonial_content_controls();
		$this->__reviewer_content_controls();

	}

    protected function __testimonial_content_controls() {

		$this->start_controls_section(
			'_section_testimonial',
			[
				'label' => __( 'Testimonial', 'langle-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'testimonial',
			[
				'label' => __( 'Testimonial', 'langle-addons' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
				'placeholder' => __( 'Type testimonial', 'langle-addons' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'align',
			[
				'label' => __( 'Alignment', 'langle-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
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
				'toggle' => false,
				'default' => 'left',
				'prefix_class' => 'la-testimonial--',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'_design',
			[
				'label' => __( 'Design', 'langle-addons' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => false,
				'options' => [
					'basic' => __( 'Default', 'langle-addons' ),
					'bubble' => __( 'Bubble', 'langle-addons' ),
				],
				'default' => 'basic',
				'prefix_class' => 'la-testimonial--',
				'style_transfer' => true,
			]
		);

		$this->end_controls_section();
	}

    protected function __reviewer_content_controls() {

		$this->start_controls_section(
			'_section_reviewer',
			[
				'label' => __( 'Reviewer', 'langle-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Image', 'langle-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'exclude' => ['custom'],
				'separator' => 'none',
			]
		);

		$this->add_control(
			'name',
			[
				'label' => __( 'Name', 'langle-addons' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => __( 'John Doe', 'langle-addons' ),
				'placeholder' => __( 'Type Reviewer Name', 'langle-addons' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'langle-addons' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => __( 'CEO, Langle Addons', 'langle-addons' ),
				'placeholder' => __( 'Type reviewer title', 'langle-addons' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->end_controls_section();
	}

    /**
     * Register widget style controls
     */
	protected function register_style_controls() {

		$this->__testimonial_style_controls();
		$this->__image_style_controls();
		$this->__reviewer_style_controls();

	}

    protected function __testimonial_style_controls() {

		$this->start_controls_section(
			'_section_style_testimonial',
			[
				'label' => __( 'Testimonial', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'testimonial_padding',
			[
				'label' => __( 'Padding', 'langle-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .la-testimonial__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'testimonial_spacing',
			[
				'label' => __( 'Bottom Spacing', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .la-testimonial__content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'testimonial_color',
			[
				'label' => __( 'Text Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-testimonial__content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'testimonial_bg_color',
			[
				'label' => __( 'Background Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-testimonial__content' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .la-testimonial__content:after' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'testimonial_typography',
				'label' => __( 'Typography', 'langle-addons' ),
				'selector' => '{{WRAPPER}} .la-testimonial__content',
				'scheme' => Typography::TYPOGRAPHY_3,
			]
		);

		$this->add_responsive_control(
			'testimonial_border_radius',
			[
				'label' => __( 'Border Radius', 'langle-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .la-testimonial__content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'testimonial_box_shadow',
				'selector' => '{{WRAPPER}} .la-testimonial__content',
			]
		);

		$this->end_controls_section();
	}

    protected function __image_style_controls() {

		$this->start_controls_section(
			'_section_style_image',
			[
				'label' => __( 'Image', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label' => __( 'Width', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 65,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .la-testimonial__reviewer-thumb' => '-webkit-flex: 0 0 {{SIZE}}{{UNIT}}; -ms-flex: 0 0 {{SIZE}}{{UNIT}}; flex: 0 0 {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}}.la-testimonial--left .la-testimonial__reviewer-meta' => '-webkit-flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); -ms-flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); max-width: calc(100% - {{SIZE}}{{UNIT}});',

					'{{WRAPPER}}.la-testimonial--right .la-testimonial__reviewer-meta' => '-webkit-flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); -ms-flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); flex: 0 0 calc(100% - {{SIZE}}{{UNIT}}); max-width: calc(100% - {{SIZE}}{{UNIT}});',

					'{{WRAPPER}}.la-testimonial--left .la-testimonial__content:after' => 'left: calc(({{SIZE}}{{UNIT}} / 2) - 18px);',

					'{{WRAPPER}}.la-testimonial--right .la-testimonial__content:after' => 'right: calc(({{SIZE}}{{UNIT}} / 2) - 18px);',
				],
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label' => __( 'Height', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .la-testimonial__reviewer-thumb' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_spacing',
			[
				'label' => __( 'Spacing', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}}.la-testimonial--left .la-testimonial__reviewer-meta' => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.la-testimonial--right .la-testimonial__reviewer-meta' => 'padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.la-testimonial--center .la-testimonial__reviewer-meta' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .la-testimonial__reviewer-thumb img',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'langle-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .la-testimonial__reviewer-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'selector' => '.la-testimonial__reviewer-thumb img',
			]
		);

		$this->end_controls_section();
	}

    protected function __reviewer_style_controls() {

		$this->start_controls_section(
			'_section_style_reviewer',
			[
				'label' => __( 'Reviewer', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'_heading_name',
			[
				'label' => __( 'Name', 'langle-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => __( 'Text Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-testimonial__reviewer-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'label' => __( 'Typography', 'langle-addons' ),
				'selector' => '{{WRAPPER}} .la-testimonial__reviewer-name',
				'scheme' => Typography::TYPOGRAPHY_2,
			]
		);

		$this->add_responsive_control(
			'name_spacing',
			[
				'label' => __( 'Bottom Spacing', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .la-testimonial__reviewer-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'_heading_title',
			[
				'label' => __( 'Title', 'langle-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-testimonial__reviewer-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'langle-addons' ),
				'selector' => '{{WRAPPER}} .la-testimonial__reviewer-title',
				'scheme' => Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();
	}

    protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'testimonial', 'advanced' );
		$this->add_render_attribute( 'testimonial', 'class', 'la-testimonial__content' );

		$this->add_inline_editing_attributes( 'name', 'basic' );
		$this->add_render_attribute( 'name', 'class', 'la-testimonial__reviewer-name' );

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_render_attribute( 'title', 'class', 'la-testimonial__reviewer-title' );
		?>

		<div <?php $this->print_render_attribute_string( 'testimonial' ); ?>>
			<?php echo langle_addons_kses_intermediate( $settings['testimonial'] ); ?>
		</div>
		<div class="la-testimonial__reviewer">
			<?php if ( ! empty( $settings['image']['url'] ) ) : ?>
				<div class="la-testimonial__reviewer-thumb">
					<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
				</div>
			<?php endif; ?>

			<div class="la-testimonial__reviewer-meta">
				<div <?php $this->print_render_attribute_string( 'name' ); ?>><?php echo langle_addons_kses_basic( $settings['name'] ); ?></div>
				<div <?php $this->print_render_attribute_string( 'title' ); ?>><?php echo langle_addons_kses_basic( $settings['title'] ); ?></div>
			</div>
		</div>
		<?php
	}
}