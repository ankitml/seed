  <!-- FOOTER -->
      <div id="footer-wrapper">
        <footer class="container" id="footer">
          <div class="row">
              <div class="col-md-4 col-sm-6">
                <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 1')); ?>
              </div>

              <div class="col-md-4 col-sm-6">
                <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 2')); ?>
              </div>

              <div class="col-md-4 col-sm-6">
                <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 3')); ?>
              </div>
          </div>
        </footer>
        <aside class="social">
        <div class="container">
        <?php

          /*---SOCIAL ICONS---*/
          $twitter_acc   = get_theme_option(wp_get_theme()->name.'_social_twitter');
          $facebook_acc  = get_theme_option(wp_get_theme()->name.'_social_facebook');
          $google_acc    = get_theme_option(wp_get_theme()->name.'_social_google_plus');
          $dribbble_acc  = get_theme_option(wp_get_theme()->name.'_social_dribbble');
          $pinterest_acc = get_theme_option(wp_get_theme()->name.'_social_pinterest');
          $linkedin_acc  = get_theme_option(wp_get_theme()->name.'_social_linkedin');
          $behance_acc   = get_theme_option(wp_get_theme()->name.'_social_behance');
          $youtube_acc   = get_theme_option(wp_get_theme()->name.'_social_youtube');
          $instagram_acc = get_theme_option(wp_get_theme()->name.'_social_instagram');
          $vimeo_acc     = get_theme_option(wp_get_theme()->name.'_social_vimeo');
          $rss_acc       = get_theme_option(wp_get_theme()->name.'_social_rss_url');

          if ($linkedin_acc != '' || $twitter_acc != '' || $facebook_acc != '' || $rss_acc != '' || $google_acc != '' || $dribbble_acc != '' || $pinterest_acc != '' || $behance_acc != '' || $youtube_acc != '' || $instagram_acc != '' || $vimeo_acc != '') {
              ?>

                  <ul class="social-icons">
                    <?php if (!empty($facebook_acc)) { ?>
                        <li><a href="http://facebook.com/<?php echo $facebook_acc; ?>"><i class="icon-facebook"></i></a></li>
                    <?php } ?>

                    <?php if (!empty($vimeo_acc)) { ?>
                        <li><a href="http://www.vimeo.com/<?php echo $vimeo_acc; ?>"><i class="icon-vimeo"></i></a></li>
                    <?php } ?>

                    <?php if (!empty($pinterest_acc)) { ?>
                        <li><a href="http://pinterest.com/<?php echo $pinterest_acc; ?>"><i class="icon-pinterest"></i></a></li>
                    <?php } ?>

                    <?php if (!empty($instagram_acc)) { ?>
                        <li><a href="http://www.instagram.com/<?php echo $instagram_acc; ?>"><i class="icon-instagram"></i></a></li>
                    <?php } ?>

                    <?php if (!empty($twitter_acc)) { ?>
                        <li><a href="http://twitter.com/<?php echo $twitter_acc; ?>" ><i class="icon-twitter"></i></a></li>
                    <?php } ?>

                    <?php if (!empty($dribbble_acc)) { ?>
                        <li><a href="http://dribbble.com/<?php echo $dribbble_acc; ?>"><i class="icon-dribbble"></i></a></li>
                    <?php } ?>

                    <?php if (!empty($linkedin_acc)) { ?>
                        <li><a href="<?php echo $linkedin_acc; ?>"><i class="icon-in"></i></a></li>
                    <?php } ?>

                    <?php if (!empty($google_acc)) { ?>
                        <li><a href="http://plus.google.com/<?php echo $google_acc; ?>"><i class="icon-gplus"></i></a></li>
                    <?php } ?>

                    <?php if (!empty($behance_acc)) { ?>
                        <li><a href="http://www.behance.net/<?php echo $behance_acc; ?>"><i class="icon-be"></i></a></li>
                    <?php } ?>
                </ul>
            <?php } ?>

            <?php
              /************************************************************/
              /*                                                          */
              /*   Get Copyright                                          */
              /*                                                          */
              /************************************************************/
              $copyright = get_theme_option(wp_get_theme()->name . '_general_footer_copy');
              if(empty($copyright)) {
                  $copyright =  __("&copy; Copyright Information Goes Here &copy; 2014. All Rights Reserved.", 'tkingdom');
              }
            ?>
            <p class="copy"><?php echo $copyright; ?></p>
          </div>
        </aside>

      </div>

    </div><!-- body-content -->

    <?php wp_footer(); ?>


  </body>
</html>