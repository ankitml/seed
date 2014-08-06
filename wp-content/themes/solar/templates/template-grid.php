<?php

	/* Template Name: Grid */
	get_header();

    $prefix = 'tk_';
    $sidebar_selected = get_post_meta($post->ID, $prefix.'sidebar', true);
    $sidebar_position = get_post_meta($post->ID, $prefix.'sidebar_position', true);

    $sidebar = 'full';
    $position_content = '';
    $cols_main = 'col-md-12';
    $cols_post = 'col-md-4';

    if($sidebar_position != 'fullwidth'){
    	$sidebar = 'sidebar';
    	$cols_main = 'col-md-8';
    	$cols_post = 'col-md-6';
		if($sidebar_position == 'left'){ $position_content = 'pull-right'; }
    }
?>
<div id="main-wrapper" class="container">
  <div class="home grid <?php echo $sidebar; ?>">
      <div class="row">
        <div class="<?php echo $cols_main; ?> main-content <?php echo $position_content; ?>">
          <div class="row grid-wrapper">
			<?php

				if(get_query_var('paged')){ $paged = get_query_var('paged'); }
				elseif(get_query_var('page')){ $paged = get_query_var('page'); }
				else{ $paged = 1; }

				$temp = $wp_query;
				$wp_query = null;

        $posts_per_page = get_option('posts_per_page');

				$wp_query = new WP_Query(array('posts_per_page' => $posts_per_page, 'post_status' => 'publish', 'paged' => $paged));
					while($wp_query->have_posts()):
						$wp_query->the_post(); 

						if(get_post_format()){
						  $post_format = get_post_format();
						}else{
						  $post_format = 'standard';
						}

                        /* Don't show sticky post in pagination */
                        $show = true;
                        $sticky = get_option('sticky_posts');
                        if(($paged > 1) && (in_array($post->ID, $sticky))){
                          	$show = false;
                        }

						if($show){ ?>
							<article class="post <?php echo $cols_post; ?> col-sm-6 <?php if($post_format == 'link'){echo 'link'; } if($post_format == 'quote'){echo 'quote'; } ?>" <?php if($post_format == 'link'){ if(!empty($thumbnail_src)){ ?> style="background: url('<?php echo $thumbnail_src[0]; ?>') !important;"; <?php } }  ?>>
								<?php  $check_image_single = get_the_post_thumbnail();
                        if(!empty($check_image_single) && ($post_format != 'link' && $post_format != 'quote' && $post_format != 'video')){ ?>
                              <a href="<?php echo get_permalink($post->ID); ?>">
                                <figure class="featured-image">
                                  <?php the_post_thumbnail('grid'); ?>
                                </figure>
                              </a>
	              <?php } ?>
								<?php get_template_part('/templates/parts/format', $post_format); ?>
							</article>
				  <?php } ?>
			  <?php endwhile; ?>
          </div><!-- row -->
          <?php if($wp_query->max_num_pages > 1){ ?>
		          <nav class="pagination">
		            <?php next_posts_link(__('Older Posts <i class="icon-load"></i>', 'tkingdom'), 0); ?>
		          </nav>
          		  <div id="loading-is"></div>
          <?php } ?>
          <?php 
      		$wp_query = null;
      		$wp_query = $temp; 
          ?>
        </div><!-- /main-content -->
        <?php if($sidebar_position != 'fullwidth'): ?>
          <?php
          	  $position = 'Right';
              if($sidebar_position == 'left'){ $position = 'Left'; }
                  tk_get_sidebar($position, $sidebar_selected);
          ?>
        <?php endif; ?>
      </div><!-- row -->
  </div><!-- home -->
</div><!-- #main-wrapper -->

<?php get_footer(); ?>