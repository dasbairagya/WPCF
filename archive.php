<?php get_header();
global $post;
global $wpdb;
$term = get_queried_object();//get the current term
$taxonomy = $term->taxonomy;
$term_id = $term->term_id;//get the currnet term ID
$term_name = $term->name;//get the current term name
$parent_id = empty( $term_id ) ? 0 : $term_id;//get the parent id of the currnet term
$term_parent = get_term($term->parent);//get the parent term from the child term
$parent_term_link = get_term_link($term_parent);//get the parent term link
$product_categories = get_categories(array(
										'parent'       => $parent_id,
										//'menu_order'   => 'ASC',
										'hide_empty'   => 0,
										'hierarchical' => 1,
										'taxonomy'     => $taxonomy,
										'pad_counts'   => 1,
										'order'        => 'DESC',
										'orderby'      => 'name'
										)
									);
$product_categories = wp_list_filter( $product_categories );//get the sub categories of a parent category 
?>

<style type="text/css">
	.main-section{
    background-color: #f1f1f1;
    padding: 20px 20px 0px 20px;
}
.image-main-section{
    margin-bottom:20px;
}
.img-part{
    border-radius: 5px;
    margin:0px;
    border:1px solid #DDDDDD;
    background-color: #fff;
    padding-bottom: 20px;
}
.img-section{
    padding: 5px;
}
.img-section img{
    width: 100%;
}
.image-title h3{
    margin:0px;
    color:#4C4C4C;
    padding: 15px 0px 8px 0px;
}
.image-description p{
    color:#848484;
}
.add-cart-btn{
    border-radius:0px;
    font-size: 11px;
}
.img-section {
    padding: 5px;
    width: 100%;
    height: 205px; position: relative; overflow: hidden;
	background-color: rgb(240, 240, 240);
	border-width: 3px;
	border-style: solid;
	border-color: rgb(240, 240, 240);
	border-radius: 2px;
	box-shadow: rgb(139, 139, 139) 1px 1px 3px 2px;}
.img-section img { position: absolute; top: 0px; left: 0px; width: 100%; height: 100%;}
.img-part { padding-bottom: 0px; border: 0px; text-align: center;}
.image-title h3 { color: #01305e; }

@media screen and (max-width: 992px) {
	.img-section { width: 100%; height: auto;}
	.img-section img { position: inherit; width: auto; height: auto; max-width: 100%}
}
</style>
    <section class="inner-header layer-overlay overlay-dark-5" data-bg-img="<?php echo esc_url( get_template_directory_uri() ); ?>/images/bg/bg9.jpg" >

      <div class="container pt-1000 pb-1000">

        <!-- Section Content -->

        <div class="section-content">

          <div class="row" style="margin-top:100px;">

            <div class="col-md-12 text-center">
              <h2 class="title text-white"><?php echo single_term_title()?></h2>
              <ol class="breadcrumb white text-center mt-10">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                <li><a href="javascript:void(0)">Product</a></li>
                <?php if($term_parent->name!=null){ ?> 
               <li class="active text-theme-colored2"><a href="<?php echo esc_url( $parent_term_link ); ?>"><?php echo $term_parent->name; ?></a></li>
               <?php } ?>

                <li class="active text-theme-colored2"><?php echo $term->name; ?></li>
               
                           
              </ol>

            </div>

          </div>

        </div>

      </div>

    </section>


	<section id="main-container" class="main-container">

		<div class="container">

		 	<?php //var_dump($product_categories); 
		 	if($product_categories){ ?>
			<div class="row">						
		

			<?php $i = 1; $j=10;foreach ($product_categories as $category) { 
		 		$term_link = get_term_link($category->term_id, $taxonomy); 
		 		$image = get_field('image', $category);
		 		$image = empty($image) ? 'http://www.graykon.com.au/wp-content/uploads/2017/12/noimage.png':$image;
			 		?>

					<div class="col-md-3 col-sm-3 col-xs-12 image-main-section">
						<a href="<?php echo $term_link;?>">
						<div class="img-part">
							<div class="img-section">
								<img src="<?php echo $image;?>">
							</div>
						</div>

						<div class="img-part">
							<div class="image-title">
								<h3><?php echo $category->name;?></h3>
							</div>			
						</div>
					</a>
					</div>
	 					<?php $i++; $j=$j+273; } /*end foreach*/ ?>
			 
		

            </div>
		 	<?php } else { ?>
			<!-- <div style="margin-bottom: 25px;">from else condition;</div> -->
				<div class="row">	

				<?php 
				
				if (get_query_var('paged')) {
                    $paged = get_query_var('paged');
                    } elseif (get_query_var('page')) { 
                        $paged = get_query_var('page');
                    } else {
                        $paged = 1;
                    } 
                    $args = array(
						'post_type' => 'product',
						'tax_query' => array(
											array(
											'taxonomy' => $taxonomy,
											'field' => 'id',
											'terms' => $term_id
											 )
										  ),
						'numberposts' => -1,
						'posts_per_page' => 20,
						'post_status'     => 'publish',
						'post_parent' => null,
						'paged' => $paged,
						'order' => 'DESC'
						);
                  
			$i=1; $j=10;
			$custom_query = new WP_Query($args);
			//var_dump($custom_query);
			if ($custom_query->have_posts()) :
			?>

						<?php 
		    			 while ($custom_query->have_posts()) : $custom_query->the_post();
		    			 $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		    			 $product_image = empty($url) ? 'http://www.graykon.com.au/wp-content/uploads/2017/12/noimage.png':$url;	
						?>

						<div class="col-md-3 col-sm-3 col-xs-12 image-main-section">
							<a href="<?php the_permalink();?>">
							<div class="img-part">
								<div class="img-section">
									<img src="<?php echo $product_image;?>">
								</div>
							</div>


							<div class="img-part">
								<div class="image-title">
									<h3><?php echo the_title();?></h3>
								</div>			
							</div>
							</a>
						</div>

		                <?php $i++;$j = $j+273; endwhile;?>
	                
						<div class="gap-30"></div>
				          <?php if ($custom_query->max_num_pages > 1) :
				          $orig_query = $wp_query;
				          $wp_query = $custom_query;
				           
				          ?>
				        <div class="paging text-center">
				              <?php
				              if (function_exists('wp_bootstrap_pagination'))
				                  wp_bootstrap_pagination();
				              ?>
				        </div>
	          			<?php $wp_query = $orig_query; ?>
		      			<?php endif;
		          		wp_reset_postdata();
		      			else: echo '<h2 style="text-align:center">' . __('!Sorry, no products matched your criteria.') . '</h2>'; ?>

	      <?php
	      endif;  
			?>
	</div><!-- Content row 1 end -->


<?php }	?>

  </div>
</section>
<?php get_footer(); ?>
<style>
h4.texti {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 100%;
}
</style>