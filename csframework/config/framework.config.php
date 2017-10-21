<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

if(get_option('subscribers_list')) :
	$subscribers_content = '<h3>There are '. count(get_option('subscribers_list')).' subscribers</h3><ul>';
	foreach(get_option('subscribers_list') as $subscriber) :
		$subscribers_content .= '<li>' . $subscriber . '</li>';
	endforeach;
	$subscribers_content .= '</ul>';
endif;

$settings = array(
	'menu_title'      => 'Agency Two',
	'menu_type'       => 'menu', // menu, submenu, options, theme, etc.
	'menu_slug'       => 'theme_options',
	'ajax_save'       => false,
	'show_reset_all'  => false,
	'framework_title' => 'Agency Two <small>Options</small>',
);

$options[]      = array(
	'name'        => 'header',
	'title'       => 'Header',
	'icon'        => 'fa fa-star',
	'fields'      => array(
		array(
			'id'      => 'site_favicon',
			'type'    => 'upload',
			'title'   => 'Website Favicon',
			'desc'    => 'This control sets the website\'s favicon'
		),
		array(
			'id'      => 'site_logo',
			'type'    => 'upload',
			'title'   => 'Website Logo',
			'desc'	  => 'This control changes the website\'s main logo, from the header'
		),
		array(
			'id'      => 'phone_number',
			'type'    => 'text',
			'title'   => 'Header phone number',
			'desc'    => 'Set the phone number from the header area with this.'
		),
		array(
			'id'      => 'email_address',
			'type'    => 'text',
			'title'   => 'Header email',
			'desc'    => 'Set the email address from the header and footer areas with this.'
		),
		array(
			'id'      => 'visit_us_link',
			'type'    => 'text',
			'title'   => 'Visit Us Link',
			'desc'    => 'This is the link from the top bar that says "Visit US!"'
		),
	), // end: fields
);

$options[]        = array(
	'name'        => 'homepage',
	'title'       => 'Homepage',
	'icon'        => 'fa fa-home',
	'fields'      => array(
		array(
			'id'    => 'default_abouts',
			'type'  => 'switcher',
			'title' => 'Hide Default Abouts?',
			'desc'  => 'Switch this ON to hide those 3 blocks "what we do", "Team", "Upcoming events", this will show the last 3 abouts post types posts'
		),
		array(
			'id'    => 'homepage_video',
			'type'  => 'textarea',
			'title' => 'Home Page Video Link',
			'desc' => 'Put an embed link in here, from vimeo or youtube'
		),
	)
);	

$options[]      = array(
	'name'        => 'footer',
	'title'       => 'Footer',
	'icon'        => 'fa fa-star',
	'fields'      => array(
		array(
			'id'      => 'phone_number_footer',
			'type'    => 'text',
			'title'   => 'Footer phone number',
			'desc'    => 'Set the phone number from the footer area with this.'
		),
		array(
			'id'      => 'footer_location',
			'type'    => 'text',
			'title'   => 'Footer Location',
			'desc'    => 'Set the "Our Location" address that is in the footer area.'
		),
		array(
			'id'      => 'fax_number',
			'type'    => 'text',
			'title'   => 'Fax Number',
			'desc'    => 'Set the footer area fax number'
		),
	), // end: fields
);

$options[]      = array(
	'name'        => 'floating_footer',
	'title'       => 'Floating Footer',
	'icon'        => 'fa fa-star',
	'fields'      => array(
		array(
			'id'      => 'floating_image',
			'type'    => 'upload',
			'title'   => 'Floating footer Image',
			'desc'	  => 'Change the default image of that nice couple to another image.'
		),
		array(
			'id'      => 'floating_footer_title',
			'type'    => 'text',
			'title'   => 'Floating Footer main title',
			'desc'    => 'Changes: Are You Financially Indep ...'
		),
		array(
			'id'    => 'floating_footer_content',
			'type'  => 'textarea',
			'title' => 'Floating footer main text',
			'desc' => 'Changes: Request a no-obligation meeting...'
		),
		array(
			'id'       => 'floating_footer_html',
			'type'     => 'wysiwyg',
			'title'    => 'Html instead form',
			'settings' => array(
				'textarea_rows' => 5,
				'tinymce'       => true,
				'media_buttons' => true,
			)
		),
	), // end: fields
);

$options[]      = array(
	'name'        => 'team_page',
	'title'       => 'Team Page',
	'icon'        => 'fa fa-user',
	'fields'      => array(
		array(
			'id'      => 'team_members_number',
			'type'    => 'text',
			'title'   => 'Members to show',
			'desc' 	=> 'Accepts 3, 6, 9 members to show in the grid on the team page.',
			'default'	=> 9
		)
	), // end: fields
);

$options[]      = array(
	'name'        => 'services_page',
	'title'       => 'Services Page',
	'icon'        => 'fa fa-cubes',
	'fields'      => array(
		array(
			'id'      => 'services_number',
			'type'    => 'text',
			'title'   => 'Services to show',
			'desc' 	=> 'Accepts 3, 6, 9 services to show in the grid on the services page.',
			'default'	=> 9
		),
		array(
			'id'      => 'services_title_color',
			'type'    => 'color_picker',
			'title'   => 'Services title color',
			'desc' 	=> 'Default it is white, #fff'
		),
		array(
			'id'      => 'services_background_color',
			'type'    => 'color_picker',
			'title'   => 'Services title background color',
			'desc' 	=> 'The default is almost black, you can choose the opaciti of the color right from here'
		),
	), // end: fields
);

$options[]      = array(
	'name'        => 'press_page',
	'title'       => 'Media Page',
	'icon'        => 'fa fa-cubes',
	'fields'      => array(
		array(
			'id'      => 'press_number',
			'type'    => 'text',
			'title'   => 'Media items to show',
			'desc' 	=> 'Accepts 3, 6, 9 12 items to show in the grid on the media page.',
			'default'  => 12
		)
	), // end: fields
);

$options[]        = array(
	'name'        => 'subscribers',
	'title'       => 'Subscribers',
	'icon'        => 'fa fa-list',
	'fields'      => array(
		array(
			'type'    => 'subheading',
			'content' => 'This is the list of your subscribesrs',
		),
		array(
			'type'    => 'content',
			'content' => $subscribers_content,
		)
	)
);

CSFramework::instance( $settings, $options );