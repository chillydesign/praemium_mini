<section class="situation_maps" id="cartes">

  <?php if (get_sub_field('directions') and !get_sub_field('hide_directions')) {
    $directions = get_sub_field('directions');
  } else {
    $directions = false;
  } ?>




  <div class="maps_tabs">
    <div class="container">

      <?php if (get_sub_field('hide_couches')) : ?>
      <?php else : ?>
        <?php if (have_rows('block_map')) { ?>
          <span class="active" id="amenites">Plan des aménités locales</span>
        <?php } # END OF IF HAVE ROWS BLOCK MAP 
        ?>
      <?php endif; # END OF IF DONT HIDE COUCHES 
      ?>


      <?php if (get_sub_field('hide_situation') == false) { ?><span id="globalmap">Plan de situation</span><?php } ?>
      <?php if ($directions) { ?>
        <span id="directions"><a style="color:white; text-decoration:none;" target="_blank" href="<?php echo $directions; ?>">Itinéraire</a></span>
      <?php } ?>
    </div>
  </div>

  <?php if (get_sub_field('hide_couches')) : ?>
  <?php else : ?>
    <?php if (have_rows('block_map')) : ?>
      <div class="amenites">
        <div class="map_layers_nav">
          <div class="container">
            <?php while (have_rows('block_map')) : the_row(); ?>
              <span class="nav_button active" id="layer_<?php echo sanitize_title(get_sub_field('label')); ?>"><?php echo get_sub_field('label'); ?></span>
            <?php endwhile; ?>
          </div>
        </div>
        <div id="amenities_map_layers" class="map_layers">

        </div>

        <script type="text/javascript">
          $amenities_layers = [{
              'label': null,
              'src': '<?php echo get_sub_field('base_map')['url']; ?>'
            },
            <?php while (have_rows('block_map')) : the_row(); ?> {
                'label': '<?php echo  sanitize_title(get_sub_field('label')); ?>',
                'src': '<?php echo get_sub_field('image')['url']; ?>'
              },
            <?php endwhile; ?>
          ];
        </script>


      </div>
    <?php endif; # END OF IF HAVE ROWS BLOCK MAP 
    ?>
  <?php endif; # END OF IF DONT HIDE COUCHES 
  ?>




  <div class="globalmap invisible">
    <div class="map_layers_nav">
      <div class="container" id="loc_cats_container">

      </div>
    </div>
    <div id="map"></div>
    <div class="left_slidies mapsidebar">

      <div id="markercontent"></div>

    </div>
  </div>




  <script>
    var latitude = <?php echo get_sub_field('lat_center'); ?>;
    var longitude = <?php echo get_sub_field('long_center'); ?>;


    <?php
    $rows = get_sub_field('points_gmap');
    $row_count = count($rows);

    $i = 1;

    echo "var locations = [";
    echo     "\n";
    echo "['" . preg_replace("/\\n/", '',   trim(get_sub_field('project_description'))) . "', '" . get_sub_field('project_lat') . "', '" . get_sub_field('project_long') . "', 'projet' ], ";
    while (have_rows('points_gmap')) : the_row();
      echo     "\n";

      echo "['" . preg_replace("/\\n/", '',   trim(get_sub_field('description'))) . "', '" . get_sub_field('latitude') . "', '" . get_sub_field('longitude') . "', '" .  get_sub_field('category') . "' ]";
      if ($i < $row_count) {
        echo " , ";
      }
      $i++;
    endwhile;
    echo "]; ";
    ?>
  </script>

</section>


<?php if ($directions) { ?>
  <section class="only_on_mobile mobile_itineraire">
    <p style="text-align:center"><a class="btn btn_inline" target="_blank" href="<?php echo $directions; ?>">Itinéraire</a></p>

  </section>
<?php } ?>