<?php
/**
 * Class: Premium_Google_Reviews
 * Name: Google Reviews
 * Slug: premium-google-reviews
 */

namespace PremiumAddonsPro\Widgets;

// Elementor Classes.
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;

// PremiumAddons Classes.
use PremiumAddons\Includes\Helper_Functions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Premium_Google_Reviews
 */
class Premium_Google_Reviews extends Widget_Base {

	/**
	 * Retrieve Widget Name.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'premium-google-reviews';
	}

	/**
	 * Retrieve Widget Title.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return sprintf( '%1$s %2$s', Helper_Functions::get_prefix(), __( 'Google Reviews', 'premium-addons-pro' ) );
	}

	/**
	 * Retrieve Widget Icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string widget icon.
	 */
	public function get_icon() {
		return 'pa-pro-google-reviews';
	}

	/**
	 * Retrieve Widget Categories.
	 *
	 * @since 1.5.1
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'premium-elements' );
	}

	/**
	 * Retrieve Widget Dependent CSS.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array CSS script handles.
	 */
	public function get_style_depends() {
		return array(
			'font-awesome-5-all',
			'premium-addons',
		);
	}

	/**
	 * Retrieve Widget Dependent JS.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array JS script handles.
	 */
	public function get_script_depends() {
		return array(
			'pa-slick',
			'isotope-js',
			'premium-pro-js',
		);
	}

	/**
	 * Widget preview refresh button.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function is_reload_preview_required() {
		return true;
	}

	/**
	 * Retrieve Widget Support URL.
	 *
	 * @access public
	 *
	 * @return string support URL.
	 */
	public function get_custom_help_url() {
		return 'https://premiumaddons.com/support/';
	}

	/**
	 * Register Google Reviews controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore

		$this->start_controls_section(
			'general',
			array(
				'label' => __( 'Access Credentials', 'premium-addons-pro' ),
			)
		);

		$this->add_control(
			'api_key',
			array(
				'label'       => __( 'API Key', 'premium-addons-pro' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'description' => 'Click <a href="https://developers.google.com/places/web-service/get-api-key" target="_blank">here</a> to get your Google Places API key',
			)
		);

		$this->add_control(
			'place_id',
			array(
				'label'       => __( 'Place ID', 'premium-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'ChIJ7abYXwhAxokRFGoJWSMHR7c',
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
				'description' => 'Click <a href="https://developers.google.com/maps/documentation/javascript/examples/places-placeid-finder" target="_blank">here</a> to get your place ID',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content',
			array(
				'label' => __( 'Display Options', 'premium-addons-pro' ),
			)
		);

		$this->add_control(
			'skin_type',
			array(
				'label'        => __( 'Skin', 'premium-addons-pro' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'default',
				'options'      => array(
					'default' => __( 'Classic', 'premium-addons-pro' ),
					'card'    => __( 'Cards', 'premium-addons-pro' ),
				),
				'render_type'  => 'template',
				'prefix_class' => 'premium-social-reviews-',
			)
		);

		$this->start_controls_tabs( 'display_tabs' );

		$this->start_controls_tab(
			'place_tab',
			array(
				'label'     => __( 'Place', 'premium-addons-pro' ),
				'condition' => array(
					'place_info' => 'yes',
				),
			)
		);

		$this->add_control(
			'place_custom_image_switch',
			array(
				'label'     => __( 'Replace Place Image', 'premium-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => array(
					'place_info'   => 'yes',
					'source_image' => 'true',
				),
			)
		);

		$this->add_control(
			'place_custom_image',
			array(
				'label'     => __( 'Upload Image', 'premium-addons-pro' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'place_info'                => 'yes',
					'place_custom_image_switch' => 'yes',
					'source_image'              => 'true',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'thumbnail',
				'default'   => 'full',
				'condition' => array(
					'place_info'                => 'yes',
					'place_custom_image_switch' => 'yes',
					'source_image'              => 'true',
				),
			)
		);

		$this->add_control(
			'place_display',
			array(
				'label'       => __( 'Display', 'premium-addons-pro' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'inline' => __( 'Inline', 'premium-addons-pro' ),
					'block'  => __( 'Block', 'premium-addons-pro' ),
				),
				'default'     => 'block',
				'render_type' => 'ui',
				'condition'   => array(
					'place_info'   => 'yes',
					'source_image' => 'true',
				),
			)
		);

		$this->add_responsive_control(
			'place_image_align',
			array(
				'label'     => __( 'Image Alignment', 'premium-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Top', 'premium-addons-pro' ),
						'icon'  => 'fa fa-long-arrow-up',
					),
					'center'     => array(
						'title' => __( 'Center', 'premium-addons-pro' ),
						'icon'  => 'fa fa-align-justify',
					),
					'flex-end'   => array(
						'title' => __( 'Bottom', 'premium-addons-pro' ),
						'icon'  => 'fa fa-long-arrow-down',
					),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .premium-fb-rev-page-inner .premium-fb-rev-page-left' => 'align-self: {{VALUE}};',
				),
				'condition' => array(
					'place_display' => 'inline',
					'source_image'  => 'true',
				),
			)
		);

		$this->add_responsive_control(
			'place_text_align',
			array(
				'label'     => __( 'Text Alignment', 'premium-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Top', 'premium-addons-pro' ),
						'icon'  => 'fa fa-long-arrow-up',
					),
					'center'     => array(
						'title' => __( 'Center', 'premium-addons-pro' ),
						'icon'  => 'fa fa-align-justify',
					),
					'flex-end'   => array(
						'title' => __( 'Bottom', 'premium-addons-pro' ),
						'icon'  => 'fa fa-long-arrow-down',
					),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .premium-fb-rev-page-inner .premium-fb-rev-page-right' => 'align-self: {{VALUE}};',
				),
				'condition' => array(
					'place_display' => 'inline',
					'source_image'  => 'true',
				),
			)
		);

		$this->add_control(
			'place_dir',
			array(
				'label'              => __( 'Direction', 'premium-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'options'            => array(
					'rtl' => 'RTL',
					'ltr' => 'LTR',
				),
				'default'            => 'ltr',
				'prefix_class'       => 'premium-reviews-src-',
				'frontend_available' => true,
				'condition'          => array(
					'place_display' => 'inline',
					'source_image'  => 'true',
				),
			)
		);

		$this->add_responsive_control(
			'place_align',
			array(
				'label'     => __( 'Place Alignment', 'premium-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'premium-addons-pro' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'premium-addons-pro' ),
						'icon'  => 'fa fa-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'premium-addons-pro' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .premium-fb-rev-container .premium-fb-rev-page' => 'text-align: {{VALUE}};',
				),
				'condition' => array(
					'place_info' => 'yes',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'reviews_tab',
			array(
				'label' => __( 'Reviews', 'premium-addons-pro' ),
			)
		);

		$this->add_responsive_control(
			'reviews_columns',
			array(
				'label'       => __( 'Reviews/Row', 'premium-addons-pro' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'100%'    => __( '1 Column', 'premium-addons-pro' ),
					'50%'     => __( '2 Columns', 'premium-addons-pro' ),
					'33.33%'  => __( '3 Columns', 'premium-addons-pro' ),
					'25%'     => __( '4 Columns', 'premium-addons-pro' ),
					'20%'     => __( '5 Columns', 'premium-addons-pro' ),
					'16.667%' => __( '6 Columns', 'premium-addons-pro' ),
				),
				'default'     => '33.33%',
				'render_type' => 'template',
				'selectors'   => array(
					'{{WRAPPER}} .premium-fb-rev-review-wrap' => 'width: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'reviews_display',
			array(
				'label'       => __( 'Display', 'premium-addons-pro' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'inline' => __( 'Inline', 'premium-addons-pro' ),
					'block'  => __( 'Block', 'premium-addons-pro' ),
				),
				'default'     => 'block',
				'render_type' => 'ui',
			)
		);

		$this->add_responsive_control(
			'reviews_image_align',
			array(
				'label'     => __( 'Image Alignment', 'premium-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Top', 'premium-addons-pro' ),
						'icon'  => 'fa fa-long-arrow-up',
					),
					'center'     => array(
						'title' => __( 'Center', 'premium-addons-pro' ),
						'icon'  => 'fa fa-align-justify',
					),
					'flex-end'   => array(
						'title' => __( 'Bottom', 'premium-addons-pro' ),
						'icon'  => 'fa fa-long-arrow-down',
					),
				),
				'default'   => 'flex-start',
				'toggle'    => false,
				'selectors' => array(
					'{{WRAPPER}} .premium-fb-rev-review-inner .premium-fb-rev-content-left' => 'align-self: {{VALUE}};',
				),
				'condition' => array(
					'reviews_display' => 'inline',
					'reviewer_image'  => 'yes',
					'skin_type'       => 'default',
				),
			)
		);

		$this->add_responsive_control(
			'reviews_text_align',
			array(
				'label'     => __( 'Text Alignment', 'premium-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Top', 'premium-addons-pro' ),
						'icon'  => 'fa fa-long-arrow-up',
					),
					'center'     => array(
						'title' => __( 'Center', 'premium-addons-pro' ),
						'icon'  => 'fa fa-align-justify',
					),
					'flex-end'   => array(
						'title' => __( 'Bottom', 'premium-addons-pro' ),
						'icon'  => 'fa fa-long-arrow-down',
					),
				),
				'default'   => 'center',
				'toggle'    => false,
				'selectors' => array(
					'{{WRAPPER}} .premium-fb-rev-review-inner .premium-fb-rev-content-right' => 'align-self: {{VALUE}};',
				),
				'condition' => array(
					'reviews_display' => 'inline',
					'skin_type'       => 'default',
				),
			)
		);

		$this->add_control(
			'reviews_style',
			array(
				'label'     => __( 'Layout', 'premium-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'even'    => __( 'Even', 'premium-addons-pro' ),
					'masonry' => __( 'Masonry', 'premium-addons-pro' ),
				),
				'default'   => 'masonry',
				'condition' => array(
					'reviews_columns!' => '100%',
				),
			)
		);

		$this->add_control(
			'reviews_dir',
			array(
				'label'              => __( 'Direction', 'premium-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'options'            => array(
					'rtl' => 'RTL',
					'ltr' => 'LTR',
				),
				'default'            => 'ltr',
				'prefix_class'       => 'premium-reviews-',
				'frontend_available' => true,
				'condition'          => array(
					'reviews_display' => 'inline',
					'skin_type'       => 'default',
				),
			)
		);

		$this->add_responsive_control(
			'content_align',
			array(
				'label'     => __( 'Content Alignment', 'premium-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'    => array(
						'title' => __( 'Left', 'premium-addons-pro' ),
						'icon'  => 'fa fa-align-left',
					),
					'center'  => array(
						'title' => __( 'Center', 'premium-addons-pro' ),
						'icon'  => 'fa fa-align-center',
					),
					'right'   => array(
						'title' => __( 'Right', 'premium-addons-pro' ),
						'icon'  => 'fa fa-align-right',
					),
					'justify' => array(
						'title' => __( 'Justify', 'premium-addons-pro' ),
						'icon'  => 'fa fa-align-justify',
					),
				),
				'default'   => 'center',
				'toggle'    => false,
				'condition' => array(
					'reviews_display' => 'block',
				),
				'selectors' => array(
					'{{WRAPPER}} .premium-fb-rev-container .premium-fb-rev-content' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'reviews_carousel',
			array(
				'label' => __( 'Carousel', 'premium-addons-pro' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);

		$this->add_control(
			'carousel_play',
			array(
				'label'     => __( 'Auto Play', 'premium-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => array(
					'reviews_carousel' => 'yes',
				),
			)
		);

		$this->add_control(
			'carousel_autoplay_speed',
			array(
				'label'       => __( 'Autoplay Speed', 'premium-addons-pro' ),
				'description' => __( 'Autoplay Speed means at which time the next slide should come. Set a value in milliseconds (ms)', 'premium-addons-pro' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 5000,
				'condition'   => array(
					'reviews_carousel' => 'yes',
					'carousel_play'    => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'carousel_arrows_pos',
			array(
				'label'      => __( 'Arrows Position', 'premium-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'range'      => array(
					'px' => array(
						'min' => -100,
						'max' => 100,
					),
					'em' => array(
						'min' => -10,
						'max' => 10,
					),
				),
				'condition'  => array(
					'reviews_carousel' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-reviews a.carousel-arrow.carousel-next' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .premium-fb-rev-reviews a.carousel-arrow.carousel-prev' => 'left: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'carousel_dots',
			array(
				'label'     => __( 'Navigation Dots', 'premium-addons-for-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => array(
					'reviews_carousel' => 'yes',
				),
			)
		);

		$this->add_control(
			'carousel_rtl',
			array(
				'label'       => __( 'RTL Mode', 'premium-addons-pro' ),
				'description' => __( 'Recommended for right to left Sites', 'premium-addons-pro' ),
				'type'        => Controls_Manager::SWITCHER,
				'condition'   => array(
					'reviews_carousel' => 'yes',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'source_settings',
			array(
				'label' => __( 'Place Settings', 'premium-addons-pro' ),
			)
		);

		$this->add_control(
			'place_info',
			array(
				'label'   => __( 'Place Info', 'premium-addons-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'source_image',
			array(
				'label'        => __( 'Place Image', 'premium-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'true',
				'return_value' => 'true',
				'condition'    => array(
					'place_info' => 'yes',
				),
			)
		);

		$this->add_control(
			'source_name',
			array(
				'label'        => __( 'Place Name', 'premium-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'true',
				'return_value' => 'true',
				'condition'    => array(
					'place_info' => 'yes',
				),
			)
		);

		$this->add_control(
			'place_rate',
			array(
				'label'     => __( 'Place Rate', 'premium-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => array(
					'place_info' => 'yes',
				),
			)
		);

		$this->add_control(
			'source_stars',
			array(
				'label'        => __( 'Rating Stars', 'premium-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'true',
				'return_value' => 'true',
				'condition'    => array(
					'place_info' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'review_settings',
			array(
				'label' => __( 'Review Settings', 'premium-addons-pro' ),
			)
		);

		$this->add_control(
			'reviewer_image',
			array(
				'label'   => __( 'Show Reviewer Image', 'premium-addons-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'stars',
			array(
				'label'   => __( 'Show Stars', 'premium-addons-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'date',
			array(
				'label' => __( 'Show Date', 'premium-addons-pro' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);

		$this->add_control(
			'date_position',
			array(
				'label'     => __( 'Date Position', 'premium-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'column'         => __( 'Above Stars', 'premium-addons-pro' ),
					'column-reverse' => __( 'Below Stars', 'premium-addons-pro' ),
				),
				'default'   => 'column',
				'condition' => array(
					'stars' => 'yes',
					'date'  => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .premium-fb-rev-info' => 'flex-direction: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'date_format',
			array(
				'label'     => __( 'Date Format', 'premium-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'd/m/Y'  => 'DD/MM/YYYY',
					'm/d/Y'  => 'MM/DD/YYYY',
					'j F, Y' => __( 'Full Date', 'premium-addons-pro' ),
				),
				'default'   => 'd/m/Y',
				'condition' => array(
					'date' => 'yes',
				),
			)
		);

		$this->add_control(
			'text',
			array(
				'label'   => __( 'Show Review Text', 'premium-addons-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'language_prefix',
			array(
				'label'       => __( 'Get Reviews By Language', 'premium-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'description' => __( 'Enter language prefix, eg. en for English, ja for Japanese, if you don\'t know your language prefix, please check <a href="https://developers.google.com/maps/faq#languagesupport" target="_blank">here</a>' ),
			)
		);

		$this->add_control(
			'filter',
			array(
				'label' => __( 'Filter by Rate', 'premium-addons-pro' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);

		$this->add_control(
			'filter_min',
			array(
				'label'     => __( 'Min Stars', 'premium-addons-pro' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 5,
				'condition' => array(
					'filter' => 'yes',
				),
			)
		);

		$this->add_control(
			'filter_max',
			array(
				'label'     => __( 'Max Stars', 'premium-addons-pro' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 5,
				'condition' => array(
					'filter' => 'yes',
				),
			)
		);

		$this->add_control(
			'limit',
			array(
				'label' => __( 'Reviews Limit', 'premium-addons-pro' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);

		$this->add_control(
			'limit_num',
			array(
				'label'       => __( 'Number of Reviews', 'premium-addons-pro' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 0,
				'max'         => 5,
				'description' => __( 'You can only pull 5 reviews from Google', 'premium-addons-pro' ),
				'condition'   => array(
					'limit' => 'yes',
				),
			)
		);

		$this->add_control(
			'words_num',
			array(
				'label' => __( 'Review Words Length', 'premium-addons-pro' ),
				'type'  => Controls_Manager::NUMBER,
				'min'   => 1,
			)
		);

		$this->add_control(
			'readmore',
			array(
				'label'     => __( 'Read More Text', 'premium-addons-pro' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Read More »', 'premium-addons-pro' ),
				'condition' => array(
					'words_num!' => '',
				),
			)
		);

		$this->add_control(
			'schema',
			array(
				'label' => __( 'Rating Schema', 'premium-addons-pro' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);

		$this->add_control(
			'schema_doc',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => __( 'Enabling schema improves SEO as it helps to list star ratings in search engine results.', 'premium-addons-pro' ),
				'content_classes' => 'editor-pa-doc',
				'condition'       => array(
					'schema' => 'yes',
				),
			)
		);

		$this->add_control(
			'reload',
			array(
				'label'   => __( 'Reload Reviews Once Every', 'premium-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'hour'  => __( 'Hour', 'premium-addons-pro' ),
					'day'   => __( 'Day', 'premium-addons-pro' ),
					'week'  => __( 'Week', 'premium-addons-pro' ),
					'month' => __( 'Month', 'premium-addons-pro' ),
					'year'  => __( 'Year', 'premium-addons-pro' ),
				),
				'default' => 'day',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_pa_docs',
			array(
				'label' => __( 'Helpful Documentations', 'premium-addons-pro' ),
			)
		);

		$docs = array(
			'https://premiumaddons.com/docs/google-reviews-widget-tutorial/' => __( 'Getting started »', 'premium-addons-pro' ),
			'https://premiumaddons.com/docs/getting-your-api-key-for-google-reviews/' => __( 'How to get an API key for Google Reviews »', 'premium-addons-pro' ),
			'https://premiumaddons.com/docs/how-to-get-google-place-id' => __( 'How to get your place ID »', 'premium-addons-pro' ),
			'https://premiumaddons.com/docs/how-to-enable-places-api-for-premium-google-reviews-widget' => __( 'Error: This APi project is not authorized to use this API »', 'premium-addons-pro' ),
			'https://www.youtube.com/watch?v=Z0EeGyD34Zk' => __( 'Check the video tutorial »', 'premium-addons-pro' ),
		);

		$doc_index = 1;
		foreach ( $docs as $url => $title ) {

			$doc_url = Helper_Functions::get_campaign_link( $url, 'editor-page', 'wp-editor', 'get-support' );

			$this->add_control(
				'doc_' . $doc_index,
				array(
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => sprintf( '<a href="%s" target="_blank">%s</a>', $doc_url, $title ),
					'content_classes' => 'editor-pa-doc',
				)
			);

			$doc_index++;

		}

		$this->end_controls_section();

		$this->start_controls_section(
			'images',
			array(
				'label' => __( 'Images', 'premium-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'images_tabs' );

		$this->start_controls_tab(
			'place_img_tab',
			array(
				'label'     => __( 'Place', 'premium-addons-pro' ),
				'condition' => array(
					'place_info'   => 'yes',
					'source_image' => 'true',
				),
			)
		);

		$this->add_responsive_control(
			'place_image_size',
			array(
				'label'      => __( 'Size', 'premium-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 400,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 60,
				),
				'condition'  => array(
					'place_custom_image_switch!' => 'yes',
					'place_info'                 => 'yes',
					'source_image'               => 'true',
				),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-page-inner .premium-fb-rev-img' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'place_image_border',
				'selector'  => '{{WRAPPER}} .premium-fb-rev-page-inner .premium-fb-rev-img',
				'condition' => array(
					'place_info'   => 'yes',
					'source_image' => 'true',
				),
			)
		);

		$this->add_control(
			'place_image_border_radius',
			array(
				'label'      => __( 'Border Radius', 'premium-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em' ),
				'condition'  => array(
					'place_info'   => 'yes',
					'source_image' => 'true',
				),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-page-inner .premium-fb-rev-img' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'label'     => __( 'Shadow', 'premium-addons-pro' ),
				'name'      => 'place_image_shadow',
				'selector'  => '{{WRAPPER}} .premium-fb-rev-page-inner .premium-fb-rev-img',
				'condition' => array(
					'place_info'   => 'yes',
					'source_image' => 'true',
				),
			)
		);

		$this->add_responsive_control(
			'place_image_margin',
			array(
				'label'      => __( 'Margin', 'premium-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'condition'  => array(
					'place_info'   => 'yes',
					'source_image' => 'true',
				),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-page-inner .premium-fb-rev-page-left' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'img_tab',
			array(
				'label'     => __( 'Review', 'premium-addons-pro' ),
				'condition' => array(
					'reviewer_image' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'image_size',
			array(
				'label'      => __( 'Size', 'premium-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 200,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-review-inner .premium-fb-rev-img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'label'    => __( 'Shadow', 'premium-addons-pro' ),
				'name'     => 'image_shadow',
				'selector' => '{{WRAPPER}} .premium-fb-rev-review-inner .premium-fb-rev-img',
			)
		);

		$this->add_responsive_control(
			'image_margin',
			array(
				'label'      => __( 'Margin', 'premium-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-review-inner .premium-fb-rev-content-left' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'page',
			array(
				'label'     => __( 'Place Info', 'premium-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'place_info' => 'yes',
				),
			)
		);

		$this->start_controls_tabs( 'place_info_tabs' );

		$this->start_controls_tab(
			'page_container',
			array(
				'label' => __( 'Container', 'premium-addons-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'page_container_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .premium-fb-rev-page',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'page_container_border',
				'selector' => '{{WRAPPER}} .premium-fb-rev-page',
			)
		);

		$this->add_control(
			'page_container_border_radius',
			array(
				'label'      => __( 'Border Radius', 'premium-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-page' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'page_container_shadow',
				'selector' => '{{WRAPPER}} .premium-fb-rev-page',
			)
		);

		$this->add_responsive_control(
			'page_container_margin',
			array(
				'label'      => __( 'Margin', 'premium-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-page' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'page_container_padding',
			array(
				'label'      => __( 'Padding', 'premium-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-page' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'page_link',
			array(
				'label'     => __( 'Name', 'premium-addons-pro' ),
				'condition' => array(
					'source_name' => 'true',
				),
			)
		);

		$this->add_control(
			'page_color',
			array(
				'label'     => __( 'Text Color', 'premium-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .premium-fb-rev-page-link' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'page_hover_color',
			array(
				'label'     => __( 'Hover Color', 'premium-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .premium-fb-rev-page-link:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'page_typo',
				'selector' => '{{WRAPPER}} .premium-fb-rev-page-link',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'place_shadow',
				'selector' => '{{WRAPPER}} .premium-fb-rev-page-link',
			)
		);

		$this->add_responsive_control(
			'page_margin',
			array(
				'label'      => __( 'Margin', 'premium-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-page-link-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'page_rate_link',
			array(
				'label' => __( 'Rate', 'premium-addons-pro' ),
			)
		);

		$this->add_control(
			'place_star_size',
			array(
				'label'     => __( 'Star Size', 'premium-addons-pro' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 50,
				'condition' => array(
					'source_stars' => 'true',
				),
			)
		);

		$this->add_control(
			'place_fill',
			array(
				'label'     => __( 'Star Color', 'premium-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
                'default'   => '#ffab40',
                'global'  => false,
				'condition' => array(
					'source_stars' => 'true',
				),
			)
		);

		$this->add_control(
			'place_empty',
			array(
				'label'     => __( 'Empty Star Color', 'premium-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'global'  => false,
				'condition' => array(
					'source_stars' => 'true',
				),
			)
		);

		$this->add_control(
			'page_rate_color',
			array(
				'label'     => __( 'Text Color', 'premium-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'condition' => array(
					'place_rate' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .premium-fb-rev-page-rating' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'page_rate_typo',
				'condition' => array(
					'place_rate' => 'yes',
				),
				'selector'  => '{{WRAPPER}} .premium-fb-rev-page-rating',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'      => 'place_rate_shadow',
				'selector'  => '{{WRAPPER}} .premium-fb-rev-page-rating',
				'condition' => array(
					'place_rate' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'page_rate_margin',
			array(
				'label'      => __( 'Margin', 'premium-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'condition'  => array(
					'place_rate' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-page-rating-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'review_container',
			array(
				'label' => __( 'Review', 'premium-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'reviews_star_size',
			array(
				'label' => __( 'Star Size', 'premium-addons-pro' ),
				'type'  => Controls_Manager::NUMBER,
				'min'   => 1,
				'max'   => 50,
			)
		);

		$this->add_control(
			'reviews_fill',
			array(
				'label'  => __( 'Star Color', 'premium-addons-pro' ),
				'type'   => Controls_Manager::COLOR,
				'global'  => false,
			)
		);

		$this->add_control(
			'reviews_empty',
			array(
				'label'  => __( 'Empty Star Color', 'premium-addons-pro' ),
				'type'   => Controls_Manager::COLOR,
				'global'  => false,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'review_container_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .premium-fb-rev-review',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'review_container_border',
				'selector' => '{{WRAPPER}} .premium-fb-rev-review',
			)
		);

		$this->add_control(
			'review_container_border_radius',
			array(
				'label'      => __( 'Border Radius', 'premium-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-review' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'review_container_box_shadow',
				'selector' => '{{WRAPPER}} .premium-fb-rev-review',
			)
		);

		$this->add_responsive_control(
			'reviews_gap',
			array(
				'label'      => __( 'Margin', 'premium-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-review-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'review_container_padding',
			array(
				'label'      => __( 'Padding', 'premium-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-review' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'reviewer',
			array(
				'label' => __( 'Reviewer Name', 'premium-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'reviewer_color',
			array(
				'label'     => __( 'Color', 'premium-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .premium-fb-rev-reviewer-link' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'reviewer_hover_color',
			array(
				'label'     => __( 'Hover Color', 'premium-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .premium-fb-rev-reviewer-link:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'reviewer_typo',
				'selector' => '{{WRAPPER}} .premium-fb-rev-reviewer-link',
			)
		);

		$this->add_responsive_control(
			'reviewer_margin',
			array(
				'label'      => __( 'Margin', 'premium-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-reviewer-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'date_style',
			array(
				'label'     => __( 'Date', 'premium-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'date' => 'yes',
				),
			)
		);

		$this->add_control(
			'date_color',
			array(
				'label'     => __( 'Color', 'premium-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .premium-fb-rev-time .premium-fb-rev-time-text' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'reviewer_date_color_hover',
			array(
				'label'     => __( 'Hover Color', 'premium-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .premium-fb-rev-time .premium-fb-rev-time-text:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'date_typo',
				'selector' => '{{WRAPPER}} .premium-fb-rev-time .premium-fb-rev-time-text',
			)
		);

		$this->add_responsive_control(
			'date_margin',
			array(
				'label'      => __( 'Margin', 'premium-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-time' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'reviewer_txt',
			array(
				'label'     => __( 'Review Text', 'premium-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'text' => 'yes',
				),
			)
		);

		$this->add_control(
			'reviewer_txt_color',
			array(
				'label'     => __( 'Color', 'premium-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} .premium-fb-rev-text' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'reviewer_txt_typo',
				'selector' => '{{WRAPPER}} .premium-fb-rev-text',
			)
		);

		$this->add_responsive_control(
			'reviewer_txt_margin',
			array(
				'label'      => __( 'Margin', 'premium-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-text-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'readmore_style',
			array(
				'label'     => __( 'Readmore Text', 'premium-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'words_num!' => '',
				),
			)
		);

		$this->add_control(
			'readmore_color',
			array(
				'label'     => __( 'Color', 'premium-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .premium-fb-rev-readmore' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'readmore_hover_color',
			array(
				'label'     => __( 'Hover Color', 'premium-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .premium-fb-rev-readmore:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'readmore_typo',
				'selector' => '{{WRAPPER}} .premium-fb-rev-readmore',
			)
		);

		$this->add_responsive_control(
			'readmore_margin',
			array(
				'label'      => __( 'Margin', 'premium-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-readmore' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'container',
			array(
				'label' => __( 'Container', 'premium-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'container_width',
			array(
				'label'      => __( 'Max Width', 'premium-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 300,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .elementor-widget-container' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'container_align',
			array(
				'label'     => __( 'Alignment', 'premium-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Left', 'premium-addons-pro' ),
						'icon'  => 'fa fa-align-left',
					),
					'center'     => array(
						'title' => __( 'Center', 'premium-addons-pro' ),
						'icon'  => 'fa fa-align-center',
					),
					'flex-end'   => array(
						'title' => __( 'Right', 'premium-addons-pro' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}}' => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'container_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .premium-fb-rev-container',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'container_border',
				'selector' => '{{WRAPPER}} .premium-fb-rev-container',
			)
		);

		$this->add_control(
			'container_border_radius',
			array(
				'label'      => __( 'Border Radius', 'premium-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-container' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'container_box_shadow',
				'selector' => '{{WRAPPER}} .premium-fb-rev-container',
			)
		);

		$this->add_responsive_control(
			'container_margin',
			array(
				'label'      => __( 'Margin', 'premium-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'container_padding',
			array(
				'label'      => __( 'Padding', 'premium-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'carousel_arrows_style',
			array(
				'label'     => __( 'Carousel Arrows', 'premium-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'reviews_carousel' => 'yes',
				),
			)
		);

		$this->add_control(
			'arrow_color',
			array(
				'label'     => __( 'Color', 'premium-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .premium-fb-rev-container .slick-arrow' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'arrow_size',
			array(
				'label'      => __( 'Size', 'premium-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-container .slick-arrow i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'arrow_background',
			array(
				'label'     => __( 'Background Color', 'premium-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} .premium-fb-rev-container .slick-arrow' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'arrow_border_radius',
			array(
				'label'      => __( 'Border Radius', 'premium-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-container .slick-arrow' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'arrow_padding',
			array(
				'label'      => __( 'Padding', 'premium-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .premium-fb-rev-container .slick-arrow' => 'padding: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'carousel_dots_style',
			array(
				'label'     => __( 'Carousel Dots', 'premium-addons-for-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'reviews_carousel' => 'yes',
					'carousel_dots'    => 'yes',
				),
			)
		);

		$this->add_control(
			'carousel_dot_color',
			array(
				'label'     => __( 'Color', 'premium-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} ul.slick-dots li' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'carousel_dot_active_color',
			array(
				'label'     => __( 'Active Color', 'premium-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} ul.slick-dots li.slick-active' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

	}

	/**
	 * Render Google Reviews widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$id = $this->get_id();

		$api_key = $settings['api_key'];

		$place_id = $settings['place_id'];

		$transient = $settings['reload'];

		$is_edit_mode = \Elementor\Plugin::$instance->editor->is_edit_mode();

		if ( empty( $api_key ) || empty( $place_id ) ) { ?>
			<div class="premium-error-notice">
				<?php echo esc_html( __( 'Please Enter a Valid API Key & Place ID', 'premium-addons-pro' ) ); ?>
			</div>
			<?php
			return;
		}

		$transient_name = sprintf( 'papro_reviews_%s_%s', $place_id, $id );

		do_action( 'papro_reviews_transient', $transient_name, $settings );

		if ( $is_edit_mode ) {
			$response = false;
		} else {
			$response = get_transient( $transient_name );
		}

		if ( false === $response ) {

			sleep( 2 );

			$lang_prefix = $settings['language_prefix'];

			$response = premium_google_rev_api_rating( $api_key, $place_id, $lang_prefix );

			$response_data = $response['data'];

			$response_json = rplg_json_decode( $response_data );

			$response = $response_json;

			if ( isset( $response->error_message ) ) {
				$error_message = $response->error_message;
				?>
				<div class="premium-error-notice">
					<?php
						echo wp_kses_post( sprintf( 'Something went wrong: %s', $error_message ) );
					?>
				</div>
				<?php
				return;
			}

			$expire_time = Helper_Functions::transient_expire( $transient );

			set_transient( $transient_name, $response, $expire_time );

		}

		$response_results = $response->result;

		$result_status = $response->status;

		if ( 'OK' !== $result_status || ! property_exists( $response_results, 'reviews' ) ) {
			?>
			<div class="premium-error-notice">
				<?php
					echo wp_kses_post( sprintf( 'Something went wrong, error: %s', $result_status ) );
				?>
			</div>
			<?php
			delete_transient( $transient_name );
			return false;
		}

		$place = $response_results;

		$reviews = $place->reviews;

		$rating = 0;

		if ( isset( $place->rating ) ) {

			if ( $place->rating > $rating ) {

				$rating = $place->rating;

			}
		} elseif ( ! empty( $reviews ) ) {

			if ( count( $reviews ) > 0 ) {

				foreach ( $reviews as $review ) {

					$rating = $rating + $review->rating;

				}

				$rating = round( $rating / count( $reviews ), 1 );
				$rating = number_format( (float) $rating, 1, '.', '' );
			}
		}

		if ( 'yes' === $settings['place_info'] && 'yes' === $settings['place_custom_image_switch'] ) {

			$image_src = $settings['place_custom_image'];

			$image_src_size = Group_Control_Image_Size::get_attachment_image_src( $image_src['id'], 'thumbnail', $settings );

			if ( empty( $image_src_size ) ) {
				$image_src_size = $image_src['url'];
			} else {
				$image_src_size = $image_src_size;
			}

			$custom_image = ! empty( $image_src_size ) ? $image_src_size : '';

		} else {
			$custom_image = '';
		}

		$show_stars = 'yes' === $settings['stars'] ? true : false;

		$show_date = 'yes' === $settings['date'] ? true : false;

		$date_format = $settings['date_format'];

		$this->add_render_attribute( 'place_dir', 'class', 'premium-fb-rev-page' );

		$this->add_render_attribute( 'reviews', 'class', 'premium-fb-rev-content' );

		$place_rate = ( 'yes' === $settings['place_info'] && 'yes' === $settings['place_rate'] ) ? true : false;

		$rev_text = 'yes' === $settings['text'] ? true : false;

		$rev_length = $settings['words_num'];

		$place_star_size   = ! empty( $settings['place_star_size'] ) ? $settings['place_star_size'] : 16;
		$place_fill_color  = ! empty( $settings['place_fill'] ) ? $settings['place_fill'] : '#ffab40';
		$place_empty_color = ! empty( $settings['place_empty'] ) ? $settings['place_empty'] : '#ccc';

		$rev_star_size   = ! empty( $settings['reviews_star_size'] ) ? $settings['reviews_star_size'] : 16;
		$rev_fill_color  = ! empty( $settings['reviews_fill'] ) ? $settings['reviews_fill'] : '#6ec1e4';
		$rev_empty_color = ! empty( $settings['reviews_empty'] ) ? $settings['reviews_empty'] : '#ccc';

		if ( 'yes' === $settings['limit'] ) {
			// phpcs:ignore WordPress.PHP.StrictComparisons
			if ( '0' == $settings['limit_num'] ) {
				$limit = 0;
			} else {
				$limit = ! empty( $settings['limit_num'] ) ? $settings['limit_num'] : 5;
			}
		} else {
			$limit = 5;
		}

		if ( 'yes' === $settings['filter'] ) {
			$min_filter = ! empty( $settings['filter_min'] ) ? $settings['filter_min'] : 1;
			$max_filter = ! empty( $settings['filter_max'] ) ? $settings['filter_max'] : 5;
		} else {
			$min_filter = 1;
			$max_filter = 5;
		}

		$carousel = 'yes' === $settings['reviews_carousel'] ? true : false;

		if ( ! empty( $settings['reviews_columns'] ) ) {
			$reviews_number = intval( 100 / substr( $settings['reviews_columns'], 0, strpos( $settings['reviews_columns'], '%' ) ) );
		} else {
			$reviews_number = 2;
		}

		$place_settings = array(
			'image'       => $custom_image,
			'show_name'   => $settings['source_name'],
			'show_image'  => $settings['source_image'],
			'rating'      => $rating,
			'color'       => $place_fill_color,
			'empty_color' => $place_empty_color,
			'stars'       => $settings['source_stars'],
			'stars_size'  => $place_star_size,
			'place_rate'  => $place_rate,
			'key'         => $api_key,
			'id'          => $id,
		);

		$reviews_settings = array(
			'show_image'  => $settings['reviewer_image'],
			'id'          => $place_id,
			'fill_color'  => $rev_fill_color,
			'empty_color' => $rev_empty_color,
			'stars'       => $show_stars,
			'stars_size'  => $rev_star_size,
			'filter_min'  => $min_filter,
			'filter_max'  => $max_filter,
			'date'        => $show_date,
			'format'      => $date_format,
			'limit'       => $limit,
			'text'        => $rev_text,
			'rev_length'  => $rev_length,
			'readmore'    => $settings['readmore'],
			'skin_type'   => $settings['skin_type'],
		);

		$this->add_render_attribute(
			'container',
			'class',
			array(
				'premium-fb-rev-container',
				'google-reviews',
				'premium-reviews-' . $settings['reviews_style'],
			)
		);

		$this->add_render_attribute(
			'container',
			array(
				'data-col'   => $reviews_number,
				'data-style' => $settings['reviews_style'],
			)
		);

		if ( $carousel ) {
			$this->add_render_attribute( 'container', 'data-carousel', $carousel );

			$play  = 'yes' === $settings['carousel_play'] ? true : false;
			$speed = ! empty( $settings['carousel_autoplay_speed'] ) ? $settings['carousel_autoplay_speed'] : 5000;
			$rtl   = 'yes' === $settings['carousel_rtl'] ? true : false;
			$dots  = 'yes' === $settings['carousel_dots'] ? 'true' : 'false';

			$this->add_render_attribute(
				'container',
				array(
					'data-play'  => $play,
					'data-speed' => $speed,
					'data-rtl'   => $rtl,
					'data-dots'  => $dots,
				)
			);

		}

		if ( 'yes' === $settings['schema'] ) {

			$ratings = $response_results->user_ratings_total;

			$address = $response_results->adr_address;

			$name = $response_results->name;

			$this->add_render_attribute(
				'container',
				array(
					'itemscope' => 'Organization',
					'itemtype'  => 'http://schema.org/AggregateRating',
				)
			);
		}

		?>
		<div <?php echo wp_kses_post( $this->get_render_attribute_string( 'container' ) ); ?>>
			<div class="premium-fb-rev-list">
				<?php if ( 'yes' === $settings['place_info'] ) : ?>
					<div <?php echo wp_kses_post( $this->get_render_attribute_string( 'place_dir' ) ); ?>>

						<div class="premium-fb-rev-page-inner">
							<?php premium_reviews_place( $place, $place_settings ); ?>
						</div>

					</div>
				<?php endif; ?>

				<?php if ( ! empty( $reviews ) ) : ?>
					<div <?php echo wp_kses_post( $this->get_render_attribute_string( 'reviews' ) ); ?>>
						<?php premium_google_rev_reviews( $reviews, $reviews_settings ); ?>
					</div>
				<?php endif; ?>
			</div>
			<?php if ( 'yes' === $settings['schema'] ) { ?>
				<span itemprop="ratingValue" class="elementor-screen-only"><?php echo wp_kses_post( $rating ); ?></span>
				<span itemprop="reviewCount" class="elementor-screen-only"><?php echo wp_kses_post( $ratings ); ?></span>
				<div class="elementor-screen-only" itemprop="itemReviewed" itemscope itemtype="http://schema.org/Organization">
					<span itemprop="name" class="elementor-screen-only"><?php echo wp_kses_post( $name ); ?></span>
					<div class="elementor-screen-only" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
						<span itemprop="streetAddress" class="elementor-screen-only"><?php echo wp_kses_post( $address ); ?></span>
					</div>
				</div>
			<?php } ?>
		</div>

		<?php
		if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {

			if ( 'masonry' === $settings['reviews_style'] && 'yes' !== $settings['reviews_carousel'] ) {
				$this->render_editor_script();
			}
		}

	}

	/**
	 * Render Editor Masonry Script.
	 *
	 * @since 1.9.4
	 * @access protected
	 */
	protected function render_editor_script() {

		?>
		<script type="text/javascript">
			jQuery( document ).ready( function( $ ) {

				$( '.premium-fb-rev-reviews' ).each( function() {

					var $node_id 	= '<?php echo esc_attr( $this->get_id() ); ?>',
						scope 		= $( '[data-id="' + $node_id + '"]' ),
						selector 	= $(this);
					if ( selector.closest( scope ).length < 1 ) {
						return;
					}
					var masonryArgs = {
						itemSelector	: '.premium-fb-rev-review-wrap',
						percentPosition : true,
						layoutMode		: 'masonry',
					};

					var $isotopeObj = {};

					selector.imagesLoaded( function() {

						$isotopeObj = selector.isotope( masonryArgs );

						selector.find('.premium-fb-rev-review-wrap').resize( function() {
							$isotopeObj.isotope( 'layout' );
						});
					});

				});
			});
		</script>
		<?php
	}
}
