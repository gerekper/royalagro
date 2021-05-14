<?php
namespace ElementPack\Modules\ParallaxEffects;

use Elementor\Controls_Manager;
use Elementor\Element_Column;
use Elementor\Element_Section;
use ElementPack;
use ElementPack\Base\Element_Pack_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Element_Pack_Module_Base {

	public function __construct() {
		parent::__construct();
		$this->add_actions();
	}

	public function get_name() {
		return 'bdt-parallax-effects';
	}
	
	public function register_widget_control($widget, $args) {
		
		$widget->add_control(
			'ep_parallax_effects_show',
			[
				'label'        => BDTEP_CP . esc_html__( 'Parallax/Scrolling Effects', 'bdthemes-element-pack' ) . BDTEP_NC,
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'return_value' => 'yes',
				'separator'    => 'after',
			]
		);
		
		$widget->add_control(
			'ep_parallax_effects_y',
			[
				'label' => __( 'Vertical Parallax', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'ep_parallax_effects_show' => 'yes',
				],
				'render_type' => 'none',
			]
		);
		
		$widget->start_popover();
		
		$widget->add_control(
			'ep_parallax_effects_y_start',
			[
				'label'       => esc_html__( 'Start', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'   => -500,
						'max'   => 500,
						'step' => 10,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'condition'    => [
					'ep_parallax_effects_show' => 'yes',
				],
			]
		);
		
		$widget->add_control(
			'ep_parallax_effects_y_end',
			[
				'label'       => esc_html__( 'End', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'   => -500,
						'max'   => 500,
						'step' => 10,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'condition'    => [
					'ep_parallax_effects_show' => 'yes',
				],
			]
		);
		
		
		
		$widget->end_popover();
		
		
		
		$widget->add_control(
			'ep_parallax_effects_x',
			[
				'label' => __( 'Horizontal Parallax', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'ep_parallax_effects_show' => 'yes',
				],
				'render_type' => 'none',
			]
		);
		
		$widget->start_popover();
		
		$widget->add_control(
			'ep_parallax_effects_x_start',
			[
				'label'       => esc_html__( 'Start', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'   => -500,
						'max'   => 500,
						'step' => 10,
					],
				],
				
				'condition'    => [
					'ep_parallax_effects_show' => 'yes',
				],
			]
		);
		
		$widget->add_control(
			'ep_parallax_effects_x_end',
			[
				'label'       => esc_html__( 'End', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'   => -500,
						'max'   => 500,
						'step' => 10,
					],
				],
				'condition'    => [
					'ep_parallax_effects_show' => 'yes',
				],
			]
		);
		
		$widget->end_popover();
		
		
		$widget->add_control(
			'ep_parallax_effects_viewport',
			[
				'label' => __( 'Animation Viewport', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'ep_parallax_effects_show' => 'yes',
				],
				'render_type' => 'none',
			]
		);
		
		$widget->start_popover();
		
		$widget->add_control(
			'ep_parallax_effects_viewport_value',
			[
				'label'       => esc_html__( 'Value', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'  => 0.1,
						'max'  => 1,
						'step' => 0.1,
					],
				],
				'condition'    => [
					'ep_parallax_effects_show' => 'yes',
				],
			]
		);
		
		$widget->end_popover();
		
		
		$widget->add_control(
			'ep_parallax_effects_opacity',
			[
				'label'   => __( 'Opacity', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'htov' => [
						'title' => __( 'Hidden to Visible', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-v-align-bottom',
					],
					'vtoh' => [
						'title' => __( 'Visible to Hidden', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-v-align-top',
					],
				],
				'toggle'      => true,
				'condition'    => [
					'ep_parallax_effects_show' => 'yes',
				],
			]
		);
		
		
		
		$widget->add_control(
			'ep_parallax_effects_blur',
			[
				'label' => __( 'Blur', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'ep_parallax_effects_show' => 'yes',
				],
				'render_type' => 'none',
			]
		);
		
		$widget->start_popover();
		
		$widget->add_control(
			'ep_parallax_effects_blur_start',
			[
				'label'       => esc_html__( 'Start', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'   => 0,
						'max'   => 20,
						'step' => 1,
					],
				],
				'condition'    => [
					'ep_parallax_effects_show' => 'yes',
				],
			]
		);
		
		$widget->add_control(
			'ep_parallax_effects_blur_end',
			[
				'label'       => esc_html__( 'End', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'   => 0,
						'max'   => 20,
						'step' => 1,
					],
				],
				'condition'    => [
					'ep_parallax_effects_show' => 'yes',
				],
			]
		);
		
		$widget->end_popover();
		
		
		$widget->add_control(
			'ep_parallax_effects_rotate',
			[
				'label' => __( 'Rotate', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'ep_parallax_effects_show' => 'yes',
				],
				'render_type' => 'none',
			]
		);
		
		$widget->start_popover();
		
		$widget->add_control(
			'ep_parallax_effects_rotate_value',
			[
				'label'       => esc_html__( 'Value', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'  => -360,
						'max'  => 360,
						'step' => 5,
					],
				],
				'condition'    => [
					'ep_parallax_effects_show' => 'yes',
				],
			]
		);
		
		$widget->end_popover();
		
		$widget->add_control(
			'ep_parallax_effects_scale',
			[
				'label' => __( 'Scale', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'ep_parallax_effects_show' => 'yes',
				],
				'render_type' => 'none',
			]
		);
		
		$widget->start_popover();
		
		$widget->add_control(
			'ep_parallax_effects_scale_value',
			[
				'label'       => esc_html__( 'Value', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'  => -10,
						'max'  => 10,
						'step' => 0.1,
					],
				],
				'condition'    => [
					'ep_parallax_effects_show' => 'yes',
				],
			]
		);
		
		$widget->end_popover();
		
		$widget->add_control(
			'ep_parallax_effects_hue',
			[
				'label' => __( 'Hue', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'ep_parallax_effects_show' => 'yes',
				],
				'render_type' => 'none',
			]
		);
		
		$widget->start_popover();
		
		$widget->add_control(
			'ep_parallax_effects_hue_value',
			[
				'label'       => esc_html__( 'Value', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'  => 0,
						'max'  => 360,
						'step' => 1,
					],
				],
				'condition'    => [
					'ep_parallax_effects_show' => 'yes',
				],
			]
		);
		
		$widget->end_popover();
		
		
		$widget->add_control(
			'ep_parallax_effects_sepia',
			[
				'label' => __( 'Sepia', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'ep_parallax_effects_show' => 'yes',
				],
				'render_type' => 'none',
			]
		);
		
		$widget->start_popover();
		
		$widget->add_control(
			'ep_parallax_effects_sepia_value',
			[
				'label'       => esc_html__( 'Value', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'%' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'condition'    => [
					'ep_parallax_effects_show' => 'yes',
				],
			]
		);
		
		
		$widget->end_popover();
		
		
		$widget->add_control(
			'ep_parallax_effects_transition',
			[
				'label' => __( 'Transition', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'ep_parallax_effects_show' => 'yes',
				],
				'render_type' => 'none',
			]
		);
		
		$widget->start_popover();
		
		$widget->add_control(
			'ep_parallax_effects_transition_for',
			[
				'label'       => esc_html__( 'Transition For', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'all',
				'condition'    => [
					'ep_parallax_effects_show' => 'yes',
					'ep_parallax_effects_transition' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => 'transition-property: {{VALUE||all}};',
				],
			]
		);
		
		$widget->add_control(
			'ep_parallax_effects_transition_duration',
			[
				'label'       => esc_html__( 'Duration (ms)', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '100',
				'condition'    => [
					'ep_parallax_effects_show' => 'yes',
					'ep_parallax_effects_transition' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => 'transition-duration: {{VALUE||100}}ms;',
				],
			]
		);
		
		$widget->add_control(
			'ep_parallax_effects_transition_easing',
			[
				'label'       => esc_html__( 'Easing', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'linear',
				'condition'    => [
					'ep_parallax_effects_show' => 'yes',
					'ep_parallax_effects_transition' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => 'transition-timing-function: {{VALUE||linear}};',
				],
			]
		);
		
		
		$widget->end_popover();

		$widget->add_control(
			'ep_parallax_effects_media_query',
			[
				'label'       => __( 'Parallax Start From', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					''    => __( 'All Device', 'bdthemes-element-pack' ),
					'@xl' => __( 'Retina to Larger', 'bdthemes-element-pack' ),
					'@l'  => __( 'Desktop to Larger', 'bdthemes-element-pack' ),
					'@m'  => __( 'Tablet to Larger', 'bdthemes-element-pack' ),
					'@s'  => __( 'Mobile to Larger', 'bdthemes-element-pack' ),
				],
				'condition' => [
					'ep_parallax_effects_show' => 'yes',
				],
				'render_type' => 'none',
				'separator'    => 'after',
			]
		);

	}


	public function widget_parallax_before_render($widget) {
		$settings = $widget->get_settings_for_display();

		if( $settings['ep_parallax_effects_show'] == 'yes' ) {

			$parallax_y_start    = ($settings['ep_parallax_effects_y_start']['size']) ? $settings['ep_parallax_effects_y_start']['size'] : 0;
			$parallax_y_end      = ($settings['ep_parallax_effects_y_end']['size']) ? $settings['ep_parallax_effects_y_end']['size'] : 0;

			$parallax_x_start    = $settings['ep_parallax_effects_x_start']['size'];
			$parallax_x_end      = $settings['ep_parallax_effects_x_end']['size'];

			$parallax_viewport   = $settings['ep_parallax_effects_viewport_value']['size'];
			$parallax_opacity    = $settings['ep_parallax_effects_opacity'];

			$parallax_blur_start = ($settings['ep_parallax_effects_blur_start']['size']) ? $settings['ep_parallax_effects_blur_start']['size'] : 0;
			$parallax_blur_end   = ($settings['ep_parallax_effects_blur_end']['size']) ? $settings['ep_parallax_effects_blur_end']['size'] : 0;

			$parallax_rotate     = $settings['ep_parallax_effects_rotate_value']['size'];
			
			$parallax_scale      = $settings['ep_parallax_effects_scale_value']['size'];
			
			$parallax_hue        = $settings['ep_parallax_effects_hue_value']['size'];
			
			$parallax_sepia      = $settings['ep_parallax_effects_sepia_value']['size'];

			$parallax_media_query      = ($settings['ep_parallax_effects_media_query']) ? $settings['ep_parallax_effects_media_query'] : '';
			
			
//			if ( $widget instanceof Element_Section ) {
//				$parallax_target = '';
//			} elseif ( $widget instanceof Element_Column ) {
//				$parallax_target = 'target: > .elementor-widget-wrap;';
//			} else {
//				$parallax_target = 'target: > .elementor-widget-container;';
//			}
//
//
//			$widget->add_render_attribute( '_wrapper', 'data-bdt-parallax', $parallax_target );
			
			if ( $settings['ep_parallax_effects_y'] ) {
				$widget->add_render_attribute( '_wrapper', 'data-bdt-parallax', 'y: ' . $parallax_y_start . ',' . $parallax_y_end . ';' );
			}

			if ( $settings['ep_parallax_effects_x'] ) {
				$widget->add_render_attribute( '_wrapper', 'data-bdt-parallax', 'x: ' . $parallax_x_start . ',' . $parallax_x_end . ';' );
			}


			if ( $settings['ep_parallax_effects_viewport'] ) {
				$widget->add_render_attribute( '_wrapper', 'data-bdt-parallax', 'viewport: ' . $parallax_viewport . ';' );
			}

			if ( !empty($parallax_opacity) ) {
				if ($parallax_opacity == 'htov') {
					$widget->add_render_attribute( '_wrapper', 'data-bdt-parallax', 'opacity: 0,1;' );
				} elseif ( $parallax_opacity == 'vtoh' ){
					$widget->add_render_attribute( '_wrapper', 'data-bdt-parallax', 'opacity: 1,0;' );
				}
			}

			if ( $settings['ep_parallax_effects_blur'] ) {
				$widget->add_render_attribute( '_wrapper', 'data-bdt-parallax', 'blur: ' . $parallax_blur_start . ',' . $parallax_blur_end . ';' );
			}

			if ( $settings['ep_parallax_effects_rotate'] ) {
				$widget->add_render_attribute( '_wrapper', 'data-bdt-parallax', 'rotate: ' . $parallax_rotate . ';' );
			}

			if ( $settings['ep_parallax_effects_scale'] ) {
				$widget->add_render_attribute( '_wrapper', 'data-bdt-parallax', 'scale: ' . $parallax_scale . ';' );
			}

			if ( $settings['ep_parallax_effects_hue'] ) {
				$widget->add_render_attribute( '_wrapper', 'data-bdt-parallax', 'hue: ' . $parallax_hue . ';' );
			}

			if ( $settings['ep_parallax_effects_sepia'] ) {
				$widget->add_render_attribute( '_wrapper', 'data-bdt-parallax', 'sepia: ' . $parallax_sepia . ';' );
			}

			if ( !empty($parallax_media_query) ) {
				$widget->add_render_attribute( '_wrapper', 'data-bdt-parallax', 'media: ' . $parallax_media_query . ';' );
			}

		}
	}

	protected function add_actions() {
		
		add_action( 'elementor/element/section/section_effects/after_section_start', [ $this, 'register_widget_control'], 10, 11 );
		add_action( 'elementor/element/column/section_effects/after_section_start', [ $this, 'register_widget_control'], 10, 11 );
		add_action( 'elementor/element/common/section_effects/after_section_start', [ $this, 'register_widget_control'], 10, 11 );
		
		add_action( 'elementor/frontend/section/before_render', [ $this, 'widget_parallax_before_render' ], 10, 2 );
		add_action( 'elementor/frontend/column/before_render', [ $this, 'widget_parallax_before_render' ], 10, 2 );
		add_action( 'elementor/frontend/widget/before_render', [ $this, 'widget_parallax_before_render' ], 10, 2 );
		
	}
}