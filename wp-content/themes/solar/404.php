<?php
  get_header();
?>

<div id="main-wrapper" class="container">
  <div class="error-404">

      <div class="row">
        <div class="col-md-12 main-content">

          <article>
            <h2 class='post-title'><?php _e('404: Page not found', 'tkingdom'); ?></h2>
            <section>
              <p class="serif">
                <?php _e('We are terribly sorry, but nothing exists at this URL:', 'tkingdom'); ?>
              </p>
              <form method="get" id="searchform" class="submit-search-form" action="">
                <label for=""><?php _e('Try searching the site:', 'tkingdom'); ?></label>
                <div id="s">
                  <input type="text" name="s" class="search-input" value="">
                  <input type="submit" id="searchsubmit" class="search-submit-button" value="<?php _e('SEARCH', 'tkingdom'); ?>">
                </div>
              </form>
            </section>
          </article>

        </div>

      </div><!-- row -->

  </div><!-- error-404 -->
</div><!-- #main-wrapper -->

<?php
  get_footer();
?>