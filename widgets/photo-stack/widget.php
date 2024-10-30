<?php
/**
 * Photo Stack widget class
 *
 * @package Langle_Addons
 */
namespace Langle_Addons\Elementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Utils;

defined('ABSPATH') || die();

class Photo_Stack extends Base {

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Photo Stack', 'langle-addons');
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
        return 'eicon-image';
    }

    public function get_keywords() {
        return ['photo', 'img-box', 'photo-gallery'];
    }

    /**
     * Register widget content controls
     */
    protected function register_content_controls() {
        $this->__photo_stack_content_controls();
    }

    protected function __photo_stack_content_controls() {

        $this->start_controls_section(
            '_section_photo_stack',
            [
                'label' => __('Photo Stack', 'langle-addons'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label'   => __('Image', 'langle-addons'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                'default'   => 'medium',
                'separator' => 'before',
                'dynamic'   => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'langle-addons' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'placeholder' => 'https://example.com',
				'dynamic' => [
					'active' => true,
				]
			]
		);
        $repeater->add_responsive_control(
            'image_offset_y',
            [
                'label'      => __('Offset Y', 'langle-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .la-photo-stack-item{{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'image_offset_x',
            [
                'label'      => __('Offset X', 'langle-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .la-photo-stack-item{{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'image_z_index',
            [
                'label'     => __('Z-Index', 'langle-addons'),
                'type'      => Controls_Manager::NUMBER,
                'min'       => -1000,
                'max'       => 1000,
                'step'      => 1,
                'selectors' => [
                    '{{WRAPPER}} .la-photo-stack-item{{CURRENT_ITEM}}' => 'z-index: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'image_list',
            [
                'show_label'  => true,
                'label'       => __('Items', 'langle-addons'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                'default'     => [
                    [
                        'image'                      => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'thumbnail_size'             => 'custom',
                        'thumbnail_custom_dimension' => [
                            'width'  => 200,
                            'height' => 200,
                        ],
                        'image_offset_y'             => [
                            'size' => 0,
                            'unit' => 'px',
                        ],
                        'image_offset_x'             => [
                            'size' => 35,
                            'unit' => 'px',
                        ],
                    ],
                    [
                        'image'                      => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'thumbnail_size'             => 'custom',
                        'thumbnail_custom_dimension' => [
                            'width'  => 300,
                            'height' => 300,
                        ],
                        'image_offset_y'             => [
                            'size' => 250,
                            'unit' => 'px',
                        ],
                        'image_offset_x'             => [
                            'size' => 0,
                            'unit' => 'px',
                        ],
                    ],
                    [
                        'image'                      => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'thumbnail_size'             => 'custom',
                        'thumbnail_custom_dimension' => [
                            'width'  => 500,
                            'height' => 400,
                        ],
                        'image_offset_y'             => [
                            'size' => 100,
                            'unit' => 'px',
                        ],
                        'image_offset_x'             => [
                            'size' => 180,
                            'unit' => 'px',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'image_infinite_animation',
            [
                'label'     => __('Infinite Animation', 'langle-addons'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    ''                    => __('None', 'langle-addons'),
                    'la-bounce'           => __('Bounce', 'langle-addons'),
                    'la-bounce-sm'        => __('Bounce Small', 'langle-addons'),
                    'la-bounce-md'        => __('Bounce Medium', 'langle-addons'),
                    'la-bounce-lg'        => __('Bounce Large', 'langle-addons'),
                    'la-fade'             => __('Fade', 'langle-addons'),
                    'la-rotating'         => __('Rotating', 'langle-addons'),
                    'la-rotating-inverse' => __('Rotating inverse', 'langle-addons'),
                    'la-scale-sm'         => __('Scale Small', 'langle-addons'),
                    'la-scale-md'         => __('Scale Medium', 'langle-addons'),
                    'la-scale-lg'         => __('Scale Large', 'langle-addons'),
                ],
                'default'   => 'la-bounce-sm',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'hover_animation_style',
            [
                'label'     => __('Hover Animation', 'langle-addons'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'none'             => __('None', 'langle-addons'),
                    'fly-sm'           => __('Fly Small', 'langle-addons'),
                    'fly'              => __('Fly Medium', 'langle-addons'),
                    'fly-lg'           => __('Fly Large', 'langle-addons'),
                    'scale-sm'         => __('Scale Small', 'langle-addons'),
                    'scale'            => __('Scale Medium', 'langle-addons'),
                    'scale-lg'         => __('Scale Large', 'langle-addons'),
                    'scale-inverse-sm' => __('Scale Inverse Small', 'langle-addons'),
                    'scale-inverse'    => __('Scale Inverse Medium', 'langle-addons'),
                    'scale-inverse-lg' => __('Scale Inverse Large', 'langle-addons'),
                ],
                'default'   => 'scale-sm',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'animation_speed',
            [
                'label'       => __('Animation speed', 'langle-addons'),
                'description' => __('Please set your animation speed in seconds. Default value is 6s.', 'langle-addons'),
                'type'        => Controls_Manager::NUMBER,
                'min'         => 0,
                'max'         => 100,
                'step'        => 1,
                'default'     => 6,
                'selectors'   => [
                    '{{WRAPPER}} .la-photo-stack-wrapper' => '--animation_speed:{{SIZE}}s',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_container_align',
            [
                'label'     => __('Alignment', 'langle-addons'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __('Left', 'langle-addons'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'langle-addons'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'langle-addons'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'toggle'    => true,
                'default'   => 'center',
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Register widget style controls
     */
    protected function register_style_controls() {
        $this->__photo_stack_style_controls();
    }

    protected function __photo_stack_style_controls() {

        $this->start_controls_section(
            '_section_photo_stack_style',
            [
                'label' => __('Common', 'langle-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_container_width',
            [
                'label'          => __('Width', 'langle-addons'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'size' => 550,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => ['px', '%', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 2000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .la-photo-stack-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_container_height',
            [
                'label'      => __('Minimum Height', 'langle-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh', 'em'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'size' => 550,
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .la-photo-stack-wrapper' => 'min-height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_layers_overflow',
            [
                'label'     => __('Overflow', 'langle-addons'),
                'type'      => Controls_Manager::SELECT,
                'options'   => array(
                    'visible' => __('Visible', 'langle-addons'),
                    'hidden'  => __('Hidden', 'langle-addons'),
                    'scroll'  => __('Scroll', 'langle-addons'),
                ),
                'default'   => 'visible',
                'selectors' => array(
                    '{{WRAPPER}} .la-photo-stack-wrapper' => 'overflow: {{VALUE}}',
                ),
            ]
        );
        $this->add_control(
			'hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
        $this->start_controls_tabs('tabs_hover_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __('Normal', 'langle-addons'),
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'img_box_shadow',
                'label'    => __('Box Shadow', 'langle-addons'),
                'selector' => '{{WRAPPER}} .la-photo-stack-item img',

            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __('Hover', 'langle-addons'),
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'img_box_shadow_hover',
                'label'    => __('Box Shadow Hover', 'langle-addons'),
                'selector' => '{{WRAPPER}} .la-photo-stack-item img:hover',

            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'border',
                'label'     => __('Border', 'langle-addons'),
                'selector'  => '{{WRAPPER}} .la-photo-stack-item img',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __('Border Radius', 'langle-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
                    'top'    => 5,
                    'right'  => 5,
                    'bottom' => 5,
                    'left'   => 5,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .la-photo-stack-item'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .la-photo-stack-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * @return null
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        if ( empty( $settings['image_list'] ) ) {
            return;
        }
        ?>

        <div class="la-photo-stack-wrapper">
			<?php foreach ( $settings['image_list'] as $index => $item ):
                $image         = wp_get_attachment_image_url( $item['image']['id'], $item['thumbnail_size'] );
                $repeater_key  = 'la_ps_item' . $index;
                $dynamic_class = 'elementor-repeater-item-' . $item['_id'];
                $tag           = 'div';
                $this->add_render_attribute( $repeater_key, 'class', 'la-photo-stack-item' );
                $this->add_render_attribute( $repeater_key, 'class', $dynamic_class );
                $this->add_render_attribute( $repeater_key, 'class', $settings['image_infinite_animation'] );
                $this->add_render_attribute( 'image', 'class', $settings['hover_animation_style'] );
                $this->add_render_attribute( 'image', 'class', 'la-photo-stack-img' ); ?>
                <?php if ( isset( $item['link'] ) && ! empty( $item['link']['url'] ) ) :
                    $anchor_tag = 'a';
                    $this->add_link_attributes( 'link_tag', $item['link'] );
                endif; ?>
				<<?php echo esc_attr( $tag ); ?> <?php $this->print_render_attribute_string( $repeater_key );?>>

					<?php if ($image): ?>
                        <?php if ( ! empty( $item['link']['url'] ) ) : ?>
                            <<?php echo esc_attr( $anchor_tag ); ?> <?php $this->print_render_attribute_string( 'link_tag' );?>>
                        <?php endif; ?>

                        <?php echo '<img src="' . Group_Control_Image_Size::get_attachment_image_src( $item['image']['id'], 'thumbnail', $item ) . '" ' . $this->get_render_attribute_string('image') . '/>'; ?>

                    <?php else: ?>
                        <?php echo $this->image_placeholder( $item, $this->get_render_attribute_string( 'image' ) ); // XSS OK ?>
                    <?php endif; ?>

                    <?php if ( ! empty( $item['link']['url'] ) ) : ?>
                        </<?php echo esc_attr( $anchor_tag ); ?>>
                    <?php endif; ?>

	            </<?php echo esc_attr( $tag ); ?>>

            <?php endforeach;?>
        </div>

		<?php
    }

    /**
     * @param $item
     * @param $attr
     */
    protected function image_placeholder($item, $attr = null) {
        if ('custom' !== $item['thumbnail_size']) {
            $width  = get_option($item['thumbnail_size'] . '_size_w');
            $height = get_option($item['thumbnail_size'] . '_size_h');
            $height = '0' == $height ? 'auto' : $height . 'px';
        } else {
            $width  = $item['thumbnail_custom_dimension']['width'];
            $height = $item['thumbnail_custom_dimension']['height'];
            $height = '0' == $height ? 'auto' : $height . 'px';
        }
        echo '<img src="' . esc_url( $item['image']['url'] ) . '" style="width: ' . esc_attr( $width ) . 'px; height: ' . esc_attr( $height ) . ';" ' . esc_attr( $attr ) . '/>';
    }

}