<div class='clearfix'></div>
<div class="featured-posts">
    <?php
        $orig_post = $post;
        global $post;
        $category_name = 'featured';
            $args = array(
                'category_name' => $category_name,
                'posts_per_page' => 3, // Number of related posts to display.
                'caller_get_posts' => 1
            );

            $my_query = new wp_query($args);

            while ($my_query->have_posts()) :
                $my_query->the_post();
                ?>
                <div class="featured-post">
                    <a rel="external" href="<?php the_permalink()?>"><?php the_post_thumbnail(array(328,328)); ?>
                        <div class="post-details">
                            <div class="post-title"><?php the_title(); ?></div>
                            <div class="post-date"><?php get_template_part('templates/entry-meta'); ?></div>                            
                        </div>
                    </a>
                </div>
        <?php 
            endwhile;        
        $post = $orig_post;
        wp_reset_query();
        ?>
</div>
<div class="clearfix"></div>