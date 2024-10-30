<?php
/**
 * Card widget class
 *
 * @package Langle_Addons
 */
namespace Langle_Addons\Elementor\Widget;

use Elementor\Group_Control_Css_Filter;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Langle_Addons\Elementor\Traits\Button_Trait;

defined( 'ABSPATH' ) || die();

class Card extends Base {

    use Button_Trait;

    /**
	 * Get widget title.
	 *
	 * @since 0.1
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Card', 'langle-addons' );
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
		return 'eicon-parallax';
	}

    public function get_keywords() {
		return [ 'card', 'blurb', 'infobox', 'content', 'block', 'box' ];
	}

    /**
     * Register widget content controls
     */
	protected function register_content_controls() {
		$this->__image_badge_content_controls();
		$this->__title_desc_content_controls();
		$this->__button_content_controls_trait();
	}

    protected function __image_badge_content_controls() {

		$this->start_controls_section(
			'_section_image',
			[
				'label' => __( 'Image & Badge', 'langle-addons' ),
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
				'default' => 'large',
				'separator' => 'none',
			]
		);

		$this->add_responsive_control(
			'image_position',
			[
				'label' => __( 'Image Position', 'langle-addons' ),
				'description' => __( 'You can adjust the image width and height from <mark>Style</mark> tab to get your expected design.', 'langle-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'langle-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __( 'Top', 'langle-addons' ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => __( 'Right', 'langle-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => false,
				'desktop_default' => 'top',
				'tablet_default' => 'top',
				'mobile_default' => 'top',
				'prefix_class' => 'la-card-%s-',
				'style_transfer' => true,
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => '{{VALUE}};',
				],
				'selectors_dictionary' => [
					'left' => '-webkit-box-orient: horizontal; -webkit-box-direction: normal; -ms-flex-direction: row; flex-direction: row; text-align: left;',
					'top' => '-webkit-box-orient: vertical; -webkit-box-direction: normal; -ms-flex-direction: column; flex-direction: column; text-align: center;',
					'right' => '-webkit-box-orient: horizontal; -webkit-box-direction: reverse; -ms-flex-direction: row-reverse; flex-direction: row-reverse; text-align: left;'
				]
			]
		);

		$this->add_control(
			'badge_text',
			[
				'label' => __( 'Badge Text', 'langle-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'Badge Text', 'langle-addons' ),
				'placeholder' => __( 'Type badge text', 'langle-addons' ),
				'separator' => 'before',
				'description' => __( 'Set badge position and control all the style settings from Style tab', 'langle-addons' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->end_controls_section();
	}

	protected function __title_desc_content_controls() {
		$this->start_controls_section(
			'_section_title',
			[
				'label' => __( 'Title & Description', 'langle-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'langle-addons' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Langle Card Title', 'langle-addons' ),
				'placeholder' => __( 'Type Card Title', 'langle-addons' ),
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
				'default' => __( 'Langle card description goes here', 'langle-addons' ),
				'placeholder' => __( 'Type card description', 'langle-addons' ),
				'rows' => 5,
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label' => __( 'Title HTML Tag', 'langle-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'h1'  => [
						'title' => __( 'H1', 'langle-addons' ),
						'icon' => 'eicon-editor-h1'
					],
					'h2'  => [
						'title' => __( 'H2', 'langle-addons' ),
						'icon' => 'eicon-editor-h2'
					],
					'h3'  => [
						'title' => __( 'H3', 'langle-addons' ),
						'icon' => 'eicon-editor-h3'
					],
					'h4'  => [
						'title' => __( 'H4', 'langle-addons' ),
						'icon' => 'eicon-editor-h4'
					],
					'h5'  => [
						'title' => __( 'H5', 'langle-addons' ),
						'icon' => 'eicon-editor-h5'
					],
					'h6'  => [
						'title' => __( 'H6', 'langle-addons' ),
						'icon' => 'eicon-editor-h6'
					]
				],
				'default' => 'h2',
				'toggle' => false,
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' 	=> __( 'Alignment', 'langle-addons' ),
				'type' 		=> Controls_Manager::CHOOSE,
				// 'default'   => 'center',
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

		$this->end_controls_section();
	}

	protected function __button_content_controls_trait() {
		$this->start_controls_section(
			'_section_button',
			[
				'label' => __( 'Button', 'langle-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->register_button_content_controls();

		$this->end_controls_section();
	}

    /**
     * Register widget style controls
     */
	protected function register_style_controls() {
		$this->__image_style_controls();
		$this->__badge_style_controls();
		$this->__title_desc_style_controls();
		$this->__button_style_controls_trait();
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
				'size_units' => [ '%', 'px' ],
				'desktop_default' => [
					'unit' => '%'
				],
				'tablet_default' => [
					'unit' => '%',
					'size' => 100
				],
				'mobile_default' => [
					'unit' => '%',
					'size' => 100
				],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 50,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--la-card-image-width: {{SIZE}}{{UNIT}};'
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
						'min' => 50,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .la-card-figure' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'offset_toggle',
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
			'image_offset_x',
			[
				'label' => __( 'Offset Left', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'condition' => [
					'offset_toggle' => 'yes'
				],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--la-card-image-offset-x: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'image_offset_y',
			[
				'label' => __( 'Offset Top', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'condition' => [
					'offset_toggle' => 'yes'
				],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--la-card-image-offset-y: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_popover();

		$this->add_responsive_control(
			'image_padding',
			[
				'label' => __( 'Padding', 'langle-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'default'    => [
					'unit'   => 'px',
					'top'    => '15',
					'right'  => '15',
					'bottom' => '15',
					'left'   => '15',
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .la-card-figure img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .la-card-figure img',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'langle-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'default'	=> [
					'unit'	=> 'px',
					'top'	=> 20,
					'right'	=> 20,
					'bottom'=> 20,
					'left'	=> 20,
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .la-card-figure img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .la-card-figure img',
				'separator' => 'after'
			]
		);

		$this->start_controls_tabs(
			'_tabs_image_effects',
			[
				'separator' => 'before'
			]
		);

		$this->start_controls_tab(
			'_tab_image_effects_normal',
			[
				'label' => __( 'Normal', 'langle-addons' ),
			]
		);

		$this->add_control(
			'image_opacity',
			[
				'label' => __( 'Opacity', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .la-card-figure img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'image_css_filters',
				'selector' => '{{WRAPPER}} .la-card-figure img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => __( 'Hover', 'langle-addons' ),
			]
		);

		$this->add_control(
			'image_opacity_hover',
			[
				'label' => __( 'Opacity', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .la-card-figure:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'image_css_filters_hover',
				'selector' => '{{WRAPPER}} .la-card-figure:hover img',
			]
		);

		$this->add_control(
			'image_background_hover_transition',
			[
				'label' => __( 'Transition Duration', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .la-card-figure img' => 'transition-duration: {{SIZE}}s;',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'langle-addons' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
				'label_block' => true,
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function __badge_style_controls() {

		$this->start_controls_section(
			'_section_style_badge',
			[
				'label' => __( 'Badge', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'badge_position',
			[
				'label' => __( 'Position', 'langle-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top-left'      => __( 'Top Left', 'langle-addons' ),
					'top-center'    => __( 'Top Center', 'langle-addons' ),
					'top-right'     => __( 'Top Right', 'langle-addons' ),
					'middle-left'   => __( 'Middle Left', 'langle-addons' ),
					'middle-center' => __( 'Middle Center', 'langle-addons' ),
					'middle-right'  => __( 'Middle Right', 'langle-addons' ),
					'bottom-left'   => __( 'Bottom Left', 'langle-addons' ),
					'bottom-center' => __( 'Bottom Center', 'langle-addons' ),
					'bottom-right'  => __( 'Bottom Right', 'langle-addons' ),
				],
				'default' => 'top-left',
			]
		);

		$this->add_control(
			'badge_offset_toggle',
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
			'badge_offset_x',
			[
				'label' => __( 'Offset Left', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'condition' => [
					'badge_offset_toggle' => 'yes'
				],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .la-badge' => '--la-badge-translate-x: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'badge_offset_y',
			[
				'label' 	=> __( 'Offset Top', 'langle-addons' ),
				'type' 		=> Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'condition' => [
					'badge_offset_toggle' => 'yes'
				],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .la-badge' => '--la-badge-translate-y: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_popover();

		$this->add_responsive_control(
			'badge_padding',
			[
				'label' => __( 'Padding', 'langle-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .la-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'badge_color',
			[
				'label' => __( 'Text Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-badge' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'badge_bg_color',
			[
				'label' => __( 'Background Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-badge' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'badge_border',
				'selector' => '{{WRAPPER}} .la-badge',
			]
		);

		$this->add_responsive_control(
			'badge_border_radius',
			[
				'label' 	=> __( 'Border Radius', 'langle-addons' ),
				'type' 		=> Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .la-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'badge_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .la-badge',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'badge_typography',
				'label' => __( 'Typography', 'langle-addons' ),
				'exclude' => [
					'line_height'
				],
				'default' => [
					'font_size' => ['']
				],
				'selector' => '{{WRAPPER}} .la-badge',
				'scheme' => Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();
	}

	protected function __title_desc_style_controls() {

		$this->start_controls_section(
			'_section_style_content',
			[
				'label' => __( 'Title & Description', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Content Padding', 'langle-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .la-card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'_heading_title',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Title', 'langle-addons' ),
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => __( 'Bottom Spacing', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .la-card-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-card-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'langle-addons' ),
				'selector' => '{{WRAPPER}} .la-card-title',
				'scheme' => Typography::TYPOGRAPHY_2,
			]
		);

		$this->add_control(
			'_heading_description',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Description', 'langle-addons' ),
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'description_spacing',
			[
				'label' 	=> __( 'Bottom Spacing', 'langle-addons' ),
				'type' 		=> Controls_Manager::SLIDER,
				'default'	=> [
					'unit'	=> 'px',
					'size'	=> 17,
				],
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .la-card-text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Text Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-card-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => __( 'Typography', 'langle-addons' ),
				'selector' => '{{WRAPPER}} .la-card-text',
				'scheme' => Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();
	}

	protected function __button_style_controls_trait() {
		$this->start_controls_section(
			'_section_style_button',
			[
				'label' => __( 'Button', 'langle-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->register_button_style_controls();

		$this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes( 'badge_text', 'none' );
		$this->add_render_attribute(
			'badge_text',
			'class',
			[ 'la-badge', sprintf( 'la-badge--%s', esc_attr( $settings['badge_position'] ) ) ]
		);

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_render_attribute( 'title', 'class', 'la-card-title' );

		$this->add_inline_editing_attributes( 'description', 'advanced' );
		$this->add_render_attribute( 'description', 'class', 'la-card-text' );
		?>

        <?php if ( $settings['image']['url'] || $settings['image']['id'] ) : ?>
			<figure class="la-card-figure">
				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
				<?php if ( $settings['badge_text'] ) : ?>
					<div <?php echo $this->get_render_attribute_string( 'badge_text' ); ?>><?php echo langle_addons_kses_intermediate( $settings['badge_text'] ); ?></div>
				<?php endif; ?>
			</figure>
		<?php endif; ?>

        <div class="la-card-body">

			<?php
			if ( $settings['title' ] ) :
				printf( '<%1$s %2$s>%3$s</%1$s>',
                langle_addons_escape_tags( $settings['title_tag'] ),
					$this->get_render_attribute_string( 'title' ),
					langle_addons_kses_basic( $settings['title' ] )
					);
			endif;
			?>

			<?php if ( $settings['description'] ) : ?>
				<div <?php echo $this->get_render_attribute_string( 'description' ); ?>>
					<p><?php echo langle_addons_kses_intermediate( $settings['description'] ); ?></p>
				</div>
			<?php endif; ?>

			<?php // $this->render_icon_button( [ 'class' => 'la-btn' ] ); ?>
			<?php $this->render_button(); ?>
		</div>
		<?php
    }

    public function content_template() {
		?>
		<#
		view.addInlineEditingAttributes( 'badge_text', 'none' );
		view.addRenderAttribute(
			'badge_text',
			'class',
			['la-badge', 'la-badge--' + settings.badge_position]
		);

		view.addInlineEditingAttributes( 'title', 'basic' );
		view.addRenderAttribute( 'title', 'class', 'la-card-title' );

		view.addInlineEditingAttributes( 'description', 'advanced' );
		view.addRenderAttribute( 'description', 'class', 'la-card-text' );

		if ( settings.image.url || settings.image.id ) {
			var image = {
				id: settings.image.id,
				url: settings.image.url,
				size: settings.thumbnail_size,
				dimension: settings.thumbnail_custom_dimension,
				model: view.getEditModel()
			};

			var image_url = elementor.imagesManager.getImageUrl( image ); #>

			<figure class="la-card-figure">
				<img class="elementor-animation-{{settings.hover_animation}}" src="{{ image_url }}">
				<# if (settings.badge_text) { #>
					<div {{{ view.getRenderAttributeString( 'badge_text' ) }}}>{{{ settings.badge_text }}}</div>
				<# } #>
			</figure>
		<# } #>

		<div class="la-card-body">
			<# if (settings.title) { #>
				<{{ settings.title_tag }} {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</{{ settings.title_tag }}>
			<# } #>

			<# if (settings.description) { #>
				<div {{{ view.getRenderAttributeString( 'description' ) }}}>
					<p>{{{ settings.description }}}</p>
				</div>
			<# } #>

			<# print( laGetButtonWithIcon( view ) ) #>
		</div>
		<?php
	}

}
