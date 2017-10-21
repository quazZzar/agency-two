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
				),
				array(
					'id'    => 'press_page_horz_image_logos',
					'type'  => 'upload',
					'title' => 'Logos Image',
					'desc' => 'This is the field for adding the horizontal image with logos'
				),
				array(
					'id'    => 'press_page_grid_bg',
					'type'  => 'color_picker',
					'title' => 'Grid Backround Color',
					'desc' => 'Changes the Grid\'s background color'
				),
				array(
					'id'    => 'press_page_grid_bg_hover',
					'type'  => 'color_picker',
					'title' => 'Grid Backround On Hover',
					'desc' => 'Changes the Grid\'s background color when the hover effect is on'
				),
				array(
					'id'    => 'press_page_text_color',
					'type'  => 'color_picker',
					'title' => 'Grid Text Color',
					'desc' => 'Changes the Grid\'s text color when the hover effect is on'
				),
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

$options[]    = array(
	'id'        => '_staff_options',
	'title'     => 'Staff Options',
	'post_type' => 'staff',
	'context'   => 'normal',
	'priority'  => 'default',
	'sections'  => array(
		array(
			'name'  => 'staff_details',
			//'title' => 'Member Options',
			'icon'  => 'fa fa-user',
			'fields' => array(
				array(
					'id'    => 'staff_first_name',
					'type'  => 'text',
					'title' => 'Button First Name',
				),
				array(
					'id'    => 'staff_position',
					'type'  => 'text',
					'title' => 'Position',
				),
				array(
					'id'    => 'staff_email',
					'type'  => 'text',
					'title' => 'Staff Member Email',
				),
			), 
		),
	),
);

$options[]    = array(
	'id'        => '_services_options',
	'title'     => 'Service Options',
	'post_type' => 'services',
	'context'   => 'normal',
	'priority'  => 'default',
	'sections'  => array(
		array(
			'name'  => 'services_details',
			//'title' => 'Service Options',
			'icon'  => 'fa fa-cubes',
			'fields' => array(
				array(
					'id'    => 'service_image',
					'type'  => 'upload',
					'title' => 'Services Page Image'
				)
			), 
		),
	),
);

$options[]    = array(
	'id'        => '_press_options',
	'title'     => 'Settings',
	'post_type' => 'press',
	'context'   => 'normal',
	'priority'  => 'default',
	'sections'  => array(
		array(
			'name'  => 'press_details',
			//'title' => 'Media Options',
			'icon'  => 'fa fa-cubes',
			'fields' => array(
				array(
					'id'    => 'media_link',
					'type'  => 'text',
					'title' => 'Media Link'
				)
			), 
		),
	),
);

CSFramework_Metabox::instance( $options );