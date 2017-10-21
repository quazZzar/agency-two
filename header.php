<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel='stylesheet' id='main-css'  href='<?php echo get_template_directory_uri().'/style.css' ?>' type='text/css' media='all' />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div class="container-fluid">
			<div class="container">
				<div class="row">
					<div class="col-md-3" style="padding:20px;">
						<a href="<?php echo home_url('/'); ?>" class="logo-url">
							<img class="img img-responsive" src="<?php if(cs_get_option('site_logo')) : echo cs_get_option('site_logo'); else : echo get_template_directory_uri().'/img/logo.jpg'; endif;  ?>">
						</a>
					</div>
					<div class="col-md-9">
						<div class="main-nav">
							<ul>
								<?php wp_nav_menu( 
									array(
										'title_li' => '',
										'theme_location' => 'main_menu',
										'container' => false,
										'items_wrap' => '%3$s',
										'fallback_cb' => 'wp_list_pages'
									)
								); ?>
							</ul>
						</div>
					</div>
				</div>		
			</div>
			<div class="row">
				<div class="col-md-12" id="secondary-header">
					<div class="container">
						<span class="menu_toggle">
							<span class="bar"></span>
							<span class="bar"></span>
							<span class="bar"></span>
						</span>
						<p>
							Contact Us Today! 
							<?php if(cs_get_option('phone_number')) : 
								echo 'Phone: '. cs_get_option('phone_number'); 
							else : 
								echo 'Phone:  800-555-1212'; 
							endif;  
							if(cs_get_option('email_address')) : ?>
								/ <a href="mailto:<?php echo cs_get_option('email_address') ?>"><?php echo cs_get_option('email_address') ?></a>
							<?php else: ?>
								/ <a href="mailto:email@email.com">email@email.com</a>
							<?php endif; 
							if(cs_get_option('visit_us_link')) : ?>
								/  <a href="<?php echo cs_get_option('visit_us_link') ?>" target="_blank" >Visit Us!</a>
							<?php else: ?>
								/ <a href="#" target="_blank">Visit Us!</a> 
							<?php endif; ?>
						</p>
					</div>
				</div>
			</div>