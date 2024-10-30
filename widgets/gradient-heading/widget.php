<?php
/**
 * Gradient Heading widget class
 *
 * @package Langle_Addons
 */
namespace Langle_Addons\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Langle_Addons\Elementor\Controls\Group_Control_Foreground;

defined( 'ABSPATH' ) || die();

class Gradient_Heading extends Base {

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Gradient Heading', 'langle-addons' );
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
		return 'eicon-heading';
	}

	public function get_keywords() {
		return [ 'gradient', 'advanced', 'heading', 'title', 'colorful' ];
	}

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {

        $this->start_controls_section(
			'_section_title',
			[
				'label' => __( 'Title', 'langle-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'langle-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Langle Gradient Heading',
				'placeholder' => __( 'Type Gradient Heading Text', 'langle-addons' ),
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
				'separator' => 'before',
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

    /**
     * Register widget style controls
     */
	protected function register_style_controls() {

        $this->start_controls_section(
			'_section_style_title',
			[
				'label' => __( 'Title', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Foreground::get_type(),
			[
				'name' => 'title',
				'selector' => '{{WRAPPER}} .la-gradient-heading-text',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title',
				'selector' => '{{WRAPPER}} .la-gradient-heading-text',
				'scheme' => Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title',
				'label' => __( 'Text Shadow', 'langle-addons' ),
				'selector' => '{{WRAPPER}} .la-gradient-heading-text',
			]
		);

		$this->add_control(
			'blend_mode',
			[
				'label' => __( 'Blend Mode', 'langle-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'normal',
				'options' => langle_addons_get_css_blend_modes(),
				'selectors' => [
					'{{WRAPPER}} .la-gradient-heading-text' => 'mix-blend-mode: {{VALUE}};',
				],
				'separator' => 'none',
			]
		);

		$this->end_controls_section();
    }

    protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_render_attribute( 'title', 'class', 'la-gradient-heading-text' );

		$title = langle_addons_kses_basic( $settings['title' ] );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'link', $settings['link'] );

			$title = sprintf( '<a %1$s>%2$s</a>',
				$this->get_render_attribute_string( 'link' ),
				$title
				);
		}

		printf( '<%1$s %2$s>%3$s</%1$s>',
			langle_addons_escape_tags( $settings['title_tag'], 'h2' ),
			$this->get_render_attribute_string( 'title' ),
			$title
		);
	}

    public function content_template() {
		?>
		<#
		view.addInlineEditingAttributes( 'title', 'basic' );
		view.addRenderAttribute( 'title', 'class', 'la-gradient-heading-text' );

		var title = _.isEmpty(settings.link.url) ? settings.title : '<a href="'+settings.link.url+'">'+settings.title+'</a>';
		#>
		<{{ settings.title_tag }} {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ title }}}</{{ settings.title_tag }}>
		<?php
	}
}