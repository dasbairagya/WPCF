 <div class="card">
            <div class="card-body">
                <h3 class="card-title">Categories</h3>
			    <ul class="list-group list-group-flush">

			    	<?php $terms = get_terms(array('taxonomy'=>'blog-cat','hide_empty'=>false));
			    	foreach ($terms as $term): ?>
		        	<li class="list-group-item"><a href="<?php echo site_url('blogs')?>?cid=<?php echo $term->term_id;?>"><?php echo $term->name; ?></a><span class="float-right">(<?php echo $term->count;?>)</span></li>
		        	<?php endforeach ?>

			    </ul>

            </div>
        </div>
        <div class="pt-3"></div>

        <div class="card">
            <div class="card-body">
                <h3 class="card-title"> Recent Posts</h3>
			    <!-- Fluid width widget -->        
    	    
                    <ul class="media-list">
						<?php 
                    	$popularpost = new WP_Query( array( 'post_type'=>'blog', 'posts_per_page' => 5, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
						while ( $popularpost->have_posts() ) : $popularpost->the_post(); 
						$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
						?>
                        <li class="media">
                            <div class="media-left">
                            	<?php the_post_thumbnail( array(100, 100) ); ?>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <?php the_title();?>                                  
                                </h4>
                                <p> <?php echo substr(get_the_excerpt(), 0, 110); ?> </p>
                            </div>
                        </li>
                         <?php endwhile; ?>
                    </ul>
    
               
            <!-- End fluid width widget --> 

            </div>
        </div>
        <div class="pt-3"></div>
         <div class="card">
            <div class="card-body">
                <h3 class="card-title">Recent Comments</h3>
			   <!-- Begin fluid width widget -->
           
                    <ul class="media-list">
                    <?php 
					$args = array (
					'status' => 'approve',
					'number' => '5'
					);
					$comments = get_comments( $args );
					if ( !empty( $comments ) ) :
					echo '<ul>';
					foreach( $comments as $comment ) :
					echo '<li class="media"><div class="media-body"> <h5 class="media-heading"> » <a href="' . get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID . '">' . $comment->comment_author . ' on ' . get_the_title( $comment->comment_post_ID ) . '</a></h5></div></li>';
					endforeach;
					echo '</ul>';
					endif;?>
                    


                       <!--  <li class="media">
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="#" class="text-info">
                                        Nulla Vitae
                                    </a>
                                </h4>
                                <p class="margin-top-10 margin-bottom-20">
                                    Pellentesque id nulla vitae nisl mollis hendrerit a non nisi. Cras ac velit elit. Fusce nulla odio, iaculis...
                                </p>
                            </div>
                        </li> -->
                        
                    </ul>
                    
              

            </div>
        </div>