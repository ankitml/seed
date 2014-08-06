<?php 
  get_header();

  $sidebar_position = get_theme_option(wp_get_theme()->name . '_general_archive_sidebar');

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
                  <div class="home">
                    <div class="row">
                      <div class="<?php echo $cols_main; ?> <?php echo $position_content; ?> main-content" id="main-content">

                            <?php
                                  if(have_posts()):
                                      while (have_posts()): the_post(); ?>
                                        <?php if(get_post_format()) {
                                                $post_format = get_post_format();
                                            } else {
                                                $post_format = 'standard';
                                            }
                                        ?>
                                        <?php $class = ''; if($post_format == 'link'){ $class = 'link'; } if($post_format == 'quote'){ $class = 'quote'; } ?>
                                        <article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
                                            <?php  $check_image_single = get_the_post_thumbnail();
                                              if(!empty($check_image_single) && ($post_format != 'link' && $post_format != 'quote' && $post_format != 'video')){ ?>
                                                  <a href="<?php echo get_permalink($post->ID); ?>">
                                                    <figure class="featured-image">
                                                      <?php the_post_thumbnail('single'); ?>
                                                    </figure>
                                                  </a>
                                            <?php } ?>
                                            <?php get_template_part('/templates/parts/format', $post_format); ?>
                                        </article>
                                <?php endwhile;
                                  endif;
                            ?>
                                <?php if($wp_query->max_num_pages > 1){ ?>
                                  <nav class="pagination">
                                    <?php next_posts_link(__('Older Posts <i class="icon-load"></i>', 'tkingdom'), 0); ?>
                                  </nav>
                                  <div id="loading-is"></div>
                                <?php } ?>
                        </div>
                            <?php if($sidebar_position != 'fullwidth'): ?>
                                    <?php
                                        $position = 'Right';
                                        if($sidebar_position == 'left'){ $position = 'Left'; }
                                            tk_get_sidebar($position, 'Archive/Default');
                                    ?>
                            <?php endif; ?>
                      </div><!-- row -->
                  </div><!-- home -->
               </div><!-- #main-wrapper -->

<?php get_footer(); ?>