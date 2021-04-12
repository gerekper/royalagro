<?php 
	if ( ! defined( 'ABSPATH' ) ) { exit; }
		
	global $theplus_options,$post_type_options;
		
add_image_size( 'tp-image-grid', 700, 700, true);

// Check Html Tag
function theplus_html_tag_check(){
	return [ 'div',
		'h1',
		'h2',
		'h3',
		'h4',
		'h5',
		'h6',
		'span',
		'p',
		'header',
		'footer',
		'article',
		'aside',
		'main',
		'nav',		
		'section',		
	];
}		

function theplus_validate_html_tag( $check_tag ) {
	return in_array( strtolower( $check_tag ), theplus_html_tag_check() ) ? $check_tag : 'div';
}

/* WOOCOMMERCE Mini Cart */
function theplus_woocomerce_ajax_cart_update($fragments) {
	if(class_exists('woocommerce')) {		
		ob_start();
		?>			
			
			<div class="cart-wrap"><span><?php echo WC()->cart->get_cart_contents_count(); ?></span></div>
		<?php
		$fragments['.cart-wrap'] = ob_get_clean();
		return $fragments;
	}
}
add_filter('woocommerce_add_to_cart_fragments', 'theplus_woocomerce_ajax_cart_update',10,3);

/*3rd party WC_Product_Subtitle*/
if(!function_exists('product_subtitle_after_title')){
	function product_subtitle_after_title() {
		echo do_shortcode("[product_subtitle]");
	}
}
add_action("theplus_after_product_title","product_subtitle_after_title");
/*3rd party WC_Product_Subtitle*/

/*defer script*/
function tp_defer_scripts( $tag, $handle, $src ) {
			$defer = array( 
	'google_platform_js'
  );
  if ( in_array( $handle, $defer ) ) {
	 return '<script src="' . $src . '" async defer type="text/javascript"></script>' . "\n";
  }
	
	return $tag;
} 

add_filter( 'script_loader_tag', 'tp_defer_scripts', 10, 3 );
/*defer script*/

function theplus_get_thumb_url(){
	return THEPLUS_ASSETS_URL .'images/placeholder-grid.jpg';
}

/* Custom Link url attachment Media */
function plus_attachment_field_media( $form_fields, $post ) {
    $form_fields['plus-gallery-url'] = array(
        'label' => esc_html__('Custom URL','theplus'),
        'input' => 'url',
        'value' => get_post_meta( $post->ID, 'plus_gallery_url', true ),
        'helps' => esc_html__('Gallery Listing Widget Used Custom Url Media','theplus'),
    );
    return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'plus_attachment_field_media', 10, 2 );
function plus_attachment_field_save( $post, $attachment ) {    
    if( isset( $attachment['plus-gallery-url'] ) )
		update_post_meta( $post['ID'], 'plus_gallery_url', esc_url( $attachment['plus-gallery-url'] ) ); 
    
	return $post;	
}
add_filter( 'attachment_fields_to_save', 'plus_attachment_field_save', 10, 2 );
/* Custom Link url attachment Media */

class Theplus_MetaBox {
	
	public static function get($name) {
		global $post;
		
		if (isset($post) && !empty($post->ID)) {
			return get_post_meta($post->ID, $name, true);
		}
		
		return false;
	}
}
function theplus_get_option($options_type,$field){
	$theplus_options=get_option( 'theplus_options' );
	$post_type_options=get_option( 'post_type_options' );
	$values='';
	if($options_type=='general'){
		if(isset($theplus_options[$field]) && !empty($theplus_options[$field])){
			$values=$theplus_options[$field];
		}
	}
	if($options_type=='post_type'){
		if(isset($post_type_options[$field]) && !empty($post_type_options[$field])){
			$values=$post_type_options[$field];
		}
	}
	return $values;
}

function theplus_white_label_option($field){
	$label_options=get_option( 'theplus_white_label' );	
		$values='';
		if(isset($label_options[$field]) && !empty($label_options[$field])){
			$values=$label_options[$field];
		}	
	return $values;
}

function theplus_testimonial_post_name(){
	$post_type_options=get_option( 'post_type_options' );
	$testi_post_type=$post_type_options['testimonial_post_type'];
	$post_name='theplus_testimonial';
	if(isset($testi_post_type) && !empty($testi_post_type)){
		if($testi_post_type=='themes'){
			$post_name=theplus_get_option('post_type','testimonial_theme_name');
		}elseif($testi_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','testimonial_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$post_name=theplus_get_option('post_type','testimonial_plugin_name');
			}
		}elseif($testi_post_type=='themes_pro'){
			$post_name='testimonial';
		}
	}else{
		$post_name='theplus_testimonial';
	}
	return $post_name;
}
function theplus_testimonial_post_category(){
	$post_type_options=get_option( 'post_type_options' );
	$testi_post_type=$post_type_options['testimonial_post_type'];
	$taxonomy_name='theplus_testimonial_cat';
	if(isset($testi_post_type) && !empty($testi_post_type)){
		if($testi_post_type=='themes'){
			$taxonomy_name=theplus_get_option('post_type','testimonial_category_name');
		}else if($testi_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','testimonial_category_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$taxonomy_name=theplus_get_option('post_type','testimonial_category_plugin_name');
			}
		}elseif($testi_post_type=='themes_pro'){
			$taxonomy_name='testimonial_category';
		}
	}else{
		$taxonomy_name='theplus_testimonial_cat';
	}
	return $taxonomy_name;
}
function theplus_client_post_name(){
	$post_type_options=get_option( 'post_type_options' );
	$client_post_type=$post_type_options['client_post_type'];
	$post_name='theplus_clients';
	if(isset($client_post_type) && !empty($client_post_type)){
		if($client_post_type=='themes'){
			$post_name=theplus_get_option('post_type','client_theme_name');
		}elseif($client_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','client_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$post_name=theplus_get_option('post_type','client_plugin_name');
			}
		}elseif($client_post_type=='themes_pro'){
			$post_name='clients';
		}
	}else{
		$post_name='theplus_clients';
	}
	return $post_name;
}
function theplus_client_post_category(){
	$post_type_options=get_option( 'post_type_options' );
	$client_post_type=$post_type_options['client_post_type'];
	$post_name='theplus_clients_cat';
	if(isset($client_post_type) && !empty($client_post_type)){
		if($client_post_type=='themes'){
			$post_name=theplus_get_option('post_type','client_category_name');
		}else if($client_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','client_category_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$post_name=theplus_get_option('post_type','client_category_plugin_name');
			}
		}elseif($client_post_type=='themes_pro'){
			$post_name='clients_category';
		}
	}else{
		$post_name='theplus_clients_cat';
	}
	return $post_name;
}
function theplus_team_member_post_name(){
	$post_type_options=get_option( 'post_type_options' );
	$team_post_type=$post_type_options['team_member_post_type'];
	$post_name='theplus_team_member';
	if(isset($team_post_type) && !empty($team_post_type)){
		if($team_post_type=='themes'){
			$post_name=theplus_get_option('post_type','team_member_theme_name');
		}elseif($team_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','team_member_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$post_name=theplus_get_option('post_type','team_member_plugin_name');
			}
		}elseif($team_post_type=='themes_pro'){
			$post_name='team_member';
		}
	}else{
		$post_name='theplus_team_member';
	}
	return $post_name;
}
function theplus_team_member_post_category(){
	$post_type_options=get_option( 'post_type_options' );
	$team_post_type=$post_type_options['team_member_post_type'];
	$taxonomy_name='theplus_team_member_cat';
	if(isset($team_post_type) && !empty($team_post_type)){
		if($team_post_type=='themes'){
			$taxonomy_name=theplus_get_option('post_type','team_member_category_name');
		}else if($team_post_type=='plugin'){
			$get_name=theplus_get_option('post_type','team_member_category_plugin_name');
			if(isset($get_name) && !empty($get_name)){
				$taxonomy_name=theplus_get_option('post_type','team_member_category_plugin_name');
			}
		}elseif($team_post_type=='themes_pro'){
			$taxonomy_name='team_member_category';
		}
	}else{
		$taxonomy_name='theplus_team_member_cat';
	}
	return $taxonomy_name;
}

function theplus_scroll_animation(){
	
	$theplus_data=get_option( 'theplus_api_connection_data' );
		
	if(isset($theplus_data['scroll_animation_offset']) && !empty($theplus_data['scroll_animation_offset']) && $theplus_data['scroll_animation_offset']!=0){
		$value= $theplus_data['scroll_animation_offset'].'%';
	}else if(isset($theplus_data['scroll_animation_offset']) && !empty($theplus_data['scroll_animation_offset']) && $theplus_data['scroll_animation_offset']==0){
		$value= '85%';
	}else{
		$value= '85%';
	}
	
	return $value;
}
function theplus_excerpt($limit) {
	if(method_exists('WPBMap', 'addAllMappedShortcodes')) {
		WPBMap::addAllMappedShortcodes();
	}
		global $post;
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt).'...';
		} else {
			$excerpt = implode(" ",$excerpt);
		}	
		$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
	
	return $excerpt;
}
function limit_words($string, $word_limit){
	$words = explode(" ",$string);
	return implode(" ",array_splice($words,0,$word_limit));
}	
function theplus_get_title($limit) {
	if(method_exists('WPBMap', 'addAllMappedShortcodes')) {
		WPBMap::addAllMappedShortcodes();
	}
		global $post;
		$title = explode(' ', get_the_title(), $limit);
		if (count($title)>=$limit) {
			array_pop($title);
			$title = implode(" ",$title).'...';
		} else {
			$title = implode(" ",$title);
		}	
		$title = preg_replace('`[[^]]*]`','',$title);
	
	return $title;
}
function theplus_loading_image_grid($postid='',$type=''){
	global $post;
	$content_image='';
	if($type!='background'){		
		$image_url=THEPLUS_ASSETS_URL .'images/placeholder-grid.jpg';
		$content_image='<img src="'.esc_url($image_url).'" alt="'.esc_attr(get_the_title()).'"/>';
		
		return $content_image;
	
	}elseif($type=='background'){
	
		$image_url=THEPLUS_ASSETS_URL .'images/placeholder-grid.jpg';
		$data_src='style="background:url('.esc_url($image_url).') #f7f7f7;" ';
		
		return $data_src;
		
	}
}
function theplus_loading_bg_image($postid=''){
	global $post;
	$content_image='';
	if(!empty($postid)){
		$featured_image=get_the_post_thumbnail_url($postid,'full');
		if(empty($featured_image)){
			$featured_image=theplus_get_thumb_url();
		}
		$content_image='style="background:url('.esc_url($featured_image).') #f7f7f7;"';
		return $content_image;
	}else{
	return $content_image;
	}
}
function theplus_array_flatten($array) {
	  if (!is_array($array)) { 
		return FALSE; 
	  } 
	  $result = array(); 
	  foreach ($array as $key => $value) { 
		if (is_array($value)) { 
		  $result = array_merge($result, theplus_array_flatten($value)); 
		} 
		else { 
		  $result[$key] = $value; 
		} 
	  } 
	  return $result; 
}
function theplus_createSlug($str, $delimiter = '-'){
	
	$slug=preg_replace('/[^A-Za-z0-9-]+/', $delimiter, $str);
	return $slug;
	
} 
/*----------------------------load more posts ---------------------------*/
function theplus_more_post_ajax(){
		global $post;
		ob_start();
		$post_type=$_POST["post_type"];
		$post_load=$_POST["post_load"];
		$texonomy_category=$_POST["texonomy_category"];
		$include_posts=$_POST["include_posts"];
		$exclude_posts=$_POST["exclude_posts"];
		$layout=$_POST["layout"];
		$b_dis_badge_switch=$_POST["badge"];
		$out_of_stock=$_POST["out_of_stock"];
		$variation_price_on=$_POST["variationprice"];
		$hover_image_on_off=$_POST["hoverimagepro"];
		$offset = $_POST["offset"];
		$display_post = $_POST["display_post"];
		$category=$_POST["category"];
		$post_tags=$_POST["post_tags"];
		$ex_cat=$_POST["ex_cat"];
		$ex_tag=$_POST["ex_tag"];
		$post_authors=$_POST["post_authors"];
		$desktop_column=$_POST["desktop_column"];
		$tablet_column=$_POST["tablet_column"];
		$mobile_column=$_POST["mobile_column"];
		$style= $_POST["style"];
		$style_layout= $_POST["style_layout"];
		$filter_category=$_POST["filter_category"];
		$order_by=$_POST["order_by"];
		$post_order=$_POST["post_order"];
		$animated_columns=$_POST["animated_columns"];
		$post_load_more=$_POST["post_load_more"];
		$display_cart_button=$_POST["cart_button"];
		$paged=$_POST["paged"];
		$metro_column=$_POST["metro_column"];
		$metro_style=$_POST["metro_style"];
		$responsive_tablet_metro=$_POST["responsive_tablet_metro"];
		$tablet_metro_column=$_POST["tablet_metro_column"];
		$tablet_metro_style=$_POST["tablet_metro_style"];
		
		$display_post_title=$_POST["display_post_title"];
		$post_title_tag=$_POST["post_title_tag"];
		$title_desc_word_break=$_POST["title_desc_word_break"];
		
		$display_title_limit=$_POST["display_title_limit"];
		$display_title_by=$_POST["display_title_by"];
		$display_title_input=$_POST["display_title_input"];
		$display_title_3_dots=$_POST["display_title_3_dots"];
		
		$feature_image=$_POST["feature_image"];
		
		$display_post_meta=$_POST["display_post_meta"];
		$post_meta_tag_style=$_POST["post_meta_tag_style"];
		$display_post_meta_date=$_POST["display_post_meta_date"];
		$display_post_meta_author=$_POST["display_post_meta_author"];
		$display_post_meta_author_pic=$_POST["display_post_meta_author_pic"];
		$display_excerpt=$_POST["display_excerpt"];
		$post_excerpt_count=$_POST["post_excerpt_count"];
		$display_post_category=$_POST["display_post_category"];
		$post_category_style=$_POST["post_category_style"];
		$dpc_all=$_POST["dpc_all"];
		$featured_image_type=$_POST["featured_image_type"];
		
		$display_thumbnail=$_POST["display_thumbnail"];
		$thumbnail=$_POST["thumbnail"];
		$thumbnail_car=$_POST["thumbnail_car"];
		
		$display_button = $_POST['display_button'];
		$button_style = $_POST['button_style'];
		$before_after = $_POST['before_after'];
		$button_text = $_POST['button_text'];
		$button_icon_style = $_POST['button_icon_style'];
		$button_icon = $_POST['button_icon'];
		$button_icons_mind = $_POST['button_icons_mind'];
		$skin_template = $_POST['skin_template'];
		$dynamic_template =explode(",",$skin_template);
		$display_product=$_POST["display_product"];
		$display_catagory=$_POST["display_catagory"];
		$display_rating=$_POST["display_rating"];
		
		$display_yith_list=$_POST["display_yith_list"];
		$display_yith_compare=$_POST["display_yith_compare"];
		$display_yith_wishlist=$_POST["display_yith_wishlist"];
		$display_yith_quickview=$_POST["display_yith_quickview"];
		
		$dcb_single_product=$_POST["dcb_single_product"];
		$dcb_variation_product=$_POST["dcb_variation_product"];
			
		$desktop_class=$tablet_class=$mobile_class='';
		if($layout!='carousel' && $layout!='metro'){
			if($desktop_column=='5'){
				$desktop_class='theplus-col-5';
			}else{
				$desktop_class='tp-col-lg-'.esc_attr($desktop_column);
			}
			
			$tablet_class='tp-col-md-'.esc_attr($tablet_column);
			$mobile_class='tp-col-sm-'.esc_attr($mobile_column);
			$mobile_class .=' tp-col-'.esc_attr($mobile_column);
		}
		
		$j=1;
		$args = array(
			'post_type' => $post_type,
			'posts_per_page' => $post_load_more,
			$texonomy_category => $category,
			'offset' => $offset,
			'orderby'	=>$order_by,
			'post_status' =>'publish',
			'order'	=>$post_order
		);
		
		if('' !== $ex_tag){
			$ex_tag =explode(",",$ex_tag);
			$args['tag__not_in'] = $ex_tag;
		}
		if('' !== $ex_cat){
			$ex_cat =explode(",",$ex_cat);
			$args['category__not_in'] = $ex_cat;
		}
		
		/*if('' !== $exclude_posts){
			$exclude_posts =explode(",",$exclude_posts);
			$args['post__not_in'] = $exclude_posts;
		}
		if('' !== $include_posts){
			$include_posts =explode(",",$include_posts);
			$args['post__in'] = $include_posts;
		}*/
		
		if(!empty($display_product) && $display_product=='featured'){
			$args['tax_query']     = array(
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => 'featured',
				),
			);
		}
		
		if(!empty($display_product) && $display_product=='on_sale'){
			$args['meta_query']     = array(
				'relation' => 'OR',
				array( // Simple products type
					'key'           => '_sale_price',
					'value'         => 0,
					'compare'       => '>',
					'type'          => 'numeric'
				),
				array( // Variable products type
					'key'           => '_min_variation_sale_price',
					'value'         => 0,
					'compare'       => '>',
					'type'          => 'numeric'
				)
			);
		}
		
		if(!empty($display_product) && $display_product=='top_sales'){
			$args['meta_query']     = array(
				array(
					'key' 		=> 'total_sales',
					'value' 	=> 0,
					'compare' 	=> '>',
					)
			);
		}
		
		if(!empty($display_product) && $display_product=='instock'){
			$args['meta_query']     = array(
				array(
					'key' 		=> '_stock_status',
					'value' 	=> 'instock',												
				)
			);
		}
		
		if(!empty($display_product) && $display_product=='outofstock'){
			$args['meta_query']     = array(
				array(
					'key' 		=> '_stock_status',
					'value' 	=> 'outofstock',												
				)
			);
		}
		
		if ( '' !== $post_tags && $post_type=='post') {
			$post_tags =explode(",",$post_tags);
			$args['tax_query'] = array(
			'relation' => 'AND',
				array(
					'taxonomy'         => 'post_tag',
					'terms'            => $post_tags,
					'field'            => 'term_id',
					'operator'         => 'IN',
					'include_children' => true,
				),
			);
		}
		
		if (!empty($post_type) && ($post_type !='post' && $post_type !='product')) {
			if ( !empty($texonomy_category) && $texonomy_category=='categories' && !empty($category)) {
				$category =explode(",",$category);
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'categories',
						'field' => 'slug',
						'terms' => $category,
					),
				);
			}
		}
		
		if('' !== $post_authors && $post_type=='post'){
			$args['author'] = $post_authors;
		}
		
		$ji=($post_load_more*$paged)-$post_load_more+$display_post+1;
		$ij='';
		$tablet_metro_class=$tablet_ij='';
		$loop = new WP_Query($args);		
			if ( $loop->have_posts() ) :
				while ($loop->have_posts()) {
					$loop->the_post();
					
					//read more button
					$the_button='';
					if($display_button == 'yes'){
						
						$btn_uid=uniqid('btn');
						$data_class= $btn_uid;
						$data_class .=' button-'.$button_style.' ';
						
						$the_button ='<div class="pt-plus-button-wrapper">';
							$the_button .='<div class="button_parallax">';
								$the_button .='<div class="ts-button">';
									$the_button .='<div class="pt_plus_button '.$data_class.'">';
										$the_button .= '<div class="animted-content-inner">';
											$the_button .='<a href="'.esc_url(get_the_permalink()).'" class="button-link-wrap" role="button" rel="nofollow">';
											$the_button .= include THEPLUS_PATH. 'includes/blog/post-button.php'; 
											$the_button .='</a>';
										$the_button .='</div>';
									$the_button .='</div>';
								$the_button .='</div>';
							$the_button .='</div>';
						$the_button .='</div>';	
					}
					
					
					if($post_load=='blogs'){
						include THEPLUS_PATH ."includes/ajax-load-post/blog-style.php";
					}
					if($post_load=='clients'){
						include THEPLUS_PATH ."includes/ajax-load-post/client-style.php";
					}
					if($post_load=='portfolios'){
						include THEPLUS_PATH ."includes/ajax-load-post/portfolio-style.php";
					}
					if($post_load=='products'){
						include THEPLUS_PATH ."includes/ajax-load-post/product-style.php";
					}
					if($post_load=='dynamiclisting'){
						$template_id='';
						if(!empty($dynamic_template)){
							$count=count($dynamic_template);
							$value = $offset%$count;
							$template_id=$dynamic_template[$value];	
						}
						include THEPLUS_PATH ."includes/ajax-load-post/dynamic-listing-style.php";
						$offset++;
					}
					$ji++;
				}
				$content = ob_get_contents();
				ob_end_clean();
			endif;
		wp_reset_postdata();
		echo $content;
		exit;
		ob_end_clean();
	}
add_action('wp_ajax_theplus_more_post','theplus_more_post_ajax');
add_action('wp_ajax_nopriv_theplus_more_post', 'theplus_more_post_ajax');

function get_current_ID($id){
	$newid = apply_filters( 'wpml_object_id', $id, 'elementor_library', TRUE  );
	return $newid ? $newid : $id;
}


function plus_acf_repeater_field_ajax(){
	$data = [];
	
	if(!empty($_REQUEST['post_id']) && isset($_REQUEST['post_id'])){
	$acf_fields = get_field_objects($_REQUEST['post_id']);
	
		if( $acf_fields ){
			foreach( $acf_fields as $field_name => $field ){
				if($field['type'] == 'repeater'){
					$data[] = [
					  'meta_id' => $field['name'],
					  'text' => $field['label']
					] ;
				}
			}
		}
	}
	wp_send_json_success($data);
}
add_action('wp_ajax_plus_acf_repeater_field','plus_acf_repeater_field_ajax');


function get_acf_repeater_field(){
	
	$data= [];
	if(class_exists('acf') && isset($_GET['post'])){
		$post_id = get_field('tp_preview_post',$_GET['post']);
		$acf_fields = get_field_objects($post_id);
		if( $acf_fields ){
			foreach( $acf_fields as $field_name => $field ){
				if($field['type'] == 'repeater'){
					$data[$field['name']] = $field['label'];
				}
			}
		}
	}
	return $data;
}

/*Wp login ajax*/
function theplus_ajax_login() {
	
	if( (!isset( $_POST['security'] ) || !wp_verify_nonce( $_POST['security'], 'ajax-login-nonce' ) )  ){		
		echo wp_json_encode( ['registered'=>false, 'message'=> esc_html__( 'Ooops, something went wrong, please try again later.', 'theplus' )] );
		exit;
	}
	
	$access_info = [];		
	$access_info['user_login']    = !empty($_POST['username']) ? $_POST['username'] : "";
	$access_info['user_password'] = !empty($_POST['password']) ? $_POST['password'] : "";
	$access_info['rememberme']    = true;
	
	$user_signon = wp_signon( $access_info );
	
	if ( !is_wp_error($user_signon) ){
		
		$userID = $user_signon->ID;
		wp_set_current_user( $userID, $access_info['user_login'] );
		wp_set_auth_cookie( $userID, true, true );
		
		echo wp_json_encode( ['loggedin' => true, 'message'=> esc_html__('Login successful, Redirecting...', 'theplus')] );
		
	} else {
		if ( isset( $user_signon->errors['invalid_email'][0] ) ) {
			
			echo wp_json_encode( ['loggedin' => false, 'message'=> esc_html__('Ops! Invalid Email..!', 'theplus')] );
		} elseif ( isset( $user_signon->errors['invalid_username'][0] ) ) {

			echo wp_json_encode( ['loggedin' => false, 'message'=> esc_html__('Ops! Invalid Username..!', 'theplus')] );
		} elseif ( isset( $user_signon->errors['incorrect_password'][0] ) ) {
			
			echo wp_json_encode( ['loggedin' => false, 'message'=> esc_html__('Ops! Incorrent Password..!', 'theplus')] );
		}
	}
	die();
}
add_action( 'wp_ajax_nopriv_theplus_ajax_login', 'theplus_ajax_login' );
/*Wp login ajax*/

/* login social application facebook/google */
function tp_login_social_app( $name, $email, $post_id, $widget_id, $type = ''){
	$response	= [];
	$user_data	= get_user_by( 'email', $email ); 

	if ( ! empty( $user_data ) && $user_data !== false ) {
		$user_ID = $user_data->ID;
		wp_set_auth_cookie( $user_ID );
		wp_set_current_user( $user_ID, $name );
		do_action( 'wp_login', $user_data->user_login, $user_data );
		echo wp_json_encode( ['loggedin' => true, 'message'=> esc_html__('Login successful, Redirecting...', 'theplus')] );
	} else {
		
		$password = wp_generate_password( 12, true, false );
		
		$args = [
			'user_login' => $name,
			'user_pass'  => $password,
			'user_email' => $email,
			'first_name' => $name,
		];
		
		if ( username_exists( $name ) ) {
			$suffix_id = '-' . zeroise( wp_rand( 0, 9999 ), 4 );
			$name  .= $suffix_id;

			$args['user_login'] = strtolower( preg_replace( '/\s+/', '', $name ) );
		}

		$result = wp_insert_user( $args );

		$user_data = get_user_by( 'email', $email );

		if ( $user_data ) {
			$user_ID    = $user_data->ID;
			$user_email = $user_data->user_email;

			$user_meta = array(
				'login_source' => $type,
			);

			update_user_meta( $user_ID, 'theplus_login_form', $user_meta );
			
			if(!empty($post_id) && !empty($widget_id)){
				$elementor = \Elementor\Plugin::$instance;			
				$meta_data = $elementor->documents->get( $post_id )->get_elements_data();
				
				$widget_data = get_element_widget_data( $meta_data, $widget_id );
				
				$widget_settings = $elementor->elements_manager->create_element_instance( $widget_data );
				
				$get_settings = $widget_settings->get_settings();
				
				if(!empty($get_settings) && !empty($get_settings['user_role'])){
					$role = $get_settings['user_role'];
					if(!empty($role)){
						wp_update_user( array ('ID' => $user_ID, 'role' => $role) ) ;
					}
				}
			}
			
			if ( wp_check_password( $password, $user_data->user_pass, $user_data->ID ) ) {
				wp_set_auth_cookie( $user_ID );
				wp_set_current_user( $user_ID, $name );
				do_action( 'wp_login', $user_data->user_login, $user_data );
				echo wp_json_encode( ['loggedin' => true, 'message'=> esc_html__('Login successful, Redirecting...', 'theplus')] );
			}
		}
	}
	
	die();
}
/* login social application facebook/google */

/*facebook verify data*/
function tp_facebook_verify_data_user( $fb_token, $fb_id, $fb_secret ) {
	$fb_api = 'https://graph.facebook.com/oauth/access_token';
	$fb_api = add_query_arg( [
		'client_id'     => $fb_id,
		'client_secret' => $fb_secret,
		'grant_type'    => 'client_credentials',
	], $fb_api );

	$fb_res = wp_remote_get( $fb_api );

	if ( is_wp_error( $fb_res ) ) {
		wp_send_json_error();
	}

	$fb_response = json_decode( wp_remote_retrieve_body( $fb_res ), true );

	$app_token = $fb_response['access_token'];

	$debug_token = 'https://graph.facebook.com/debug_token';
	$debug_token = add_query_arg( [
		'input_token'  => $fb_token,
		'access_token' => $app_token,
	], $debug_token );

	$response = wp_remote_get( $debug_token );

	if ( is_wp_error( $response ) ) {
		return false;
	}

	return json_decode( wp_remote_retrieve_body( $response ), true );
}

function tp_facebook_get_user_email( $user_id, $access_token ){
	$fb_url = 'https://graph.facebook.com/' . $user_id;
	$fb_url = add_query_arg( [
		'fields'       => 'email',
		'access_token' => $access_token,
	], $fb_url );

	$response = wp_remote_get( $fb_url );

	if ( is_wp_error( $response ) ) {
		return false;
	}

	return json_decode( wp_remote_retrieve_body( $response ), true );
}
/*facebook verify data*/

/*Wp facebook social login ajax*/
function theplus_ajax_facebook_login() {
	
	if(!get_option('users_can_register')){
		echo wp_json_encode( ['registered'=>false, 'message'=> esc_html__( 'Registration option not enbled in your general settings.', 'theplus' )] );
		die();
	}
	
	if( (!isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'ajax-login-nonce' ) )  ){		
		echo wp_json_encode( ['registered'=>false, 'message'=> esc_html__( 'Ooops, something went wrong, please try again later.', 'theplus' )] );
		die();
	}
	
	$access_token = (!empty( $_POST['accessToken'] )) ? sanitize_text_field( $_POST['accessToken'] ) : '';
	$user_id = (!empty( $_POST['id'] )) ? sanitize_text_field( $_POST['id'] ) : 0;
	$email	=	(isset($_POST['email'])) ? sanitize_email($_POST['email']) : '';
	$name	=	(isset($_POST['name'])) ? sanitize_user( $_POST['name'] ) : '';
	$page_id	=	(isset($_POST['page_id'])) ? sanitize_text_field( $_POST['page_id'] ) : '';
	$widget_id	=	(isset($_POST['widget_id'])) ? sanitize_text_field( $_POST['widget_id'] ) : '';
	
	$fb_data= get_option( 'theplus_api_connection_data' );
	$fb_app_id = (!empty($fb_data['theplus_facebook_app_id'])) ? $fb_data['theplus_facebook_app_id'] : '';
	$fb_secret_id = (!empty($fb_data['theplus_facebook_app_secret'])) ? $fb_data['theplus_facebook_app_secret'] : '';
				
	$verify_data = tp_facebook_verify_data_user( $access_token, $fb_app_id, $fb_secret_id );
	
	if ( empty( $user_id ) || ( $user_id !== $verify_data['data']['user_id'] ) || empty( $verify_data ) || empty( $fb_app_id ) || empty( $fb_secret_id ) || ( $fb_app_id !== $verify_data['data']['app_id'] ) || ( ! $verify_data['data']['is_valid'] ) ) {
		echo wp_json_encode( ['loggedin' => false, 'message'=> esc_html__('Invalid Authorization', 'theplus')] );
		die();
	}
	
	$email_res = tp_facebook_get_user_email( $verify_data['data']['user_id'], $access_token );
	
	if ( !empty( $email ) && ( empty( $email_res['email'] ) || $email_res['email'] !== $email ) ) {
		echo wp_json_encode( ['loggedin' => false, 'message'=> esc_html__('Facebook email validation failed', 'theplus')] );
		die();
	}

	$verify_email = !empty( $email ) && !empty( $email_res['email'] ) ? sanitize_email( $email_res['email'] ) : $verify_data['user_id'] . '@facebook.com';
	
	tp_login_social_app( $name, $verify_email, $page_id, $widget_id, 'facebook' );
	
	die();
}

add_action( 'wp_ajax_nopriv_theplus_ajax_facebook_login', 'theplus_ajax_facebook_login' );
/*Wp facebook social login ajax*/

/*Google Login Start*/
/*verify google */
function tp_verify_google_data_user( $token, $client_id ){
	require_once THEPLUS_INCLUDES_URL . 'vendor/autoload.php';

	$client_data = new \Google_Client( array( 'client_id' => $client_id ) );  //PHPCS:ignore:PHPCompatibility.PHP.ShortArray.Found

	$verified = $client_data->verifyIdToken( $token );

	if ( $verified ) {
		return $verified;
	} else {
		echo wp_json_encode( ['loggedin' => false, 'message'=> esc_html__('Unauthorized access', 'theplus')] );
		die();
	}
}
/*verify google */
add_action( 'wp_ajax_nopriv_theplus_google_ajax_register', 'theplus_google_ajax_register' );
function theplus_google_ajax_register() {
	
	if(!get_option('users_can_register')){
		echo wp_json_encode( ['registered'=>false, 'message'=> esc_html__( 'Registration option not enbled in your general settings.', 'theplus' )] );
		exit;
	}
	
	if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'ajax-login-nonce' ) ){		
		echo wp_json_encode( ['registered'=>false, 'message'=> esc_html__( 'Ooops, something went wrong, please try again later.', 'theplus' )] );
		exit;
	 }
	
	$response  = array();
	$user_data = array();
	$result    = '';
	$response['loggedin'] = false;
	$response['message'] = 'Invalid User.';
	if ( isset( $_POST['email'] ) && sanitize_email( $_POST['email'] ) ) {
		
		$name       = isset( $_POST['name'] ) ? sanitize_text_field($_POST['name']) : '';
		$email      = isset( $_POST['email'] ) ? sanitize_email($_POST['email']) : '';
		$page_id	=	(isset($_POST['page_id'])) ? sanitize_text_field( $_POST['page_id'] ) : '';
		$widget_id	=	(isset($_POST['widget_id'])) ? sanitize_text_field( $_POST['widget_id'] ) : '';
		$id_token = filter_input( INPUT_POST, 'id_token', FILTER_SANITIZE_STRING );
		$google_data= get_option( 'theplus_api_connection_data' );
		$client_id = (!empty($google_data['theplus_google_client_id'])) ? $google_data['theplus_google_client_id'] : '';
		$verified = tp_verify_google_data_user( $id_token, $client_id );

		if ( empty( $verified ) ) {
			echo wp_json_encode( ['loggedin'=>false, 'message'=> esc_html__( 'User not verified by Google', 'theplus' )] );
			exit;
		}
		
		$v_client_id = isset( $verified['aud'] ) ? $verified['aud'] : '';
		$v_name      = isset( $verified['name'] ) ? $verified['name'] : '';
		$v_email     = isset( $verified['email'] ) ? $verified['email'] : '';
		

		if ( ( $client_id !== $v_client_id ) || ( $email !== $v_email ) || ( $name !== $v_name ) ) {
			echo wp_json_encode( ['loggedin'=>false, 'message'=> esc_html__( 'User not verified by Google', 'theplus' )] );
			exit;
		}

		tp_login_social_app( $v_name, $v_email, $page_id, $widget_id, 'google' );
		
	} else {
		echo wp_json_encode( $response );
		die;
	}
}
/*google login end*/

/*Forgot Password*/
function theplus_ajax_forgot_password_ajax() {
	global $wpdb, $wp_hasher;
	
	$nonce = $_POST['nonce'];
	
	if ( ! wp_verify_nonce( $nonce, 'tp_user_lost_password_action' ) )
        die ( 'Security checked!');
		
	$user_login = $_POST['user_login'];
	
	$errors = new WP_Error();
 
    if ( empty( $_POST['user_login'] ) || ! is_string( $_POST['user_login'] ) ) {        
		echo wp_json_encode( [ 'lost_pass'=>'empty_username', 'message'=> sprintf(__( '<strong>ERROR</strong>: Enter a username or email address.','theplus' )) ] );
		exit;
    } elseif ( strpos( $_POST['user_login'], '@' ) ) {
        $user_data = get_user_by( 'email', trim( wp_unslash( $_POST['user_login'] ) ) );
        if ( empty( $user_data ) ) {          
			echo wp_json_encode( [ 'lost_pass'=>'invalid_email', 'message'=> sprintf(__( '<strong>ERROR</strong>: There is no account with that username or email address.','theplus' )) ] );
			exit;
        }
    } else {
        $login     = trim( $_POST['user_login'] );
        $user_data = get_user_by( 'login', $login );
		if ( ! $user_data ) {			
			echo wp_json_encode( [ 'lost_pass'=>'invalidcombo', 'message'=> sprintf(__( '<strong>ERROR</strong>: There is no account with that username or email address.','theplus' )) ] );
			exit;
		}
    }
 
    do_action( 'lostpassword_post', $errors );

    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;
    $key        = get_password_reset_key( $user_data );

    if ( is_wp_error( $key ) ) {
		return $key;
    }

    if ( is_multisite() ) {
		$site_name = get_network()->site_name;
    } else {
		$site_name = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
	}
	
	/*forgot password mail*/
	if(!empty($_POST['tceol']) && (!empty($_POST['tceol']['tp_cst_email_lost_opt']) && $_POST['tceol']['tp_cst_email_lost_opt']=='yes')){
					
		$elsub =  html_entity_decode($_POST['tceol']['tp_cst_email_lost_subject']);
		$elmsg =  html_entity_decode($_POST['tceol']['tp_cst_email_lost_message']);
		$reset_url = $_POST["resetpageurl"];
		$forgot_url = $_POST["forgotpageurl"];
		if(!empty($_POST["f_p_opt"]) && $_POST["f_p_opt"]=='default'){		
			$tplr_link = network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' );		
		}else if(!empty($_POST["f_p_opt"]) && $_POST["f_p_opt"]=='f_p_frontend'){		
			$tplr_link = network_site_url( "wp-login.php?action=theplusrp&key=$key&redirecturl=$reset_url&forgoturl=$forgot_url&login=" . rawurlencode( $user_login ), 'login' );
		}
		
		$elfind = array( '/\[tplr_sitename\]/', '/\[tplr_username\]/', '/\[tplr_link\]/' );
		$lrreplacement = array( $site_name,$user_login,$tplr_link);		
		$clrmessage = preg_replace( $elfind,$lrreplacement,$elmsg );
		
		$lrheaders = array( 'Content-Type: text/html; charset=UTF-8' );
		 
		wp_mail( $user_email, $elsub, $clrmessage, $lrheaders );
		
	}else{ 
		$message = esc_html__( 'Someone has requested a password reset for the following account:','theplus' ) . "\r\n\r\n";

		$message .= sprintf( esc_html__( 'Site Name: %s','theplus' ), $site_name ) . "\r\n\r\n";

		$message .= sprintf( esc_html__( 'Username: %s','theplus' ), $user_login ) . "\r\n\r\n";
		$message .= esc_html__( 'If this was a mistake, just ignore this email and nothing will happen.','theplus' ) . "\r\n\r\n";
		$message .= esc_html__( 'To reset your password, visit the following address:','theplus' ) . "\r\n\r\n";
		
		$reset_url = $_POST["resetpageurl"];
		$forgot_url = $_POST["forgotpageurl"];
		if(!empty($_POST["f_p_opt"]) && $_POST["f_p_opt"]=='default'){		
			$message .= '<' . network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . ">\r\n";		
		}else if(!empty($_POST["f_p_opt"]) && $_POST["f_p_opt"]=='f_p_frontend'){		
			$message .= '<' . network_site_url( "wp-login.php?action=theplusrp&key=$key&redirecturl=$reset_url&forgoturl=$forgot_url&login=" . rawurlencode( $user_login ), 'login' ) . ">\r\n";
		}
	}
	

	$title = sprintf( esc_html__( '[%s] Password Reset','theplus' ), $site_name );

	$title = apply_filters( 'retrieve_password_title', $title, $user_login, $user_data );

	$message = apply_filters( 'retrieve_password_message', $message, $key, $user_login, $user_data );
	
	if(!empty($_POST['tceol']) && (!empty($_POST['tceol']['tp_cst_email_lost_opt']) && $_POST['tceol']['tp_cst_email_lost_opt']=='yes')){
		echo wp_json_encode( [ 'lost_pass'=>'confirm', 'message'=> esc_html__('Check your e-mail for the reset password link.','theplus') ] );
	}else{
		if ( wp_mail( $user_email, wp_specialchars_decode( $title ), $message ) )
		echo wp_json_encode( [ 'lost_pass'=>'confirm', 'message'=> esc_html__('Check your e-mail for the reset password link.','theplus') ] );
	else
		echo wp_json_encode( [ 'lost_pass'=>'could_not_sent', 'message'=> esc_html__('The e-mail could not be sent.','theplus') . "<br />\n" . esc_html__('Possible reason: your host may have disabled the mail() function.','theplus') ] );
	}
	

	exit;
}
add_action( 'wp_ajax_nopriv_theplus_ajax_forgot_password', 'theplus_ajax_forgot_password_ajax' );
add_action( 'wp_ajax_theplus_ajax_forgot_password', 'theplus_ajax_forgot_password_ajax' );
/*Forgot Password*/
/*reset password start*/
add_action( 'wp_ajax_nopriv_theplus_ajax_reset_password', 'theplus_ajax_reset_password_ajax' );
add_action( 'wp_ajax_theplus_ajax_reset_password', 'theplus_ajax_reset_password_ajax' );
function theplus_ajax_reset_password_ajax() {
    if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
        $user_login = $_REQUEST['user_login'];
        $user_key = $_REQUEST['user_key'];
 
        $user = check_password_reset_key( $user_key, $user_login );
 
        if ( ! $user || is_wp_error( $user ) ) {
            if ( $user && $user->get_error_code() === 'expired_key' ) {
			   echo wp_json_encode( [ 'reset_pass'=>'expire', 'message'=> esc_html__('The entered key has expired. Please start reset process again.','theplus') ] );
            } else {
				echo wp_json_encode( [ 'reset_pass'=>'invalid', 'message'=> esc_html__('The entered key is invalid. Please start reset process again.','theplus') ] );
            }
            exit;
        }
 
        if ( isset( $_POST['user_pass'] ) ) {
            if ( $_POST['user_pass'] != $_POST['user_pass_conf'] ) {                
				echo wp_json_encode( [ 'reset_pass'=>'mismatch', 'message'=> esc_html__('Password does not match. Please try again.','theplus') ] );
				exit;
            }
 
            if ( empty( $_POST['user_pass'] ) ) {                
                echo wp_json_encode( [ 'reset_pass'=>'empty', 'message'=> esc_html__('Password Field is Empty. Enter Password.
','theplus') ] );                
                exit;
            }
			
            reset_password( $user, $_POST['user_pass'] );
			
           echo wp_json_encode( [ 'reset_pass'=>'success', 'message'=> esc_html__('Your password has been changed. Use your new password to sign in.','theplus') ] );
		   
        } else {
            echo "Invalid request.";
        }
 
        exit;
    }
}

add_action( 'login_form_theplusrp','redirect_to_tp_custom_password_reset');
if(!empty($_REQUEST['forgoturl'])){
	add_action( 'login_form_resetpass','redirect_to_tp_custom_password_reset' );	
}

function redirect_to_tp_custom_password_reset() {
		
    if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
        // Verify key / login combo
		 
        $user = check_password_reset_key( $_REQUEST['key'], $_REQUEST['login'] );		
        if ( ! $user || is_wp_error( $user ) ) {
            if ( $user && $user->get_error_code() === 'expired_key' ) {
				$redirect_url = $_REQUEST['forgoturl'];
				$redirect_url = add_query_arg( 'expired', 'expired', $redirect_url );
				wp_redirect($redirect_url);
            } else {
				$redirect_url = $_REQUEST['forgoturl'];
				$redirect_url = add_query_arg( 'invalid', 'invalid', $redirect_url );
				wp_redirect($redirect_url);
            }
            exit;
        }
		if(!empty($_REQUEST['redirecturl'])){
			
			$redirect_url = $_REQUEST['redirecturl'];
			$redirect_url = add_query_arg( 'login', esc_attr( $_REQUEST['login'] ), $redirect_url );
			$redirect_url = add_query_arg( 'key', esc_attr( $_REQUEST['key'] ), $redirect_url );
			$redirect_url = add_query_arg( 'action', 'theplusrpf', $redirect_url );
			$redirect_url = add_query_arg( 'forgoturl', $_REQUEST['forgoturl'], $redirect_url );
			wp_redirect($redirect_url);
		}else{
			wp_redirect(home_url());
		}
        exit;
    }
}
/*reset password end*/

function theplus_ajax_register_user( $email='', $first_name='', $last_name='',$tp_user_role='' ) {
	    $errors = new \WP_Error();
		$result    = '';
	    if ( ! is_email( $email ) ) {
	        $errors->add( 'email', esc_html__( 'The email address you entered is not valid.', 'theplus' ) );
	        return $errors;
	    }
	 
	    if ( username_exists( $email ) || email_exists( $email ) ) {
	        $errors->add( 'email_exists', esc_html__( 'An account exists with this email address.', 'theplus' ) );
	        return $errors;
	    }
		
	    if(!empty($_POST["dis_password"]) && $_POST["dis_password"]=='yes'){
			if(!empty($_POST["dis_password_conf"]) && $_POST["dis_password_conf"]!='yes' && $_POST['password']){
				$password = $_POST['password'];
			}else{
				if($_POST['password'] == $_POST['conf_password']){	
					$password = $_POST['password'];
				}else{
					$errors->add( 'pass_mismatch', esc_html__( 'Password & Confirm Password Not Match!', 'theplus' ) );
					return $errors;
				}
			}			
		}else{
			$password = wp_generate_password( 12, false );
		}
		
		if(!empty($_POST["user_login"])){
			$user_login = $_POST['user_login'];
		}else{
			$user_login = $email;
		}
		
	    $user_data = array(
	        'user_login'    => $user_login,
	        'user_email'    => $email,
	        'user_pass'     => $password,
	        'first_name'    => $first_name,
	        'last_name'     => $last_name,
	        'nickname'      => $first_name,
	    );
		$user_id_get = username_exists( $user_login );
		
		$user_id='';
		if ( ! $user_id_get ) {
			$user_id = wp_insert_user( $user_data );
			if(empty($_POST['tceo'])){
				if(!empty($_POST["dis_password"]) && $_POST["dis_password"]=='no'){
					wp_new_user_notification( $user_id, null, 'both' );
				}else{
					wp_new_user_notification( $user_id, null, 'both' );
				}
			}
			
			$tp_user_role='subscriber';
			$post_id   = $_POST['page_id'];
			$widget_id = $_POST['widget_id'];
						
			$elementor = \Elementor\Plugin::$instance;			
			$meta_data      = $elementor->documents->get( $post_id )->get_elements_data();
			
			$widget_data = get_element_widget_data( $meta_data, $widget_id );
			
			$widget_settings = $elementor->elements_manager->create_element_instance( $widget_data );
			
			$get_settings = $widget_settings->get_settings();
			
			if(!empty($get_settings) && !empty($get_settings['user_role'])){
				$tp_user_role = $get_settings['user_role'];
			}
			wp_update_user( array ('ID' => $user_id, 'role' => $tp_user_role) ) ;
		}
		
	    return $user_id;
}
if(get_option('users_can_register')){
	add_action( 'wp_ajax_nopriv_theplus_ajax_register', 'theplus_ajax_register' );
}

function get_element_widget_data( $elements, $id ) {

	foreach ( $elements as $element ) {
		if ( $id === $element['id'] ) {
			return $element;
		}

		if ( ! empty( $element['elements'] ) ) {
			$element = get_element_widget_data( $element['elements'], $id );

			if ( $element ) {
				return $element;
			}
		}
	}

	return false;
}
function theplus_ajax_register() {
	
	 if( !isset( $_POST['security'] ) || !wp_verify_nonce( $_POST['security'], 'ajax-login-nonce' ) ){		
		echo wp_json_encode( ['registered'=>false, 'message'=> esc_html__( 'Ooops, something went wrong, please try again later.', 'theplus' )] );
		exit;
	 }
	 
	if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) { 
		if ( ! get_option( 'users_can_register' ) ) {
			echo wp_json_encode( ['registered'=>false, 'message'=> esc_html__( 'Registering new users is currently not allowed.', 'theplus' )] );
		} else {
			$email      = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
			$first_name = isset($_POST['first_name']) ? sanitize_text_field( $_POST['first_name'] ) : '';
			$last_name  = isset($_POST['last_name']) ? sanitize_text_field( $_POST['last_name'] ) : '';
			$user_login  = isset($_POST['user_login']) ? sanitize_text_field( $_POST['user_login'] ) : '';
			$passwordemc  = isset($_POST['password']) ? $_POST['password'] : '';
		
			$captcha = isset($_POST["token"]) ? $_POST["token"] : '';
			$dis_cap = $_POST["dis_cap"];
			$dis_mail_chimp = $_POST["dis_mail_chimp"];
			$mail_chimp_check = $_POST["mail_chimp_check"];
			$auto_loggedin = $_POST["auto_loggedin"];
			
			if(!empty($dis_cap) && $dis_cap=='yes'){
				if(!$captcha){
					$message = sprintf(__( 'Please check the the captcha form.', 'theplus' ), get_bloginfo( 'name' ) );
					echo wp_json_encode( ['registered' => false, 'message'=> $message] );					
					exit;
				}
			}
			$check_recaptcha= get_option( 'theplus_api_connection_data' );
			$resscore='';
			$check_captcha = false;
			if( !empty($dis_cap) && $dis_cap=='yes' && !empty($check_recaptcha['theplus_secret_key_recaptcha']) && !empty($captcha) ){
				$secretKey = $check_recaptcha['theplus_secret_key_recaptcha'];
				$ip = $_SERVER['REMOTE_ADDR'];
				
				$url = 'https://www.google.com/recaptcha/api/siteverify';
				$data = array('secret' => $secretKey, 'response' => $captcha);
				
				$options = array(
					'http' => array(
					  'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					  'method'  => 'POST',
					  'content' => http_build_query($data)
					)
				  );
				  
				  
				$context  = stream_context_create($options);
				$response = file_get_contents($url, false, $context);
				$responseKeys = json_decode($response,true);
				$resscore=$responseKeys["score"];
				$check_captcha = true;
				if(!$responseKeys['success']){
					$message = sprintf(__( 'Please check the the reCaptcha form.', 'theplus' ), get_bloginfo( 'name' ) );
					echo wp_json_encode( ['registered' => false, 'message'=> $message, 'recaptcha' => false ] );
					exit;
				}
			}
			
			$result     = theplus_ajax_register_user( $email, $first_name, $last_name );
			if(empty($result)){				
				echo wp_json_encode( ['registered'=>false, 'message'=> esc_html__( 'Username Already Exists.', 'theplus' )] );				
			}else if ( is_wp_error( $result ) ) {
				// Parse errors into a string and append as parameter to redirect
				$errors  = $result->get_error_message();
				echo wp_json_encode( ['registered' => false, 'message'=> $errors ] );
			} else {
				// Success
				
				if(!empty($_POST['tceo']) && (!empty($_POST['tceo']['tp_cst_email_opt']) && $_POST['tceo']['tp_cst_email_opt']=='yes')){
					
					$esub =  html_entity_decode($_POST['tceo']['tp_cst_email_subject']);
					$emsg =  html_entity_decode($_POST['tceo']['tp_cst_email_message']);
					$find = array( '/\[tp_firstname\]/', '/\[tp_lastname\]/', '/\[tp_username\]/', '/\[tp_email\]/', '/\[tp_password\]/' );
					$replacement = array( $first_name,$last_name, $user_login, $email,$passwordemc );
					$cmessage = preg_replace( $find, $replacement, $emsg );
					$headers = array( 'Content-Type: text/html; charset=UTF-8' );
					 
					wp_mail( $email, $esub, $cmessage, $headers );
				}				
				$message = sprintf(__( 'You have successfully registered to %s. We have emailed your password to the email address you entered.', 'theplus' ), get_bloginfo( 'name' ) );
				$response = ['registered' => true, 'message'=> $message, 'recaptcha' => $check_captcha, 'recaptcha_score' => $resscore ];
				
				//mailchimp subscriber user
				
				if((!empty($dis_mail_chimp) && $dis_mail_chimp=='yes') && (!empty($mail_chimp_check) && $mail_chimp_check=='yes')){
					$sep_cust_mail_chimp_apikey = isset($_POST["mc_custom_apikey"]) ? $_POST["mc_custom_apikey"] : '';
					$sep_cust_mail_chimp_listid = isset($_POST["mc_custom_listid"]) ? $_POST["mc_custom_listid"] : '';
					
					$mc_cst_group_value=$mc_cst_tags_value='';

					if(!empty($_POST['mc_cst_group_value'])){
						$mc_cst_group_value=$_POST['mc_cst_group_value'];
					}
					if(!empty($_POST['mc_cst_tags_value'])){
						$mc_cst_tags_value=$_POST['mc_cst_tags_value'];
					}
					
					plus_mailchimp_subscribe_using_lr($email, $first_name, $last_name,$dis_mail_chimp,$sep_cust_mail_chimp_apikey,$sep_cust_mail_chimp_listid,$mc_cst_group_value,$mc_cst_tags_value);
				}
				
				if((!empty($auto_loggedin) && $auto_loggedin==true)){
					$access_info = [];
					$access_info['user_login']    = !empty($email) ? $email : "";
					$access_info['user_password'] = !empty($_POST['password']) ? $_POST['password'] : "";
					$access_info['rememberme']    = true;
					$user_signon = wp_signon( $access_info, false );
					if ( !is_wp_error($user_signon) ){				
						$response = ['registered' => true, 'message'=> esc_html__('Login successful, Redirecting...', 'theplus')];
					} else {			
						$response = ['registered' => false, 'message'=> esc_html__('Registered Successfully, Ops! Login Failed...!', 'theplus')];
					}
				}
				echo wp_json_encode($response);
			}
		}

		exit;
	}
}

function plus_mailchimp_subscribe_using_lr($email='', $first_name='', $last_name='',$dis_mail_chimp='',$sep_cust_mail_chimp_apikey='',$sep_cust_mail_chimp_listid='',$mc_cst_group_value='',$mc_cst_tags_value=''){
	
		
	$list_id=$api_key='';
	if($dis_mail_chimp=='yes' && (!empty($sep_cust_mail_chimp_apikey) && !empty($sep_cust_mail_chimp_listid))){
		$api_key = $sep_cust_mail_chimp_apikey;
		$list_id = $sep_cust_mail_chimp_listid;		
	}else{
		$options = get_option( 'theplus_api_connection_data' );
		$list_id = (!empty($options['theplus_mailchimp_id'])) ? $options['theplus_mailchimp_id'] : '';
		$api_key = (!empty($options['theplus_mailchimp_api'])) ? $options['theplus_mailchimp_api'] : '';
	}
	
	$mc_r_status = 'subscribed';
	if(!empty($_POST['mcl_double_opt_in']) && $_POST['mcl_double_opt_in']=='yes'){
		$mc_r_status = 'pending';
	}
	
	$mc_cst_group_value=$mc_cst_tags_value='';

	if(!empty($_POST['mc_cst_group_value'])){
		$mc_cst_group_value=$_POST['mc_cst_group_value'];
	}
	if(!empty($_POST['mc_cst_tags_value'])){
		$mc_cst_tags_value=$_POST['mc_cst_tags_value'];
	}
	$result = json_decode( theplus_mailchimp_subscriber_message($email, $mc_r_status, $list_id, $api_key, array('FNAME' => $first_name,'LNAME' => $last_name),$mc_cst_group_value,$mc_cst_tags_value ) );	
	
}



function theplus_load_metro_style_layout($columns='1',$metro_column='3',$metro_style='style-1'){
	$i=($columns!='') ? $columns : 1;
	if(!empty($metro_column)){
		//style-3
		if($metro_column=='3' && $metro_style=='style-1'){
			$i=($i<=10) ? $i : ($i%10);			
		}
		if($metro_column=='3' && $metro_style=='style-2'){
			$i=($i<=9) ? $i : ($i%9);			
		}
		if($metro_column=='3' && $metro_style=='style-3'){
			$i=($i<=15) ? $i : ($i%15);			
		}
		if($metro_column=='3' && $metro_style=='style-4'){
			$i=($i<=8) ? $i : ($i%8);			
		}
		//style-4
		if($metro_column=='4' && $metro_style=='style-1'){
			$i=($i<=12) ? $i : ($i%12);			
		}
		if($metro_column=='4' && $metro_style=='style-2'){
			$i=($i<=14) ? $i : ($i%14);			
		}
		if($metro_column=='4' && $metro_style=='style-3'){
			$i=($i<=12) ? $i : ($i%12);			
		}
		//style-5
		if($metro_column=='5' && $metro_style=='style-1'){
			$i=($i<=18) ? $i : ($i%18);			
		}
		//style-6
		if($metro_column=='6' && $metro_style=='style-1'){
			$i=($i<=16) ? $i : ($i%16);			
		}
	}
	return $i;
}

function theplus_key_notice_ajax(){
	if ( get_option( 'theplus-notice-dismissed' ) !== false ) {
		update_option( 'theplus-notice-dismissed', '1' );
	} else {
		$deprecated = null;
		$autoload = 'no';
		add_option( 'theplus-notice-dismissed','1', $deprecated, $autoload );
	}
}
add_action('wp_ajax_theplus_key_notice','theplus_key_notice_ajax');
	
//post pagination
function theplus_pagination($pages = '', $range = 2)
	{  
		$showitems = ($range * 2)+1;  
		
		global $paged;
		if(empty($paged)) $paged = 1;
		
		if($pages == '')
		{
			global $wp_query;
			if( $wp_query->max_num_pages <= 1 )
			return;
			
			$pages = $wp_query->max_num_pages;
			/*if(!$pages)
			{
				$pages = 1;
			}*/
			$pages = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		}   
		
		if(1 != $pages)
		{
			$paginate ="<div class=\"theplus-pagination\">";
			if ( get_previous_posts_link() ){
				$paginate .= '<div class="paginate-prev">'.get_previous_posts_link('<i class="fas fa-long-arrow-alt-left" aria-hidden="true"></i> PREV').'</div>';
			}
			
			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages && ( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					$paginate .= ($paged == $i)? "<span class=\"current\">".esc_html($i)."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".esc_html($i)."</a>";
				}
			}
			if ( get_next_posts_link() ){
				$paginate .='<div class="paginate-next">'.get_next_posts_link('NEXT <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i>',1).'</div>';
			}
			
			$paginate .="</div>\n";
			return $paginate;
		}
}

function theplus_mailchimp_subscriber_message( $email, $status, $list_id, $api_key, $merge_fields = array(), $mc_cst_group_value, $mc_cst_tags_value){

    $data = array(
        'apikey'        => $api_key,
        'email_address' => $email,
        'status'        => $status,
    );
	
	if(!empty($merge_fields)){
		$data['merge_fields'] = $merge_fields;
	}
	
	if(!empty($mc_cst_group_value)){
		$interests = explode( ' | ', trim( $mc_cst_group_value ) );
		$interests=array_flip($interests);
		
		foreach($interests as $key => $value){
			$data['interests'][$key] = true;
		}
	}
	
	if(!empty($mc_cst_tags_value)){
		$data['tags'] = explode( '|', trim($mc_cst_tags_value) );;
	}
	
	$mch_api = curl_init();
 
    curl_setopt($mch_api, CURLOPT_URL, 'https://' . substr($api_key,strpos($api_key,'-')+1) . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5(strtolower($data['email_address'])));
    curl_setopt($mch_api, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '.base64_encode( 'user:'.$api_key )));
    curl_setopt($mch_api, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
    curl_setopt($mch_api, CURLOPT_RETURNTRANSFER, true); // return the API response
    curl_setopt($mch_api, CURLOPT_CUSTOMREQUEST, 'PUT'); // method PUT
    curl_setopt($mch_api, CURLOPT_TIMEOUT, 10);
    curl_setopt($mch_api, CURLOPT_POST, true);
    curl_setopt($mch_api, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($mch_api, CURLOPT_POSTFIELDS, json_encode($data) ); // send data in json
 
    $result = curl_exec($mch_api);
    return $result;
}
function plus_mailchimp_subscribe(){
	$options = get_option( 'theplus_api_connection_data' );
	$list_id = (!empty($options['theplus_mailchimp_id'])) ? $options['theplus_mailchimp_id'] : '';
	$api_key = (!empty($options['theplus_mailchimp_api'])) ? $options['theplus_mailchimp_api'] : ''; // YOUR MAILCHIMP API KEY HERE
	
	$FNAME=$LNAME=$BIRTHDAY=$PHONE='';	
	$chimp_field = array();
	if(!empty($_POST['FNAME'])){
		$FNAME=$_POST['FNAME'];
		$chimp_field['FNAME'] =$FNAME;
	}
	if(!empty($_POST['LNAME'])){
		$LNAME=$_POST['LNAME'];
		$chimp_field['LNAME'] =$LNAME;
	}
	if(!empty($_POST['BIRTHDAY']) && !empty($_POST['BIRTHMONTH'])){
		$BIRTHDAY = $_POST['BIRTHMONTH'] . '/' . $_POST['BIRTHDAY'];
		$chimp_field['BIRTHDAY'] =$BIRTHDAY;
	}
	if(!empty($_POST['PHONE'])){
		$PHONE=$_POST['PHONE'];
		$chimp_field['PHONE'] =$PHONE;
	}
	
	$mc_status = 'subscribed';
	if(!empty($_POST['mc_double_opt_in']) && $_POST['mc_double_opt_in']=='pending'){
		$mc_status = 'pending';
	}
	
	$mc_cst_group_value = '';
	if(!empty($_POST['mc_cst_group_value'])){
		$mc_cst_group_value=$_POST['mc_cst_group_value'];
	}
	
	$mc_cst_tags_value = '';
	if(!empty($_POST['mc_cst_tags_value'])){
		$mc_cst_tags_value=$_POST['mc_cst_tags_value'];
	}
	
	$result = json_decode( theplus_mailchimp_subscriber_message($_POST['email'], $mc_status, $list_id, $api_key, $chimp_field,$mc_cst_group_value,$mc_cst_tags_value) );
	
	if( $result->status == 400 ){
		echo 'incorrect';
	} elseif( $result->status == 'subscribed' ){
		echo 'correct';
	} elseif( $result->status == 'pending' ){
		echo 'pending';
	} else {
		echo 'not-verify';
	}
	die;
}
add_action('wp_ajax_plus_mailchimp_subscribe','plus_mailchimp_subscribe');
add_action('wp_ajax_nopriv_plus_mailchimp_subscribe', 'plus_mailchimp_subscribe');

if(!function_exists('theplus_api_check_license')){
	function theplus_api_check_license($tp_api_key='',$home_url='',$check_license='') {
		$store_url = 'https://store.posimyth.com';
		$item_name = 'The Plus Addons for Elementor';
		$option_name = 'theplus_verified';
		$license_action = (!empty($check_license)) ? $check_license : 'activate_license';
		$api_params = array(
			'edd_action' => $license_action,
			'license' => '1415b451be1a13c283ba771ea52d38bb',
			'item_name' => urlencode( $item_name ),
			'url' => $home_url
		);
		
		//@version 3.3.4
		$response = true;		
		if (false === $response || $license_action == 'activate_license') {				
			$response = wp_remote_post( $store_url, array( 'timeout' => 30, 'sslverify' => false, 'body' => $api_params ) );
			set_transient('theplus_verify_trans_api_store', $response, 172800); 
		}
		
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		$license_data->success = true;
		$license_data->license = 'valid';
		$license_data->expires = 'lifetime';
			if ( !empty($license_data) && true == $license_data->success  && !empty($license_data->success)) {
				
				if(!empty($license_data->license)){
					$license = $license_data->license;
				}
				
				$expire_date=$license_data->expires;
				if($expire_date!='lifetime'){
					$expire = strtotime($expire_date);
				}else{
					$expire = $expire_date;
				}
				$today_date = strtotime("today midnight");
				if($expire !='lifetime' && $today_date >= $expire && $license_data->license == 'valid'){
					$verify= '0' ;
					theplus_check_api_options('theplus_verified',$verify,$license,$expire);
					
					return 'expired';
				}
				if( $license_data->license == 'valid' ) {
					$verify = '1' ;
					theplus_check_api_options('theplus_verified',$verify,$license,$expire);
					
					return 'valid';
				}elseif($license_data->license == 'expired' ){
					$verify = '0' ;
					theplus_check_api_options('theplus_verified',$verify,$license,$expire);
					
					return 'expired';
				} else {
					$verify = '0' ;
					theplus_check_api_options('theplus_verified',$verify,$license,$expire);
					
					return 'invalid';
				}
			}else{
				$verify = '0' ;
				theplus_check_api_options('theplus_verified',$verify,$license);
				
				return 'success_false';
			}
		
	}
}

if(!function_exists('theplus_api_check_license_code')){
	function theplus_api_check_license_code($tp_api_key='',$generate_key='',$check_license='') {
		

			$license_data = json_decode( wp_remote_retrieve_body( $response ) );
			$license_data->success = true;
			$license_data->license = 'valid';
			$license = 'valid';
			$option_name = 'theplus_verified';
			$verify = '1' ;
			theplus_check_api_options('theplus_verified',$verify,$license,$expire);
			return 'valid';

		
	}
}

if(!function_exists('plus_simple_crypt')){
	function plus_simple_crypt( $string, $action = 'dy' ) {
	    $secret_key = 'PO$_key';
	    $secret_iv = 'PO$_iv';
	    $output = false;
	    $encrypt_method = "AES-128-CBC";
	    $key = hash( 'sha256', $secret_key );
	    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
	 
	    if( $action == 'ey' ) {
	        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
	    }
	    else if( $action == 'dy' ){
	        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
	    }
	 
	    return $output;
	}
}

function theplus_check_api_options($option_name,$verify,$valid='',$expire=''){
	
	if($option_name!='' && $verify!=''){	
		$value=array(
			 'verify'=>$verify,
			 'license' => $valid,
			 'expire'=>$expire,
		 );
		
		if ( get_option( $option_name ) ) {
			update_option( $option_name, $value );
		} else {
			$deprecated = null;
			$autoload = 'yes';
			add_option( $option_name,$value, $deprecated, $autoload );
		}
	}
}

if(!function_exists('theplus_check_api_status')){
	function theplus_check_api_status() {
		$option_name = 'theplus_verified';
		$values=get_option( $option_name );
		$expired='lifetime';
		$verify=1;
		$today_date = strtotime("today midnight");
    	return 1;
	}
}


//@version 3.3.5
function check_expired_date_key() {
	$option_name = 'theplus_verified';
	
	$values=get_option( $option_name );
	$expired=!empty($values["expire"]) ? $values["expire"] : '';
	$verify=!empty($values["verify"]) ? $values["verify"] : '';
	$today_date = strtotime("today midnight");
	
		
}
add_action( 'admin_init', 'check_expired_date_key', 1 );

if ( !class_exists( 'Theplus_BodyMovin' ) ) {
	class Theplus_BodyMovin {
		public static $animations = array();

		function __construct() {
			add_action( 'wp_footer', array( $this, 'plus_animation_data' ), 5 );			
		}

		public static function plus_addAnimation( $animation = array() ) {
			
			if ( empty( $animation ) || empty( $animation['id'] ) ) {
				return false;
			}
			
			self::$animations[$animation['container_id']] = $animation;
		}
		public static function plus_getAnimations() {
			return apply_filters( 'wpbdmv-animations', self::$animations );
		}

		public static function plus_hasAnimations() {
			$animations = self::plus_getAnimations();
			return empty( $animations ) ? false : true;
		}

		function plus_animation_data() {
			if ( !self::plus_hasAnimations() ) {
				return;
			}
			wp_localize_script( 'theplus-bodymovin', 'wpbodymovin', array(
				'animations' => self::plus_getAnimations(),
				'ajaxurl'    => admin_url( 'admin-ajax.php' )
			) );
		}

	}
	$Theplus_BodyMovin = new Theplus_BodyMovin;
}

//Woocommerce Products
if(class_exists('woocommerce')) {
function theplus_out_of_stock() {
  global $post;
  $id = $post->ID;
  $status = get_post_meta($id, '_stock_status',true);
  
  if ($status == 'outofstock') {
  	return true;
  } else {
  	return false;
  }
}
function theplus_product_badge($out_of_stock_val='') {
 global $post, $product;
 	if (theplus_out_of_stock()) {
		echo '<span class="badge out-of-stock">'.$out_of_stock_val.'</span>';
	} else if ( $product->is_on_sale() ) {
		if ('discount' == 'discount') {
			if ($product->get_type() == 'variable') {
				$available_variations = $product->get_available_variations();								
				$maximumper = 0;
				for ($i = 0; $i < count($available_variations); ++$i) {
					$variation_id=$available_variations[$i]['variation_id'];
					$variable_product1= new WC_Product_Variation( $variation_id );
					$regular_price = $variable_product1->get_regular_price();
					$sales_price = $variable_product1->get_sale_price();
					$percentage = $sales_price ? round( ( ( $regular_price - $sales_price ) / $regular_price ) * 100) : 0;
					if ($percentage > $maximumper) {
						$maximumper = $percentage;
					}
				}
				echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$maximumper.'%</span>', $post, $product);
			} else if ($product->get_type() == 'simple'){
				$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
				echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$percentage.'%</span>', $post, $product);
			} else if ($product->get_type() == 'external'){
				$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
				echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc">&darr; '.$percentage.'%</span>', $post, $product);
			}
		} else {
			echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale">'.esc_html__( 'Sale','theplus' ).'</span>', $post, $product);
		}
	}
}
add_action( 'theplus_product_badge', 'theplus_product_badge',3 );

function plus_filter_woocommerce_sale_flash( $output_html, $post, $product ) { 
	if ($product->get_type() == 'variable') {
		$available_variations = $product->get_available_variations();								
		$maximumper = 0;
		for ($i = 0; $i < count($available_variations); ++$i) {
			$variation_id=$available_variations[$i]['variation_id'];
			$variable_product1= new WC_Product_Variation( $variation_id );
			$regular_price = $variable_product1->get_regular_price();
			$sales_price = $variable_product1->get_sale_price();
			$percentage = $sales_price ? round( ( ( $regular_price - $sales_price ) / $regular_price ) * 100) : 0;
			if ($percentage > $maximumper) {
				$maximumper = $percentage;
			}
		}
		$output_html = '<span class="badge onsale perc">&darr; '.$maximumper.'%</span>';
	} else if ($product->get_type() == 'simple'){
		$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
		$output_html = '<span class="badge onsale perc">&darr; '.$percentage.'%</span>';
	} else if ($product->get_type() == 'external'){
		$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
		$output_html = '<span class="badge onsale perc">&darr; '.$percentage.'%</span>';
	}else {
		$output_html = '<span class="badge onsale">'.esc_html__( 'Sale','theplus' ).'</span>';
	}
    return $output_html;
}; 

add_filter( 'woocommerce_sale_flash', 'plus_filter_woocommerce_sale_flash', 11, 3 );

}


add_action('elementor/widgets/widgets_registered', function($widgets_manager){
  $elementor_widget_blacklist = [
  'plus-elementor-widget',
];

  foreach($elementor_widget_blacklist as $widget_name){
    $widgets_manager->unregister_widget_type($widget_name);
  }
}, 15);

function registered_widgets(){
	
	// widgets class map
	return [
		
		'tp-adv-text-block' => [
			'dependency' => [],
		],
		'tp-advanced-typography' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/adv-typography/plus-adv-typography.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/circletype.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/adv-typography/plus-adv-typography.min.js',
				],
			],
		],
		'tp-advanced-buttons' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/advanced-buttons/plus-advanced-buttons.min.css',
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/advanced-buttons/plus-advanced-buttons.min.js',
				],
			],
		],
		'tp_advertisement_banner' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/addbanner/plus-addbanner.min.css',
				],
			],
		],
		'tp-accordion' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/tabs-tours/plus-tabs-tours.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/accordion/plus-accordion.min.js',
				],
			],
		],		
		'tp-animated-service-boxes' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .  'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .  'assets/css/main/animated-service-box/plus-animated-service-boxes.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/animated-service-box/plus-service-box.min.js',
				],
			],
		],
		'tp-audio-player' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .  'assets/css/main/audio-player/plus-audio-player.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/audio-player/plus-audio-player.min.js',					
				],
			],
		],
		'tp-before-after' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/before-after/plus-before-after.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/before-after/plus-before-after.min.js',
				],
			],
		],
		'tp-blockquote' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/block-quote/plus-block-quote.css',
				],
			],
		],
		'tp-blog-listout' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .  'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/blog-list/plus-blog-list.min.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/plus-extra-adv/plus-button-extra.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-posts-listing.min.js',
				],
			],
		],
		'tp-dynamic-smart-showcase' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/dynamic-smart-showcase/plus-dynamic-smart-showcase.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/dynamic-smart-showcase/plus-dynamic-smart-showcase.min.js',					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/dynamic-smart-showcase/plus-bss-filter.min.js',
				],
			],
		],
		'tp-breadcrumbs-bar' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/breadcrumbs-bar/plus-breadcrumbs-bar.min.css',
				],				
			],
		],
		'plus-post-filter' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/plus-extra-adv/plus-post-filter.min.css',
				],
			],
		],
		'plus-pagination' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/plus-extra-adv/plus-pagination.css',
				],
			],
		],
		'plus-listing-metro' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/imagesloaded.pkgd.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/isotope.pkgd.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-posts-metro-list.min.js',
				],
			],
		],
		'plus-listing-masonry' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/imagesloaded.pkgd.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/isotope.pkgd.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/packery-mode.pkgd.min.js',
				],
			],
		],
		'tp-button' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .  'assets/css/main/plus-extra-adv/plus-button.min.css',
				],
			],
		],
		'tp-wp-bodymovin' => [
		],
		'tp-carousel-anything' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/slick.min.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/plus-extra-adv/plus-slick-carousel.min.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/plus-extra-adv/plus-carousel-anything.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/slick.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-slick-carousel.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/carousel-anything/plus-carousel-anything.min.js',
				],
			],
		],
		'tp-carousel-remote' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/plus-extra-adv/plus-carousel-remote.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/slick.min.js',					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/carousel-remote/plus-carousel-remote.min.js',
				],
			],
		],
		'tp-caldera-forms' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/forms-style/plus-caldera-form.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/forms-style/plus-caldera-form.js',
				],
			],
		],
		'tp-cascading-image' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/image-factory/plus-image-factory.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/cascading-image/plus-cascading-image.min.js',
				],
			],
		],
		'tp-chart' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/chart.js', 
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/chart/chart.min.js', 
				], 
			],
		],
		'tp-circle-menu' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/circle-menu/plus-circle-menu.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/jquery.circlemenu.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/circle-menu/plus-circle-menu.min.js',
				],
			],
		],
		'tp-clients-listout' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .  'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/client-list/plus-client-list.css',					
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-posts-listing.min.js',
				],
			],
		],
		'tp-contact-form-7' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .  'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/forms-style/plus-cf7-style.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/forms-style/plus-cf7-form.js',
				],
			],
		],
		'tp-dynamic-listing' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .  'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/dynamic-listing/plus-dynamic-listing.min.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/plus-extra-adv/plus-button-extra.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/dynamic-listing/plus-dynamic-listing.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-posts-listing.min.js',
				],
			],
		],
		'tp-custom-field' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/custom-field/plus-custom-field.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/custom-field/plus-custom-field.min.js',					
				],
			],
		],
		'tp-countdown' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/countdown/plus-countdown.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/jquery.downCount.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/countdown/plus-countdown.min.js',
				],
			],
		],
		'tp-dark-mode' => [
			'dependency' => [
				'css' => [										
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/darkmode/plus-dark-mode.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/darkmode.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/darkmode/plus-dark-mode.min.js',
				],
			],
		],
		'tp-draw-svg' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/vivus.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/draw-svg/plus-draw-svg.min.js',
				],
			],
		],
		'tp-dynamic-device' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/lity.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/dynamic-device/plus-dynamic-device.min.css',					
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/lity.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/dynamic-device/plus-dynamic-device.min.js',
				],
			],
		],
		'tp-everest-form' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/forms-style/plus-everest-form.css',
				],
			],
		],
		'tp-smooth-scroll' => [
			'dependency' => [
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/smooth-scroll.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/smooth-scroll/plus-smooth-scroll.min.js',
				],
			],
		],
		'tp-flip-box' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/info-box/plus-info-box.min.css',
				],
			],
		],
		
		'tp-gallery-listout' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/gallery-list/plus-gallery-list.min.css',					
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.hoverdir.js',					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-posts-listing.min.js',
				],
			],
		],
		'tp-google-map' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/google-map/plus-gmap.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/google-map/plus-gmap.min.js',
				]
			],
		],
		'tp-gravityt-form' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/forms-style/plus-gravity-form.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/forms-style/plus-gravity-form.js',
				]
			],
		],		
		'tp-heading-animation' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/heading-animation/plus-heading-animation.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/heading-animation/plus-heading-animation.min.js',
				]
			],
		],
		'tp-header-extras' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/header-extras/plus-header-extras.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/buzz.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/header-extras/plus-header-extras.min.js',
				],
			],
		],
		'tp-heading-title' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/heading-title/plus-heading-title.min.css',
				],
			],
		],
		'tp-hotspot' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/tippy.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/hotspot/plus-hotspot.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tippy.all.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/hotspot/plus-hotspot.min.js',
				],
			],
		],
		'tp-image-factory' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/image-factory/plus-image-factory.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/image-factory/plus-image-factory.min.js',
				],
			],
		],
		
		'tp-info-box' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/info-box/plus-info-box.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/info-box/plus-info-box.min.js',
				],
			],
		],
		'tp-instagram' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/tp-bootstrap-grid.css',					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/plus-extra-adv/plus-instafeed.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/imagesloaded.pkgd.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/isotope.pkgd.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/instafeed.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/instafeed/plus-instafeed.min.js',
				],
			],
		],
		'tp-mailchimp-subscribe' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/mailchimp/plus-mailchimp.css',
				],
			],
		],
		'tp-morphing-layouts' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/shape-morph/plus-shape-morph.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/scrollmonitor.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/anime.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/shape-morph/theplus-shape-morph.min.js',
				],
			],
		],
		'tp-navigation-menu' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/navigation-menu/plus-nav-menu.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/navigation-menu/plus-nav-menu.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/headroom.min.js',
				],
			],
		],
		'tp-navigation-menu-lite' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/navigation-menu-lite/plus-nav-menu-lite.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/navigation-menu-lite/plus-nav-menu-lite.min.js',
				],
			],
		],
		'tp-ninja-form' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/forms-style/plus-ninja-form.css',
				],
			],
		],
		'tp-number-counter' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/number-counter/plus-number-counter.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/numscroller.js',
				],
			],
		],
		'tp-off-canvas' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/off-canvas/plus-off-canvas.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/offcanvas/plus-offcanvas.js',
				],
			],
		],
		'tp-page-scroll' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/page-scroll/plus-page-scroll.min.css',
				],
				'js'  => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/page-scroll/plus-page-scroll.min.js',
				],
			],
		],
		'tp-fullpage' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/fullpage.css',
				],
				'js'  => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/fullpage.js',
				],
			],
		],
		'tp-pagepiling' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/jquery.pagepiling.css',
				],
				'js'  => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/jquery.pagepiling.min.js',
				],
			],
		],
		'tp-multiscroll' => [
			'dependency' => [
				'js'  => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/jquery.multiscroll.min.js',
				],
			],
		],
		'tp-horizontal-scroll' => [
			'dependency' => [
				'js'  => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/jquery.jInvertScroll.min.js',
				],
			],
		],
		'tp-mobile-menu' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/mobile-menu/plus-mobile-menu.min.css',
				],
				'js'  => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/mobile-menu/plus-mobile-menu.min.js',
				],
			],
		],
		'tp-pricing-list' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/pricing-list/plus-pricing-list.min.css',
				],
			],
		],
		'tp-pricing-table' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/tippy.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/plus-extra-adv/plus-button-extra.min.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/pricing-table/plus-pricing-table.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tippy.all.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/pricing-table/plus-pricing-table.min.js',
				],
			],
		],
		'tp-product-listout' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .  'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/product-list/plus-product-list.css',					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/plus-extra-adv/plus-button-extra.min.css',
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-posts-listing.min.js',					
				],
			],
		],
		'plus-product-listout-yithcss' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/product-list/plus-product-list-yith.css',
				],
			],
		],
		'plus-product-listout-quickview' => [
			'dependency' => [				
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/product-listing/plus-product-listing.min.js',					
				],
			],
		],
		'tp-protected-content' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/plus-extra-adv/plus-password-protected.css',
				],
			],
		],
		'tp-post-search' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/mailchimp/plus-mailchimp.css',
				],
			],
		],
		'tp-progress-bar' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/progress-piechart/plus-progress-piechart.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.waypoints.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/circle-progress.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/progress-bar/plus-progress-bar.min.js',
				],
			],
		],
		'tp-process-steps' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/process-steps/plus-process-steps.min.css',
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/process-steps/plus-process-steps.min.js',
				],
			],
		],
		'tp-row-background' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/row-background/plus-row-background.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/row-background/plus-row-background.min.js',
				],
			],
		],
		'plus-vegas-gallery' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/vegas.css',					
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/vegas.js',
				],
			],
		],
		'plus-row-animated-color' => [
			'dependency' => [
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/effect.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/row-background/plus-row-animate-color.js',
				],
			],
		],
		'plus-row-segmentation' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/anime.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/imagesloaded.pkgd.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/segmentation.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/row-background/plus-row-segmentation.min.js',
				],
			],
		],
		'plus-row-scroll-color' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/scrolling_background_color.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/scrollmonitor.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/row-background/plus-scroll-bg-color.min.js',
				],
			],
		],
		'plus-row-canvas-particle' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/particles.min.js',
				],
			],
		],
		'plus-row-canvas-particleground' => [
			'dependency' => [
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.particleground.js', //canvas style 6
				],
			],
		],
		'plus-row-canvas-8' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/row-background/plus-row-canvas-style-8.min.js',
				],
			],
		],
		
		'tp-scroll-navigation' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/scroll-navigation/plus-scroll-navigation.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/pagescroll2id.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/scroll-navigation/plus-scroll-navigation.min.js',
				],
			],
		],
		'tp-shape-divider' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/shape-divider/plus-shape-divider.min.css',
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/shape-divider/plus-shape-divider.min.js',
				],
			],
		],
		'tp-site-logo' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/site-logo/plus-site-logo.css',
				],		
			],
		],
		'tp-social-icon' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/social-icon/plus-social-icon.min.css',
				],				
			],
		],
		'tp-style-list' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/stylist-list/plus-style-list.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/stylist-list/plus-stylist-list.min.js',
				],
			],
		],
		'tp-switcher' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/switcher/plus-switcher.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/switcher/plus-switcher.min.js',
				],
			],
		],
		'tp-table' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/plus-extra-adv/plus-button-extra.min.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/data-table/plus-data-table.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/extra/jquery.datatables.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/js/main/data-table/plus-data-table.min.js',
				],
			],
		],
		'tp-tabs-tours' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/tabs-tours/plus-tabs-tours.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/tabs-tours/plus-tabs-tours.min.js',
				],
			],
		],
		'tp-team-member-listout' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR .  'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/team-member-list/plus-team-member.css',
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-posts-listing.min.js',
				],
			],
		],
		'tp-testimonial-listout' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/slick.min.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .  'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/plus-extra-adv/plus-slick-carousel.min.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/testimonial/plus-testimonial.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/imagesloaded.pkgd.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/slick.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-slick-carousel.min.js',
				],
			],
		],
		'tp-timeline' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/plus-extra-adv/plus-button-extra.min.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/timeline/plus-timeline.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/imagesloaded.pkgd.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.waypoints.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/isotope.pkgd.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/packery-mode.pkgd.min.js',					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/velocity/velocity.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/velocity/velocity.ui.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-animation-load.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/posts-listing/plus-posts-listing.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/timeline/plus-timeline.min.js',					
				],
			],
		],
		'tp-unfold' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/unfold/plus-unfold.min.css',
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/unfold/plus-unfold.min.js',
				],
			],
		],
		'tp-video-player' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/lity.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/video-player/plus-video-player.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/lity.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/video-player/plus-video-player.min.js',
				],
			],
		],
		'tp-dynamic-categories' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .  'assets/css/extra/tp-bootstrap-grid.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/dynamic-categories/plus-dynamic-categories.min.css',
				],
			],
		],
		'tp-wp-forms' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/forms-style/plus-wpforms-form.css',
				],
			],
		],
		'tp-wp-login-register' => [
			'dependency' => [
				'css' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/wp-login-register/plus-wp-login-register.min.css',
				],
			],
		],
		'tp-wp-login-register-ex' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/login-register/plus-login-register.min.js',
				],
			],
		],
		'plus-velocity' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.waypoints.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/velocity/velocity.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/velocity/velocity.ui.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-animation-load.min.js',
				],
			],
		],
		'plus-magic-scroll' => [
			'dependency' => [
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tweenmax/timelinemax.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tweenmax/tweenmax.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/scrollmagic/scrollmagic.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/scrollmagic/animation.gsap.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-magic-scroll.min.js',
				],
			],
		],
		'plus-tooltip' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/tippy.css',
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tippy.all.min.js',
				],
				],
		],
		'plus-mousemove-parallax' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tweenmax/tweenmax.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-mouse-move-parallax.min.js',
				],
			],
		],
		'plus-tilt-parallax' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tilt.jquery.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-tilt-parallax.min.js',
				],
			],
		],
		'plus-reveal-animation' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.waypoints.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-reveal-animation.min.js',
				],
			],
		],
		'plus-content-hover-effect' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .  'assets/css/main/plus-extra-adv/plus-content-hover-effect.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .  'assets/js/main/general/plus-content-hover-effect.min.js',
				],
			],
		],
		'plus-button' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .  'assets/css/main/plus-extra-adv/plus-button.min.css',
				],
			],
		],
		'plus-button-extra' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/plus-extra-adv/plus-button-extra.min.css',
				],
			],
		],
		'plus-carousel' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/slick.min.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/main/plus-extra-adv/plus-slick-carousel.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/slick.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-slick-carousel.min.js',
				],
			],
		],
		'plus-imagesloaded' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/imagesloaded.pkgd.min.js',
				],
			],
		],
		'plus-isotope' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/isotope.pkgd.js',
				],
			],
		],
		'plus-hover3d' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.hover3d.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-hover-tilt.js',
				],
			],
		],
		'plus-wavify' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tweenmax/tweenmax.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/wavify.js',
				],
			],
		],
		'plus-lity-popup' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/lity.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/lity.min.js',
				],
			],
		],
		'plus-extras-column' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/resizesensor.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/sticky-sidebar.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.jsticky.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/column-stickly/plus-column-stickly.min.js',
				],
			],
		],
		'plus-equal-height' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/equal-height/plus-equal-height.min.js',
				],
			],
		],
		'plus-column-cursor' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/main/mouse-cursor/plus-mouse-cursor.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/mouse-cursor/plus-mouse-cursor.min.js',
				],
			],
		],
		'plus-extras-section-skrollr' => [
			'dependency' => [
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/skrollr.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-section-skrollr.min.js',
				],
			],
		],
		'plus-adv-typo-extra-js-css' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR .'assets/css/extra/imagerevealbase.css',
				],
				'js' => [										
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/charming.min.js',					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/imagesloaded.pkgd.min.js',					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tweenmax/tweenmax.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/imagerevealdemo.js',
				],
			],
		],
		'plus-swiper' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/swiper-bundle.min.css',
				],
				'js' => [					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/swiper-bundle.min.js',
				],
			],
		],
		'plus-backend-editor' => [
			'dependency' => [
				'css' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/css/extra/tippy.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .  'assets/css/main/plus-extra-adv/plus-button.min.css',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .  'assets/css/main/plus-extra-adv/plus-content-hover-effect.min.css',
				],
				'js' => [
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/jquery.waypoints.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/general/modernizr.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/velocity/velocity.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/velocity/velocity.ui.js',					
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tilt.jquery.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tippy.all.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tweenmax/timelinemax.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tweenmax/tweenmax.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/tweenmax/jquery-parallax.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/scrollmagic/scrollmagic.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/extra/scrollmagic/animation.gsap.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/plus-extra-adv/plus-backend-editor.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-animation-load.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-magic-scroll.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-mouse-move-parallax.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR . 'assets/js/main/general/plus-reveal-animation.min.js',
					THEPLUS_PATH . DIRECTORY_SEPARATOR .  'assets/js/main/general/plus-content-hover-effect.min.js',
				],
			],
		],
	];
	
}