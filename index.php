<?php get_header(); ?>
<?php get_template_part('header_html'); ?>





			<article id="main_article">

			<?php if( get_option('page_for_posts' ) ) : ?>
			<h1 ><?php echo apply_filters('the_title',get_page( get_option('page_for_posts') )->post_title); ?></h1>
			<?php endif; ?>



				<?php get_template_part('loop'); ?>

				<?php get_template_part('pagination'); ?>
			</article>
	


<?php get_template_part('footer_html'); ?>
<?php get_footer(); ?>
