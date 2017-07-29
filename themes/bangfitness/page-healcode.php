<?php
/**
 * Template Name: bangFitness Page
 */
?>

<?php while (have_posts()) : the_post(); ?>

<section class="contact heal-code">

    <?php echo do_shortcode('[hc-hmw snippet="wwk-schedule"]'); ?>

	<p class="copyright">&copy; <?php echo date('Y') ?> Bang Fitness</p>
</section>
<?php endwhile; ?>