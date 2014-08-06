<?php
  get_header();

  $prefix = 'tk_';
  $sidebar_position = get_theme_option(wp_get_theme()->name . '_general_search_sidebar');
  $social_share = get_theme_option(wp_get_theme()->name . '_social_social_share_blog');

  $sidebar = 'full';
  $position_content = '';
  $cols_main = 'col-md-12';

  if($sidebar_position != 'fullwidth'){
      $sidebar = 'sidebar';
      $cols_main = 'col-md-8';
      if($sidebar_position == 'left'){ $position_content = 'pull-right'; }
  }

?>

<div id="main-wrapper" class="container">
  <div class="single-post">
      <div class="row">
        <div class="<?php echo $cols_main; ?> <?php echo $position_content; ?> main-content">
            <article class="post">
              <section>
                <div class="post-content">
                  <h2 class='post-title search-title'>
                      <?php printf( __('Search Results for: %s', 'tkingdom'),'' . get_search_query() . ''); ?>
                  </h2>
                          <?php if (have_posts()) : ?>
                                </div>
                              </section>
                           </article>
                              <?php while (have_posts()) : the_post(); ?>
                                  <?php 
                                      if (get_post_format()) {
                                          $post_format = get_post_format();
                                      } else {
                                          $post_format = 'standard';
                                      }
                                  ?>
                                      <?php $class = ''; if($post_format == 'link'){ $class = 'link'; } if($post_format == 'quote'){ $class = 'quote'; } if(get_post_type()=='page'){ $class = 'post'; } ?>
                                      <article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
                                        <?php
                                          get_template_part('/templates/parts/format', $post_format); ?>
                                      </article>
                              <?php endwhile; ?>
                          <?php else : ?>
                        <h4><?php _e('No Results Found', 'tkingdom'); ?></h4>
                      </div>
                    </section>
               </article>
                <?php endif;?>
        </div>
        <?php if($sidebar_position != 'fullwidth'): ?>
        <?php
            $position = 'Right';
            if($sidebar_position == 'left'){ $position = 'Left'; }
                tk_get_sidebar($position, 'Search');
        ?>
        <?php endif; ?>
      </div><!-- row -->
  </div><!-- single-post -->
</div><!-- #main-wrapper -->
<?php
  get_footer();
?>