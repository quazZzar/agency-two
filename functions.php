<?php
/******************************************************************************/
/*				Including the Framework			           */
/******************************************************************************/
require_once( get_template_directory(). '/csframework/cs-framework.php' );

/******************************************************************************/
/*				        Styles Enqueue	                             	                           */
/******************************************************************************/
function goodies_enqueue(){
	#Styles
	wp_enqueue_style( 'bootstrap', get_template_directory_uri(). '/css/bootstrap.min.css', array(), false, 'all' );
	wp_enqueue_style( 'main', get_template_directory_uri(). '/css/main.css', array(), false, 'all' );
	wp_enqueue_style( 'Monserat', 'https://fonts.googleapis.com/css?family=Montserrat:300,400', array( ), false, 'all' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri().'/assets/css/font-awesome.min.css', array(), false, 'all' );
	if( is_page() || is_single() ){
		wp_enqueue_style( 'postslayout', get_template_directory_uri().'/css/post-layout.css', array(), false, 'all' );	
	}
	if(is_singular( 'events' )) {
		wp_enqueue_style( 'events', get_template_directory_uri().'/css/event-page.css', array(), false, 'all' );
		wp_enqueue_script( 'gmap', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCnjCTk-fTAVxyPADepxbBvTEdFt1qZ0qA', array(), false, false );
	}	
	#Scripts
	wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/js/scripts.js', array('jquery'), false, true);
	wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
}
add_action( 'wp_enqueue_scripts', 'goodies_enqueue' );

function admin_side_scripts(){
	wp_enqueue_script( 'admin-js', get_template_directory_uri().'/js/admin-side.js', array( 'jquery' ), false, true );
}

add_action( 'admin_enqueue_scripts', 'admin_side_scripts' );

/******************************************************************************/
/*				      Theme Supports                             	                           */
/******************************************************************************/
#post-thumbnails
add_theme_support('post-thumbnails');
#add  html5 support
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'caption' ));
#title tag
 add_theme_support( 'title-tag' );

/******************************************************************************/
/*				        Favicon 		                             	                           */
/******************************************************************************/
function theme_favicon() {
	if( function_exists( 'wp_site_icon' ) && has_site_icon() ) {
		wp_site_icon();
	} else if(cs_get_option( 'site_favicon')){
		echo "\r\n" . sprintf( '<link rel="shortcut icon" href="%s">', cs_get_option( 'site_favicon') ) . "\r\n";
	}
}
add_action( 'wp_head', 'theme_favicon');

/******************************************************************************/
/*			            Subsciption Form AJAX	                              */
/******************************************************************************/
add_action('wp_ajax_subscribe_email', 'subscribe_email');
add_action('wp_ajax_nopriv_subscribe_email', 'subscribe_email');
function subscribe_email(){
	$subscriber = $_POST['email'];

	if($subscriber && is_email( $subscriber)) :
		if(get_option( 'subscribers_list', false )) :
			$existing_data = get_option( 'subscribers_list', false );
			if(!in_array($subscriber, $existing_data)){
				array_push($existing_data, $subscriber);
				update_option( 'subscribers_list', $existing_data, false );
				$result['info'] = 'Successfully Subscribed';
			} else {
				$result['info'] = 'Email already exists';
			}
		else :	
			$subscribers = array();
			array_push($subscribers, $subscriber);
			update_option( 'subscribers_list', $subscribers, false );
			$result['info'] = 'Successfully Subscribed';
		endif;
	else :
		$result['info'] = 'Invalid Email address';
	endif;
die(json_encode($result));
}

/******************************************************************************/
/*			           Custom Post Type Abouts	              	                           */
/******************************************************************************/
add_action( 'init', 'post_type_about' );
function post_type_about() {
	#By the way adding the image size
	add_image_size( 'abouts-thumbnail', 495, 280, array('center', 'center') );
	add_image_size( 'staff-single', 400, 400, array('top', 'center') );
	add_image_size( 'single-service', 400, 300, array('center', 'center') );
	add_image_size( 'press-single', 220, 220, array('center', 'center') );

	$labels = array(
		'name'               => _x( 'Abouts', 'post type general name', 'agency-two' ),
		'singular_name'      => _x( 'About', 'post type singular name', 'agency-two' ),
		'menu_name'          => _x( 'Abouts', 'admin menu', 'agency-two' ),
		'name_admin_bar'     => _x( 'About', 'add new on admin bar', 'agency-two' ),
		'add_new'            => _x( 'Add New', 'book', 'agency-two' ),
		'add_new_item'       => __( 'Add New About', 'agency-two' ),
		'new_item'           => __( 'New About', 'agency-two' ),
		'edit_item'          => __( 'Edit About', 'agency-two' ),
		'view_item'          => __( 'View About', 'agency-two' ),
		'all_items'          => __( 'All Abouts', 'agency-two' ),
		'search_items'       => __( 'Search Abouts', 'agency-two' ),
		'parent_item_colon'  => __( 'Parent Abouts:', 'agency-two' ),
		'not_found'          => __( 'No abouts found.', 'agency-two' ),
		'not_found_in_trash' => __( 'No abouts found in Trash.', 'agency-two' )
	);

	$args = array(
		'labels'             => $labels,
					'description'        => __( 'Description.', 'agency-two' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'abouts' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 100,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'abouts', $args );
}

/***********************************************************************************************/
/* 										Add Menus 											   */
/***********************************************************************************************/

function register_menus($return = false){
	$menus = array(
		'main_menu'    => __('Main menu', 'dashboard'),
	);
	if($return)
		return $menus;
	register_nav_menus($menus);
}
add_action('init', 'register_menus');


/***********************************************************************************************/
/* Add Sidebar Support */
/***********************************************************************************************/
function reg_sideb(){
	if (function_exists('register_sidebar')) {
		register_sidebar(
			array(
				'name'           => esc_html__('Main Sidebar', 'agency-two'),
				'id'             => 'main-sidebar',
				'description'    => esc_html__('Main Sidebar Area', 'agency-two'),
				'before_widget'  => '<div class="widget %2$s">',
				'after_widget'   => '</div>',
				'before_title'   => '<h4 class="widget-title">',
				'after_title'    => '</h4>'
			)
		);
		register_sidebar(
			array(
				'name'           => esc_html__('Contact Form Sidebar', 'agency-two'),
				'id'             => 'contact-form-sidebar',
				'description'    => esc_html__('This sidebar holds the main contact form of the website', 'agency-two'),
				'before_widget'  => '<div class="widget %2$s">',
				'after_widget'   => '</div>',
				'before_title'   => '<h4 class="widget-title">',
				'after_title'    => '</h4>'
			)
		);
		register_sidebar(
			array(
				'name'           => esc_html__('Contact Page Sidebar', 'agency-two'),
				'id'             => 'contact-page-sidebar',
				'description'    => esc_html__('This sidebar is shown on the contact page right side', 'agency-two'),
				'before_widget'  => '<div class="widget %2$s">',
				'after_widget'   => '</div>',
				'before_title'   => '<h4 class="widget-title">',
				'after_title'    => '</h4>'
			)
		);
		register_sidebar(
			array(
				'name'           => esc_html__('About Page Sidebar', 'agency-two'),
				'id'             => 'about-page-sidebar',
				'description'    => esc_html__('This sidebar is shown on the about page right side', 'agency-two'),
				'before_widget'  => '<div class="widget %2$s">',
				'after_widget'   => '</div>',
				'before_title'   => '<h4 class="widget-title">',
				'after_title'    => '</h4>'
			)
		);
		register_sidebar(
			array(
				'name'           => esc_html__('Event Sidebar', 'agency-two'),
				'id'             => 'event-sidebar',
				'description'    => esc_html__('Event post Sidebar Area', 'agency-two'),
				'before_widget'  => '<div class="widget %2$s">',
				'after_widget'   => '</div>',
				'before_title'   => '<h4 class="widget-title">',
				'after_title'    => '</h4>'
			)
		);
	}
}
add_action('widgets_init','reg_sideb');

/******************************************************************************/
/*                                                        Custom Post Types  		                                        */
/******************************************************************************/

function create_posttypes() {

	$labels = array(
		'name'               => _x( 'Staff Members', 'post type general name', 'agency-two' ),
		'singular_name'      => _x( 'Staff', 'post type singular name', 'agency-two' ),
		'menu_name'          => _x( 'Staff', 'admin menu', 'agency-two' ),
		'name_admin_bar'     => _x( 'Staff', 'add new on admin bar', 'agency-two' ),
		'add_new'            => _x( 'Add New', 'staff', 'agency-two' ),
		'add_new_item'       => __( 'Add New Staff Member', 'agency-two' ),
		'new_item'           => __( 'New Staff Member', 'agency-two' ),
		'edit_item'          => __( 'Edit Staff Member', 'agency-two' ),
		'view_item'          => __( 'View Staff Member', 'agency-two' ),
		'all_items'          => __( 'All Staff Members', 'agency-two' ),
		'search_items'       => __( 'Search Staff', 'agency-two' ),
		'parent_item_colon'  => __( 'Parent Staff:', 'agency-two' ),
		'not_found'          => __( 'No Staff found.', 'agency-two' ),
		'not_found_in_trash' => __( 'No Staff found in Trash.', 'agency-two' )
	);
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'agency-two' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'staff' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 100,
		'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail'  )
	);
	register_post_type( 'staff', $args );

	$labels = array(
		'name'               => _x( 'Services', 'post type general name', 'agency-two' ),
		'singular_name'      => _x( 'Service', 'post type singular name', 'agency-two' ),
		'menu_name'          => _x( 'Services', 'admin menu', 'agency-two' ),
		'name_admin_bar'     => _x( 'Service', 'add new on admin bar', 'agency-two' ),
		'add_new'            => _x( 'Add New', 'service', 'agency-two' ),
		'add_new_item'       => __( 'Add New Service', 'agency-two' ),
		'new_item'           => __( 'New Service', 'agency-two' ),
		'edit_item'          => __( 'Edit Service', 'agency-two' ),
		'view_item'          => __( 'View Service', 'agency-two' ),
		'all_items'          => __( 'All Services', 'agency-two' ),
		'search_items'       => __( 'Search Services', 'agency-two' ),
		'parent_item_colon'  => __( 'Parent Service', 'agency-two' ),
		'not_found'          => __( 'No Services found.', 'agency-two' ),
		'not_found_in_trash' => __( 'No Services found in Trash.', 'agency-two' )
	);
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'agency-two' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'service' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 100,
		'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail'  )
	);
	register_post_type( 'services', $args );

	$labels = array(
		'name'               => _x( 'Press', 'post type general name', 'agency-two' ),
		'singular_name'      => _x( 'Press', 'post type singular name', 'agency-two' ),
		'menu_name'          => _x( 'Press', 'admin menu', 'agency-two' ),
		'name_admin_bar'     => _x( 'Press', 'add new on admin bar', 'agency-two' ),
		'add_new'            => _x( 'Add New', 'press', 'agency-two' ),
		'add_new_item'       => __( 'Add New Media', 'agency-two' ),
		'new_item'           => __( 'New Media', 'agency-two' ),
		'edit_item'          => __( 'Edit Media', 'agency-two' ),
		'view_item'          => __( 'View Media', 'agency-two' ),
		'all_items'          => __( 'All Press', 'agency-two' ),
		'search_items'       => __( 'Search Press', 'agency-two' ),
		'parent_item_colon'  => __( 'Parent Press', 'agency-two' ),
		'not_found'          => __( 'No Press found.', 'agency-two' ),
		'not_found_in_trash' => __( 'No Press found in Trash.', 'agency-two' )
	);
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'agency-two' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'press' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 100,
		'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail'  )
	);
	register_post_type( 'press', $args );

	$labels = array(
		'name'               => _x( 'Events', 'post type general name', 'agency-two' ),
		'singular_name'      => _x( 'Event', 'post type singular name', 'agency-two' ),
		'menu_name'          => _x( 'Events', 'admin menu', 'agency-two' ),
		'name_admin_bar'     => _x( 'Events', 'add new on admin bar', 'agency-two' ),
		'add_new'            => _x( 'Add New', 'events', 'agency-two' ),
		'add_new_item'       => __( 'Add New Event', 'agency-two' ),
		'new_item'           => __( 'New Event', 'agency-two' ),
		'edit_item'          => __( 'Edit Event', 'agency-two' ),
		'view_item'          => __( 'View Event', 'agency-two' ),
		'all_items'          => __( 'All Events', 'agency-two' ),
		'search_items'       => __( 'Search Event', 'agency-two' ),
		'parent_item_colon'  => __( 'Parent Event', 'agency-two' ),
		'not_found'          => __( 'No Event found.', 'agency-two' ),
		'not_found_in_trash' => __( 'No Event found in Trash.', 'agency-two' )
	);
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'agency-two' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'events' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 100,
		'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail'  )
	);
	register_post_type( 'events', $args );

}
add_action( 'init', 'create_posttypes' );

/***********************************************************************************************/
/* 					Excerpt filter 							   */
/***********************************************************************************************/
function af_excerpt_more( $more ) {
	esc_html__(' ...', 'agency-two');
}
add_filter( 'excerpt_more', 'af_excerpt_more' );

function custom_excerpt_length( $length ) {
	if(is_page_template( 'page-media-page.php' ) || is_archive('press')){
		return 17;
	} else {
		return 55;
	}
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );