<?php 
/**
 * Template Name: Post Layout
 *
 * @package WordPress
 * @subpackage Agency Themes
 * @
 */ 
get_header(); 
	if(have_posts()) :
		while(have_posts()) : the_post();  
			$page_meta = get_post_meta(get_the_ID(), '_agtwo_page_options', true); ?>
			<div id="subpageImageCover" style="background-image:url(<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : get_template_directory_uri().'/img/i-main-2.jpg' ; ?>)">
				<div id="subPage">
					<div class="container">
						<div class="subPageHeader">
							<?php if($page_meta && @$page_meta['page_head_text']): 
								echo @$page_meta['page_head_text']; 
							else: ?>
								Building lifelong relationships rooted in performance and trust
							<?php endif; ?>
						</div>
						<div class="subPageText"></div>
					</div>
				</div>
			</div>
			<?php $layout = get_post_meta(get_the_ID(), 'layout', true);
		endwhile;
	endif; ?>
	<section id="four" class="main">
		<div class="container">
			<?php if ($layout == 'media') :
				if(cs_get_option('page_layout_text')) : ?>
					<span id="seen-on"><?php echo cs_get_option('page_layout_text'); ?></span> 
				<?php else : ?>
					<span id="seen-on"><?php echo 'As seen or heard on...'; ?></span>
				<?php endif; 
			endif; ?>
			<div class="row">
					<?php 
					$qwer_args = array(
						'post_type' => $layout,
						'post_status' => 'publish',
						'posts_per_page' => 25
					);	 
					$qwer = new WP_Query($qwer_args);
					if($qwer->have_posts()) :
						while($qwer->have_posts()) : $qwer->the_post(); ?>
							<div class="col-md-6 col-xs-12">
								<article id="post-<?php the_ID(); ?>" class="single-post<?php echo ($layout == 'services') ? ' a-service' : '';?>">
									<?php $media_link = get_post_meta(get_the_ID(), 'media-link', true); ?>
									<?php $staff_title = get_post_meta(get_the_ID(), 'title', true); ?>
									<?php $event_meta = get_post_meta(get_the_ID(), '_events_options', true); ?>									
									<div class="row">
										<div class="col-md-4">
											<div class="post-thumbnail">
												<?php if(has_post_thumbnail()):
													echo ($layout == 'media') ? '<a href="' . $media_link . '">' : '';
													echo ($layout == 'events') ? '<a href="' . get_permalink() . '">' : '';											
													  the_post_thumbnail('post-thumb');
													echo ($layout == 'media' || $layout == 'events' ) ? '</a>' : '';
												else: ?>
													<img src="<?php echo get_template_directory_uri().'/img/pic01.jpg' ?>" />
												<?php endif; ?>
											</div>	
										</div>
										<div class="col-md-8">
											<div class="post-meta">
												<h1 class="post-title"><?php the_title(); ?></h1>
												<div class="post-content">
													<?php
														echo ($layout == 'media') ? 'Dateline: ' . get_the_excerpt() : '';
														echo ($layout == 'staff') ? '<div class="staff-title">' . $staff_title . '</div>': '';
														echo ($layout == 'events') ? '<div class="event-datetime"><a href="' . get_permalink() . '">' . @$event_meta['event_datetime'] . '</a></div>': ''; 															
													?>
													<p><?php echo get_the_content(); 
													echo ($layout == 'media') ? '<a href="' . $media_link . '"> See More</a>' : '';
													?></p>
												</div>
											</div>
										</div>
									</div>
								</article>
							</div>
						<?php endwhile;
					endif; ?>
			</div>
		</div>
		<div class="<?php echo ($layout == 'services') ? 'services-bottom' : '';?>"></div>
	</section>
<?php get_footer();