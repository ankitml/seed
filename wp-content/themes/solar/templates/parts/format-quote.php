<?php
	
	/* Quote Post Format */
	$quote_text = get_post_meta($post->ID, 'tk_quote', true);
	$quote_author = get_post_meta($post->ID, 'tk_quote_author', true);

	$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "quote-link" );
?>

<?php if(is_single()){ //If is single post ?>
      <section>
        <blockquote <?php if(!empty($thumbnail_src)){ ?> style="background-image: url('<?php echo $thumbnail_src[0]; ?>');" <?php } ?> >
            <span><?php echo $quote_text; ?></span>
            <small><?php echo $quote_author; ?></small>
      	</blockquote>
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
            <blockquote <?php if(!empty($thumbnail_src)){ ?> style="background-image: url('<?php echo $thumbnail_src[0]; ?>');" <?php } ?> >
              <span><?php echo $quote_text; ?></span>
              <small><?php echo $quote_author; ?></small>
            </blockquote>
          </div>
        </section>
<?php } ?>