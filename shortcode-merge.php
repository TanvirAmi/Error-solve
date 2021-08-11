 function wallboxbanner(){

		global $post;

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

		ob_start(); ?>

		<section id="infoboxen-two">
    		<div class="anondi-infobox2">
      			<div class="box1">
        		<div class="ribbon">
            		<span>bis zu <b>30%</b> sparen</span>
        		</div><a href="https://www.garage-und-carport.de/ausstattung-und-zubehoer/ladestation/wallboxen-angebote-vergleichen/"><img src="/wp-content/uploads/images/ladestationen-wallbox-tiefgarage-wellnhofer-designs-adobestock-300x300.jpg" alt="" titel=""></a></div>
     		 <div class="box2 left" style="background-color:#E16424;">
        <h4 class="not-active">Angebote für Wallboxen<br />
    	E-Auto zu Hause laden</h4>
        <div class="button-inner">
          <a href="https://www.garage-und-carport.de/ausstattung-und-zubehoer/ladestation/wallboxen-angebote-vergleichen/"><button>Jetzt vergleichen</button></a>
        </div>
      </div>
	      <div class="box3" style="background-color:#C9CECE;">
	        <div class="box3-inner">Unverbindlich</div>
	        <div class="box3-inner">Qualifizierte Anbieter</div>
	        <div class="box3-inner">Kostenlos</div>
	      </div>
		  </div>
	   </section>
	   <?php
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
add_shortcode('wallboxbanner', 'wallboxbanner');
