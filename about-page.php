<?php 
/**
 * Template Name: About Page
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

			<div id="subPageCover">
				<div class="container">
					<div id="subPageBreadCrumb">
						Home » <?php the_title(); ?>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div id="subPageLeft" class="cushycms">
								<h1><?php the_title(); ?></h1>
								<?php the_content();?>
							</div>
						</div>
						<div class="col-md-4">
							<div id="subPageRight">
								<div id="offerSubPage">
									<?php if (is_active_sidebar( 'about-page-sidebar' )):
										dynamic_sidebar('about-page-sidebar');
									endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endwhile;
	endif; 
get_footer(); ?>