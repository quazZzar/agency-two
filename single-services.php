<?php get_header(); 
	if(have_posts()) :
		while(have_posts()) : the_post(); 
			$services_meta = get_post_meta(get_the_ID(), '_services_options', true); ?>
			<div id="subpageImageCover" style="background-image:url(<?php echo @$services_meta['service_image'] ? @$services_meta['service_image'] : get_template_directory_uri().'/assets/images/page-main.jpg' ; ?>)">
				<div id="subPage">
					<div class="container">
						<div class="subPageHeader">
							<?php the_title(); ?>
						</div>
						<div class="subPageText"></div>
					</div>
				</div>
			</div>

			<div id="subPageCover">
				<div class="container">
					<div class="row">
						<div class="col-md-<?php echo is_active_sidebar( 'services-sidebar' ) ? '8' : '12'; ?>">
							<div class="service_body">
								<div class="service_content_box">
									<?php the_content(); ?>
								</div>
							</div>
						</div>
						<?php if (is_active_sidebar( 'services-sidebar' )): ?>
							<div class="col-md-4">
								<div id="subPageRight" class="event_has_sidebar">
									<div id="offerSubPage">
										<?php dynamic_sidebar('services-sidebar'); ?>
									</div>
								</div>
							</div>
						<?php endif;  ?>
					</div>
				</div>
			</div>
		<?php endwhile;
	endif; ?>
<?php get_footer();