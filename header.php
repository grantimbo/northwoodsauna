<!doctype html>
<html <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">

		<?php if ( is_front_page() ) : ?>
			<title><?php bloginfo('name'); ?> &mdash; <?php bloginfo('description'); ?></title>
		<?php else : ?>
			<title><?php bloginfo('name'); ?> &mdash; <?php wp_title(''); ?></title>
		<?php endif; ?>

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">

		<link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
	    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
		<link href="https://fonts.googleapis.com/css?family=Raleway:400,700&display=swap" rel="stylesheet">

		<div id="fb-root"></div>

		<?php wp_head(); ?>
		
	</head>
	<body <?php body_class(); ?>>
		<header class="header clear">
			<div class="wrap">
				<div class="mobile-menu-wrap">
					<header class="header clear">
					<a class="icon-cross mobile-menu"></a>
					<a class="logo" href="<?php home_url(); ?>"><?php echo bloginfo('name'); ?></a>
					<?php head_nav(); ?>
					</header>
				</div>
				<a class="icon-menu mobile-menu"></a>
				<a class="logo" href="<?php echo home_url(); ?>"><?php echo bloginfo('name'); ?></a>
				<div class="desktop-menu-wrap">
					<?php head_nav(); ?>
				</div>
			</div>
		</header>



		
		

		