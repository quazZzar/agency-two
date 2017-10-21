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
				'name'           => esc_html__('Event Sidebar', 'agency-one'),
				'id'             => 'event-sidebar',
				'description'    => esc_html__('Event post Sidebar Area', 'agency-one'),
				'before_widget'  => '<div class="widget %2$s">',
				'after_widget'   => '</div>',
				'before_title'   => '<h4 class="widget-title">',
				'after_title'    => '</h4>'
			)
		);
	}
}
add_action('widgets_init','reg_sideb');

function create_posttypes() {
 
	register_post_type( 'staff',
		array(
			'labels' => array(
				'name' => __( 'Staff Members' ),
				'singular_name' => __( 'Staff' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'staff'),
			'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail'  )			
		)
	);
	register_post_type( 'services',
		array(
			'labels' => array(
				'name' => __( 'Services' ),
				'singular_name' => __( 'Service' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'services'),
			'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail'  )			
		)
	);	
	register_post_type( 'media',
		array(
			'labels' => array(
				'name' => __( 'In The Media' ),
				'singular_name' => __( 'In The Media' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'media'),
			'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail'  )			
		)		
	);
	register_post_type( 'events',
		array(
			'labels' => array(
				'name' => __( 'Events' ),
				'singular_name' => __( 'Events' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'events'),
			'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail' )
		)		
	);		
	
}
add_action( 'init', 'create_posttypes' );