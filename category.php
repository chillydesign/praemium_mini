<?php get_header(); ?>
<?php get_template_part('header_html'); ?>




			<article id="main_article">



		<h1 ><?php _e( 'Categories for ', 'html5blank' ); single_cat_title(); ?></h1>

			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>


			</article>


<?php get_template_part('footer_html'); ?>
<?php get_footer(); ?>