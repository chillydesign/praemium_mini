<?php get_header(); ?>

<?php get_template_part('header_html'); ?>



			<!-- section -->

				<article id="main_article">
					<h1><?php echo sprintf( __( '%s Search Results for ', 'html5blank' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>


					<?php get_template_part('loop'); ?>

					<?php get_template_part('pagination'); ?>
				</article>
		
<?php get_template_part('footer_html'); ?>

	<?php get_footer(); ?>
