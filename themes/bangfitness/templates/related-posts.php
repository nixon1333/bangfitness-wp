<div class="relatedposts">
    <h3>Related posts</h3>
    <?php
        $orig_post = $post;
        global $post;
        $categories = get_the_category($post->ID);

        if ($categories) :
            $category_ids = array();
            foreach ($categories as $individual_category)
                $category_ids[] = $individual_category->term_id;
            $args = array(
                'category__in' => $category_ids,
                'post__not_in' => array($post->ID),
                'posts_per_page' => 3, // Number of related posts to display.
                'caller_get_posts' => 1
            );

            $my_query = new wp_query($args);

            while ($my_query->have_posts()) :
                $my_query->the_post();
                ?>
                <div class="relatedthumb">
                    <a rel="external" href="<?php the_permalink()?>"><?php the_post_thumbnail(array(330)); ?>
                        <div class="related-title"><?php the_title(); ?></div>
                        <div class="related-date"><?php get_template_part('templates/entry-meta'); ?></div>
                    </a>
                </div>
        <?php 
            endwhile;
        endif;
    $post = $orig_post;
    wp_reset_query();
    ?>
</div>