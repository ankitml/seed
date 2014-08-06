<?php
/**
 * The template for displaying image attachments.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>


<div id="main-wrapper" class="container">
  <div class="single-post">
      <div class="row">
        <div class="col-md-12 main-content">

				<?php while ( have_posts() ) : the_post(); ?>

						<article class="post">
							<section>
								<div class="post-content">
									
											<?php
												$metadata = wp_get_attachment_metadata();
												printf( __( '<h5><span class="meta-prep meta-prep-entry-date">Published </span> <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a>.', 'twentytwelve' ),
													esc_attr( get_the_date( 'c' ) ),
													esc_html( get_the_date() ),
													esc_url( wp_get_attachment_url() ),
													$metadata['width'],
													$metadata['height'],
													esc_url( get_permalink( $post->post_parent ) ),
													esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
													get_the_title( $post->post_parent )
												);
											?>
											<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span></h5>' ); ?>
								</div>
							</section>
						</article>
						<article class="post">
							<section>
				                    <nav id="image-navigation" class="navigation image-navigation" role="navigation">
				                        <span class="nav-previous"><?php previous_image_link( false, __( '<span class="meta-nav">&larr;</span> Previous', 'twentythirteen' ) ); ?></span>
				                        <span class="nav-next"><?php next_image_link( false, __( 'Next <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?></span>
				                    </nav><!-- #image-navigation -->
				                    
										<figure class="featured-image">
											<?php
											/**
											 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
											 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
											 */
											$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
											foreach ( $attachments as $k => $attachment ) :
												if ( $attachment->ID == $post->ID )
													break;
											endforeach;

											$k++;
											// If there is more than 1 attachment in a gallery
											if ( count( $attachments ) > 1 ) :
												if ( isset( $attachments[ $k ] ) ) :
													// get the URL of the next image attachment
													$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
												else :
													// or get the URL of the first image attachment
													$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
												endif;
											else :
												// or, if there's only 1 image, get the URL of the image
												$next_attachment_url = wp_get_attachment_url();
											endif;
											?>
										<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
											<?php
												echo wp_get_attachment_image( $post->ID, 'full-width-image' );
											?>
										</a>
										<?php if ( ! empty( $post->post_excerpt ) ) : ?>
										<div class="entry-caption">
											<?php the_excerpt(); ?>
										</div>
										<?php endif; ?>
									
								</figure>

								<div class="entry-description">
									<?php the_content(); ?>
									<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
								</div><!-- .entry-description -->

						<?php if(comments_open()): ?>
		                        <div class="comments-area block" id="comments">
		                          <?php comments_template(); ?>
		                        </div><!-- comments-area -->
		                <?php endif; ?>
						</section>
						</article><!-- #post -->

					<?php endwhile; // end of the loop. ?>

			</div><!-- #primary -->
        </div><!-- container -->

    </div><!-- row-fluid -->
</div><!-- #content -->

<?php get_footer(); ?>