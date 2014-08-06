<?php

  /* Link Post Format */
  $link_url = get_post_meta($post->ID, 'tk_link_url', true);
  $link_text = get_post_meta($post->ID, 'tk_link_text', true);

  $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "quote-link" );
?>

<?php if(is_single()){ //If is single post ?>
            
            <section>
              <article class="post link" style="margin-bottom:0;" >
                <div class="post-content" <?php if(!empty($thumbnail_src)){ ?> style="background-image: url('<?php echo $thumbnail_src[0]; ?>');" <?php } ?>>
                  <a href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a>
                  <small><a href="<?php echo $link_url; ?>"><?php echo $link_url; ?></a></small>
                </div>
              </article>              
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
                    <span><i class="icon-pin"></i>Sticky</span>
                  </li>
                <?php } ?>
              </ul>
            </div>
<?php }else{ ?>
          <section>
            <div class="post-content" <?php if(!empty($thumbnail_src)){ ?> style="background-image: url('<?php echo $thumbnail_src[0]; ?>');" <?php } ?>>
              <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $link_text; ?></a>
              <small><a href="<?php echo $link_url; ?>"><?php echo $link_url; ?></a></small>
            </div>
          </section>
<?php } ?>