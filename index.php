<?php get_header(); ?>
		<div class="row secondRow" style="">
			<div class="col-sm-6" id="col-left">
				<p id="main-headline" style="color:#594343; <?php 
					if(cs_get_option('homepage_section_one_bg')) echo ' background: '. cs_get_option('homepage_section_one_bg'). '; ';
					if(cs_get_option('homepage_section_one_txt_color')) echo ' color: '. cs_get_option('homepage_section_one_txt_color'). ';';

				 ?>">
					<?php if(cs_get_option('homepage_section_one')) :
						echo cs_get_option('homepage_section_one');
					else : ?>
						Our goal is to help you plan for a successful retirement.
						We want to see you enter retirement on your terms without financial worry.
					<?php endif; ?>
				</p>
			</div>
			<div class="col-sm-6" id="col-right" style="">
				<div class="row">
					<div class="col-sm-12">
						<div class="embed-responsive embed-responsive-16by9" style="margin-top: 3px;border: solid 3px #ebebeb;">
							<iframe class="embed-responsive-item" src="<?php if(cs_get_option('homepage_video')) : echo cs_get_option('homepage_video'); else : echo 'https://player.vimeo.com/video/152588476'; endif;  ?>" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" style="border: solid 3px #ebebeb;"></iframe>
						</div>
					</div>
				</div>
				<div class="row" style="margin-top: 11px;padding: 0px 15px;">
					<div class="col-sm-12" style="background-color: rgba(0, 71, 128, 0.7);">
						<div class="row hidden-xs hidden-sm" style="border: solid 5px #ebebeb;">
							<div class="col-sm-3">
								<img class="img " style="margin-left: -40px;" src="<?php echo get_template_directory_uri().'/img/report.png' ?>">
							</div>
							<div class="col-sm-2">
								<img class="img" style="margin-left: -20px;margin-top: 72px;z-index: 10;position: absolute;" src="<?php echo get_template_directory_uri().'/img/arrow.png' ?>">
							</div>
							<div class="col-sm-7 pull-right" style="">
								<span style="" Complimentary Report</span>
								<p style="">
									Learn the important retirement considerations in this free report;<br>
									"Your Retirement Decisions." 
								</p>
								<div class="row">
									<div class="col-sm-9" style="padding-right: 11px;">
										<input id="subscribtion_email_input" name="subscribtion_email_input" type="email" spellcheck="false" placeholder="enter your email address" class="form-control input-md" value="" maxlength="30" tabindex="1" required="">
									</div>
									
									<div class="col-sm-3" style="padding-left: 1px;">
										<button type="button" class="btn btn-warning btn-md subscription_button">Submit</button>
									</div>
								</div>
							</div>
						</div>
						<div class="row hidden-md hidden-lg" style="border: solid 5px #ebebeb;">
							<div class="col-sm-12 pull-right" style="">
								<span style="">Complimentary Report</span>
								<p style="">
									Learn the important retirement considerations in this free report;<br>
									"Your Retirement Decisions." 
								</p>
								<div class="row">
									<div class="col-sm-9" style="padding-right: 1px;">
										<input id="subscribtion_email_input2" name="subscribtion_email_input2" type="email" placeholder="enter your email address" class="form-control input-md"  tabindex="1" required="">
									</div>									
									<div class="col-sm-3" style="padding-left: 1px;margin-top: 5px;">
										<button type="button" class="btn btn-warning btn-md subscription_button2">Submit</button>
									</div>
								</div>
							</div>
						</div>				
					</div>
					<span id="sub-headline" style="color:#fff;">*The free Report is provided for informational purposes only. It is not intended to provide tax or legal advice. By requesting this report you may be provided with information regarding the purchase of insurance and investment products in the future. Financial professionals are able to provide you with information but not guidance or advice related to Social Security benefits. This firm is not affiliated with the US government or any governmental agency.</span>
				</div>
			</div>
		</div>
<?php get_footer(); ?>