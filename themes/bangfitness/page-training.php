<?php use Roots\Sage\Utils; ?>
<?php while (have_posts()) : the_post(); ?>
<?php get_template_part('templates/page', 'header'); ?>
<section class="programs accordion">
	<?php if( have_rows('programs') ): ?>
		<?php while ( have_rows('programs') ) : the_row(); ?>
		<article class="program section">
			<figure class="bg" style="background-image:url(<?php the_sub_field('image'); ?>)"></figure>
			<div class="inner">
				<div class="upper">
					<h2><?php the_sub_field('program_name'); ?></h2>
					<?php get_template_part('templates/accordion', 'trigger'); ?>
				</div>
				<div class="info lower">
					<p><?php echo Utils\smallcapsify(get_sub_field('program_description')); ?></p>
					<button class="sign-up sign-up-trigger">Sign-Up</button>
					<?php if (! empty(get_sub_field('price'))): ?>
					<button class="plan">
						<span class="dollar">$</span>
						<span class="price"><?php the_sub_field('price'); ?></span>
						<span class="from">
							<?php $output = ''; ?>
							<?php $from = get_sub_field('from') ?>
							<?php if ($from): ?>
							<?php $output .= '<span class="white">From</span>' ?>
							<?php endif ?>
							<?php $output .= '<br />'; ?>
							<?php $period = get_sub_field('billing_period'); ?>
							<?php if ($period !== 'one-time') $output .= '&#47;'; ?>
							<?php switch ($period) {
								case 'hourly':
									$output .= 'hr';
									break;
								case 'monthly':
									$output .= 'mo';
									break;
								case 'annual':
									$output .= 'yr';
									break;
								default:
									break;
							} ?>
							<?php echo $output ?>
						</span>
					</button>
					<?php endif; ?>
				</div>
			</div>
		</article>
		<?php endwhile; ?>
	<?php endif; ?>
</section>
<?php endwhile; ?>