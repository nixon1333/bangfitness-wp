<?php use Roots\Sage\Utils; ?>
<?php //get_template_part('templates/page', 'header'); ?>
<?php
$blog_query = new WP_Query(array(
	'post_type' => 'post',
	'orderby' => 'date',
	'order' => 'desc',
	'posts_per_page' => -1
));
?>

    <section class="blog-posts" id='blog-articles'>
        <?php if ( is_active_sidebar( 'sidebar-featured-blog' ) ) { ?>
	<section id="sidebar-featured-blog">
		<?php dynamic_sidebar( 'sidebar-featured-blog' ); ?>
	</section>
        <?php } ?>
        <?php get_template_part('templates/featured-posts'); ?>
            <?php if( $blog_query->have_posts() ): ?>
                    <?php while ( $blog_query->have_posts()) : $blog_query->the_post(); ?>
                    <article class="section blog-post">
                        <div class='blog-post-image'>
                            <?php if ( has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink()?>"> <?php the_post_thumbnail(array(330)); ?></a>
                            <?php else : ?>
                                <a href="<?php the_permalink()?>"> <img src="/wp-content/uploads/2017/04/image-coming-soon.jpg" width="330" /></a>
                            <?php endif; ?>
                        </div>
                        <div class="inner">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <time><?php echo get_the_date('F j Y'); ?></time>
                            <?php the_excerpt(); ?>
                        </div>

                        <div class='category-color'>&nbsp;</div>
                    </article>
                    <!-- <hr />-->
                    <?php endwhile; ?>
            <?php endif; ?>
    </section>
