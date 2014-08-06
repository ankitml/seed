<?php
  	get_header();

  $prefix = 'tk_';
  $sidebar_selected = get_post_meta($post->ID, $prefix.'sidebar', true);
  $sidebar_position = get_post_meta($post->ID, $prefix.'sidebar_position', true);
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
            <article class="post <?php if(is_single()){ ?> featured <?php } ?>">
              <!-- POST CONTENT -->
              <?php if (have_posts()): ?>
                  <?php while (have_posts()): the_post(); ?>
                      <?php
                      if (get_post_format()) {
                          $post_format = get_post_format();
                      } else {
                          $post_format = 'standard';
                      }
                      get_template_part('/templates/parts/format', $post_format); ?>
                  <?php endwhile; ?>
              <?php endif; ?>
              <!-- POST META -->
              <div class="post-meta block">
                <ul>
                  <li>
                    <strong><?php _e('Category', 'tkingdom'); ?></strong>
                      <?php echo get_the_category_list(' ', $post->ID); ?>
                  </li>
                  <li>
                    <?php
                        $posttags = get_the_tags();
                        if($posttags){ ?>
                            <strong><?php _e('Tags', 'tkingdom'); ?></strong>
                          <?php foreach($posttags as $tag) {
                              echo '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a>'; 
                            }
                        }
                    ?>
                  </li>
                </ul>
              </div>
              <?php if($social_share != 'yes'){ ?>
                <!-- POST SHARE -->
                <div class="share block">
                  <strong><?php _e('Share This', 'tkingdom'); ?></strong>
                  <?php get_template_part('/templates/parts/entry', 'social'); ?>
                </div>
              <?php } ?>
              <!-- POST NAV -->
              <div class="post-nav block">
                <nav>
                  <!-- PREVIOUS POST -->
                  <?php $prev_post = get_previous_post();
                      if (!empty( $prev_post )): ?>
                        <a class="prev-post" href="<?php echo get_permalink( $prev_post->ID ); ?>">
                          <i class="icon-prev"></i>
                          <h2><?php echo $prev_post->post_title; ?></h2>
                        </a>
                  <?php endif; ?>
                  <!-- NEXT POST -->
                  <?php $next_post = get_next_post();
                      if(!empty( $next_post )): ?>
                        <a class="next-post" href="<?php echo get_permalink( $next_post->ID ); ?>">
                          <h2><?php echo $next_post->post_title; ?></h2>
                          <i class="icon-next"></i>
                        </a>
                  <?php endif; ?>
                </nav>
              </div>
              <!-- POST COMMENTS -->
              <?php if(comments_open()): ?>
                      <div class="comments-area block" id="comments">
                        <?php comments_template(); ?>
                      </div><!-- comments-area -->
              <?php endif; ?>
            </section>
          </article>
        </div>

            <?php if($sidebar_position != 'fullwidth'): ?>
            <?php
                $position = 'Right';
                if($sidebar_position == 'left'){ $position = 'Left'; }
                    tk_get_sidebar($position, $sidebar_selected);
            ?>
            <?php endif; ?>
          </div><!-- row -->
          <?php if(comments_open()): ?></div><?php endif; ?>
      </div><!-- single-post -->
    </div><!-- #main-wrapper -->
<?php
  get_footer();
?>