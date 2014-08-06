<?php /* Standard Post Format */ ?>

<?php if(is_single()){ //If is single post ?>
      <?php
          $prefix = 'tk_';
          $sidebar_position = get_post_meta($post->ID, $prefix.'sidebar_position', true);
          $check_image_single = get_the_post_thumbnail();
          
          if(!empty($check_image_single)){ ?>
              <figure class="featured-image">
                  <?php if($sidebar_position == 'fullwidth'){ the_post_thumbnail('single-full'); } else { the_post_thumbnail('single'); } ?>
              </figure>
        <?php } ?>
      <section>
        <div class="post-content">
          <h1 class='post-title'><?php the_title(); ?></h1>
            <div class="shortcodes clearfix">
                <?php the_content(); ?>
                <?php
                wp_link_pages( array(
                  'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'tkingdom' ) . '</span>',
                  'after'       => '</div>',
                  'link_before' => '<span>',
                  'link_after'  => '</span>',
                ) );
                ?>
            </div>
            <ul class="meta">
              <li class="date">
                <time><?php echo get_the_date(); ?></time>
              </li>
              <?php if(is_sticky()){ ?>
                <li class="featured-banner">
                  <span><i class="icon-pin"></i><?php _e('Sticky', 'tkingdom'); ?></span>
                </li>
              <?php } ?>
            </ul>
        </div>
<?php }else{ ?>
        <section>
          <div class="post-content">
            <h2 class='post-title'><a href="<?php echo get_permalink($post->ID); ?>"><?php the_title(); ?></a></h2>
            <?php
            global $more;
            $more = 0;
            if($post->post_excerpt){
                the_excerpt();
            } else { ?>
                <div class="shortcodes clearfix">
                    <?php the_content('Read More...', false); ?>
                </div>
            <?php } ?>
            <ul class="meta">
              <li class="comments">
                <a href="<?php comments_link(); ?>"><i class="icon-comment"></i><span><?php echo get_comments_number(); ?></span></a>
              </li>
              <li class="date">
                <time><?php echo get_the_date(); ?></time>
              </li>
              <?php if(is_sticky()){ ?>
                <li class="featured-banner">
                  <span><i class="icon-pin"></i><?php _e('Sticky', 'tkingdom'); ?></span>
                </li>
              <?php } ?>
            </ul>
          </div>
        </section>
<?php } ?>