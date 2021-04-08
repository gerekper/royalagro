<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class WC_Products_Compare_Frontend {
	private static $_this;
	public static $cookie_name;

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 * @return bool
	 */
	public function __construct() {
		self::$_this = $this;

		if ( is_admin() ) {
			add_action( 'wp_ajax_wc_products_compare_add_product_ajax', array( $this, 'add_product_ajax' ) );
			add_action( 'wp_ajax_nopriv_wc_products_compare_add_product_ajax', array( $this, 'add_product_ajax' ) );

		} else {
			// Display compare button after add to cart.
			add_action( 'woocommerce_after_shop_loop_item', array( $this, 'display_compare_button' ), 11 );
			add_action( 'woocommerce_single_product_summary', array( $this, 'display_compare_button' ), 31 );

			add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );
		}

		// Set the cookie name.
		self::$cookie_name = 'wc_products_compare_products';

		add_action( 'init', array( $this, 'add_endpoint' ) );

		add_action( 'template_include', array( $this, 'display_template' ) );
		add_filter( 'pre_get_document_title', array( $this, 'add_page_title' ) );
		add_filter( 'woocommerce_get_breadcrumb', array( $this, 'add_wc_breadcrumb' ) );

		// Yoast SEO Compatability.
		add_filter( 'wpseo_title', array( $this, 'add_page_title' ) );
		add_filter( 'wpseo_breadcrumb_single_link_info', array( $this, 'add_page_title' ) );

		return true;
	}

	/**
	 * Get object instance.
	 *
	 * @since 1.0.0
	 * @return instance object
	 */
	public function get_instance() {
		return self::$_this;
	}

	/**
	 * Get the endpoint.
	 *
	 * @since 1.0.0
	 * @return string $endpoint
	 */
	public static function get_endpoint() {

		// set the endpoint per user setting
		return apply_filters( 'woocommerce_products_compare_end_point', 'products-compare' );
	}

	/**
	 * Get the page title.
	 *
	 * @since 1.0.5
	 * @return string $title
	 */
	public static function get_page_title() {
		return apply_filters( 'woocommerce_products_compare_page_title', __( 'Products Compare', 'woocommerce-products-compare' ) );
	}

	/**
	 * Check if the current page is the products compare page.
	 *
	 * @since 1.0.5
	 * @return bool
	 */
	public function is_compare_page() {
		global $wp_query;

		return array_key_exists( $this->get_endpoint(), $wp_query->query_vars );
	}

	/**
	 * Load frontend scripts.
	 *
	 * @since 1.0.0
	 * @return bool
	 */
	public function load_scripts() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_enqueue_script( 'wc_products_compare_script', plugins_url( 'assets/js/frontend' . $suffix . '.js', dirname( __FILE__ ) ), array( 'jquery', 'jquery-cookie' ), WC_PRODUCTS_COMPARE_VERSION, true );

		// Maximum products allowed to be compared.
		$max_products = apply_filters( 'woocommerce_products_compare_max_products', 5 );

		$localized_vars = array(
			'ajaxurl'              => admin_url( 'admin-ajax.php' ),
			'ajaxAddProductNonce'  => wp_create_nonce( '_wc_products_compare_add_product_nonce' ),
			'noCookies'            => __( 'Sorry, you must have cookies enabled in your browser to use compare products feature', 'woocommerce-products-compare' ),
			'cookieName'           => self::$cookie_name,
			'cookieExpiry'         => apply_filters( 'woocommerce_products_compare_cookie_expiry', 7 ),
			'maxProducts'          => $max_products,
			'maxAlert'             => sprintf( __( 'Sorry, a maximum of %s products can be compared at one time.', 'woocommerce-products-compare' ), $max_products ),
			'noProducts'           => WC_products_compare_Frontend::empty_message(),
			'moreProducts'         => __( 'Please add at least 2 or more products to compare.', 'woocommerce-products-compare' ),
			'widgetNoProducts'     => __( 'Add some products to compare.', 'woocommerce-products-compare' ),
			'widgetRemoveProducts' => __( 'Remove all products', 'woocommerce-products-compare' ),
		);

		wp_localize_script( 'wc_products_compare_script', 'wc_products_compare_local', $localized_vars );

		wp_enqueue_style( 'wc_products_compare_style', plugins_url( 'assets/css/frontend.css', dirname( __FILE__ ) ), array( 'dashicons' ), WC_PRODUCTS_COMPARE_VERSION );

		return true;
	}

	/**
	 * Add compare page endpoint to permalink structure.
	 *
	 * @since 1.0.0
	 * @return bool
	 */
	public function add_endpoint() {
		add_rewrite_endpoint( $this->get_endpoint(), EP_ROOT );

		// Only flush once on activate when endpoint is not yet set.
		if ( ! get_option( 'wc_products_compare_endpoint_set', false ) ) {
			flush_rewrite_rules();

			// update option so this doesn't need to run again
			update_option( 'wc_products_compare_endpoint_set', true );
		}

		return true;
	}

	/**
	 * Return the page title for compare page.
	 *
	 * @since 1.0.5
	 * @return string $title
	 */
	public function add_page_title( $title ) {
		if ( $this->is_compare_page() ) {
			$title = $this->get_page_title();
		}

		return $title;
	}

	/**
	 * Add a breadcrumb for the compare page.
	 *
	 * @since 1.0.5
	 * @return array $crumbs
	 */
	public function add_wc_breadcrumb( $crumbs) {
		if ( $this->is_compare_page() ) {
			$crumbs[1] = array( $this->get_page_title() );
		}

		return $crumbs;
	}

	/**
	 * Display the compare page template.
	 *
	 * @since 1.0.0
	 * @since 1.0.20 Use WC core get template function.
	 * @return mixed
	 */
	public function display_template( $path ) {
		if ( $this->is_compare_page() ) {
			wc_get_template(
				'products-compare-page-html.php',
				'',
				'',
				plugin_dir_path( dirname( __FILE__ ) ) . 'templates/'
			);

			exit;
		}

		return $path;
	}

	/**
	 * Display compare button.
	 *
	 * @since 1.0.0
	 * @return $html mixed
	 */
	public function display_compare_button() {
		global $post;

		$name = __( 'Compare', 'woocommerce-products-compare' );

		$checked = checked( $this->is_listed( $post->ID ), true, false );

		$html = '<p class="woocommerce-products-compare-compare-button"><label for="woocommerce-products-compare-checkbox-' . esc_attr( $post->ID ) . '"><input type="checkbox" class="woocommerce-products-compare-checkbox" data-product-id="' . esc_attr( $post->ID ) . '" ' . $checked . ' id="woocommerce-products-compare-checkbox-' . esc_attr( $post->ID ) . '" />&nbsp;' . $name . '</label> <a href="' . get_home_url() . '/' . $this->get_endpoint() . '" title="' . esc_attr__( 'Compare Page', 'woocommerce-products-compare' ) . '" class="woocommerce-products-compare-compare-link"><span class="dashicons dashicons-external"></span></a></p>';

		echo apply_filters( 'woocommerce_products_compare_compare_button', $html, $post->ID, $checked );

		return true;
	}

	/**
	 * Checks if the product is listed in the compared products cookie.
	 *
	 * @since 1.0.0
	 * @param $product_id int
	 * @return bool
	 */
	public function is_listed( $product_id ) {
		$products = $this->get_compared_products(); // Comma delimited string.

		// List exists.
		if ( $products && is_array( $products ) && in_array( (string) $product_id, $products ) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Get the selected compared products from cookie.
	 *
	 * @since 1.0.0
	 * @return $ids array
	 */
	public static function get_compared_products() {
		$products = isset( $_COOKIE[ self::$cookie_name ] ) ? $_COOKIE[ self::$cookie_name ] : false;

		// Check if list exists.
		if ( ! empty( $products ) ) {
			// Convert it back to array.
			$products = explode( ',', $products );
		} else {
			$products = false;
		}

		return $products;
	}

	/**
	 * Get product metas headers.
	 *
	 * @since 1.0.0
	 * @param array $products
	 * @return array $headers
	 */
	public static function get_product_meta_headers( $products = array() ) {
		if ( empty( $products ) ) {
			return 0;
		}

		$headers = array();

		foreach ( $products as $product ) {

			$product = wc_get_product( $product );

			if ( ! WC_Products_Compare::is_product( $product ) ) {
				continue;
			}

			$attributes = $product->get_attributes();

			$description = version_compare( WC_VERSION, '3.0.0', '<' ) ? $product->post->post_content : $product->get_description();

			if ( ! empty( $description ) ) {
				$headers[] = 'description';
			}

			if ( $product->get_sku() ) {
				$headers[] = 'sku';
			}

			if ( $product->managing_stock() ) {
				$headers[] = 'stock';
			}

			if ( is_array( $attributes ) && ! empty( $attributes ) ) {
				foreach ( $attributes as $attribute => $value ) {
					if ( ! in_array( $attribute, $headers, true ) && $value['is_visible'] ) {
						$headers[] = $value->get_name();
					}
				}
			}
		}

		// Remove any duplicates.
		$headers = array_unique( $headers );

		// Move description to the top.
		if ( in_array( 'description', $headers, true ) ) {
			// Get array key index position.
			$index = array_search( 'description', $headers );

			unset( $headers[ $index ] );

			array_unshift( $headers, 'description' );
		}

		// Move sku to the top.
		if ( in_array( 'sku', $headers, true ) ) {
			// Get array key index position.
			$index = array_search( 'sku', $headers );

			unset( $headers[ $index ] );

			array_unshift( $headers, 'sku' );
		}

		// Move stock to the top.
		if ( in_array( 'stock', $headers, true ) ) {
			// Get array key index position.
			$index = array_search( 'stock', $headers );

			unset( $headers[ $index ] );

			array_unshift( $headers, 'stock' );
		}

		return apply_filters( 'woocommerce_products_compare_meta_headers', $headers );		
	}

	/**
	 * Displays empty compare page message and link
	 *
	 * @since 1.0.0
	 * @return mix $html
	 */
	public static function empty_message() {
		$html = '';

		$html .= '<p>' . esc_html__( 'Sorry you do not have any products to compare.', 'woocommerce-products-compare' ) . '</p>' . PHP_EOL;

		$html .= '<p class="return-to-shop">' . PHP_EOL;

		$html .= '<a href="' . apply_filters( 'woocommerce_return_to_shop_redirect', get_permalink( wc_get_page_id( 'shop' ) ) ) . '" title="' . esc_attr__( 'Return to Shop.', 'woocommerce-products-compare' ) . '" class="button wc-backward">' . esc_html__( 'Return to Shop', 'woocommerce-products-compare' ) . '</a>' . PHP_EOL;

		$html .= '</p>' . PHP_EOL;

		return $html;
	}

	/**
	 * Add product ajax
	 *
	 * @since 1.0.0
	 * @return html
	 */
	public function add_product_ajax() {
		$nonce = $_POST['ajaxAddProductNonce'];

		// Bail if nonce don't check out.
		if ( ! wp_verify_nonce( $nonce, '_wc_products_compare_add_product_nonce' ) ) {
			die( 'error' );
		}

		// Bail if no ids submitted.
		if ( ! isset( $_POST['product_id'] ) ) {
			die( 'error' );
		}

		$product_id = sanitize_text_field( $_POST['product_id'] );

		$product = wc_get_product( $product_id );
		$post = get_post( $product_id );

		$html = '';

		$html .= '<li data-product-id="' . esc_attr( $product->get_id() ) . '">' . PHP_EOL;

		$html .= '<a href="' . get_permalink( $product->get_id() ) . '" title="' . esc_attr( $post->post_title ) . '" class="product-link">' . PHP_EOL;

		$html .= $product->get_image( 'shop_thumbnail' ) . PHP_EOL;

		$html .= '<h3>' . $post->post_title . '</h3>' . PHP_EOL;

		$html .= '<a href="#" title="' . esc_attr( 'Remove Product', 'woocommerce-products-compare' ) . '" class="remove-compare-product" data-remove-id="' . esc_attr( $product->get_id() ) . '">' . __( 'Remove Product', 'woocommerce-products-compare' ) . '</a>' . PHP_EOL;

		$html .= '</a>' . PHP_EOL;

		$html .= '</li>' . PHP_EOL;		

		echo $html;
		exit;
	}
}

new WC_Products_Compare_Frontend();
