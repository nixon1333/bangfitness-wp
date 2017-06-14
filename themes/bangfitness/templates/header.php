<?php use Roots\Sage\Utils; ?>
<section class="signup-modal modal" id="signup-modal">
  <?php get_template_part('templates/accordion', 'trigger'); ?>
  <h1><?php the_field('sign_up_form_heading', 'option'); ?></h1>
  <p><?php echo Utils\smallcapsify(get_field('sign_up_form_body', 'option')); ?></p>
  <?php get_template_part('templates/contact', 'form'); ?>
</section>
<header class="banner site-main" role="banner">
  <div class="container">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>"><span>Bang</span>Fitness</a>
    <div class="lower">
      <div class="underlay"></div>
      <nav role="navigation" class="main-menu">
        <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
        endif;
        ?>
      </nav>
      <nav class="extras">
        <ul>
          <li><a href="tel:+14167772264">(416) 777-2264</a></li>
          <li><a href="<?php the_field('members_link', 'option'); ?>" target="_blank">Members</a></li>
          <li><a href="#" class="sign-up-trigger">Sign Up</a></li>
        </ul>
      </nav>
    </div>
    <button id="mobile-toggle" class="mobile-toggle cmn-toggle-switch cmn-toggle-switch__htx"><span>Toggle Menu</span></button>
  </div>
</header>
