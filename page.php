<?php get_header(); ?>
<style type="text/css">
	<?php echo strip_tags(get_field('custom_style')); ?>
</style>





<!--		<?php // if (have_posts()): while (have_posts()) : the_post(); 
			?>
 				<h2><?php the_title(); ?></h2>
			<?php //if (get_the_content()  != '' ) : 
			?>
				<?php the_content(); ?>
			<?php //endif; 
			?>
			<?php //endwhile; endif; 
			?>
 -->
<?php include('section-loop.php'); ?>



<?php
$video_mp4 = get_field('video_mp4');
$video_ogv = get_field('video_ogv');
?>
<script type="text/javascript">
	<?php if ($video_mp4) : ?>
		var video_mp4 = '<?php echo $video_mp4['url']; ?>';
	<?php endif; ?>
	<?php if ($video_ogv) : ?>
		var video_ogv = '<?php echo $video_ogv['url']; ?>';
	<?php endif; ?>
</script>




<?php $bgimage = get_field('title_background_image'); ?>
<?php if ($bgimage) : ?>
	<div id="bg" style="background-image: url(<?php echo $bgimage; ?>">
		<?php if ($video_mp4) : ?>
			<video playsinline muted loop poster=" <?php echo $bgimage; ?>" id="vidbg" autoplay="autoplay"></video>
		<?php endif; ?>
	</div>
<?php endif; ?>



<?php if (get_field('couleur_1')  || get_field('couleur_2') || get_field('macaron_couleur')) : ?>
	<?php $macaron_couleur = get_field('macaron_couleur'); ?>
	<?php $colour_1 = get_field('couleur_1'); ?>
	<?php $colour_2 = get_field('couleur_2') ? get_field('couleur_2') : $colour_1;  ?>
	<style type="text/css">
		<?php if ($colour_1) : ?>

		/*CHANGE FEATURE COLOUR*/
		a:link,
		a:link h3 {
			color: <?php echo $colour_1; ?>
		}

		a:visited,
		a:visited h3 {
			color: <?php echo $colour_1; ?>
		}

		a:hover,
		a:hover h3 {
			color: <?php echo $colour_1; ?>
		}

		header nav ul.navVisible {
			background-color: <?php echo $colour_1; ?>;
		}

		.home_box_bg_inner.featured_color {
			background-color: <?php echo $colour_1; ?>
		}

		.blue {
			background-color: <?php echo $colour_1; ?>;
		}

		.map_layers_nav span.active {
			background: white;
			color: <?php echo $colour_1; ?>;
		}

		header nav a:link,
		header nav a:visited,
		header nav a:active {
			color: <?php echo $colour_1; ?>;
		}

		.left_slidies_bg.featured_color {
			background-color: <?php echo $colour_1; ?>;
		}

		.left_slidies_arrow.featured_color {
			background-color: <?php echo $colour_1; ?>;
		}

		<?php endif; ?><?php if ($colour_2) : ?>

		/*SECOND FEATURE COLOUR*/
		.macaron {
			background-color: <?php echo $colour_2; ?>;
		}

		.partenairesslider h2 {
			color: <?php echo $colour_2; ?>;
		}

		.contact-macaron {
			background: <?php echo $colour_2; ?>;
		}

		thead {
			background: <?php echo $colour_2; ?>;
		}

		.btn {
			background: <?php echo $colour_2; ?>;
		}

		span.plus {
			background: <?php echo $colour_2; ?>;
		}

		<?php endif; ?><?php if ($macaron_couleur) : ?>.macaron {
			background-color: <?php echo $macaron_couleur; ?>;
		}

		<?php endif; ?>
	</style>
<?php endif; ?>





<?php $heading_font = get_field('heading_font'); ?>
<?php $heading_font_embed = get_field('heading_font_embed'); ?>
<?php $body_font = get_field('body_font'); ?>
<?php $body_font_embed = get_field('body_font_embed'); ?>

<?php if ($heading_font  || $body_font) : ?>

	<?php if ($heading_font_embed) echo $heading_font_embed; ?>
	<?php if ($body_font_embed) echo $body_font_embed; ?>

	<style type="text/css">
		<?php if ($heading_font) : ?>h1,
		h2,
		h3,
		h4,
		h5,
		.branding,
		header {
			<?php echo $heading_font; ?>
		}

		<?php endif; ?><?php if ($body_font) : ?>body {
			<?php echo $body_font; ?>
		}

		<?php endif; ?>
	</style>
<?php endif; ?>

<?php get_footer(); ?>