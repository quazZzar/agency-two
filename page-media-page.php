<?php 
/**
 * Template Name: Media Page
 *
 * @package WordPress
 * @subpackage Agency Themes
 * @
 */ 
get_header(); ?>
	<div id="subpageImageCover" style="background-image:url(<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : get_template_directory_uri().'/assets/images/page-main.jpg' ; ?>)">
		<div id="subPage">
			<div class="container">
				<?php $page_meta = get_post_meta(get_the_ID(), '_agtwo_page_options', true);?>
				<div class="subPageHeader">
					<?php if(@$page_meta['page_head_text']) :
						echo @$page_meta['page_head_text'];
					 endif; ?>
				</div>
				<div class="subPageText"></div>
			</div>
		</div>
	</div>
	<div id="subPageCover" <?php post_class('media-page-template'); ?>>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<?php 
					if(@$page_meta['press_page_horz_image_logos']) : ?>
						<img src="<?php echo $page_meta['press_page_horz_image_logos']; ?>" class="logos_image_press_page">
					<?php endif; ?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1 resources">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1 resources">
							<div class="row">
								<?php $press_args = array(
									'post_type' => 'press',
									'post_status' => 'publish',
									'posts_per_page' => cs_get_option('press_number') ? cs_get_option('press_number') : 12
								);
								$press_query = new WP_Query($press_args);
								if($press_query->have_posts()) :
									$i = 1;
									while($press_query->have_posts()) : $press_query->the_post(); 
										if($press_query->post_count < 12 && $i >= 10 || $press_query->post_count < 9 && $i >= 7 || $press_query->post_count < 6 && $i >= 4 ) break;
										$media_meta = get_post_meta(get_the_ID(), '_press_options', true); ?>
										<div class="col-lg-4 col-sm-6">
											<div class="resource" style="<?php if(@$page_meta['press_page_grid_bg']) echo 'background: '.$page_meta['press_page_grid_bg'].'; '; if(@$page_meta['press_page_grid_bg_hover']) echo 'border-color: '.$page_meta['press_page_grid_bg_hover'].'; '; ?>">
												<a href="<?php echo @$media_meta['media_link'] ? @$media_meta['media_link'] : '#';  ?>" target="_blank">
												<div class="color" style="<?php if(@$page_meta['press_page_grid_bg_hover']) echo 'background: '.$page_meta['press_page_grid_bg_hover'].'; '; if(@$page_meta['press_page_grid_bg']) echo 'border-color: '.$page_meta['press_page_grid_bg'].'; '; ?>">
													<div class="info" style="<?php if(@$page_meta['press_page_text_color']) echo 'color: '.$page_meta['press_page_text_color'].'; '; ?>">
														<?php echo get_the_excerpt(); ?>
													</div>
													<img src="<?php echo get_template_directory_uri().'/img/arrow-white.png'; ?>" alt="" class="arrow">
												</div>
												</a>
												<div class="name">
													<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'press-single' ); ?>" alt="press logo"></div>
											</div>
										</div>
									<?php $i++; endwhile; wp_reset_postdata();
								endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>