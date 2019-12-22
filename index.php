<?php get_header(); ?>
	<main role="main">
		<section>
			<h1><?php _e( 'Post', 'html5blank' ); ?></h1>
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
				<article class="client-wrap clear">
					<div class="client-content">
						<?php the_post_thumbnail(); ?>
						<h2 class="client-title"><?php the_title(); ?><span class="address">(<?php echo get_the_excerpt(); ?>)</span></h2>
						<?php the_content(); ?>
						<div class="readmore">
							<a class="read">Read More</a>
						</div>
					</div>
				</article>
			<!-- /client-content -->
			<?php endwhile; endif; ?>

			<div class="pagination clear">
				<?php grantimbo_pagination(); ?>
			</div>
			<!-- /pagination -->

		</section>
	</main>
<?php get_footer(); ?>
