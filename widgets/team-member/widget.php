<?php
/**
 * Team Member widget class
 *
 * @package Langle_Addons
 */
namespace Langle_Addons\Elementor\Widget;

use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;
use Langle_Addons\Elementor\Traits\Button_Renderer;

defined( 'ABSPATH' ) || die();

class Team_Member extends Base {

	use Button_Renderer;

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Team Member', 'langle-addons' );
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
		return 'eicon-user-circle-o';
	}

	public function get_keywords() {
		return [ 'team', 'member', 'crew', 'staff', 'person' ];
	}

	public function get_style_depends() {
		return [
			'elementor-icons-fa-solid',
			'elementor-icons-fa-brands',
		];
	}

	protected static function get_profile_names() {
		return [
			'500px'          => __( '500px', 'langle-addons' ),
			'apple'          => __( 'Apple', 'langle-addons' ),
			'behance'        => __( 'Behance', 'langle-addons' ),
			'bitbucket'      => __( 'BitBucket', 'langle-addons' ),
			'codepen'        => __( 'CodePen', 'langle-addons' ),
			'delicious'      => __( 'Delicious', 'langle-addons' ),
			'deviantart'     => __( 'DeviantArt', 'langle-addons' ),
			'digg'           => __( 'Digg', 'langle-addons' ),
			'dribbble'       => __( 'Dribbble', 'langle-addons' ),
			'email'          => __( 'Email', 'langle-addons' ),
			'phone'          => __( 'Phone', 'langle-addons' ),
			'facebook'       => __( 'Facebook', 'langle-addons' ),
			'flickr'         => __( 'Flicker', 'langle-addons' ),
			'foursquare'     => __( 'FourSquare', 'langle-addons' ),
			'github'         => __( 'Github', 'langle-addons' ),
			'houzz'          => __( 'Houzz', 'langle-addons' ),
			'instagram'      => __( 'Instagram', 'langle-addons' ),
			'jsfiddle'       => __( 'JS Fiddle', 'langle-addons' ),
			'linkedin'       => __( 'LinkedIn', 'langle-addons' ),
			'medium'         => __( 'Medium', 'langle-addons' ),
			'pinterest'      => __( 'Pinterest', 'langle-addons' ),
			'product-hunt'   => __( 'Product Hunt', 'langle-addons' ),
			'reddit'         => __( 'Reddit', 'langle-addons' ),
			'slideshare'     => __( 'Slide Share', 'langle-addons' ),
			'snapchat'       => __( 'Snapchat', 'langle-addons' ),
			'soundcloud'     => __( 'SoundCloud', 'langle-addons' ),
			'spotify'        => __( 'Spotify', 'langle-addons' ),
			'stack-overflow' => __( 'StackOverflow', 'langle-addons' ),
			'tripadvisor'    => __( 'TripAdvisor', 'langle-addons' ),
			'tumblr'         => __( 'Tumblr', 'langle-addons' ),
			'twitch'         => __( 'Twitch', 'langle-addons' ),
			'twitter'        => __( 'Twitter', 'langle-addons' ),
			'vimeo'          => __( 'Vimeo', 'langle-addons' ),
			'vk'             => __( 'VK', 'langle-addons' ),
			'website'        => __( 'Website', 'langle-addons' ),
			'whatsapp'       => __( 'WhatsApp', 'langle-addons' ),
			'wordpress'      => __( 'WordPress', 'langle-addons' ),
			'xing'           => __( 'Xing', 'langle-addons' ),
			'yelp'           => __( 'Yelp', 'langle-addons' ),
			'youtube'        => __( 'YouTube', 'langle-addons' ),
		];
	}

    /**
	 * Register widget content controls
	 */
	protected function register_content_controls() {
		$this->__info_content_controls();
		$this->__social_content_controls();
		$this->__details_content_controls();
	}

    protected function __info_content_controls() {

		$this->start_controls_section(
			'_section_info',
			[
				'label' => __( 'Information', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->start_controls_tabs( '_tabs_photo' );

		$this->start_controls_tab(
			'_tab_photo_normal',
			[
				'label' => __( 'Normal', 'langle-addons' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label'      => __( 'Photo', 'langle-addons' ),
				'show_label' => false,
				'type'       => Controls_Manager::MEDIA,
				'default'    => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic'    => [
					'active' => true,
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_photo_hover',
			[
				'label' => __( 'Hover', 'langle-addons' ),
			]
		);

		$this->add_control(
			'image2',
			[
				'label'      => __( 'Photo 2', 'langle-addons' ),
				'show_label' => false,
				'type'       => Controls_Manager::MEDIA,
				'dynamic'    => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'extra_hover_cls',
			[
				'label'        => __( 'Extra class added', 'langle-addons' ),
				'type'         => Controls_Manager::HIDDEN,
				'default'      => 'on',
				'prefix_class' => 'la-team-member-hover-image-',
				'condition'    => [
					'image2[url]!' => '',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'large',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => __( 'Name', 'langle-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Team Member Name',
				'placeholder' => __( 'Type Team Member Name', 'langle-addons' ),
				'separator'   => 'before',
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'job_title',
			[
				'label'       => __( 'Job Title', 'langle-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Team Member Job Title', 'langle-addons' ),
				'placeholder' => __( 'Team Member Job Title', 'langle-addons' ),
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'bio',
			[
				'label'       => __( 'Short Bio', 'langle-addons' ),
				'description' => langle_addons_get_allowed_html_desc( 'intermediate' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'langle-addons' ),
				'placeholder' => __( 'Write something awesome about the Team member', 'langle-addons' ),
				'rows'        => 5,
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'     => __( 'Title HTML Tag', 'langle-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
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
				'default'   => 'h2',
				'toggle'    => false,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'     => __( 'Alignment', 'langle-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'	=> 'center',
				'options'   => [
					'left'    => [
						'title' => __( 'Left', 'langle-addons' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => __( 'Center', 'langle-addons' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => __( 'Right', 'langle-addons' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justify', 'langle-addons' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

    protected function __social_content_controls() {

		$this->start_controls_section(
			'_section_social',
			[
				'label' => __( 'Social Profiles', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'name',
			[
				'label'          => __( 'Profile Name', 'langle-addons' ),
				'type'           => Controls_Manager::SELECT2,
				'label_block'    => true,
				'select2options' => [
					'allowClear' => false,
				],
				'options'        => self::get_profile_names(),
			]
		);

		$repeater->add_control(
			'link', [
				'label'         => __( 'Profile Link', 'langle-addons' ),
				'placeholder'   => __( 'Add your profile link', 'langle-addons' ),
				'type'          => Controls_Manager::URL,
				'label_block'   => true,
				'autocomplete'  => false,
				'show_external' => false,
				'condition'     => [
					'name!' => ['email','phone'],
				],
				'dynamic'       => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'email', [
				'label'       => __( 'Email Address', 'langle-addons' ),
				'placeholder' => __( 'Add your email address', 'langle-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'input_type'  => 'email',
				'condition'   => [
					'name' => 'email',
				],
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'phone', [
				'label'       => __( 'Phone Number', 'langle-addons' ),
				'placeholder' => __( 'Add your phone number', 'langle-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'input_type'  => 'text',
				'condition'   => [
					'name' => 'phone',
				],
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'customize',
			[
				'label'          => __( 'Want To Customize?', 'langle-addons' ),
				'type'           => Controls_Manager::SWITCHER,
				'label_on'       => __( 'Yes', 'langle-addons' ),
				'label_off'      => __( 'No', 'langle-addons' ),
				'return_value'   => 'yes',
				'style_transfer' => true,
			]
		);

		$repeater->start_controls_tabs(
			'_tab_icon_colors',
			[
				'condition' => ['customize' => 'yes'],
			]
		);
		$repeater->start_controls_tab(
			'_tab_icon_normal',
			[
				'label' => __( 'Normal', 'langle-addons' ),
			]
		);

		$repeater->add_control(
			'color',
			[
				'label'          => __( 'Text Color', 'langle-addons' ),
				'type'           => Controls_Manager::COLOR,
				'selectors'      => [
					'{{WRAPPER}} .la-team-member-links > {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
				],
				'condition'      => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'bg_color',
			[
				'label'          => __( 'Background Color', 'langle-addons' ),
				'type'           => Controls_Manager::COLOR,
				'selectors'      => [
					'{{WRAPPER}} .la-team-member-links > {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
				],
				'condition'      => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'_tab_icon_hover',
			[
				'label' => __( 'Hover', 'langle-addons' ),
			]
		);

		$repeater->add_control(
			'hover_color',
			[
				'label'          => __( 'Text Color', 'langle-addons' ),
				'type'           => Controls_Manager::COLOR,
				'selectors'      => [
					'{{WRAPPER}} .la-team-member-links > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .la-team-member-links > {{CURRENT_ITEM}}:focus' => 'color: {{VALUE}}',
				],
				'condition'      => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'hover_bg_color',
			[
				'label'          => __( 'Background Color', 'langle-addons' ),
				'type'           => Controls_Manager::COLOR,
				'selectors'      => [
					'{{WRAPPER}} .la-team-member-links > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .la-team-member-links > {{CURRENT_ITEM}}:focus' => 'background-color: {{VALUE}}',
				],
				'condition'      => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'hover_border_color',
			[
				'label'          => __( 'Border Color', 'langle-addons' ),
				'type'           => Controls_Manager::COLOR,
				'selectors'      => [
					'{{WRAPPER}} .la-team-member-links > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .la-team-member-links > {{CURRENT_ITEM}}:focus' => 'border-color: {{VALUE}}',
				],
				'condition'      => ['customize' => 'yes'],
				'style_transfer' => true,
			]
		);

		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

		$this->add_control(
			'profiles',
			[
				'show_label'  => false,
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
				'default'     => [
					[
						'link' => ['url' => 'https://facebook.com/'],
						'name' => 'facebook',
					],
					[
						'link' => ['url' => 'https://twitter.com/'],
						'name' => 'twitter',
					],
					[
						'link' => ['url' => 'https://linkedin.com/'],
						'name' => 'linkedin',
					],
				],
			]
		);

		$this->add_control(
			'show_profiles',
			[
				'label'          => __( 'Show Profiles', 'langle-addons' ),
				'type'           => Controls_Manager::SWITCHER,
				'label_on'       => __( 'Show', 'langle-addons' ),
				'label_off'      => __( 'Hide', 'langle-addons' ),
				'return_value'   => 'yes',
				'default'        => 'yes',
				'separator'      => 'before',
				'style_transfer' => true,
			]
		);

		$this->end_controls_section();
	}

    protected function __details_content_controls() {

		$this->start_controls_section(
			'_section_button',
			[
				'label' => __( 'Details Button', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_details_button',
			[
				'label'          => __( 'Show Button', 'langle-addons' ),
				'type'           => Controls_Manager::SWITCHER,
				'label_on'       => __( 'Show', 'langle-addons' ),
				'label_off'      => __( 'Hide', 'langle-addons' ),
				'return_value'   => 'yes',
				'default'        => '',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'button_position',
			[
				'label'          => __( 'Position', 'langle-addons' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => 'after',
				'style_transfer' => true,
				'options'        => [
					'before' => __( 'Before Social Icons', 'langle-addons' ),
					'after'  => __( 'After Social Icons', 'langle-addons' ),
				],
				'condition'      => [
					'show_details_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'       => __( 'Text', 'langle-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Show Details', 'langle-addons' ),
				'placeholder' => __( 'Type button text here', 'langle-addons' ),
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
				'condition'   => [
					'show_details_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_link',
			[
				'label'       => __( 'Link', 'langle-addons' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://example.com',
				'dynamic'     => [
					'active' => true,
				],
				'default'     => [
					'url' => '#',
				],
				'condition'   => [
					'show_details_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label'       => __( 'Icon', 'langle-addons' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => false,
				'show_label'  => true,
				'skin'        => 'inline',
				'condition'   => [
					'show_details_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_icon_position',
			[
				'label'          => __( 'Icon Position', 'langle-addons' ),
				'type'           => Controls_Manager::CHOOSE,
				'label_block'    => false,
				'options'        => [
					'before' => [
						'title' => __( 'Before', 'langle-addons' ),
						'icon'  => 'eicon-h-align-left',
					],
					'after'  => [
						'title' => __( 'After', 'langle-addons' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'        => 'after',
				'toggle'         => false,
				'style_transfer' => true,
				'condition'      => [
					'show_details_button' => 'yes',
					'button_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'button_icon_spacing',
			[
				'label'     => __( 'Icon Spacing', 'langle-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 10,
				],
				'condition' => [
					'show_details_button' => 'yes',
					'button_icon[value]!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .la-btn--icon-before .la-btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .la-btn--icon-after .la-btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

    
	/**
	 * Register widget style controls
	 */
	protected function register_style_controls() {
		$this->__photo_style_controls();
		$this->__body_content_style_controls();
		$this->__social_style_controls();
		$this->__details_style_controls();

	}

    protected function __photo_style_controls() {

		$this->start_controls_section(
			'_section_style_image',
			[
				'label' => __( 'Photo', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label'      => __( 'Width', 'langle-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'unit'	 => 'px',
					'size'	 => '180',
				],
				'size_units' => [ 'px', '%'],
				'range'      => [
					'%'  => [
						'min' => 20,
						'max' => 100,
					],
					'px' => [
						'min' => 100,
						'max' => 700,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .la-team-member-figure' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label'      => __( 'Height', 'langle-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'unit'	 => 'px',
					'size'	 => '180',
				],
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 100,
						'max' => 700,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .la-team-member-figure' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'langle-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .la-team-member-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'image_padding',
			[
				'label'      => __( 'Padding', 'langle-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'unit'	 => 'px',
					'top'	 => '10',
					'right'	 => '10',
					'bottom' => '10',
					'left'	 => '10',
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .la-team-member-figure img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'image_border',
				'selector' => '{{WRAPPER}} .la-team-member-figure img',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label'      => __( 'Border Radius', 'langle-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'unit'	 => '%',
					'top'	 => '50',
					'right'	 => '50',
					'bottom' => '50',
					'left'	 => '50',
				],
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .la-team-member-figure img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'image_box_shadow',
				'exclude'  => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .la-team-member-figure img',
			]
		);

		$this->add_control(
			'image_bg_color',
			[
				'label'     => __( 'Background Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#DCDCDC',
				'selectors' => [
					'{{WRAPPER}} .la-team-member-figure img' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs(
			'_tabs_img_effects', [
				'condition' => [
					'image2[url]' => '',
				],
			]
		);

		$this->start_controls_tab(
			'_tab_img_effects_normal',
			[
				'label' => __( 'Normal', 'langle-addons' ),
			]
		);

		$this->add_control(
			'img_opacity',
			[
				'label'     => __( 'Opacity', 'langle-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max'  => 1,
						'min'  => 0,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .la-team-member-figure img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'img_css_filters',
				'selector' => '{{WRAPPER}} .la-team-member-figure img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_img_effects_hover',
			[
				'label' => __( 'Hover', 'langle-addons' ),
			]
		);

		$this->add_control(
			'img_hover_opacity',
			[
				'label'     => __( 'Opacity', 'langle-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max'  => 1,
						'min'  => 0,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .la-team-member-figure:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'img_hover_css_filters',
				'selector' => '{{WRAPPER}} .la-team-member-figure:hover img',
			]
		);

		$this->add_control(
			'img_hover_transition',
			[
				'label'     => __( 'Transition Duration', 'langle-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max'  => 3,
						'step' => 0.1,
					],
				],
				'default'   => [
					'size' => .2,
				],
				'selectors' => [
					'{{WRAPPER}} .la-team-member-figure img' => 'transition-duration: {{SIZE}}s;',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

    protected function __body_content_style_controls() {

		$this->start_controls_section(
			'_section_style_content',
			[
				'label' => __( 'Name, Job Title & Bio', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => __( 'Content Padding', 'langle-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .la-team-member-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'_heading_title',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Name', 'langle-addons' ),
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'langle-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'default'	 => [
					'unit'	 => 'px',
					'size'	 => '10',
				],
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .la-team-member-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Text Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '#151515',
				'selectors' => [
					'{{WRAPPER}} .la-team-member-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .la-team-member-name',
				'scheme'   => Typography::TYPOGRAPHY_2,
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .la-team-member-name',
			]
		);

		$this->add_control(
			'_heading_job_title',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Job Title', 'langle-addons' ),
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'job_title_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'langle-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'default'	 => [
					'unit'	 => 'px',
					'size'	 => '10',
				],
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .la-team-member-position' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'job_title_color',
			[
				'label'     => __( 'Text Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '#8D8D8D',
				'selectors' => [
					'{{WRAPPER}} .la-team-member-position' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'job_title_typography',
				'selector' => '{{WRAPPER}} .la-team-member-position',
				'scheme'   => Typography::TYPOGRAPHY_3,
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'job_title_text_shadow',
				'selector' => '{{WRAPPER}} .la-team-member-position',
			]
		);

		$this->add_control(
			'_heading_bio',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Short Bio', 'langle-addons' ),
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'bio_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'langle-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .la-team-member-bio' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'bio_color',
			[
				'label'     => __( 'Text Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-team-member-bio' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'bio_typography',
				'selector' => '{{WRAPPER}} .la-team-member-bio',
				'scheme'   => Typography::TYPOGRAPHY_3,
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'bio_text_shadow',
				'selector' => '{{WRAPPER}} .la-team-member-bio',
			]
		);

		$this->end_controls_section();
	}

    protected function __social_style_controls() {

		$this->start_controls_section(
			'_section_style_social',
			[
				'label' => __( 'Social Icons', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'links_spacing',
			[
				'label'      => __( 'Right Spacing', 'langle-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .la-team-member-links > a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'links_padding',
			[
				'label'      => __( 'Padding', 'langle-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'default'	 => [
					'unit'	 => 'px',
					'size'	 => '10',
				],
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .la-team-member-links > a' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'links_icon_size',
			[
				'label'      => __( 'Icon Size', 'langle-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .la-team-member-links > a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'links_border',
				'selector' => '{{WRAPPER}} .la-team-member-links > a',
			]
		);

		$this->add_responsive_control(
			'links_border_radius',
			[
				'label'      => __( 'Border Radius', 'langle-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'	 => [
					'unit'	 => '%',
					'top'	 => '50',
					'right'	 => '50',
					'bottom' => '50',
					'left'	 => '50',
				],
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .la-team-member-links > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( '_tab_links_colors' );
		$this->start_controls_tab(
			'_tab_links_normal',
			[
				'label' => __( 'Normal', 'langle-addons' ),
			]
		);

		$this->add_control(
			'links_color',
			[
				'label'     => __( 'Text Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-team-member-links > a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'links_bg_color',
			[
				'label'     => __( 'Background Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '#CECECE',
				'selectors' => [
					'{{WRAPPER}} .la-team-member-links > a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'_tab_links_hover',
			[
				'label' => __( 'Hover', 'langle-addons' ),
			]
		);

		$this->add_control(
			'links_hover_color',
			[
				'label'     => __( 'Text Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-team-member-links > a:hover, {{WRAPPER}} .la-team-member-links > a:focus' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'links_hover_bg_color',
			[
				'label'     => __( 'Background Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-team-member-links > a:hover, {{WRAPPER}} .la-team-member-links > a:focus' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'links_hover_border_color',
			[
				'label'     => __( 'Border Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-team-member-links > a:hover, {{WRAPPER}} .la-team-member-links > a:focus' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'links_border_border!' => '',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

    protected function __details_style_controls() {

		$this->start_controls_section(
			'_section_style_button',
			[
				'label' => __( 'Details Button', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label'      => __( 'Margin', 'langle-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .la-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => __( 'Padding', 'langle-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .la-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .la-btn',
				'scheme'   => Typography::TYPOGRAPHY_4,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'button_border',
				'selector' => '{{WRAPPER}} .la-btn',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'      => __( 'Border Radius', 'langle-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .la-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .la-btn',
			]
		);

		$this->add_control(
			'hr',
			[
				'type'  => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->start_controls_tabs( '_tabs_button' );
		$this->start_controls_tab(
			'_tab_button_normal',
			[
				'label' => __( 'Normal', 'langle-addons' ),
			]
		);

		$this->add_control(
			'button_color',
			[
				'label'     => __( 'Text Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .la-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label'     => __( 'Background Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_button_hover',
			[
				'label' => __( 'Hover', 'langle-addons' ),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'     => __( 'Text Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-btn:hover, {{WRAPPER}} .la-btn:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label'     => __( 'Background Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-btn:hover, {{WRAPPER}} .la-btn:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => __( 'Border Color', 'langle-addons' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'button_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .la-btn:hover, {{WRAPPER}} .la-btn:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

    protected function get_post_template( $term = 'page' ) {
		$posts = get_posts(
			[
				'post_type'      => 'elementor_library',
				'orderby'        => 'title',
				'order'          => 'ASC',
				'posts_per_page' => '-1',
				'tax_query'      => [
					[
						'taxonomy' => 'elementor_library_type',
						'field'    => 'slug',
						'terms'    => $term,
					],
				],
			]
		);

		$templates = [];
		foreach ( $posts as $post ) {
			$templates[] = [
				'id'   => $post->ID,
				'name' => $post->post_title,
			];
		}
		return $templates;
	}

    protected function get_saved_content( $term = 'section' ) {
		$saved_contents = $this->get_post_template( $term );

		if ( count( $saved_contents ) > 0 ) {
			$options['0'] = __( 'None', 'langle-addons' );
			foreach ( $saved_contents as $saved_content ) {
				$content_id             = $saved_content['id'];
				$options[ $content_id ] = $saved_content['name'];
			}
		} else {
			$options['no_template'] = __( 'Nothing Found', 'langle-addons' );
		}
		return $options;
	}

    protected function render() {
		$settings = $this->get_settings_for_display();

		$button_position = ! empty( $settings['button_position'] ) ? $settings['button_position'] : 'after';

		$show_button = false;
		if ( ! empty( $settings['show_details_button'] ) && $settings['show_details_button'] === 'yes' ) {
			$show_button = true;
		}

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_render_attribute( 'title', 'class', 'la-team-member-name' );

		$this->add_inline_editing_attributes( 'job_title', 'basic' );
		$this->add_render_attribute( 'job_title', 'class', 'la-team-member-position' );

		$this->add_inline_editing_attributes( 'bio', 'advanced' );
		$this->add_render_attribute( 'bio', 'class', 'la-team-member-bio' );
		?>

		<?php if ( $settings['image']['url'] || $settings['image']['id'] ) :
			$settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
			?>
			<figure class="la-team-member-figure">
				<?php
					echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );
				if ( $settings['image2']['url'] || $settings['image2']['id'] ) {
					echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image2' );
				}
				?>
			</figure>
		<?php endif; ?>

		<div class="la-team-member-body">
			<?php if ( $settings['title'] ) :
				printf( '<%1$s %2$s>%3$s</%1$s>',
					langle_addons_escape_tags( $settings['title_tag'], 'h2' ),
					$this->get_render_attribute_string( 'title' ),
					langle_addons_kses_basic( $settings['title'] )
				);
			endif; ?>

			<?php if ( $settings['job_title'] ) : ?>
				<div <?php $this->print_render_attribute_string( 'job_title' ); ?>><?php echo langle_addons_kses_basic( $settings['job_title'] ); ?></div>
			<?php endif; ?>

			<?php if ( $settings['bio'] ) : ?>
				<div <?php $this->print_render_attribute_string( 'bio' ); ?>>
					<p><?php echo langle_addons_kses_intermediate( $settings['bio'] ); ?></p>
				</div>
			<?php endif; ?>

			<?php
			if ( $show_button && $button_position === 'before' ) {
				$this->render_icon_button( [ 'new_icon' => 'button_icon', 'old_icon' => '' ] );
			}
			?>

			<?php if ( $settings['show_profiles'] && is_array( $settings['profiles'] ) ) : ?>
				<div class="la-team-member-links">
					<?php
					foreach ( $settings['profiles'] as $profile ) :
						$icon = $profile['name'];
						$url  = isset( $profile['link']['url'] ) ? $profile['link']['url'] : '';

						if ( 'website' === $profile['name'] ) {
							$icon = 'globe far';
						} elseif ( 'email' === $profile['name'] ) {
							$icon = 'envelope far';
							$url  = 'mailto:' . antispambot( $profile['email'] );
						} elseif ( 'phone' === $profile['name'] ) {
							$icon = 'phone-alt fas';
							$url  = 'tel:' . esc_html( $profile['phone'] );
						} else {
							$icon .= ' fab';
						}

						printf( '<a target="_blank" rel="noopener" href="%s" class="elementor-repeater-item-%s"><i class="fa fa-%s" aria-hidden="true"></i></a>',
							esc_url( $url ),
							esc_attr( $profile['_id'] ),
							esc_attr( $icon )
						);
					endforeach; ?>
				</div>
			<?php endif; ?>

			<?php
			if ( $show_button && $button_position === 'after' ) {
				$this->render_icon_button( [ 'new_icon' => 'button_icon', 'old_icon' => '' ] );
			}
			?>
		</div>
		<?php
	}
}