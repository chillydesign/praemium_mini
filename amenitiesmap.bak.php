    <div class="map_layers">
      <img class="layers_stack" src="<?php echo get_sub_field('base_map')['url']; ?>" style="position:absolute; width:100%; height:auto;">
    <!-- <div class="layers_stack" style="position:absolute; background-image:url('<?php // echo get_sub_field('base_map')['url']; ?>'); background-size:contain; background-repeat:no-repeat; background-position:center;  width:100%;"></div> -->
    <?php while ( have_rows('block_map') ) : the_row(); ?>
     <img class="layers_stack layer_<?php echo sanitize_title(get_sub_field('label')); ?>" src="<?php echo get_sub_field('image')['url']; ?>" style="position:absolute; left:0;width:100%; height:auto;">
      <!-- <div class="layers_stack layer_<?php // echo sanitize_title(get_sub_field('label')); ?>" style="position:absolute; background-image:url('<?php // echo get_sub_field('image')['url']; ?>'); background-size:contain; background-repeat:no-repeat; background-position:center; width:100%;"></div> -->// 
    <?php endwhile; ?>
    </div>
