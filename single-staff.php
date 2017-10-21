<?php get_header(); 
	if(have_posts()) :
		while(have_posts()) : the_post();  
			$staff_meta = get_post_meta(get_the_ID(), '_staff_options', true); ?>
			<div id="subPageCover" <?php post_class(); ?>>
				<div class="container">
					<div class="row">
						<div class="col-md-<?php echo is_active_sidebar( 'staff-sidebar' ) ? '8' : '12'; ?>">
							<section class="staff_body">
								<div class="row">
									<div class="col-md-5">
										<div class="staff_thumbnail">
											<?php if(has_post_thumbnail()) : ?>
												<img src="<?php the_post_thumbnail_url( 'staff-single' ); ?>">
											<?php endif; ?>
										</div>
									</div>
									<div class="col-md-7">
										<div class="staff_sumarry">
											<h1 class="staff_name"><?php the_title(); ?></h1>
											<?php if(@$staff_meta['staff_email']) : ?>
												<div class="staff_email">
													<span>Email: </span><?php echo $staff_meta['staff_email']; ?>
												</div>
											<?php endif; ?>
											<div class="staff_content">
												<?php the_content(); ?>
											</div>
										</div>
									</div>
								</div>	
							</section>
						</div>
						<?php if (is_active_sidebar( 'staff-sidebar' )): ?>
							<div class="col-md-4">
								<div id="subPageRight" class="event_has_sidebar">
									<div id="offerSubPage">
										<?php dynamic_sidebar('staff-sidebar'); ?>
									</div>
								</div>
							</div>
						<?php endif;  ?>
					</div>
				</div>
			</div>
		<?php endwhile;
	endif;
get_footer();