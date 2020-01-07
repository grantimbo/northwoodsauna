<?php /* Template Name: Home Draft */ wp_head(); ?>

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

    <body>
        <img style="display: table; margin: 30vh auto; max-width: 230px;" src="<?php echo get_template_directory_uri(); ?>/img/logo-black.png" alt="Northwood Sauna">
    <body>

</html>
<?php wp_footer(); ?>