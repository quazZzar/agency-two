<?php 
/**
 * Template Name: Team Page
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
	<div id="subPageCover" <?php post_class('staff-members-template'); ?>>
		<div class="container">
			<div class="row">
				<?php $staff_args = array(
					'post_type' => 'staff',
					'post_status' => 'publish',
					'posts_per_page' => cs_get_option('team_members_number') ? cs_get_option('team_members_number') : 9
				);
				$staff_query = new WP_Query($staff_args);

				if($staff_query->have_posts()) :
					while($staff_query->have_posts()) : $staff_query->the_post(); 
						$staff_meta = get_post_meta(get_the_ID(), '_staff_options', true); ?>
						<div class="col-sm-4 staff_member_item">
							<article id="<?php the_ID() ?>" class="team-member">
								<?php if(has_post_thumbnail()) : ?>
									<a href="<?php the_permalink(); ?>">
										<img class="staff_member_photo" src="<?php the_post_thumbnail_url('single-staff'); ?>">
									</a>
								<?php endif; ?>
								<div class="staff_name">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</div>
								<?php if(@$staff_meta['staff_position']) : ?>
									<div class="staff_position">
										<?php echo @$staff_meta['staff_position']; ?>
									</div>
								<?php endif;
								if(@$staff_meta['staff_email']) : ?>
									<div class="staff_email">
										<i class="fa fa-envelope-o"></i><a href="mailto:<?php echo @$staff_meta['staff_email']; ?>" "email me"><?php echo @$staff_meta['staff_email']; ?></a>
									</div>
								<?php endif; 
								if(@$staff_meta['staff_first_name']) : ?>
									<div class="about_staff_btn">
										<a href="<?php the_permalink(); ?>"><?php echo 'About '.$staff_meta['staff_first_name']; ?></a>
									</div>
								<?php endif; ?>
							</article>
						</div>
					<?php endwhile;
				endif; ?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>