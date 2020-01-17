<?php get_header(); ?>

<?php get_template_part('header-contents'); ?>
<main role="main" class="container default-container">
	<div class="wrap clear">
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
			<section>
				<?php the_content(); ?>
			</section>
		<?php endwhile;  endif; ?>
	</div>
</main>

<?php get_footer(); ?>