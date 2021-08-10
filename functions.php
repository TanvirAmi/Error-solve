// Custom shortcode for related post

function related_posts_shortcode($attributes) {
		global $post;

		// Bail if user don't want to display the related posts via theme settings.
		if ( of_get_option( 'daily_related_posts', 'on' ) != 'on' ) {
			return;
		}

		// Get the taxonomy terms of the current page for the specified taxonomy.
		$terms = wp_get_post_terms( $post->ID, 'category', array( 'fields' => 'ids' ) );

		// Bail if the term empty.
		if ( empty( $terms ) ) {
			return;
		}
		
		// Posts query arguments.
		$query = array(
			'post__not_in' => array( $post->ID ),
			'tax_query'    => array(
				array(
					'taxonomy' => 'category',
					'field'    => 'id',
					'terms'    => $terms,
					'operator' => 'IN'
				)
			),
			'posts_per_page' => 4,
			'post_type'      => 'post',
		);

		// Allow dev to filter the query.
		$args = apply_filters( 'daily_related_posts_args', $query );

		ob_start();
		// The post query
		$related = new WP_Query( $args );

		if ( $related->have_posts() ) : ?>

			<div class="related-posts">
				<h3><?php _e( 'Related Posts', 'daily' ); ?></h3>
				<ul class="clearfix">
					<?php while ( $related->have_posts() ) : $related->the_post(); ?>
						<li>
							<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'daily-widget-thumb-big', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
								<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
							</a>
						</li>
					<?php endwhile; ?>
				</ul>
			</div>
		
		<?php endif;

		// Restore original Post Data.
		wp_reset_postdata();
  
		$output = ob_get_clean();
  	return $output;
}

add_shortcode('rel_post','related_posts_shortcode');
