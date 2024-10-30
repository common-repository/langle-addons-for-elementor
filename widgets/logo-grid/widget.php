<?php
/**
 * Logo Grid widget class
 *
 * @package Langle_Addons
 */
namespace Langle_Addons\Elementor\Widget;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;

defined( 'ABSPATH' ) || die();

class Logo_Grid extends Base {

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Logo Grid', 'langle-addons' );
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
        return 'eicon-logo';
    }

    public function get_keywords() {
        return [ 'grid', 'logo' ];
    }
        
    /**
     * Register widget content controls
     */
    protected function register_content_controls() {
		$this->__logo_content_controls();
		$this->__settings_content_controls();
	}
    protected function __logo_content_controls() {

        $this->start_controls_section(
            '_section_logo',
            [
                'label' => __( 'Logo Grid', 'langle-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => __( 'Logo', 'langle-addons' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => __( 'Website Url', 'langle-addons' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
				],
				'default' => [
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				]
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label' => __( 'Brand Name', 'langle-addons' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Brand Name', 'langle-addons' ),
            ]
        );

        $this->add_control(
            'logo_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                'default' => [
                    [
						'image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'link' => [
							'url'         => '#',
							'is_external' => true,
							'nofollow'    => true,
						],
					],
                    [
						'image' => [
							'url' => Utils::get_placeholder_image_src()
						],
						'link' => [
							'url'         => '#',
							'is_external' => true,
							'nofollow'    => true,
						],
					],
					[
						'image' => [
							'url' => Utils::get_placeholder_image_src()
						],
						'link' => [
							'url'         => '#',
							'is_external' => true,
							'nofollow'    => true,
						],
					],
					[
						'image' => [
							'url' => Utils::get_placeholder_image_src()
						],
						'link' => [
							'url'         => '#',
							'is_external' => true,
							'nofollow'    => true,
						],
					],
					[
						'image' => [
							'url' => Utils::get_placeholder_image_src()
						],
						'link' => [
							'url'         => '#',
							'is_external' => true,
							'nofollow'    => true,
						],
					],
					[
						'image' => [
							'url' => Utils::get_placeholder_image_src()
						],
						'link' => [
							'url'         => '#',
							'is_external' => true,
							'nofollow'    => true,
						],
					],
					[
						'image' => [
							'url' => Utils::get_placeholder_image_src()
						],
						'link' => [
							'url'         => '#',
							'is_external' => true,
							'nofollow'    => true,
						],
					],
					[
						'image' => [
							'url' => Utils::get_placeholder_image_src()
						],
						'link' => [
							'url'         => '#',
							'is_external' => true,
							'nofollow'    => true,
						],
					],
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

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __( 'Grid Layout', 'langle-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'box' => __( 'Box', 'langle-addons' ),
                    'border' => __( 'Border', 'langle-addons' ),
                    'tictactoe' => __( 'Tic Tac Toe', 'langle-addons' ),
                ],
                'default' => 'box',
                'prefix_class' => 'la-logo-grid--',
                'style_transfer' => true,
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label' => __( 'Columns', 'langle-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    2 => __( '2 Columns', 'langle-addons' ),
                    3 => __( '3 Columns', 'langle-addons' ),
                    4 => __( '4 Columns', 'langle-addons' ),
                    5 => __( '5 Columns', 'langle-addons' ),
                    6 => __( '6 Columns', 'langle-addons' ),
                ],
                'desktop_default' => 4,
                'tablet_default' => 2,
                'mobile_default' => 2,
                'prefix_class' => 'la-logo-grid--col-%s',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Register widget style controls
     */
    protected function register_style_controls() {

        $this->start_controls_section(
            '_section_style_grid',
            [
                'label' => __( 'Grid', 'langle-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => __( 'Padding', 'langle-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'unit'  => 'px',
                    'top'   => 0,
                    'right'   => 0,
                    'bottom'   => 0,
                    'left'   => 0,
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .la-logo-grid-figure' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                        'max' => 500,
                        'min' => 100,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-logo-grid-item' => 'height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'grid_border_type',
            [
                'label' => __( 'Border Type', 'langle-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => __( 'None', 'langle-addons' ),
                    'solid' => __( 'Solid', 'langle-addons' ),
                    'double' => __( 'Double', 'langle-addons' ),
                    'dotted' => __( 'Dotted', 'langle-addons' ),
                    'dashed' => __( 'Dashed', 'langle-addons' ),
                    'groove' => __( 'Groove', 'langle-addons' ),
                ],
                'default' => 'solid',
                'selectors' => [
                    '{{WRAPPER}} .la-logo-grid-item' => 'border-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'grid_border_width',
            [
                'label' => __( 'Border Width', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '(desktop+){{WRAPPER}}.la-logo-grid--border .la-logo-grid-item' => 'border-right-width: {{grid_border_width.SIZE}}{{UNIT}}; border-bottom-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--border .la-logo-grid-item' => 'border-right-width: {{grid_border_width_tablet.SIZE}}{{UNIT}}; border-bottom-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--border .la-logo-grid-item' => 'border-right-width: {{grid_border_width_mobile.SIZE}}{{UNIT}}; border-bottom-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',

                    '(desktop+){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col-2 .la-logo-grid-item:nth-child(2n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col-3 .la-logo-grid-item:nth-child(3n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col-4 .la-logo-grid-item:nth-child(4n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col-5 .la-logo-grid-item:nth-child(5n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col-6 .la-logo-grid-item:nth-child(6n+1)' => 'border-left-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col-2 .la-logo-grid-item:nth-child(-n+2)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col-3 .la-logo-grid-item:nth-child(-n+3)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col-4 .la-logo-grid-item:nth-child(-n+4)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col-5 .la-logo-grid-item:nth-child(-n+5)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col-6 .la-logo-grid-item:nth-child(-n+6)' => 'border-top-width: {{grid_border_width.SIZE}}{{UNIT}};',

                    '(tablet){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--tablet2 .la-logo-grid-item:nth-child(2n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--tablet3 .la-logo-grid-item:nth-child(3n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--tablet4 .la-logo-grid-item:nth-child(4n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--tablet5 .la-logo-grid-item:nth-child(5n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--tablet6 .la-logo-grid-item:nth-child(6n+1)' => 'border-left-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--tablet2 .la-logo-grid-item:nth-child(-n+2)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--tablet3 .la-logo-grid-item:nth-child(-n+3)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--tablet4 .la-logo-grid-item:nth-child(-n+4)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--tablet5 .la-logo-grid-item:nth-child(-n+5)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--tablet6 .la-logo-grid-item:nth-child(-n+6)' => 'border-top-width: {{grid_border_width_tablet.SIZE}}{{UNIT}};',

                    '(mobile){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--mobile2 .la-logo-grid-item:nth-child(2n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--mobile3 .la-logo-grid-item:nth-child(3n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--mobile4 .la-logo-grid-item:nth-child(4n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--mobile5 .la-logo-grid-item:nth-child(5n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--mobile6 .la-logo-grid-item:nth-child(6n+1)' => 'border-left-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--mobile2 .la-logo-grid-item:nth-child(-n+2)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--mobile3 .la-logo-grid-item:nth-child(-n+3)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--mobile4 .la-logo-grid-item:nth-child(-n+4)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--mobile5 .la-logo-grid-item:nth-child(-n+5)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--mobile6 .la-logo-grid-item:nth-child(-n+6)' => 'border-top-width: {{grid_border_width_mobile.SIZE}}{{UNIT}};',

                    '{{WRAPPER}}.la-logo-grid--tictactoe .la-logo-grid-item' => 'border-top-width: {{SIZE}}{{UNIT}}; border-right-width: {{SIZE}}{{UNIT}};',

                    '{{WRAPPER}}.la-logo-grid--box .la-logo-grid-item' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'grid_border_type!' => 'none',
                ]
            ]
        );

        $this->add_control(
            'grid_border_color',
            [
                'label' => __( 'Border Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#E9E9E9',
                'selectors' => [
                    '{{WRAPPER}} .la-logo-grid-item' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'grid_border_type!' => 'none',
                ]
            ]
        );

        $this->add_control(
            'grid_bg_color',
            [
                'label' => __( 'Background Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-logo-grid-figure' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'grid_border_radius',
            [
                'label' => __( 'Border Radius', 'langle-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}.la-logo-grid--border .la-logo-grid-wrapper, {{WRAPPER}}.la-logo-grid--box .la-logo-grid-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}}.la-logo-grid--border .la-logo-grid-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}};',
                    '{{WRAPPER}}.la-logo-grid--border .la-logo-grid-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}};',

                    '(desktop+){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col-2 .la-logo-grid-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col-2 .la-logo-grid-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col-3 .la-logo-grid-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col-3 .la-logo-grid-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col-4 .la-logo-grid-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col-4 .la-logo-grid-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col-5 .la-logo-grid-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col-5 .la-logo-grid-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col-6 .la-logo-grid-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col-6 .la-logo-grid-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',

                    '(tablet){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--tablet2 .la-logo-grid-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--tablet2 .la-logo-grid-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--tablet3 .la-logo-grid-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--tablet3 .la-logo-grid-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--tablet4 .la-logo-grid-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--tablet4 .la-logo-grid-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--tablet5 .la-logo-grid-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--tablet5 .la-logo-grid-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--tablet6 .la-logo-grid-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--tablet6 .la-logo-grid-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',

                    '(mobile){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--mobile2 .la-logo-grid-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--mobile2 .la-logo-grid-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--mobile3 .la-logo-grid-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--mobile3 .la-logo-grid-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--mobile4 .la-logo-grid-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--mobile4 .la-logo-grid-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--mobile5 .la-logo-grid-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--mobile5 .la-logo-grid-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--mobile6 .la-logo-grid-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--border.la-logo-grid--col--mobile6 .la-logo-grid-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',

                    // Tictactoe
                    '{{WRAPPER}}.la-logo-grid--tictactoe .la-logo-grid-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}}.la-logo-grid--tictactoe .la-logo-grid-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}};',
                    '{{WRAPPER}}.la-logo-grid--tictactoe .la-logo-grid-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}};',

                    '(desktop+){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col-2 .la-logo-grid-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col-2 .la-logo-grid-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col-3 .la-logo-grid-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col-3 .la-logo-grid-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col-4 .la-logo-grid-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col-4 .la-logo-grid-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col-5 .la-logo-grid-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col-5 .la-logo-grid-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col-6 .la-logo-grid-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius.RIGHT}}{{UNIT}};',
                    '(desktop+){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col-6 .la-logo-grid-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius.LEFT}}{{UNIT}};',

                    '(tablet){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col--tablet2 .la-logo-grid-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col--tablet2 .la-logo-grid-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col--tablet3 .la-logo-grid-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col--tablet3 .la-logo-grid-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col--tablet4 .la-logo-grid-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col--tablet4 .la-logo-grid-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col--tablet5 .la-logo-grid-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col--tablet5 .la-logo-grid-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col--tablet6 .la-logo-grid-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius_tablet.RIGHT}}{{UNIT}};',
                    '(tablet){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col--tablet6 .la-logo-grid-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius_tablet.LEFT}}{{UNIT}};',

                    '(mobile){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col--mobile2 .la-logo-grid-item:nth-child(2)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col--mobile2 .la-logo-grid-item:nth-last-child(2)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col--mobile3 .la-logo-grid-item:nth-child(3)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col--mobile3 .la-logo-grid-item:nth-last-child(3)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col--mobile4 .la-logo-grid-item:nth-child(4)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col--mobile4 .la-logo-grid-item:nth-last-child(4)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col--mobile5 .la-logo-grid-item:nth-child(5)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col--mobile5 .la-logo-grid-item:nth-last-child(5)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col--mobile6 .la-logo-grid-item:nth-child(6)' => 'border-top-right-radius: {{grid_border_radius_mobile.RIGHT}}{{UNIT}};',
                    '(mobile){{WRAPPER}}.la-logo-grid--tictactoe.la-logo-grid--col--mobile6 .la-logo-grid-item:nth-last-child(6)' => 'border-bottom-left-radius: {{grid_border_radius_mobile.LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'grid_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}}.la-logo-grid--tictactoe .la-logo-grid-wrapper, {{WRAPPER}}.la-logo-grid--border .la-logo-grid-wrapper, {{WRAPPER}}.la-logo-grid--box .la-logo-grid-item'
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
                        'min' => 0,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-logo-grid-figure img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'image_css_filters',
                'selector' => '{{WRAPPER}} .la-logo-grid-figure img',
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
                        'min' => 0,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-logo-grid-figure:hover img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'image_css_filters_hover',
                'selector' => '{{WRAPPER}} .la-logo-grid-figure:hover img',
            ]
        );

        $this->add_control(
            'image_bg_hover_transition',
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
                    '{{WRAPPER}} .la-logo-grid-figure:hover img' => 'transition-duration: {{SIZE}}s;',
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

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty($settings['logo_list'] ) ) {
            return;
        }
        ?>

        <div class="la-logo-grid-wrapper">
            <?php
            foreach ( $settings['logo_list'] as $index => $item ) :
                $image = $item['image'];
                $repeater_key = 'grid_item' . $index;
                $tag = 'div';
                $this->add_render_attribute( $repeater_key, 'class', 'la-logo-grid-item' );

                if ( $item['link']['url'] ) {
                    $tag = 'a';
					$this->add_render_attribute( $repeater_key, 'class', 'la-logo-grid-link' );
					$this->add_link_attributes( $repeater_key, $item['link'] );
                }
                ?>
                <<?php echo esc_attr( $tag ); ?> <?php $this->print_render_attribute_string( $repeater_key ); ?>>
                    <figure class="la-logo-grid-figure">
                    <?php if ( isset( $image['source'] ) && $image['id'] ) :
							echo wp_get_attachment_image(
								$image['id'],
								$settings['thumbnail_size'],
								false,
								[
									'class' => 'la-logo-grid-img elementor-animation-' . esc_attr( $settings['hover_animation'] )
								]
							);
                        else :
							$url = $image['url'] ? $image['url'] : Utils::get_placeholder_image_src();
                            printf( '<img class="la-logo-grid-img elementor-animation-%s" src="%s" alt="%s">',
                                esc_attr( $settings['hover_animation'] ),
                                esc_url( $url ),
                                esc_attr( $item['name'] )
                                );
                        endif; ?>
                    </figure>
                </<?php echo esc_attr( $tag ); ?>>
            <?php endforeach; ?>
        </div>

        <?php
    }
}