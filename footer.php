		<div class="row">
			<div class="well" style="border: none;border-radius: 0px;margin: 0px;">
				<div class="row">
					<div class="col-sm-12 ">
						<p class="heading">
							about Demo Financial Services
						</p>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<?php if(cs_get_option('default_abouts')) : 
							$abouts_query = new WP_Query(array('post_type' => 'abouts'));
							if($abouts_query->have_posts()):
								while($abouts_query->have_posts()) : $abouts_query->the_post(); ?>
									<div class="col-sm-4 abouts">
										<p class="subHeading"><?php the_title() ?></p>
										<img class="img img-responsive" src="<?php
										if(has_post_thumbnail()) :
											echo get_the_post_thumbnail_url(get_the_id(), 'abouts-thumbnail' );
										else :
											echo get_template_directory_uri().'/img/box-1.jpg' ;
										endif; ?>">
										<p class="innerText"><?php echo get_the_content() ?>
										</p>
										<?php $post_meta = get_post_meta(get_the_ID(), '_about_cpt_options', true); 
										?>
										<a href="<?php echo $post_meta['section_1_button_link'] ?>" class="btn btn-primary btn-lg"><?php echo $post_meta['section_1_button_text'] ?></a>

									</div>		
								<?php endwhile;
								endif;
						else : ?>
							<div class="col-sm-4 abouts">
								<p class="subHeading">Our Team</p>
								<img class="img img-responsive" src="<?php echo get_template_directory_uri().'/img/box-2.jpg' ?>">
								<p class="innerText">We are strong group of individuals with many diverse skills and abilitities.  We are ready to serve you.
								</p>
								<a href="/team/" class="btn btn-primary btn-lg">Meet The Team</a>
							</div>
							<div class="col-sm-4 abouts">
								<p class="subHeading">What We Do
								</p>
								<img class="img img-responsive" src="<?php echo get_template_directory_uri().'/img/box-3.jpg' ?>">
								<p class="innerText">
								&#187; Retirement Planning Strategies<br>
								&#187; Wealth Management Strategies<br>
								&#187; Fixed Annuities<br>
								&#187; And Much More<br>
								</p>
								<a href="/our-services/" class="btn btn-primary btn-lg">Our Services</a>
							</div>
							<div class="col-sm-4 abouts">
								<p class="subHeading">Upcoming Events
								</p>
								<img class="img img-responsive" src="<?php echo get_template_directory_uri().'/img/box-1.jpg' ?>">
								<p class="innerText">We off many excellent events for the community. 
								</p>
								<a href="/upcoming-events/" class="btn btn-primary btn-lg">Event Schedule</a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<?php if(!is_singular()) : ?>
			<div class="row fourthRow">
				<div class="container">
					<div class="col-sm-12">
						<p class="call-to-action">
							We are committed to maintaining the highest standards of integrity and professionalism in all areas of business and pleasure.
						</p><br>
						<p class="sub-call-to-action" style="">
							Contact us at <?php echo cs_get_option('phone_number_footer') ? cs_get_option('phone_number_footer') : '800-555-1212';  ?> to schedule a time to discuss your financial goals and the potential role of insurance and investments in your retirement preparation strategy.
						</p>
					</div>
				</div>
			</div>
		<?php endif; ?>
			<div class="row terms_conditions">
				<div class="container">
					<div class="col-sm-4 terms_culomn">
						<p>connect with us</p>
						<p>
							Phone: <?php echo cs_get_option('phone_number_footer') ? cs_get_option('phone_number_footer') : '800-555-1212'; ?><br>
							Fax: <?php echo cs_get_option('fax_number') ? cs_get_option('fax_number') : '1-8888-555-1212'; ?><br>
							<a href="mailto:<?php echo cs_get_option('email_address') ? cs_get_option('email_address') : 'email@email.com'; ?>"><?php echo cs_get_option('email_address') ? cs_get_option('email_address') : 'email@email'; ?></a>
						</p>
					</div>
					<div class="col-sm-4 terms_culomn">
						<p>LOCATION</p>
						<p>
							<?php
								if(cs_get_option('footer_location')) :
									echo cs_get_option('footer_location');
								else: ?>
									33445 Eleven ST NW<br>
									Jonesville, MI 45000<br>
							<?php endif; ?>
						</p>
					</div>
					<div class="col-sm-4 terms_culomn">
						<p>DISCLOSURES</p>
						<p>
							<a href="#">Privacy Policy</a><br>
							<a href="#">Terms of Use</a>
						</p>
					</div>
				</div>
			</div>
			<div class="row footer_texts">
				<div class="container">
					<div class="col-sm-12">
[This is a Demo Site] CoreCap Investments, Inc., is a member of FINRA/SIPC and does not provide tax or legal advice. The information presented here is not specific to any individual's personal circumstances.
<br><br>
This website does not constitute an offer to sell or a solicitation of offers to purchase or sell securities in any jurisdiction in which CoreCap Investments, Inc., is not registered as a broker-dealer.
<br><br>
To the extent that this material concerns tax matters, it is not intended or written to be used, and cannot be used, by a taxpayer for the purpose of avoiding penalties that may be imposed by law.  Further, nothing on this site is intended to be, or to be relied upon as, tax, legal, or investment advice. Investors should consult with their own tax, legal, and investment professionals.
<br><br>
These materials are provided for general information and educational purposes based upon publicly available information from sources believed to be reliable—we cannot assure the accuracy or completeness of these materials. The information in these materials may change at any time and without notice.
					</div>
				</div>
			</div>		
		</div>
		<div id="popup">
			<div>
				<img src="<?php echo cs_get_option('floating_image') ? cs_get_option('floating_image') : get_template_directory_uri().'/img/sticky-couple.png' ?>" />
				<div>
					<span><?php echo cs_get_option('floating_footer_title') ? cs_get_option('floating_footer_title') : 'Are You Financially Ready to Retire?' ?></span>
					<hr>
					<p><?php echo cs_get_option('floating_footer_content') ? cs_get_option('floating_footer_content') : 'Request a no-obligation appointment to begin the process of preparing you for a successful retirement.' ?></p>
				</div>
				<?php if(cs_get_option('floating_footer_html')) :
					echo cs_get_option('floating_footer_html');
				else: ?>
					<form action="https://agencydemo.simplybook.me/v2/" method="get">
						<input style="margin-top:60px;" type="submit" value="Book Now">
					</form>
				<?php endif; ?>
			</div>
			<img src="<?php echo get_template_directory_uri().'/img/close.png'; ?> " id="popup_close " onclick="close_popup() " width="50 " height="50 " alt="close " />
		</div>
		<?php wp_footer(); ?>
	</body>
</html>