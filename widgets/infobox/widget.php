<?php
/**
 * Infobox widget class
 *
 * @package Langle_Addons
 */
namespace Langle_Addons\Elementor\Widget;

use Elementor\Core\Schemes\Typography;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Langle_Addons\Elementor\Traits\Button_Trait;

defined( 'ABSPATH' ) || die();

class Infobox extends Base {

    use Button_Trait;

    /**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Info Box', 'langle-addons' );
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
		return 'eicon-info-box';
	}

    public function get_keywords() {
		return [ 'info', 'infobox', 'box' ];
	}

    /**
     * Register widget content controls
     */
	protected function register_content_controls() {
        $this->__icon_image_content_controls();
        $this->__title_desc_content_controls();
        $this->__button_content_controls_trait();
    }

    protected function __icon_image_content_controls() {
        $this->start_controls_section(
			'_section_media',
			[
				'label' => __( 'Icon / Image', 'langle-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'type',
			[
				'label' => __( 'Media Type', 'langle-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'icon' => [
						'title' => __( 'Icon', 'langle-addons' ),
						'icon' => 'eicon-star',
					],
					'image' => [
						'title' => __( 'Image', 'langle-addons' ),
						'icon' => 'eicon-image',
					],
				],
				'default' => 'icon',
				'toggle' => false,
				'style_transfer' => true,
				'prefix_class' => 'la-infobox-media-type-',
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
				'condition' => [
					'type' => 'image'
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
				'default' => 'medium_large',
				'separator' => 'none',
				'exclude' => [
					'full',
					'custom',
					'large',
					'shop_catalog',
					'shop_single',
					'shop_thumbnail'
				],
				'condition' => [
					'type' => 'image'
				]
			]
		);

		if ( langle_addons_is_elementor_version( '<', '2.6.0' ) ) {
			$this->add_control(
				'icon',
				[
					'label' => __( 'Icon', 'langle-addons' ),
					'label_block' => true,
					'type' => Controls_Manager::ICON,
					'default' => 'fab fa-wordpress',
					'condition' => [
						'type' => 'icon'
					]
				]
			);
		} else {
			$this->add_control(
				'selected_icon_info',
				[
					'type' => Controls_Manager::ICONS,
					'fa4compatibility' => 'icon',
					'label_block' => true,
					'default' => [
						'value' => 'fab fa-wordpress',
						'library' => 'fa-solid',
					],
					'condition' => [
						'type' => 'icon'
					]
				]
			);
		}

		$this->add_responsive_control(
			'media_direction',
			[
				'label' => __('Media direction', 'langle-addons'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'langle-addons'),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __('Top', 'langle-addons'),
						'icon' => 'eicon-v-align-top',
					],
				],
				'default' => 'top',
				'toggle' => false,
                'style_transfer' => true,
				'prefix_class' => 'la-infobox-media-dir%s-',
			]
		);

		$this->add_responsive_control(
			'media_v_align',
			[
				'label' => __('Vertical Alignment', 'langle-addons'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __('Top', 'langle-addons'),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => __('Center', 'langle-addons'),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __('Bottom', 'langle-addons'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'toggle' => false,
				'condition' => [
					'media_direction' => 'left',
				],
                'style_transfer' => true,
				'selectors_dictionary' => [
                    'top' => ' -webkit-align-self: flex-start; -ms-flex-item-align: flex-start; align-self: flex-start;',
                    'center' => ' -webkit-align-self: center; -ms-flex-item-align: center; align-self: center;',
                    'bottom' => ' -webkit-align-self: flex-end; -ms-flex-item-align: end; align-self: flex-end;',
                ],
				'selectors' => [
					'body[data-elementor-device-mode="widescreen"] {{WRAPPER}}.la-infobox-media-dir-widescreen-left .la-infobox-figure' => '{{VALUE}};',
					'body[data-elementor-device-mode="desktop"] {{WRAPPER}}.la-infobox-media-dir-left .la-infobox-figure' => '{{VALUE}};',
					'body[data-elementor-device-mode="laptop"] {{WRAPPER}}.la-infobox-media-dir-laptop-left .la-infobox-figure' => '{{VALUE}};',
					'body[data-elementor-device-mode="tablet_extra"] {{WRAPPER}}.la-infobox-media-dir-tablet_extra-left .la-infobox-figure' => '{{VALUE}};',
					'body[data-elementor-device-mode="tablet"] {{WRAPPER}}.la-infobox-media-dir-tablet-left .la-infobox-figure' => '{{VALUE}};',
					'body[data-elementor-device-mode="mobile_extra"] {{WRAPPER}}.la-infobox-media-dir-mobile_extra-left .la-infobox-figure' => '{{VALUE}};',
					'body[data-elementor-device-mode="mobile"] {{WRAPPER}}.la-infobox-media-dir-mobile-left .la-infobox-figure' => '{{VALUE}};',

					'body[data-elementor-device-mode="widescreen"] {{WRAPPER}}.la-infobox-media-dir-left .la-info-box-icon' => '{{VALUE}};',
					'body[data-elementor-device-mode="desktop"] {{WRAPPER}}.la-infobox-media-dir-left .la-info-box-icon' => '{{VALUE}};',
					'body[data-elementor-device-mode="laptop"] {{WRAPPER}}.la-infobox-media-dir-laptop-left .la-info-box-icon' => '{{VALUE}};',
					'body[data-elementor-device-mode="tablet_extra"] {{WRAPPER}}.la-infobox-media-dir-tablet_extra-left .la-info-box-icon' => '{{VALUE}};',
					'body[data-elementor-device-mode="tablet"] {{WRAPPER}}.la-infobox-media-dir-tablet-left .la-info-box-icon' => '{{VALUE}};',
					'body[data-elementor-device-mode="mobile_extra"] {{WRAPPER}}.la-infobox-media-dir-mobile_extra-left .la-info-box-icon' => '{{VALUE}};',
					'body[data-elementor-device-mode="mobile"] {{WRAPPER}}.la-infobox-media-dir-mobile-left .la-info-box-icon' => '{{VALUE}};',
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
				'default' => __( 'Langle Info Box Title', 'langle-addons' ),
				'placeholder' => __( 'Type Info Box Title', 'langle-addons' ),
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
				'default' => __( 'Langle info box description goes here', 'langle-addons' ),
				'placeholder' => __( 'Type info box description', 'langle-addons' ),
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
				'label' => __( 'Alignment', 'langle-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
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
					'{{WRAPPER}}' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();
    }

	protected function __button_content_controls_trait(){
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
        $this->__icon_image_style_controls();
        $this->__title_style_controls();
        $this->__button_style_controls_trait();
    }

    protected function __icon_image_style_controls() {
        $this->start_controls_section(
			'_section_media_style',
			[
				'label' => __( 'Icon / Image', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .la-infobox-figure--icon' => 'font-size: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					 'type' => 'icon'
				]
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label' => __( 'Width', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' 	  => 1,
						'max' 	  => 400,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .la-infobox-figure--image' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'type' => 'image'
				]
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
						'min' => 1,
						'max' => 400,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .la-infobox-figure--image' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'type' => 'image'
				]
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
			'media_offset_x',
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
					'{{WRAPPER}}' => '--la-infobox-media-offset-x: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'media_offset_y',
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
					'{{WRAPPER}}' => '--la-infobox-media-offset-y: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_popover();

		$this->add_responsive_control(
			'media_spacing',
			[
				'label' => __( 'Spacing', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'body[data-elementor-device-mode="widescreen"] {{WRAPPER}}.la-infobox-media-dir-widescreen-top .la-infobox-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="desktop"] {{WRAPPER}}.la-infobox-media-dir-top .la-infobox-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="laptop"] {{WRAPPER}}.la-infobox-media-dir-laptop-top .la-infobox-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="tablet_extra"] {{WRAPPER}}.la-infobox-media-dir-tablet_extra-top .la-infobox-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="tablet"] {{WRAPPER}}.la-infobox-media-dir-tablet-top .la-infobox-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="mobile_extra"] {{WRAPPER}}.la-infobox-media-dir-mobile_extra-top .la-infobox-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="mobile"] {{WRAPPER}}.la-infobox-media-dir-mobile-top .la-infobox-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					
					'body[data-elementor-device-mode="widescreen"] {{WRAPPER}}.la-infobox-media-dir-widescreen-left .la-infobox-figure' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="desktop"] {{WRAPPER}}.la-infobox-media-dir-left .la-infobox-figure' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="laptop"] {{WRAPPER}}.la-infobox-media-dir-laptop-left .la-infobox-figure' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="tablet_extra"] {{WRAPPER}}.la-infobox-media-dir-tablet_extra-left .la-infobox-figure' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="tablet"] {{WRAPPER}}.la-infobox-media-dir-tablet-left .la-infobox-figure' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="mobile_extra"] {{WRAPPER}}.la-infobox-media-dir-mobile_extra-left .la-infobox-figure' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
					'body[data-elementor-device-mode="mobile"] {{WRAPPER}}.la-infobox-media-dir-mobile-left .la-infobox-figure' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'media_padding',
			[
				'label' => __( 'Padding', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .la-infobox-figure--image img, {{WRAPPER}} .la-infobox-figure--icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'media_border',
				'selector' => '{{WRAPPER}} .la-infobox-figure--image img, {{WRAPPER}} .la-infobox-figure--icon',
			]
		);

		$this->add_responsive_control(
			'media_border_radius',
			[
				'label' => __( 'Border Radius', 'langle-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .la-infobox-figure--image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .la-infobox-figure--icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'media_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .la-infobox-figure--image img, {{WRAPPER}} .la-infobox-figure--icon'
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-infobox-figure--icon' => 'color: {{VALUE}}',
				],
				'condition' => [
					'type' => 'icon'
				]
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label' => __( 'Background Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-infobox-figure--icon' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'type' => 'icon'
				]
			]
		);

		$this->add_control(
			'icon_bg_rotate',
			[
				'label' => __( 'Background Rotate', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'default' => [
					'unit' => 'deg',
				],
				'range' => [
					'deg' => [
						'min' => 0,
						'max' => 360,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--la-infobox-media-rotate: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'type' => 'icon'
				]
			]
		);

		$this->end_controls_section();
    }

    protected function __title_style_controls() {

		$this->start_controls_section(
			'_section_title_style',
			[
				'label' => __( 'Title & Description', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Content Box Padding', 'langle-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .la-infobox-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_heading',
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
					'{{WRAPPER}} .la-infobox-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-infobox-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'langle-addons' ),
				'selector' => '{{WRAPPER}} .la-infobox-title',
				'scheme' => Typography::TYPOGRAPHY_2
			]
		);

		$this->add_control(
			'description_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Description', 'langle-addons' ),
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'description_spacing',
			[
				'label' => __( 'Bottom Spacing', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .la-infobox-text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Text Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-infobox-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => __( 'Typography', 'langle-addons' ),
				'selector' => '{{WRAPPER}} .la-infobox-text',
				'scheme' => Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();
	}

	protected function __button_style_controls_trait(){
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

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_render_attribute( 'title', 'class', 'la-infobox-title' );

		$this->add_inline_editing_attributes( 'description', 'advanced' );
		$this->add_render_attribute( 'description', 'class', 'la-infobox-text' );
		?>

		<?php if ( $settings['type'] === 'image' && ( $settings['image']['url'] || $settings['image']['id'] ) ) :
			$settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
			?>
			<figure class="la-infobox-figure la-infobox-figure--image">
				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
			</figure>		
		<?php elseif ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon_info']['value'] ) ) : ?>
			<figure class="la-infobox-figure la-infobox-figure--icon">
				<?php langle_addons_render_icon( $settings, 'icon', 'selected_icon_info' ); ?>
			</figure>
		<?php endif; ?>

		<div class="la-infobox-body">
			<?php
			if ( $settings['title' ] ) :
				printf( '<%1$s %2$s>%3$s</%1$s>',
					langle_addons_escape_tags( $settings['title_tag'], 'h2' ),
					$this->get_render_attribute_string( 'title' ),
					langle_addons_kses_basic( $settings['title' ] )
				);
			endif;
			?>

			<?php if ( $settings['description'] ) : ?>
				<div <?php $this->print_render_attribute_string( 'description' ); ?>>
					<p><?php echo langle_addons_kses_intermediate( $settings['description'] ); ?></p>
				</div>
			<?php endif; ?>

			<?php $this->render_button(); ?>
		</div>
		<?php
	}

	public function content_template() {
		?>
		<#
		var iconTag = 'span',
			iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon_info, { 'aria-hidden': true }, 'i' , 'object' ),
			migrated = elementor.helpers.isIconMigrated( settings, 'selected_icon_info' );

		view.addInlineEditingAttributes( 'title', 'basic' );
		view.addRenderAttribute( 'title', 'class', 'la-infobox-title' );

		view.addInlineEditingAttributes( 'description', 'advanced' );
		view.addRenderAttribute( 'description', 'class', 'la-infobox-text' );

		if ( settings.type == 'image' && (settings.image.url || settings.image.id) ) {
			var image = {
				id: settings.image.id,
				url: settings.image.url,
				size: settings.thumbnail_size,
				dimension: settings.thumbnail_custom_dimension,
				model: view.getEditModel()
			};

			var image_url = elementor.imagesManager.getImageUrl( image );
			#>

			<figure class="la-infobox-figure la-infobox-figure--image">
				<img src="{{ image_url }}">
			</figure>
		<# } else if( settings.type == 'icon' && ( settings.icon || settings.selected_icon_info.value ) ) { #>
			<figure class="la-infobox-figure la-infobox-figure--icon">
				<{{{ iconTag }}} class="elementor-icon elementor-animation-{{ settings.hover_animation }}">
					<# if ( iconHTML && iconHTML.rendered && ( ! settings.icon || migrated ) ) { #>
						{{{ iconHTML.value }}}
						<# } else { #>
							<i class="{{ settings.icon }}" aria-hidden="true"></i>
						<# } #>
				</{{{ iconTag }}}>
			</figure>
		<# } #>

		<div class="la-infobox-body">
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