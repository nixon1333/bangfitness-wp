<section class="upper page-upper">
  <h1 class="page-title"><?php the_title() ?></h1>
  <?php if (! empty($page_description = get_field('page_description'))): ?>
  <p class="page-description"><?php echo $page_description ?></p>
  <?php endif; ?>
</section>