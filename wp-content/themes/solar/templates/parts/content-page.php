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
            <?php
                  $check_image_single = get_the_post_thumbnail();
                  if(!empty($check_image_single)){ ?>
                      <figure class="featured-image">
                        <?php if($sidebar_position == 'fullwidth'){ the_post_thumbnail('single-full'); } else { the_post_thumbnail('single'); } ?>
                      </figure>
            <?php } ?>
            <section>
              <div class="post-content">
                <h1 class='post-title'><?php the_title(); ?></h1>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="shortcodes clearfix">
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; ?>
                <?php endif; ?>
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
  </div><!-- single-post -->
</div><!-- #main-wrapper -->
<?php
  get_footer();
?>