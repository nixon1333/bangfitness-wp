<?php use Roots\Sage\Utils; ?>
<?php while (have_posts()) : the_post(); ?>
<section class="home-slider">
	<div class="flexslider" id="home-slider">
		<ul class="slides">
		<?php if( have_rows('testimonial_slider') ): ?>
			<?php while ( have_rows('testimonial_slider') ) : the_row(); ?>
				<?php $video_slide = get_sub_field('video_slide'); ?>
					<li style="background-image:url(<?php the_sub_field('image'); ?>)">
						<?php if ($video_slide): ?>
								<iframe id="player_<?php the_sub_field('video_id'); ?>" src="https://player.vimeo.com/video/<?php the_sub_field('video_id'); ?>?api=1&player_id=player_<?php the_sub_field('video_id'); ?>&title=0&description=0&byline=0&badge=0&autoplay=1&portrait=0&color=FF6426" width="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>

						<?php else: ?>
							<div class="testimonial">
								<p class="text"><?php the_sub_field('testimonial'); ?></p>
								<h5 class="name"><?php the_sub_field('testimonial_name'); ?></h5>
							</div>
						<?php endif; ?>
					</li>
			<?php endwhile; ?>
		<?php endif; ?>
		</ul>
	</div>
</section>
<a name="about" id="about-anchor"><span></span></a>
<section class="about">
	<div class="upper">
		<?php the_field('about_text'); ?>
	</div>
	<div class="accordion foundations">
	<?php if( have_rows('about_sections') ): ?>
		<?php while ( have_rows('about_sections') ) : the_row(); ?>
		<article class="foundation section">
			<div class="inner">
				<h2><?php the_sub_field('header'); ?></h2>
				<?php get_template_part('templates/accordion', 'trigger'); ?>
				<div class="info">
					<p><?php echo Utils\smallcapsify(get_sub_field('body')); ?></p>
				</div>
			</div>
		</article>
		<?php endwhile; ?>
	<?php endif; ?>
	</div>
</section>
<section class="team">
	<h1 class="page-title">Team</h1>
	<?php if( have_rows('team_members') ): ?>
		<?php while ( have_rows('team_members') ) : the_row(); ?>
		<article class="team-member" data-name="<?php the_sub_field('name'); ?>" data-desc="<?php the_sub_field('popup_text'); ?>">
			<figure class="portrait" style="background-image:url(<?php the_sub_field('portrait'); ?>)"></figure>
			<div class="info">
				<h2 class="name"><?php the_sub_field('name'); ?></h2>
				<p class="desc"><?php the_sub_field('title'); ?></p>
			</div>
		</article>
		<?php endwhile; ?>
	<?php endif; ?>
	<div id="team-member-modal" class="team-member-modal fade-out">
		<div class="inner">
			<h1 id="team-member-modal-name"></h1>
			<p id="team-member-modal-desc"></p>
		</div>
		<?php get_template_part('templates/accordion', 'trigger'); ?>
	</div>
</section>
<?php $email_modal_state = get_field('email_sign_up_modal', 'option'); ?>
<?php if ($email_modal_state === 'enable'): ?>
<div class="email-modal modal fade-out" id="email-modal">
	<?php get_template_part('templates/accordion', 'trigger'); ?>
	<h1><?php the_field('email_modal_copy'); ?></h1>
	<!--Begin mc_embed_signup-->
	<div id="mc_embed_signup">
		<form action="//bangfitness.us9.list-manage.com/subscribe/post?u=a776c6f8b980bd03dc38348c8&amp;id=ec546debef" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate lower" target="_blank" novalidate>
			<div class="mc-field-group">
			  <label for="mce-EMAIL">Email Address</label>
			  <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Enter email">
			  <div id="mce-responses" class="clear">
			  <div class="response" id="mce-error-response" style="display:none"></div>
			  <div class="response" id="mce-success-response" style="display:none"></div>
			  </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
			  <div style="position: absolute; left: -5000px;"><input type="text" name="b_a776c6f8b980bd03dc38348c8_ec546debef" tabindex="-1" value=""></div>
			  <div class="clear"><input type="submit" value="Sign-up" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
			</div>
		</form>
	</div>
	<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='MMERGE3';ftypes[3]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
	<!--End mc_embed_signup-->
</div>
<?php endif; ?>
<?php endwhile; ?>
