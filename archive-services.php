<?php get_header(); ?>
	<div id="subPageCover" class="services-page-template">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1 class="archive-title">Services</h1>
				</div>
			</div>
			<div class="row">
				<?php if(have_posts()) :
					while(have_posts()) : the_post();  ?>
						<div class="col-sm-4">
							<a href="<?php the_permalink(); ?>" class="caption_link">
								<div class="service_item_archive">
									<figure>
										<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'single-service'); ?>" alt="service">
										<figcaption>
											<div class="service_caption_title"><?php the_title(); ?></div>
										</figcaption>
									</figure>
								</div>
							</a>
						</div>
					<?php endwhile;
				endif; ?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>