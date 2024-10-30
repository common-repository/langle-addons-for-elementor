<?php
/**
 * Flip Box widget class
 *
 * @package Langle_Addons
 */
namespace Langle_Addons\Elementor\Widget;

use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Flip_Box extends Base {
    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Flip Box', 'langle-addons' );
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
        return 'eicon-flip-box';
    }

    public function get_keywords() {
        return [ 'flip', 'box', 'flip', 'info', 'content', 'animation' ];
    }

	/**
     * Register widget content controls
     */
    protected function register_content_controls() {
		$this->__front_side_content_controls();
		$this->__back_side_content_controls();
		$this->__settings_content_controls();
	}

    protected function __front_side_content_controls() {

        $this->start_controls_section(
            '_section_front',
            [
                'label' => __( 'Front Side', 'langle-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'front_icon_type',
            [
                'label' => __( 'Media Type', 'langle-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'icon',
                'options' => [
                    'none' => [
                        'title' => __( 'None', 'langle-addons' ),
                        'icon' => 'eicon-close',
                    ],
                    'icon' => [
                        'title' => __( 'Icon', 'langle-addons' ),
                        'icon' => 'eicon-star',
                    ],
                    'image' => [
                        'title' => __( 'Image', 'langle-addons' ),
                        'icon' => 'eicon-image',
                    ],
                ],
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        if ( langle_addons_is_elementor_version( '<', '2.6.0' ) ) {
            $this->add_control(
                'front_icon',
                [
                    'label' => __( 'Icon', 'langle-addons' ),
                    'type' => Controls_Manager::ICON,
                    'default' => 'fa fa-home',
                    'condition' => [
                        'front_icon_type' => 'icon'
                    ],
                ]
                
            );
        } else {
            $this->add_control(
                'front_selected_icon',
                [
                    'label' => __( 'Icon', 'langle-addons' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'front_icon',
                    'label_block' => true,
                    'default' => [
                        'value' => '',
                        'library' => '',
                    ],
                    'condition' => [
                        'front_icon_type' => 'icon'
                    ],
                ]
            );
        }

        $this->add_control(
            'front_icon_image',
            [
                'label' => __( 'Image', 'langle-addons' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'front_icon_type' => 'image'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'front_icon_thumbnail',
                'default' => 'thumbnail',
                'exclude' => [
                    'full',
                    'shop_catalog',
                    'shop_single',
                ],
                'condition' => [
                    'front_icon_type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'front_title',
            [
                'label' => __( 'Title', 'langle-addons' ),
                'label_block' => true,
                'separator' => 'before',
                'type' => Controls_Manager::TEXT,
                'default' => 'Start Marketing',
                'placeholder' => __( 'Type Flip Box Title', 'langle-addons' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'front_description',
            [
                'label' => __( 'Description', 'langle-addons' ),
                'description' => langle_addons_get_allowed_html_desc( 'basic' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'consectetur adipiscing elit, sed do<br>eiusmod Lorem ipsum dolor sit amet,<br> consectetur.',
                'placeholder' => __( 'Description', 'langle-addons' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'front_text_align',
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
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-front-inner .icon-wrap' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .la-flip-box-front-inner .la-text' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function __back_side_content_controls() {

        $this->start_controls_section(
            '_section_back',
            [
                'label' => __( 'Back Side', 'langle-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'back_icon_type',
            [
                'label' => __( 'Media Type', 'langle-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'none',
                'options' => [
                    'none' => [
                        'title' => __( 'None', 'langle-addons' ),
                        'icon' => 'eicon-close',
                    ],
                    'icon' => [
                        'title' => __( 'Icon', 'langle-addons' ),
                        'icon' => 'eicon-star',
                    ],
                    'image' => [
                        'title' => __( 'Image', 'langle-addons' ),
                        'icon' => 'eicon-image',
                    ],
                ],
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'back_icon_image',
            [
                'label' => __( 'Image', 'langle-addons' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'back_icon_type' => 'image'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'back_icon_thumbnail',
                'default' => 'thumbnail',
                'exclude' => [
                    'full',
                    'shop_catalog',
                    'shop_single',
                ],
                'condition' => [
                    'back_icon_type' => 'image'
                ]
            ]
        );

        if ( langle_addons_is_elementor_version( '<', '2.6.0' ) ) {
            $this->add_control(
                'back_icon',
                [
                    'label' => __( 'Icon', 'langle-addons' ),
                    'type' => Controls_Manager::ICON,
                    'default' => 'fa fa-home',
                    'condition' => [
                        'back_icon_type' => 'icon'
                    ],
                ]
            );
        } else {
            $this->add_control(
                'back_selected_icon',
                [
                    'label' => __( 'Icon', 'langle-addons' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'back_icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-smile-wink',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'back_icon_type' => 'icon'
                    ],
                ]
            );
        }

        $this->add_control(
            'back_title',
            [
                'label' => __( 'Title', 'langle-addons' ),
                'label_block' => true,
                'separator' => 'before',
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Start Marketing', 'langle-addons' ),
                'placeholder' => __( 'Type Flip Box Title', 'langle-addons' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'back_description',
            [
                'label' => __( 'Description', 'langle-addons' ),
                'description' => langle_addons_get_allowed_html_desc( 'intermediate' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'consectetur adipiscing elit, sed do<br>eiusmod Lorem ipsum dolor sit amet.',
                'placeholder' => __( 'Description', 'langle-addons' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'back_text_align',
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
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-back-inner .icon-wrap' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .la-flip-box-back-inner .la-text' => 'text-align: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_section();
	}

    protected function __settings_content_controls() {

        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __( 'Settings', 'langle-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'flip_position',
            [
                'label' => __( 'Flip Direction', 'langle-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left-right',
                'label_block' => false,
                'options' => [
                    'bottom-top' => [
                        'title' => __( 'Bottom To Top', 'langle-addons' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'left-right' => [
                        'title' => __( 'Left To Right', 'langle-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => false,
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
		$this->__front_side_style_controls();
		$this->__back_side_style_controls();

	}

    protected function __common_style_controls() {

        $this->start_controls_section(
            '_section_common_style',
            [
                'label' => __( 'Common', 'langle-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label' => __( 'Height', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-front' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .la-flip-box-back' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_area_border_radius',
            [
                'label' => __( 'Border Radius', 'langle-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-front' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .la-flip-box-front:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .la-flip-box-back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .la-flip-box-back:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
	}

    protected function __front_side_style_controls() {

        // front side
        $this->start_controls_section(
            '_section_front_style',
            [
                'label' => __( 'Front Side', 'langle-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'front_content_padding',
            [
                'label' => __( 'Padding', 'langle-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-front' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'front_border',
                'selector' => '{{WRAPPER}} .la-flip-box-front',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'front_box_shadow',
                'selector' => '{{WRAPPER}} .la-flip-box-front',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'front_background_image',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .la-flip-box-front',
            ]
        );

        $this->add_control(
            'front_background_overlay',
            [
                'label' => __( 'Background Overlay', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
					'front_background_image_background' => 'classic'
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-front:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'front_icon_heading',
            [
                'label' => __( 'Media Type - Icon', 'langle-addons' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'front_icon_type' => 'icon'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'front_icon_heading_image',
            [
                'label' => __( 'Media Type - Image', 'langle-addons' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'front_icon_type' => 'image'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'front_icon_spacing',
            [
                'label' => __( 'Bottom Spacing', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-front .la-flip-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'front_icon_image_size',
            [
                'label' => __( 'Resize Image', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'front_icon_type' => 'image'
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-front-inner .icon-wrap .la-flip-icon img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'front_icon_image_fit',
            [
                'label' => __( 'Image Fit', 'langle-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'contain'  => __( 'Contain', 'langle-addons' ),
                    'cover' => __( 'Cover', 'langle-addons' ),
                ],
                'condition' => [
                    'front_icon_type' => 'image'
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-front-inner .icon-wrap .la-flip-icon img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'front_icon_font_size',
            [
                'label' => __( 'Icon Size', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300
					],
					'em' => [
						'min' => 6,
						'max' => 300
					]
				],
                'condition' => [
                    'front_icon_type' => 'icon'
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-front-inner .la-flip-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'front_icon_background_size',
            [
                'label' => __( 'Padding', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'front_icon_type' => [ 'icon', 'image' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-front-inner .icon-wrap .la-flip-icon' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'front_icon_border',
                'condition' => [
                    'front_icon_type' => [ 'icon', 'image' ],
                ],
                'selector' => '{{WRAPPER}} .la-flip-box-front-inner .icon-wrap .la-flip-icon',
            ]
        );

        $this->add_control(
            'front_icon_border_radius',
            [
                'label' => __( 'Border Radius', 'langle-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'condition' => [
                    'front_icon_type' => [ 'icon', 'image' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-front-inner .icon-wrap .la-flip-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .la-flip-box-front-inner .la-flip-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'front_icon_box_shadow',
                'selector' => '{{WRAPPER}} .la-flip-box-front-inner .la-flip-icon',
                'condition' => [
                    'front_icon_type' => [ 'icon', 'image' ],
                ],
            ]
        );

        $this->add_control(
            'front_icon_color',
            [
                'label' => __( 'Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'front_icon_type' => 'icon'
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-front-inner .icon-wrap .la-flip-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'front_icon_background_color',
            [
                'label' => __( 'Background Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'front_icon_type' => [ 'icon', 'image' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-front-inner .icon-wrap .la-flip-icon' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'front_text',
            [
                'label' => __( 'Title & Description', 'langle-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( '_tabs_front_text' );
        $this->start_controls_tab(
            '_tab_front_title',
            [
                'label' => __( 'Title', 'langle-addons' ),
            ]
        );

        $this->add_control(
            'front_title_color',
            [
                'label' => __( 'Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-front-inner .la-flip-box-heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'front_title_typography',
                'label' => __( 'Typography', 'langle-addons' ),
                'selector' => '{{WRAPPER}} .la-flip-box-front-inner .la-flip-box-heading',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'front_title_text_shadow',
                'label' => __( 'Text Shadow', 'langle-addons' ),
                'selector' => '{{WRAPPER}} .la-flip-box-front-inner .la-flip-box-heading',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_front_description',
            [
                'label' => __( 'Description', 'langle-addons' ),
            ]
        );

        $this->add_responsive_control(
            'front_description_space',
            [
                'label' => __( 'Spacing', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-front-inner .la-text p' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'front_description_color',
            [
                'label' => __( 'Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-front-inner .la-text p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'front_description_typography',
                'label' => __( 'Typography', 'langle-addons' ),
                'selector' => '{{WRAPPER}} .la-flip-box-front-inner .la-text p',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'front_description_text_shadow',
                'label' => __( 'Text Shadow', 'langle-addons' ),
                'selector' => '{{WRAPPER}} .la-flip-box-front-inner .la-text p',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
	}

    protected function __back_side_style_controls() {

        // back side
        $this->start_controls_section(
            '_section_back_text_style',
            [
                'label' => __( 'Back Side', 'langle-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'back_content_padding',
            [
                'label' => __( 'Padding', 'langle-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-back' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'back_border',
                'selector' => '{{WRAPPER}} .la-flip-box-back',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'back_box_shadow',
                'selector' => '{{WRAPPER}} .la-flip-box-back',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'back_background_image',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .la-flip-box-back',
            ]
        );

        $this->add_control(
            'back_background_overlay',
            [
                'label' => __( 'Background Overlay', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.27)',
                'condition' => [
                    'back_background_image_background' => 'classic'
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-back:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'back_background_color',
            [
                'label' => __( 'Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#27374c',
                'condition' => [
                    'back_background_type' => 'color'
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-back' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'back_icon_heading',
            [
                'label' => __( 'Media Type - Icon', 'langle-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'back_icon_type' => 'icon'
                ],
            ]
        );

        $this->add_control(
            'back_icon_heading_image',
            [
                'label' => __( 'Media Type - Image', 'langle-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'back_icon_type' => 'image'
                ],
            ]
        );

        $this->add_responsive_control(
            'back_icon_spacing',
            [
                'label' => __( 'Bottom Spacing', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%'],
                'condition' => [
                    'back_icon_type' => [ 'icon', 'image' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-back-inner .la-flip-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'back_icon_image_size',
            [
                'label' => __( 'Resize Image', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'back_icon_type' => 'image'
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-back-inner .la-flip-icon img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'back_icon_image_fit',
            [
                'label' => __( 'Image Fit', 'langle-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'contain'  => __( 'Contain', 'langle-addons' ),
                    'cover' => __( 'Cover', 'langle-addons' ),
                ],
                'condition' => [
                    'back_icon_type' => 'image'
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-back-inner .icon-wrap .la-flip-icon img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'back_icon_font_size',
            [
                'label' => __( 'Icon Size', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300
					],
					'em' => [
						'min' => 6,
						'max' => 300
					]
				],
                'condition' => [
                    'back_icon_type' => 'icon'
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-back-inner .la-flip-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'back_icon_padding',
            [
                'label' => __( 'Padding', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'back_icon_type' => [ 'icon', 'image' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-back-inner .icon-wrap .la-flip-icon' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'back_icon_border',
                'condition' => [
                    'back_icon_type' => [ 'icon', 'image' ],
                ],
                'selector' => '{{WRAPPER}} .la-flip-box-back-inner .icon-wrap .la-flip-icon',
            ]
        );

        $this->add_control(
            'back_icon_border_radius',
            [
                'label' => __( 'Border Radius', 'langle-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'condition' => [
                    'back_icon_type' => [ 'icon', 'image']
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-back-inner .icon-wrap .la-flip-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .la-flip-box-back-inner .la-flip-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'back_icon_box_shadow',
                'condition' => [
                    'back_icon_type' => [ 'icon', 'image']
                ],
                'selector' => '{{WRAPPER}} .la-flip-box-back-inner .la-flip-icon',
            ]
        );

        $this->add_control(
            'back_icon_color',
            [
                'label' => __( 'Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'back_icon_type' => 'icon'
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-back-inner .la-flip-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'back_icon_background_color',
            [
                'label' => __( 'Background Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'back_icon_type' => [ 'icon', 'image' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-back-inner .icon-wrap .la-flip-icon' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'back_text',
            [
                'label' => __( 'Title & Description', 'langle-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( '_tabs_back_text' );
        $this->start_controls_tab(
            '_tab_back_title',
            [
                'label' => __( 'Title', 'langle-addons' ),
            ]
        );

		$this->add_responsive_control(
			'back_title_space',
			[
				'label' => __( 'Bottom Spacing', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .la-flip-box-back-inner .la-flip-box-heading-back' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'back_title_color',
            [
                'label' => __( 'Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-back-inner .la-flip-box-heading-back' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'back_title_typography',
                'label' => __( 'Typography', 'langle-addons' ),
                'selector' => '{{WRAPPER}} .la-flip-box-back-inner .la-flip-box-heading-back',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'back_title_shadow',
                'label' => __( 'Text Shadow', 'langle-addons' ),
                'selector' => '{{WRAPPER}} .la-flip-box-back-inner .la-flip-box-heading-back',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_back_description',
            [
                'label' => __( 'Description', 'langle-addons' ),
            ]
        );

        $this->add_control(
            'back_description_color',
            [
                'label' => __( 'Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-flip-box-back-inner .la-text p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'back_description_typography',
                'label' => __( 'Typography', 'langle-addons' ),
                'selector' => '{{WRAPPER}} .la-flip-box-back-inner .la-text p',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'back_description_text_shadow',
                'label' => __( 'Text Shadow', 'langle-addons' ),
                'selector' => '{{WRAPPER}} .la-flip-box-back-inner .la-text p',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // icon/image
        if ( isset( $settings['front_icon_image']['id'] ) && isset( $settings['front_icon_image']['url'] ) ) {
            $this->add_render_attribute( 'front_icon_image', 'src', $settings['front_icon_image']['url'] );
            $this->add_render_attribute( 'front_icon_image', 'alt', Control_Media::get_image_alt( $settings['front_icon_image'] ) );
            $this->add_render_attribute( 'front_icon_image', 'title', Control_Media::get_image_title( $settings['front_icon_image'] ) );
        }

        // title & description
        $this->add_render_attribute( 'front_title', 'class', 'la-flip-box-heading' );
        $this->add_render_attribute( 'back_title', 'class', 'la-flip-box-heading-back' );
        $this->add_render_attribute( 'front_description', 'class', 'la-desc' );
        $this->add_render_attribute( 'back_description', 'class', 'la-desc' );
        $this->add_inline_editing_attributes( 'back_description', 'advanced' );

        // display type
        $this->add_render_attribute( 'display', 'class', 'la-flip-box-container la-flip-effect-classic' );

        // flip position
        $this->add_render_attribute( 'flip-position', 'class', 'la-flip-box-inner' );
        if ( $settings['flip_position'] === 'bottom-top' ) {
            $this->add_render_attribute( 'flip-position', 'class', 'la-flip-up' );
        } elseif ( $settings['flip_position'] === 'left-right' ) {
            $this->add_render_attribute( 'flip-position', 'class', 'la-flip-right' );
        }
        ?>

        <div <?php echo $this->get_render_attribute_string( 'display' ); ?>>

            <div <?php echo $this->get_render_attribute_string( 'flip-position' ); ?>>
                <div class="la-flip-box-inner-wrapper">
                    <div class="la-flip-box-front">
                        <div class="la-flip-box-front-inner">
                            <div class="icon-wrap">
                                <?php if ( ! empty( $settings['front_icon'] ) || ! empty( $settings['front_selected_icon'] ) ) : ?>
                                    <span class="la-flip-icon icon">
                                        <?php langle_addons_render_icon( $settings, 'front_icon', 'front_selected_icon' ); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if ( $settings['front_icon_image'] ) : ?>
                                    <div class="la-flip-icon">
                                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'front_icon_thumbnail', 'front_icon_image' ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="la-text">
                                <?php if ( $settings['front_title'] ) : ?>
                                    <h2 <?php echo $this->get_render_attribute_string( 'front_title' ); ?>><?php echo langle_addons_kses_basic( $settings['front_title'] ); ?></h2>
                                <?php endif; ?>

                                <?php if ( $settings['front_description'] ) : ?>
                                    <p <?php echo $this->get_render_attribute_string( 'front_description' ); ?>><?php echo langle_addons_kses_basic( $settings['front_description'] ); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="la-flip-box-back">
                        <div class="la-flip-box-back-inner">
                            <div class="icon-wrap">
                                <?php if ( ! empty( $settings['back_icon'] ) || ! empty( $settings['back_selected_icon'] ) ) : ?>
                                    <span class="la-flip-icon icon">
                                        <?php langle_addons_render_icon( $settings, 'back_icon', 'back_selected_icon' ); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if ( $settings['back_icon_image'] ) : ?>
                                    <div class="la-flip-icon">
                                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'back_icon_thumbnail', 'back_icon_image' ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="la-text">
                                <?php if ( $settings['back_title'] ) : ?>
                                    <h2 <?php echo $this->get_render_attribute_string( 'back_title' ); ?>><?php echo langle_addons_kses_basic( $settings['back_title'] ); ?></h2>
                                <?php endif; ?>

                                <?php if ( $settings['back_description'] ) : ?>
                                    <p <?php echo $this->get_render_attribute_string( 'back_description' ) ?>><?php echo langle_addons_kses_intermediate( $settings['back_description'] ); ?></p>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }

}