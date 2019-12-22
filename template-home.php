<?php /* Template Name: Home */ get_header(); ?>

<main class="container homepage-hero">
	<div class="wrap">
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<header>
				<h1>Northwood Sauna</h1>
				<p>The finest wood and sauna accesories</p>
				<p><a class="button" style="font-weight: bold;" href="https://danielaudunsson.com/freevalue" rel="noopener noreferrer"><span></span>SEE HOW</a></p>
			</header>
		
			<!-- /article -->
		<?php endwhile; endif; ?>
	</div>
</main>

<main class="container homepage-portfolio">
	<div class="wrap" style="max-width: 880px;">
		<header>
		<h1>About Daniel Audunsson</h1>
		</header>
		<p>Hey! I'm an entrepreneur from Iceland who dropped out of university and started a successful private label brand by the age of 23 working out of a bedroom at my parents farm.</p>
		<p>During the last 6+ years I've sold millions of dollars worth of my products online and opened up offices in Hong Kong, China and The Philippines totaling over 50 employees at one time. During the last 6+ years I have sold over 200 different private label products and built over 15 different brands.</p>
		<p>I've also helped 1000's of other entrepreneurs successfully build and grow wildly profitable private label brands. I've been featured in Forbes, BBC and a 30 minute documentary was made about my early success as an entrepreneur.</p>

	</div>
</main>

<main class="container homepage-social">
	<div class="wrap">
		<header>
			<h1>I Am Social</h1>
			<p>Follow me on :</p>
		</header>
		<div class="social-icons clear">
			<a href="https://www.instagram.com/danielaudunsson" target="_blank" alt="Instagram"><i class="icon-instagram"></i></a>
			<a href="https://twitter.com/danielaudunsson" target="_blank" alt="Twitter"><i class="icon-twitter"></i></a>
			<a href="https://www.facebook.com/danielaudunssonlive" target="_blank" alt="Facebook"><i class="icon-facebook"></i></a>
			<a href="https://www.youtube.com/channel/UCOhQ7IdiVx4IKDOKRKl7RtA/featured" target="_blank" alt="Youtube"><i class="icon-youtube"></i></a>
			<a href="https://is.linkedin.com/in/daniel-audunsson-81b3b27b" target="_blank" alt="LinkedIn"><i class="icon-linkedin"></i></a>
		</div>
	</div>
</main>


<?php get_footer(); ?>