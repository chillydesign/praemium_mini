  <!-- HEADER -->
  <header id="header">
    <div class="social">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo home_url();; ?>" class="social_link social_facebook">Facebook </a>
            <a target="_blank" href="http://www.twitter.com/share?url=<?php echo home_url(); ?>" class="social_link social_twitter">Twitter </a>

            <?php $instagram = get_field('instagram'); ?>
            <?php if (isset($instagram) && strlen($instagram) > 3) : ?>
              <a target="_blank" href="<?php echo $instagram; ?>" class="social_link social_instagram">Instagram</a>
            <?php endif; ?>

            <?php $email_subject = get_field('header_email_subject'); ?>
            <?php if (!$email_subject) {
              $email_subject = 'Les Townhouses du Cèdre';
            } ?>

            <a style="display:none;" target="_blank" href="https://www.linkedin.com/company/1641770?trk=tyah&trkInfo=clickedVertical%3Acompany%2CclickedEntityId%3A1641770%2Cidx%3A2-1-2%2CtarId%3A1481892370165%2Ctas%3Apraemium%20immo" class="social_link social_linkedin">LinkedIn</a>
            <a href="mailto:info@praemium.ch?<?php echo htmlentities('subject=' . $email_subject . '&body=' . get_home_url()); ?>" class="social_link social_email">Email</a>
          </div>
          <div class="col-sm-6 col-sm-right">

            <?php $has_brochure = get_field('brochure');
            $link_text = false;
            if ($has_brochure) :  ?>
              <?php if ($has_brochure == 'link')  $link_text =  get_field('brochure_lien'); ?>
              <?php if ($has_brochure == 'file')  $link_text =  get_field('brochure_fichier')['url']; ?>
              <?php if ($link_text) : ?>
                <a target="_blank" href="<?php echo $link_text; ?>" class="brochure">Afficher la brochure</a>
              <?php endif; ?>
            <?php endif; ?>
            <a href="#contact" class="rdv">Prendre rendez-vous</a>
          </div>

        </div>

      </div>
    </div>
    <div class="navigation">
      <div class="container-fluid">
        <div class="row">
          <ul class="branding col-md-4 col-xs-8 ">

            <li> <a href="#"><?php echo get_field('pagename') ?></a></li>
          </ul>

          <div class="col-md-8 col-xs-4">
            <nav>
              <ul>
                <?php // chilly_nav('header-menu'); 
                ?>

                <?php $menu_items = get_field('menu'); ?>

                <?php if (($menu_items) &&  sizeof($menu_items) > 0) : foreach ($menu_items as $menu_item) : ?>
                    <li><a href="#<?php echo $menu_item['link']; ?>"><?php echo $menu_item['nom']; ?></a></li>
                <?php endforeach;
                endif; ?>

              </ul>
            </nav>
            <a href="#" id="show_nav_button">Menu</a>
          </div>
        </div>

      </div>
    </div>
  </header>