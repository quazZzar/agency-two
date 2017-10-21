<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

$options      = array();

$options[]    = array(
	'id'        => '_about_cpt_options',
	'title'     => '"About" Item Options',
	'post_type' => 'abouts',
	'context'   => 'normal',
	'priority'  => 'default',
	'sections'  => array(
		array(
			'name'  => 'section_1',
			'title' => 'Item Options',
			'icon'  => 'fa fa-cog',
			'fields' => array(
				array(
					'id'    => 'section_1_button_text',
					'type'  => 'text',
					'title' => 'Button Text',
				),
				array(
					'id'    => 'section_1_button_link',
					'type'  => 'text',
					'title' => 'Button Link',
				),
			), 
		), 
	),
);

$options[]    = array(
	'id'        => '_agtwo_page_options',
	'title'     => 'Page',
	'post_type' => 'page',
	'context'   => 'normal',
	'priority'  => 'default',
	'sections'  => array(
		array(
			'name'  => 'page_section_1',
			'title' => 'Page Options',
			'icon'  => 'fa fa-cog',
			'fields' => array(
				array(
					'id'    => 'page_head_text',
					'type'  => 'text',
					'title' => 'Header Text',
				)
			), 
		), 
	),
);

$options[]    = array(
	'id'        => '_events_options',
	'title'     => 'Event',
	'post_type' => 'events',
	'context'   => 'normal',
	'priority'  => 'default',
	'sections'  => array(
		array(
			'name'  => 'event_details',
			'title' => 'Event Options',
			'icon'  => 'fa fa-calendar',
			'fields' => array(
				array(
					'id'    => 'event_datetime',
					'type'  => 'text',
					'title' => 'Event Date',
				),
				array(
					'id'    => 'event_location',
					'type'  => 'text',
					'title' => 'Event Location',
				),
				array(
					'id'    => 'event_venue',
					'type'  => 'text',
					'title' => 'Event Venue',
				)
			), 
		), 
		array(
			'name'  => 'event_map',
			'title' => 'MAP Options',
			'icon'  => 'fa fa-map',
			'fields' => array(
				array(
					'id'    => 'latitude',
					'type'  => 'text',
					'title' => 'Latitude',
					'desc' => 'Something like this: 70.243325'
				),
				array(
					'id'    => 'longitude',
					'type'  => 'text',
					'title' => 'Longitude',
					'desc' => 'Something like this: -40.3244353'
				)
			), 
		), 
	),
);

CSFramework_Metabox::instance( $options );