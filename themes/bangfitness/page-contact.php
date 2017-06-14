<?php while (have_posts()) : the_post(); ?>
<?php $contact_sections = get_field('contact_section') ?>
<?php $left_section = array_shift($contact_sections) ?>
<?php $right_section = array_shift($contact_sections) ?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABZQj6f2mc_eaLjRkSQcvCYan95t8jP3w"></script>
<section class="map">
	<figure id="contact-map"></figure>
</section>
<section class="contact">
	<div class="top">
		<div class="phone contact-section">
			<h2><?php echo $left_section['section_title'] ?></h2>
			<p><?php echo $left_section['section_text'] ?></p>
		</div>
		<div class="phone contact-section">
			<h2><?php echo $right_section['section_title'] ?></h2>
			<p><?php echo $right_section['section_text'] ?></p>
		</div>
	</div>
	<?php foreach ($contact_sections as $section): ?>
	<div class="contact-section">
			<h2><?php echo $section['section_title'] ?></h2>
			<p><?php echo $section['section_text'] ?></p>
	</div>
	<?php endforeach; ?>
	<p class="copyright">&copy; <?php echo date('Y') ?> Bang Fitness</p>
</section>
<?php endwhile; ?>