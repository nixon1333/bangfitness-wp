<?php while (have_posts()) : the_post(); ?>
  <?php $blog_page = get_page_by_path('blog') ?>
  <article <?php post_class(); ?>>
    <header>
      <div class="back">
         <a href="<?php echo get_permalink($blog_page); ?>">&#8592; All Posts</a>
      </div>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
      <p class="byline author vcard"><?= __('', 'sage'); ?> <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?= get_the_author(); ?></a></p>
    </div>
    <footer>
      <div class="blog-nav">
        <p><?php previous_post_link('<span>Previous Post</span><br>%link'); ?></p>
        <p><?php next_post_link('<span>Next Post</span><br>%link'); ?></p>
      </div>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
  </article>
<?php endwhile; ?>
