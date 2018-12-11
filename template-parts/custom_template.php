<?php

 /**
 * Template Name: Page Builder
 */

get_header(); ?>

<div class="ec-main-content">
	<div style="margin-top:150px;"></div>
	<div class="container">
<!-- Home Template -->

      
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			// End of the loop.
		endwhile;
		?>
	

<!-- End Home Template -->

</div>
</div>

<?php get_footer(); ?>


