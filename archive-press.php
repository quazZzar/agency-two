<?php get_header(); ?>
	
	<div id="subPageCover" <?php post_class('media-page-template'); ?>>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1 class="archive-title">Press</h1>
				</div>
			</div>		
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1 resources">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1 resources">
							<div class="row">
								<?php if(have_posts()) :
									while(have_posts()) : the_post(); 
										$media_meta = get_post_meta(get_the_ID(), '_press_options', true); ?>
										<div class="col-lg-4 col-sm-6">
											<div class="resource">
												<a href="<?php echo @$media_meta['media_link'] ? @$media_meta['media_link'] : '#';  ?>" target="_blank">
												<div class="color">
													<div class="info">
														<?php echo get_the_excerpt(); ?>
													</div>
													<img src="<?php echo get_template_directory_uri().'/img/arrow-white.png'; ?>" alt="" class="arrow">
												</div>
												</a>
												<div class="name">
													<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'press-single' ); ?>" alt="press logo"></div>
											</div>
										</div>
									<?php endwhile;
								endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>