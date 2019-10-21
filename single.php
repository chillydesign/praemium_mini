<?php get_header(); ?>




<?php get_template_part('header_html'); ?>



	<?php if (have_posts()): while (have_posts()) : the_post(); ?>



		<!-- article -->
		<article  <?php post_class(); ?>>
	<h1 ><?php the_title(); ?></h1>
		
			<p class="meta">
				<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?>. </span>
				<span class="comment_count"> <?php comments_number(  ); ?>.</span>
			</p>

				<?php the_content(); // Dynamic Content ?>




			<?php edit_post_link(); ?>

	


			<?php   comments_template(); ?>

		</article>
		<!-- /article -->

	<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>


<?php get_template_part('footer_html'); ?>


<?php get_footer(); ?>