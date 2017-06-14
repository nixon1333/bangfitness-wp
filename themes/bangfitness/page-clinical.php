<?php use Roots\Sage\Utils; ?>
<?php while (have_posts()) : the_post(); ?>
<?php get_template_part('templates/page', 'header'); ?>
<section class="clinical_services accordion">
	<?php if( have_rows('clinical_services') ): ?>
		<?php while ( have_rows('clinical_services') ) : the_row(); ?>
		<article class="clinical_service section">
			<figure class="bg" style="background-image:url(<?php the_sub_field('background_image'); ?>)"></figure>
			<div class="inner">
				<div class="upper">
					<h2><?php the_sub_field('service_name'); ?></h2>
					<!-- <time><?php the_sub_field('service_description'); ?></time> -->
					<?php get_template_part('templates/accordion', 'trigger'); ?>
				</div>
				<div class="info lower">
					<p><?php echo Utils\smallcapsify(get_sub_field('service_description')); ?></p>
				</div>
			</div>
		</article>
		<?php endwhile; ?>
	<?php endif; ?>
</section>
<?php endwhile; ?>