<?php
/**
 * Pricing table widget class
 *
 * @package Langle_Addons
 */
namespace Langle_Addons\Elementor\Widget;

use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Langle_Addons\Elementor\Traits\Button_Trait;

defined( 'ABSPATH' ) || die();

class Pricing_Table extends Base {

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
        return __( 'Pricing Table', 'langle-addons' );
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
        return 'eicon-price-table';
    }

    public function get_keywords() {
        return [ 'pricing', 'price', 'table', 'package', 'product', 'plan' ];
    }

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {
		$this->__header_content_controls();
		$this->__price_content_controls();
		$this->__features_content_controls();
		$this->__content_controls_button_trait();
		$this->__badge_content_controls();
	}

    protected function __header_content_controls() {

        $this->start_controls_section(
			'_section_header',
			[
				'label' => __( 'Header', 'langle-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'langle-addons' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Basic', 'langle-addons' ),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

		$this->add_control(
			'title_tag',
			[
				'label'   => __( 'Title HTML Tag', 'langle-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'h1' => [
						'title' => __( 'H1', 'langle-addons' ),
						'icon'  => 'eicon-editor-h1',
					],
					'h2' => [
						'title' => __( 'H2', 'langle-addons' ),
						'icon'  => 'eicon-editor-h2',
					],
					'h3' => [
						'title' => __( 'H3', 'langle-addons' ),
						'icon'  => 'eicon-editor-h3',
					],
					'h4' => [
						'title' => __( 'H4', 'langle-addons' ),
						'icon'  => 'eicon-editor-h4',
					],
					'h5' => [
						'title' => __( 'H5', 'langle-addons' ),
						'icon'  => 'eicon-editor-h5',
					],
					'h6' => [
						'title' => __( 'H6', 'langle-addons' ),
						'icon'  => 'eicon-editor-h6',
					],
				],
				'default' => 'h2',
				'toggle'  => false,
			]
		);

        $this->end_controls_section();

    }
    protected function __price_content_controls() {

        $this->start_controls_section(
            '_section_pricing',
            [
                'label' => __( 'Pricing', 'langle-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'currency',
            [
                'label' => __( 'Currency', 'langle-addons' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    ''             => __( 'None', 'langle-addons' ),
                    'baht'         => '&#3647; ' . _x( 'Baht', 'Currency Symbol', 'langle-addons' ),
                    'bdt'          => '&#2547; ' . _x( 'BD Taka', 'Currency Symbol', 'langle-addons' ),
                    'dollar'       => '&#36; ' . _x( 'Dollar', 'Currency Symbol', 'langle-addons' ),
                    'euro'         => '&#128; ' . _x( 'Euro', 'Currency Symbol', 'langle-addons' ),
                    'franc'        => '&#8355; ' . _x( 'Franc', 'Currency Symbol', 'langle-addons' ),
                    'guilder'      => '&fnof; ' . _x( 'Guilder', 'Currency Symbol', 'langle-addons' ),
                    'krona'        => 'kr ' . _x( 'Krona', 'Currency Symbol', 'langle-addons' ),
                    'lira'         => '&#8356; ' . _x( 'Lira', 'Currency Symbol', 'langle-addons' ),
                    'peseta'       => '&#8359 ' . _x( 'Peseta', 'Currency Symbol', 'langle-addons' ),
                    'peso'         => '&#8369; ' . _x( 'Peso', 'Currency Symbol', 'langle-addons' ),
                    'pound'        => '&#163; ' . _x( 'Pound Sterling', 'Currency Symbol', 'langle-addons' ),
                    'real'         => 'R$ ' . _x( 'Real', 'Currency Symbol', 'langle-addons' ),
                    'ruble'        => '&#8381; ' . _x( 'Ruble', 'Currency Symbol', 'langle-addons' ),
                    'rupee'        => '&#8360; ' . _x( 'Rupee', 'Currency Symbol', 'langle-addons' ),
                    'indian_rupee' => '&#8377; ' . _x( 'Rupee (Indian)', 'Currency Symbol', 'langle-addons' ),
                    'shekel'       => '&#8362; ' . _x( 'Shekel', 'Currency Symbol', 'langle-addons' ),
                    'won'          => '&#8361; ' . _x( 'Won', 'Currency Symbol', 'langle-addons' ),
                    'yen'          => '&#165; ' . _x( 'Yen/Yuan', 'Currency Symbol', 'langle-addons' ),
                    'custom'       => __( 'Custom', 'langle-addons' ),
                ],
                'default' => 'dollar',
            ]
        );

        $this->add_control(
            'currency_custom',
            [
                'label' => __( 'Custom Symbol', 'langle-addons' ),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'currency' => 'custom',
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => __( 'Price', 'langle-addons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '99.99',
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'period',
            [
                'label' => __( 'Period', 'langle-addons' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Per Month', 'langle-addons' ),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->end_controls_section();

    }
    protected function __features_content_controls() {

        $this->start_controls_section(
            '_section_features',
            [
                'label' => __( 'Features', 'langle-addons' ),
            ]
        );

        $this->add_control(
            'features_title',
            [
                'label' => __( 'Title', 'langle-addons' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Features', 'langle-addons' ),
                'separator' => 'after',
                'label_block' => true,
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

		$this->add_control(
			'features_title_tag',
			[
				'label'   => __( 'Title HTML Tag', 'langle-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'h1' => [
						'title' => __( 'H1', 'langle-addons' ),
						'icon'  => 'eicon-editor-h1',
					],
					'h2' => [
						'title' => __( 'H2', 'langle-addons' ),
						'icon'  => 'eicon-editor-h2',
					],
					'h3' => [
						'title' => __( 'H3', 'langle-addons' ),
						'icon'  => 'eicon-editor-h3',
					],
					'h4' => [
						'title' => __( 'H4', 'langle-addons' ),
						'icon'  => 'eicon-editor-h4',
					],
					'h5' => [
						'title' => __( 'H5', 'langle-addons' ),
						'icon'  => 'eicon-editor-h5',
					],
					'h6' => [
						'title' => __( 'H6', 'langle-addons' ),
						'icon'  => 'eicon-editor-h6',
					],
				],
				'default' => 'h4',
				'toggle'  => false,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'text',
			[
				'label' => __( 'Text', 'langle-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Exciting Feature', 'langle-addons' ),
				'dynamic' => [
					'active' => true
				]
			]
		);

		$repeater->add_control(
			'selected_icon',
			[
				'label' => __( 'Icon', 'langle-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-check',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-regular' => [
						'check-square',
						'window-close',
					],
					'fa-solid' => [
						'check',
					]
				]
			]
		);

        $this->add_control(
            'features_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'text' => __( 'Standard Feature', 'langle-addons' ),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'text' => __( 'Another Great Feature', 'langle-addons' ),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'text' => __( 'Obsolete Feature', 'langle-addons' ),
                        'icon' => 'fa fa-close',
                    ],
                    [
                        'text' => __( 'Exciting Feature', 'langle-addons' ),
                        'icon' => 'fa fa-check',
                    ],
                ],
                'title_field' => '<# print(haGetFeatureLabel(text)); #>',
            ]
        );

        $this->end_controls_section();

    }
    protected function __content_controls_button_trait(){
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
    protected function __badge_content_controls() {

        $this->start_controls_section(
            '_section_badge',
            [
                'label' => __( 'Badge', 'langle-addons' ),
            ]
        );

        $this->add_control(
            'show_badge',
            [
                'label' => __( 'Show', 'langle-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'langle-addons' ),
                'label_off' => __( 'Hide', 'langle-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'badge_position',
            [
                'label' => __( 'Position', 'langle-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'langle-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'langle-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => false,
                'default' => 'right',
                'style_transfer' => true,
                'condition' => [
                    'show_badge' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label' => __( 'Badge Text', 'langle-addons' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Recommended', 'langle-addons' ),
                'placeholder' => __( 'Type badge text', 'langle-addons' ),
                'condition' => [
                    'show_badge' => 'yes'
                ],
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Register widget style controls
     */
    protected function register_style_controls() {
		$this->__general_style_controls();
		$this->__header_style_controls();
		$this->__price_style_controls();
		$this->__feature_style_controls();
		// $this->__footer_style_controls();
		$this->__style_controls_button_trait();
		$this->__badge_style_controls();
	}
    protected function __general_style_controls() {

        $this->start_controls_section(
            '_section_style_general',
            [
                'label' => __( 'General', 'langle-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Text Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-pricing-table-title,'
                    . '{{WRAPPER}} .la-pricing-table-currency,'
                    . '{{WRAPPER}} .la-pricing-table-period,'
                    . '{{WRAPPER}} .la-pricing-table-features-title,'
                    . '{{WRAPPER}} .la-pricing-table-features-list li,'
                    . '{{WRAPPER}} .la-pricing-table-price-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }
    protected function __header_style_controls() {

        $this->start_controls_section(
            '_section_style_header',
            [
                'label' => __( 'Header', 'langle-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .la-pricing-table-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-pricing-table-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .la-pricing-table-title',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_text_shadow',
                'selector' => '{{WRAPPER}} .la-pricing-table-title',
            ]
        );

        $this->end_controls_section();

    }
    protected function __price_style_controls() {

        $this->start_controls_section(
            '_section_style_pricing',
            [
                'label' => __( 'Pricing', 'langle-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_price',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Price', 'langle-addons' ),
            ]
        );

        $this->add_responsive_control(
            'price_spacing',
            [
                'label' => __( 'Bottom Spacing', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .la-pricing-table-price-tag' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Text Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-pricing-table-price-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .la-pricing-table-price-text',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_control(
            '_heading_currency',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Currency', 'langle-addons' ),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'currency_spacing',
            [
                'label' => __( 'Side Spacing', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .la-pricing-table-currency' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'currency_color',
            [
                'label' => __( 'Text Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-pricing-table-currency' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'currency_typography',
                'selector' => '{{WRAPPER}} .la-pricing-table-currency',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_control(
            '_heading_period',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Period', 'langle-addons' ),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'period_spacing',
            [
                'label' => __( 'Bottom Spacing', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .la-pricing-table-price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'period_color',
            [
                'label' => __( 'Text Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-pricing-table-period' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'period_typography',
                'selector' => '{{WRAPPER}} .la-pricing-table-period',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();

    }
    protected function __feature_style_controls() {

        $this->start_controls_section(
            '_section_style_features',
            [
                'label' => __( 'Features', 'langle-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'features_container_spacing',
            [
                'label' => __( 'Container Bottom Spacing', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .la-pricing-table-body' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_heading_features_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'langle-addons' ),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'features_title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .la-pricing-table-features-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'features_title_color',
            [
                'label' => __( 'Text Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-pricing-table-features-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_title_typography',
                'selector' => '{{WRAPPER}} .la-pricing-table-features-title',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            '_heading_features_list',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'List', 'langle-addons' ),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'features_list_spacing',
            [
                'label' => __( 'Spacing Between', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .la-pricing-table-features-list > li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'features_list_color',
            [
                'label' => __( 'Text Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-pricing-table-features-list > li' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_list_typography',
                'selector' => '{{WRAPPER}} .la-pricing-table-features-list > li',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();

    }
    protected function __style_controls_button_trait(){
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
    protected function __badge_style_controls() {

        $this->start_controls_section(
            '_section_style_badge',
            [
                'label' => __( 'Badge', 'langle-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'badge_padding',
            [
                'label' => __( 'Padding', 'langle-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .la-pricing-table-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'badge_color',
            [
                'label' => __( 'Text Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-pricing-table-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label' => __( 'Background Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-pricing-table-badge' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'badge_border',
                'selector' => '{{WRAPPER}} .la-pricing-table-badge',
            ]
        );

        $this->add_responsive_control(
            'badge_border_radius',
            [
                'label' => __( 'Border Radius', 'langle-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .la-pricing-table-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'badge_box_shadow',
                'selector' => '{{WRAPPER}} .la-pricing-table-badge',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'badge_typography',
                'label' => __( 'Typography', 'langle-addons' ),
                'selector' => '{{WRAPPER}} .la-pricing-table-badge',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();

    }

    private static function get_currency_symbol( $symbol_name ) {
        $symbols = [
            'baht' => '&#3647;',
            'bdt' => '&#2547;',
            'dollar' => '&#36;',
            'euro' => '&#128;',
            'franc' => '&#8355;',
            'guilder' => '&fnof;',
            'indian_rupee' => '&#8377;',
            'pound' => '&#163;',
            'peso' => '&#8369;',
            'peseta' => '&#8359',
            'lira' => '&#8356;',
            'ruble' => '&#8381;',
            'shekel' => '&#8362;',
            'rupee' => '&#8360;',
            'real' => 'R$',
            'krona' => 'kr',
            'won' => '&#8361;',
            'yen' => '&#165;',
        ];

        return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'badge_text', 'class',
            [
                'la-pricing-table-badge',
                'la-pricing-table-badge--' . $settings['badge_position']
            ]
        );

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'la-pricing-table-title' );

        $this->add_inline_editing_attributes( 'price', 'basic' );
        $this->add_render_attribute( 'price', 'class', 'la-pricing-table-price-text' );

        $this->add_inline_editing_attributes( 'period', 'basic' );
        $this->add_render_attribute( 'period', 'class', 'la-pricing-table-period' );

        $this->add_inline_editing_attributes( 'features_title', 'basic' );
        $this->add_render_attribute( 'features_title', 'class', 'la-pricing-table-features-title' );

        if ( $settings['currency'] === 'custom' ) {
            $currency = $settings['currency_custom'];
        } else {
            $currency = self::get_currency_symbol( $settings['currency'] );
        }
        ?>

        <?php if ( $settings['show_badge'] ) : ?>
            <span <?php $this->print_render_attribute_string( 'badge_text' ); ?>><?php echo esc_html( $settings['badge_text'] ); ?></span>
        <?php endif; ?>

        <div class="la-pricing-table-header">
            <?php if ( $settings['title'] ) : ?>
				<?php
					printf(
						'<%1$s %2$s>%3$s</%1$s>',
						langle_addons_escape_tags( $settings['title_tag'] ),
						$this->get_render_attribute_string( 'title' ),
						esc_html( langle_addons_kses_basic( $settings['title'] ) )
					);
				?>
            <?php endif; ?>
        </div>
        <div class="la-pricing-table-price">
            <div class="la-pricing-table-price-tag"><span class="la-pricing-table-currency"><?php echo esc_html( $currency ); ?></span><span <?php $this->print_render_attribute_string( 'price' ); ?>><?php echo langle_addons_kses_basic( $settings['price'] ); ?></span></div>
            <?php if ( $settings['period'] ) : ?>
                <div <?php $this->print_render_attribute_string( 'period' ); ?>><?php echo langle_addons_kses_basic( $settings['period'] ); ?></div>
            <?php endif; ?>
        </div>
        <div class="la-pricing-table-body">
            <?php if ( $settings['features_title'] ) : ?>
				<?php
					printf(
						'<%1$s %2$s>%3$s</%1$s>',
						langle_addons_escape_tags( $settings['features_title_tag'] ),
						$this->get_render_attribute_string( 'features_title' ),
						esc_html( langle_addons_kses_basic( $settings['features_title'] ) )
					);
				?>
            <?php endif; ?>

            <?php if ( is_array( $settings['features_list'] ) ) : ?>
                <ul class="la-pricing-table-features-list">
                    <?php foreach ( $settings['features_list'] as $index => $feature ) :
                        $name_key = $this->get_repeater_setting_key( 'text', 'features_list', $index );
                        $this->add_inline_editing_attributes( $name_key, 'advanced' );
                        $this->add_render_attribute( $name_key, 'class', 'la-pricing-table-feature-text' );
                        ?>
                        <li class="<?php echo esc_attr( 'elementor-repeater-item-' . $feature['_id'] ); ?>">
                            <?php if ( ! empty( $feature['icon'] ) || ! empty( $feature['selected_icon']['value'] ) ) :
                                langle_addons_render_icon( $feature, 'icon', 'selected_icon' );
                            endif; ?>
                            <div <?php $this->print_render_attribute_string( $name_key ); ?>><?php echo langle_addons_kses_intermediate( $feature['text'] ); ?></div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <?php $this->render_button(); ?>
        </div>

        <?php
    }
    
}