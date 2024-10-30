<?php
/**
 * Skills widget class
 *
 * @package Langle_Addons
 */
namespace Langle_Addons\Elementor\Widget;

use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;

defined( 'ABSPATH' ) || die();

class Skill_Bars extends Base {

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Skill Bars', 'langle-addons' );
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
        return ' eicon-skill-bar';
    }

    public function get_keywords() {
        return [ 'progress', 'skill', 'bar', 'chart' ];
    }

    /**
     * Register widget content controls
     */
	protected function register_content_controls() {

		$this->start_controls_section(
            '_section_skills',
            [
                'label' => __( 'Skills', 'langle-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __( 'Name', 'langle-addons' ),
                'default' => __( 'Design', 'langle-addons' ),
                'placeholder' => __( 'Type a skill name', 'langle-addons' ),
            ]
        );

        $repeater->add_control(
            'level',
            [
                'label' => __( 'Level (Out Of 100)', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                    'size' => 95
                ],
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'customize',
            [
                'label' => __( 'Want To Customize?', 'langle-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'langle-addons' ),
                'label_off' => __( 'No', 'langle-addons' ),
                'return_value' => 'yes',
                'description' => __( 'You can customize this skill bar color from here or customize from Style tab', 'langle-addons' ),
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'color',
            [
                'label' => __( 'Text Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .la-skill-info' => 'color: {{VALUE}};',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'level_color',
            [
                'label' => __( 'Level Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .la-skill-level' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'base_color',
            [
                'label' => __( 'Base Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.la-skill' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'skills',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print((name || level.size) ? (name || "Skill") + " - " + level.size + level.unit : "Skill - 0%") #>',
                'default' => [
                    [
                        'name' => 'Wordpress',
                        'level' => ['size' => 80, 'unit' => '%']
                    ],
                    [
                        'name' => 'PHP',
                        'level' => ['size' => 65, 'unit' => '%']
                    ],
                    [
                        'name' => 'JavaScript',
                        'level' => ['size' => 75, 'unit' => '%']
                    ],
                    [
                        'name' => 'CSS',
                        'level' => ['size' => 55, 'unit' => '%']
                    ],
                    [
                        'name' => 'Bootstrap',
                        'level' => ['size' => 87, 'unit' => '%']
                    ]
                ]
            ]
        );

        $this->add_control(
            'view',
            [
                'type' => Controls_Manager::SELECT,
                'label' => __( 'Text Position', 'langle-addons' ),
                'separator' => 'before',
                'default' => 'outside',
                'options' => [
                    'inside' => __( 'Text Inside', 'langle-addons' ),
                    'outside' => __( 'Text Outside', 'langle-addons' ),
                ],
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Register widget style controls
     */
    protected function register_style_controls() {
		$this->__bars_style_controls();
		$this->__content_style_controls();
	}
    protected function __bars_style_controls() {

		$this->start_controls_section(
            '_section_style_bars',
            [
                'label' => __( 'Skill Bars', 'langle-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'height',
            [
                'label' => __( 'Height', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-skill--outside' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .la-skill--inside' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'spacing',
            [
                'label' => __( 'Spacing Between', 'langle-addons' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => '33',
                ],
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .la-skill--outside' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .la-skill--inside:not(:first-child)' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', 'langle-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .la-skill, {{WRAPPER}} .la-skill-level' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .la-skill'
            ]
        );

        $this->end_controls_section();
	}
    protected function __content_style_controls() {

        $this->start_controls_section(
            '_section_content',
            [
                'label' => __( 'Content', 'langle-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => __( 'Text Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .la-skill-info' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'level_color',
            [
                'label' => __( 'Level Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#137D69',
                'selectors' => [
                    '{{WRAPPER}} .la-skill-level' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'base_color',
            [
                'label' => __( 'Base Color', 'langle-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#F9D781',
                'selectors' => [
                    '{{WRAPPER}} .la-skill' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_typography',
                'selector' => '{{WRAPPER}} .la-skill-info',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'info_text_shadow',
                'selector' => '{{WRAPPER}} .la-skill-info',
            ]
        );

		$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( ! is_array( $settings['skills'] ) ) {
            return;
        }

        foreach ( $settings['skills'] as $index => $skill ) :
            $name_key = $this->get_repeater_setting_key( 'name', 'bars', $index );
            $this->add_inline_editing_attributes( $name_key, 'none' );
            $this->add_render_attribute( $name_key, 'class', 'la-skill-name' );
            ?>
            <div class="la-skill la-skill--<?php echo esc_attr( $settings['view'] ); ?> elementor-repeater-item-<?php echo esc_attr( $skill['_id'] ); ?>">
                <div class="la-skill-level" data-level="<?php echo esc_attr( $skill['level']['size'] ); ?>">
                    <div class="la-skill-info"><span <?php echo $this->get_render_attribute_string( $name_key ); ?>><?php echo esc_html( $skill['name'] ); ?></span><span class="la-skill-level-text"></span></div>
                </div>
            </div>
            <?php
        endforeach;
    }

    protected function content_template() {
        ?>
        <#
        if (_.isArray(settings.skills)) {
            _.each(settings.skills, function(skill, index) {
            var nameKey = view.getRepeaterSettingKey( 'name', 'skills', index);
            view.addInlineEditingAttributes( nameKey, 'none' );
            view.addRenderAttribute( nameKey, 'class', 'la-skill-name' );
            #>
            <div class="la-skill la-skill--{{settings.view}} elementor-repeater-item-{{skill._id}}">
                <div class="la-skill-level" data-level="{{skill.level.size}}">
                    <div class="la-skill-info"><span {{{view.getRenderAttributeString( nameKey )}}}>{{skill.name}}</span><span class="la-skill-level-text"></span></div>
                </div>
            </div>
            <# });
        } #>
        <?php
    }
}