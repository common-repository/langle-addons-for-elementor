<?php
/**
 * Review widget class
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

defined( 'ABSPATH' ) || die();

class Review extends Base {

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Review', 'langle-addons' );
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
		return 'eicon-review';
	}

	public function get_keywords() {
		return [ 'review', 'comment', 'feedback', 'testimonial' ];
	}

	/**
     * Register widget content controls
     */
	protected function register_content_controls() {

		$this->__review_content_controls();
		$this->__reviewer_content_controls();

	}

    protected function __review_content_controls() {

        $this->start_controls_section(
			'_section_review',
			[
				'label' => __( 'Review', 'langle-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'ratting',
			[
				'label' => __( 'Rating', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => 4.2,
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5,
						'step' => .5,
					],
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'ratting_style',
			[
				'label' => __( 'Rating Style', 'langle-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'star' => __( 'Star', 'langle-addons' ),
					'num' => __( 'Number', 'langle-addons' ),
				],
				'default' => 'star',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'review',
			[
				'label' => __( 'Review', 'langle-addons' ),
				'description' => langle_addons_get_allowed_html_desc( 'intermediate' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is most popular dummy text.', 'langle-addons' ),
				'placeholder' => __( 'Type amazing review from reviewer', 'langle-addons' ),
				'separator' => 'before',
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'review_position',
			[
				'label' => __( 'Review Position', 'langle-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'before' => __( 'Before Rating', 'langle-addons' ),
					'after' => __( 'After Rating', 'langle-addons' ),
				],
				'default' => 'before',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'rating_position',
			[
				'label' => __( 'Rating Position', 'langle-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'before' => __( 'Before Reviwer', 'langle-addons' ),
					'after' => __( 'After Reviwer', 'langle-addons' ),
				],
				'default' => 'before',
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
				'label' => __( 'Photo', 'langle-addons' ),
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

		$this->add_control(
			'image_position',
			[
				'label' => __( 'Image Position', 'langle-addons' ),
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
				'default' => 'top',
				'toggle' => false,
				'prefix_class' => 'la-review--',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Name', 'langle-addons' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => 'Reviewer Name',
				'placeholder' => __( 'Type Reviewer Name', 'langle-addons' ),
				'separator' => 'before',
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'job_title',
			[
				'label' => __( 'Job Title', 'langle-addons' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Reviewer Job Title', 'langle-addons' ),
				'placeholder' => __( 'Type Reviewer Job Title', 'langle-addons' ),
				'dynamic' => [
					'active' => true,
				]
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
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label' => __( 'Name HTML Tag', 'langle-addons' ),
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

		$this->end_controls_section();

    }

    /**
     * Register widget style controls
     */
	protected function register_style_controls() {
		$this->__photo_style_controls();
		$this->__review_reviewer_style_controls();
		$this->__ratting_style_controls();
	}

	protected function __photo_style_controls() {

        $this->start_controls_section(
			'_section_photo_style',
			[
				'label' => __( 'Photo', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
						'min' => 70,
						'max' => 500,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--la-review-media-width: {{SIZE}}{{UNIT}};',
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
						'min' => 70,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .la-review-figure' => 'height: {{SIZE}}{{UNIT}};',
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
				'label' => __( 'Offset X', 'langle-addons' ),
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
					'{{WRAPPER}}' => '--la-review-media-offset-x: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'image_offset_y',
			[
				'label' => __( 'Offset Y', 'langle-addons' ),
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
					'{{WRAPPER}}' => '--la-review-media-offset-y: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->end_popover();

		$this->add_responsive_control(
			'image_padding',
			[
				'label' => __( 'Padding', 'langle-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .la-review-figure img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .la-review-figure img',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'langle-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .la-review-figure img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .la-review-figure img',
			]
		);

		$this->end_controls_section();

    }

    protected function __review_reviewer_style_controls() {

        $this->start_controls_section(
			'_section_review_style',
			[
				'label' => __( 'Review & Reviewer', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'body_padding',
			[
				'label' => __( 'Text Box Padding', 'langle-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .la-review-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'_heading_name',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Name', 'langle-addons' ),
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => __( 'Bottom Spacing', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default'	=> [
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .la-review-reviewer' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => __( 'Text Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-review-reviewer' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .la-review-reviewer',
				'scheme' => Typography::TYPOGRAPHY_2,
			]
		);

		$this->add_control(
			'_heading_job_title',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Job Title', 'langle-addons' ),
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'job_title_spacing',
			[
				'label' => __( 'Bottom Spacing', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default'	=> [
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .la-review-position' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'job_title_color',
			[
				'label' => __( 'Text Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-review-position' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'job_title_typography',
				'selector' => '{{WRAPPER}} .la-review-position',
				'scheme' => Typography::TYPOGRAPHY_3,
			]
		);

		$this->add_control(
			'_heading_review',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'Review', 'langle-addons' ),
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'review_spacing',
			[
				'label' => __( 'Bottom Spacing', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .la-review-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'review_color',
			[
				'label' => __( 'Text Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-review-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'review_typography',
				'selector' => '{{WRAPPER}} .la-review-desc',
				'scheme' => Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();

    }

	protected function __ratting_style_controls() {

        $this->start_controls_section(
			'_section_ratting_style',
			[
				'label' => __( 'Rating', 'langle-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'ratting_size',
			[
				'label' => __( 'Size', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .la-review-ratting' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ratting_spacing',
			[
				'label' => __( 'Bottom Spacing', 'langle-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default'	=> [
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .la-review-ratting' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ratting_padding',
			[
				'label' => __( 'Padding', 'langle-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .la-review-ratting' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ratting_color',
			[
				'label' => __( 'Text Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-review-ratting' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ratting_bg_color',
			[
				'label' => __( 'Background Color', 'langle-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .la-review-ratting' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ratting_border',
				'selector' => '{{WRAPPER}} .la-review-ratting',
			]
		);

		$this->add_control(
			'ratting_border_radius',
			[
				'label' => __( 'Border Radius', 'langle-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .la-review-ratting' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

    }

    

    protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_render_attribute( 'title', 'class', 'la-review-reviewer' );

		$this->add_inline_editing_attributes( 'job_title', 'basic' );
		$this->add_render_attribute( 'job_title', 'class', 'la-review-position' );

		$this->add_inline_editing_attributes( 'review', 'advanced' );
		$this->add_render_attribute( 'review', 'class', 'la-review-desc' );

		$this->add_render_attribute( 'ratting', 'class', [
			'la-review-ratting',
			'la-review-ratting--' . $settings['ratting_style']
		] );

		$ratting = max( 0, $settings['ratting']['size'] );
		if ( $settings['image']['url'] || $settings['image']['id'] ) :
			$settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
			?>
			<figure class="la-review-figure">
				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
			</figure>
		<?php endif; ?>

		<div class="la-review-body">
			<?php if ( $settings['review_position'] === 'before' && $settings['review'] ) : ?>
				<div <?php $this->print_render_attribute_string( 'review' ); ?>>
					<p><?php echo langle_addons_kses_intermediate( $settings['review'] ); ?></p>
				</div>
			<?php endif; ?>

			<div class="la-review-header">

				<?php if ( $settings['rating_position'] === 'before' ) : ?>

					<div <?php $this->print_render_attribute_string( 'ratting' ); ?>>
						<?php if ( $settings['ratting_style'] === 'num' ) : ?>
							<?php echo esc_html( $ratting ); ?> <i class="fas fa-star" aria-hidden="true"></i>
						<?php else :
							for ( $i = 1; $i <= 5; ++$i ) :
								if ( $i <= $ratting ) {
									echo '<i class="fas fa-star" aria-hidden="true"></i>';
								} else {
									echo '<i class="far fa-star" aria-hidden="true"></i>';
								}
							endfor;
						endif; ?>
					</div>
				<?php endif; ?>


				<?php if ( $settings['title' ] ) :
					printf( '<%1$s %2$s>%3$s</%1$s>',
						langle_addons_escape_tags( $settings['title_tag'], 'h2' ),
						$this->get_render_attribute_string( 'title' ),
						langle_addons_kses_basic( $settings['title' ] )
					);
				endif; ?>

				<?php if ( $settings['job_title' ] ) : ?>
					<div <?php $this->print_render_attribute_string( 'job_title' ); ?>><?php echo langle_addons_kses_basic( $settings['job_title' ] ); ?></div>
				<?php endif; ?>

				<?php if ( $settings['rating_position'] === 'after' ) : ?>
					<div <?php $this->print_render_attribute_string( 'ratting' ); ?>>
						<?php if ( $settings['ratting_style'] === 'num' ) : ?>
							<?php echo esc_html( $ratting ); ?> <i class="fas fa-star" aria-hidden="true"></i>
						<?php else :
							for ( $i = 1; $i <= 5; ++$i ) :
								if ( $i <= $ratting ) {
									echo '<i class="fas fa-star" aria-hidden="true"></i>';
								} else {
									echo '<i class="far fa-star" aria-hidden="true"></i>';
								}
							endfor;
						endif; ?>
					</div>
				<?php endif; ?>

			</div>

			<?php if ( $settings['review_position'] === 'after' && $settings['review'] ) : ?>
				<div <?php $this->print_render_attribute_string( 'review' ); ?>>
					<p><?php echo langle_addons_kses_intermediate( $settings['review'] ); ?></p>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}

    public function content_template() {
		?>
		<#
		view.addInlineEditingAttributes( 'title', 'basic' );
		view.addRenderAttribute( 'title', 'class', 'la-review-reviewer' );

		view.addInlineEditingAttributes( 'job_title', 'basic' );
		view.addRenderAttribute( 'job_title', 'class', 'la-review-position' );

		view.addInlineEditingAttributes( 'review', 'advanced' );
		view.addRenderAttribute( 'review', 'class', 'la-review-desc' );

		var ratting = Math.max(0, settings.ratting.size);

		if (settings.image.url || settings.image.id) {
			var image = {
				id: settings.image.id,
				url: settings.image.url,
				size: settings.thumbnail_size,
				dimension: settings.thumbnail_custom_dimension,
				model: view.getEditModel()
			};

			var image_url = elementor.imagesManager.getImageUrl( image );
			#>
			<figure class="la-review-figure">
				<img src="{{ image_url }}">
			</figure>
		<# } #>

		<div class="la-review-body">
			<# if (settings.review_position === 'before' && settings.review) { #>
				<div {{{ view.getRenderAttributeString( 'review' ) }}}>
					<p>{{{ settings.review }}}</p>
				</div>
			<# } #>
			<div class="la-review-header">

				<# if (settings.rating_position === 'before' ) { #>
					<# if ( settings.ratting_style === 'num' ) { #>
						<div class="la-review-ratting la-review-ratting--num">{{ ratting }} <i class="fa fa-star"></i></div>
					<# } else { #>
						<div class="la-review-ratting la-review-ratting--star">
							<# _.each(_.range(1, 6), function(i) {
								if (i <= ratting) {
									print('<i class="fas fa-star"></i>');
								} else {
									print('<i class="far fa-star"></i>');
								}
							}); #>
						</div>
					<# } #>
				<# } #>

				<# if (settings.title) { #>
					<{{ settings.title_tag }} {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</{{ settings.title_tag }}>
				<# } #>
				<# if (settings.job_title) { #>
					<div {{{ view.getRenderAttributeString( 'job_title' ) }}}>{{{ settings.job_title }}}</div>
				<# } #>

				<# if (settings.rating_position === 'after' ) { #>
					<# if ( settings.ratting_style === 'num' ) { #>
						<div class="la-review-ratting la-review-ratting--num">{{ ratting }} <i class="fa fa-star"></i></div>
					<# } else { #>
						<div class="la-review-ratting la-review-ratting--star">
							<# _.each(_.range(1, 6), function(i) {
								if (i <= ratting) {
									print('<i class="fas fa-star"></i>');
								} else {
									print('<i class="far fa-star"></i>');
								}
							}); #>
						</div>
					<# } #>
				<# } #>
				
			</div>
			<# if ( settings.review_position === 'after' && settings.review) { #>
				<div {{{ view.getRenderAttributeString( 'review' ) }}}>
					<p>{{{ settings.review }}}</p>
				</div>
			<# } #>
		</div>
		<?php
	}

}