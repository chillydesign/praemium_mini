<?php get_header(); ?>
<?php get_template_part('header_html'); ?>
<article id="main_article">

	<h1 class="container"><?php _e( 'Author Archives for ', 'html5blank' ); echo get_the_author(); ?></h1>




	<?php get_template_part('loop'); ?>
	<?php get_template_part('pagination'); ?>
	</article>


<?php get_template_part('footer_html'); ?>



<?php get_footer(); ?>
