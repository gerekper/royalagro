<?php
/**
 * Elementor Widget
 * @package Appside
 * @since 1.0.0
 */

namespace Elementor;
class Appside_Boxed_Button_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Elementor widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'appside-boxed-button-widget';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Elementor widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Button: 01', 'aapside-master' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Elementor widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-button';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Elementor widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'appside_widgets' ];
	}

	/**
	 * Register Elementor widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'General Settings', 'aapside-master' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'btn_text',
			[
				'label'       => esc_html__( 'Button Text', 'aapside-master' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'enter button text.', 'aapside-master' ),
				'default'     => esc_html__('Learn More','aapside-master')
			]
		);
		$this->add_control(
			'btn_link',
			[
				'label'       => esc_html__( 'Button Link', 'aapside-master' ),
				'type'        => Controls_Manager::URL,
				'default' => array(
					'url' => '#'
				),
				'description' => esc_html__( 'enter button url.', 'aapside-master' ),
			]
		);
		$this->add_control(
			'btn_rounded',
			[
				'label'       => esc_html__( 'Button Rounded', 'aapside-master' ),
				'type'        => Controls_Manager::SWITCHER,
				'description' => esc_html__( 'enable button rounded.', 'aapside-master' ),
				'default'     => 'no'
			]
		);
		$this->add_control(
			'btn_white_color',
			[
				'label'       => esc_html__( 'Button White Color', 'aapside-master' ),
				'type'        => Controls_Manager::SWITCHER,
				'description' => esc_html__( 'enable button white color.', 'appside-core' ),
				'default'     => 'no'
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'aapside-master' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'aapside-master' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'aapside-master' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'aapside-master' ),
						'icon' => 'eicon-text-align-right',
					]
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .btn-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'typography_section',
			[
				'label' => esc_html__( 'Button Typography', 'aapside-master' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(Group_Control_Typography::get_type(),[
			'name' => 'button_typography',
			'label' => esc_html__('Typography','aapside-master'),
			'selector' => "{{WRAPPER}} .btn-wrapper .boxed-btn"
		]);
		$this->end_controls_section();
		$this->start_controls_section(
			'button_gd_two_section',
			[
				'label' => esc_html__( 'Button Styling', 'aapside-master' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('button_two_background');

		$this->start_controls_tab('normal_two_style',[
			'label' => esc_html__('Normal','aapside-master')
		]);
		$this->add_group_control(Group_Control_Background::get_type(),[
			'name' => 'gd_two_background',
			'selector' => "{{WRAPPER}} .btn-wrapper .boxed-btn",
			'description' => esc_html__('button background','aapside-master')
		]);
		$this->add_control( 'gd_two_text_color', [
			'label'       => esc_html__( 'Button Text Color', 'aapside-master' ),
			'type'        => Controls_Manager::COLOR,
			'description' => esc_html__( 'change button text color', 'aapside-master' ),
			'default'     => '#fff',
			'selectors'   => [
				"{{WRAPPER}} .btn-wrapper .boxed-btn" => "color: {{VALUE}}"
			]
		] );
		$this->add_group_control(Group_Control_Border::get_type(),[
			'name' => 'button_normal_border',
			'label' => esc_html__('Border','aapside-master'),
			'selector' => "{{WRAPPER}} .btn-wrapper .boxed-btn"
		]);

		$this->end_controls_tab();

		$this->start_controls_tab('hover_two_style',[
			'label' => esc_html__('Hover','aapside-master')
		]);
		$this->add_group_control(Group_Control_Background::get_type(),[
			'name' => 'appside_button_hover_background',
			'selector' => "{{WRAPPER}} .btn-wrapper .boxed-btn:hover",
			'description' => esc_html__('button hover background','aapside-master')
		]);
		$this->add_control( 'gd_two_hover_text_color', [
			'label'       => esc_html__( 'Button Text Color', 'aapside-master' ),
			'type'        => Controls_Manager::COLOR,
			'description' => esc_html__( 'change button text color', 'aapside-master' ),
			'default'     => '#333',
			'selectors'   => [
				"{{WRAPPER}} .btn-wrapper .boxed-btn:hover" => "color: {{VALUE}}"
			]
		] );
		$this->add_group_control(Group_Control_Background::get_type(),[
			'name' => 'appside_gd_two_hover_background',
			'selector' => "{{WRAPPER}} .btn-wrapper .boxed-btn:hover",
			'description' => esc_html__('button hover background','aapside-master')
		]);
		$this->add_group_control(Group_Control_Border::get_type(),[
			'name' => 'button_hover_border',
			'label' => esc_html__('Border','aapside-master'),
			'selector' => "{{WRAPPER}} .btn-wrapper .boxed-btn:hover"
		]);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	/**
	 * Render Elementor widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute('button_attr','class','boxed-btn');
		if (( 'yes' == $settings['btn_rounded'] )){
		    $this->add_render_attribute('button_attr','class','btn-rounded');
        }
		if (( 'yes' == $settings['btn_white_color'] )){
			$this->add_render_attribute('button_attr','class','blank');
		}
		if (!empty($settings['btn_link']['url'])){
		    $this->add_link_attributes('button_attr',$settings['btn_link']);
        }
		?>
		<div class="btn-wrapper">
			<a <?php echo $this->get_render_attribute_string('button_attr');?>>
				<?php echo esc_html($settings['btn_text']);?>
			</a>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Appside_Boxed_Button_Widget() );