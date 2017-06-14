<?php use Roots\Sage\Utils; ?>
<?php get_template_part('templates/page', 'header'); ?>
<?php 
$blog_query = new WP_Query(array(
	'post_type' => 'post',
	'orderby' => 'date',
	'order' => 'desc',
	'posts_per_page' => -1
));
?>
<section class="blog-posts">
	<?php if( $blog_query->have_posts() ): ?>
		<?php while ( $blog_query->have_posts()) : $blog_query->the_post(); ?>
		<article class="section blog-post">
			<div class="inner">
				<time class="colored"><?php echo get_the_date('F j Y'); ?></time>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			</div>
		</article>
		<?php endwhile; ?>
	<?php endif; ?>
</section>
