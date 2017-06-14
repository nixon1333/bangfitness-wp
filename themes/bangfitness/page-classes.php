<?php use Roots\Sage\Utils; ?>
<?php while (have_posts()) : the_post(); ?>
<?php get_template_part('templates/page', 'header'); ?>
<section class="classes accordion">
	<?php if( have_rows('classes') ): ?>
		<?php while ( have_rows('classes') ) : the_row(); ?>
		<article class="class section">
			<figure class="bg" style="background-image:url(<?php the_sub_field('image'); ?>)"></figure>
			<div class="inner">
				<div class="upper">
					<h2><?php the_sub_field('class_name'); ?></h2>
					<time><?php the_sub_field('class_timing'); ?></time>
					<?php get_template_part('templates/accordion', 'trigger'); ?>
				</div>
				<div class="info lower">
					<p><?php echo Utils\smallcapsify(get_sub_field('description')); ?></p>
					<div class="instructor">
						<div class="left">
							<p class="head small-caps">Instructor</p>
							<h6><?php the_sub_field('instructor_name'); ?></h6>
						</div>
						<figure class="portrait" style="background-image:url(<?php the_sub_field('instructor_portrait'); ?>)"></figure>
					</div>
				</div>
			</div>
		</article>
		<?php endwhile; ?>
	<?php endif; ?>
</section>
<?php endwhile; ?>