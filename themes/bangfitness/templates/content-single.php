<?php while (have_posts()) : the_post(); ?>
  <?php $blog_page = get_page_by_path('blog') ?>
  <article <?php post_class(); ?> id='blog-article'>
    <header>
    <?php  
        if ( has_post_thumbnail()) {
            $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
            echo '<img src="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
            
        } 
    ?>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <div id='entry-details'>
            <div id='entry-details-container'>
                <span class="blog-by">
                    By <?= __('', 'sage'); ?> 
                    <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?= get_the_author(); ?></a>                    
                </span>                
                <span class="blog-details-divider">|</span>                
                <span class="blog-date" datetime="<?= get_the_time('F j y'); ?>">
                    <?= get_the_date(); ?>
                </span>                
                <span class="blog-details-divider">|</span>
                <?php echo do_shortcode('[rt_reading_time label="Read Time:" postfix="minutes"]'); ?>
            </div>
        </div>        
    </header>
    <div class="clear entry-content">      
      <?php the_content(); ?>      
    </div>
    <footer>
      <?php get_template_part('templates/related-posts'); ?>
    </footer>
  </article>
<?php endwhile; ?>
