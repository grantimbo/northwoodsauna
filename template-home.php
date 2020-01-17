<?php /* Template Name: Home */ get_header(); ?>

<main class="homepage">

	<section class="container homepage-hero">
		<div class="wrap">
			<img src="<?php echo get_template_directory_uri(); ?>/img/logo-black.png" alt="Northwood Sauna">
			<p><?php the_field('description'); ?></p>
		</div>
	</section>

	<section class="container homepage-products">
		<div class="wrap">
			<header>
				<h1>Our Products</h1>
			</header>
			
		
			<div class="products">

				<?php $args = array( 
					'post_type' => 'products',  
					'orderby'=> 'menu_order',  
					'paged' => $paged
				); 
		
				$temp = $wp_query; 
				$wp_query = null; 
				$wp_query = new WP_Query(); 
				$wp_query->query( $args ); 
		
				if($wp_query->have_posts()) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
				<?php $images = get_field('images'); ?>

				<div class="prod">
					
					<div class="product-slide">
						<div class="slide-controls">
							<a class="prev-slide"><i class="icon-navigate_before"></i></a>
							<a class="next-slide"><i class="icon-navigate_next"></i></a>
						</div>
						<div class="slides">
							<?php if( $images ): foreach( $images as $image ): ?>
								<div class="slider-container" style="background-image:url(<?php echo esc_url($image['sizes']['large']); ?>)"></div>
							<?php endforeach; endif; ?>
						</div>
					</div>


					<h2><?php the_field('title'); ?></h2>
					<p><?php the_field('description'); ?></p>
					<div class="exc-rate star<?php the_field('rating'); ?>"></div>
					<a class="button" target="_blank" href="<?php the_field('link'); ?>">Order now on Amazon</a>

				</div>
		
				<?php endwhile; endif; wp_reset_query(); ?>

				
			</div>

		</div>
	</section>

	<section class="container homepage-about-us">
		<div class="wrap" >
			<header>
				<h1>About Us</h1>
			</header>
			<p><?php the_field('about_us'); ?></p>
		</div>
	</section>


	<section class="container homepage-guarantee-support">
		<div class="wrap" >
			<header>
				<h1>Guarantee & Support</h1>
			</header>
			<p><?php the_field('guarantee_support'); ?></p>
		</div>
	</section>

</main>

<?php get_footer(); ?>