<?php if ( $wp_query->max_num_pages  > 1) : ?>
<!-- pagination -->
<div class="pagination">
	<?php html5wp_pagination(); ?>
</div>
<!-- /pagination -->


<?php endif; ?>