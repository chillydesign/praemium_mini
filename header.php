<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title(''); ?><?php if (wp_title('', false)) {
										echo ' :';
									} ?> <?php bloginfo('name'); ?></title>


	<?php $tdu = get_template_directory_uri(); ?>

	<?php if (is_tattes()) : ?>
		<link rel="apple-touch-icon" href="<?php echo $tdu; ?>/img/favicon_tattes/favicon.png">
		<link rel="icon" type="image/png" href="<?php echo $tdu; ?>/img/favicon_tattes/favicon.png">
	<?php else : ?>
		<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $tdu; ?>/img/favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo $tdu; ?>/img/favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $tdu; ?>/img/favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $tdu; ?>/img/favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $tdu; ?>/img/favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $tdu; ?>/img/favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $tdu; ?>/img/favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $tdu; ?>/img/favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $tdu; ?>/img/favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192" href="<?php echo $tdu; ?>/img/favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $tdu; ?>/img/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="<?php echo $tdu; ?>/img/favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $tdu; ?>/img/favicon/favicon-16x16.png">
	<?php endif; ?>


	<link href="//www.google-analytics.com" rel="dns-prefetch">

	<link href="<?php echo get_template_directory_uri(); ?>/css/jquery.bxslider.css" rel="stylesheet" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<?php wp_head(); ?>


	<?php $smp_title = get_the_title(); ?>
	<?php $smp_description = get_field('social_description'); ?>
	<?php $smp_image = get_field('title_background_image'); ?>
	<meta property="og:type" content="article" />
	<meta property="og:site_name" content="<?php echo $smp_title; ?>" />
	<meta property="og:title" content="<?php echo $smp_title; ?>">
	<meta name="twitter:title" content="<?php echo $smp_title; ?>">
	<meta itemprop="name" content="<?php echo $smp_title; ?>">

	<?php if ($smp_description) : ?>
		<meta name="twitter:card" value="<?php echo $smp_description; ?>">
		<meta name="twitter:description" content="<?php echo $smp_description; ?>">
		<meta property="og:description" content="<?php echo $smp_description; ?>">
		<meta itemprop="description" content="<?php echo $smp_description; ?>">
	<?php endif; ?>
	<?php if ($smp_image) : ?>
		<meta itemprop="image" content="<?php echo $smp_image; ?>">
		<meta name="twitter:image" content="<?php echo $smp_image; ?>">
		<meta property="og:image" content="<?php echo $smp_image; ?>">
		<meta property="og:img" content="<?php echo $smp_image; ?>">
	<?php endif; ?>



</head>


<body <?php body_class(); ?>>



	<?php $hide_welcome_screen = get_field('hide_welcome_screen'); ?>

	<?php if ($hide_welcome_screen == false || $hide_welcome_screen == null) : ?>
		<div class="loader">
			<div class="loaderinside">
				<?php include('img/logo.svg'); ?>
			</div>
		</div>
		<script>
			const show_loader_screen = true;
		</script>
	<?php endif; ?>