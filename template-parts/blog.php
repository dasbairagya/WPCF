<?php /*Template Name: Blog*/
get_header(); ?>
 <img src="<?php echo get_field('banner_image','option');?>"> 
 <style type="text/css">
    .card{border: 1px solid rgba(0,0,0,.125);box-shadow: 5px 5px 10px #ececec; margin-bottom: 10px;}
    .card-img-top {padding-bottom: 22px;}
 </style>
<div class="clearfix"></div>
<div class="pt-5"></div>
    <!-- Page Content -->
    <div class="container">

<div class="row">
    <!--Panel-->
    <div class="col-sm-8">
        <div class="row">
            
        <?php 
        global $post;
        /**
         * Custom Slug Name blog
         */
        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) { // 'page' is used instead of 'paged' on Static Front Page
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }
        if($_GET['cid']!=null && $_GET['cid']!=''){
            $term_id = $_GET['cid'];
             $args = array( 
                'posts_per_page'  =>   -1 ,
                'orderby'         => 'date',
                'order'           => 'DESC',
                'post_type'       => 'blog',
                'post_status'     => 'publish',
                'posts_per_page' => 2,
                'paged' => $paged,  //very important
                'tax_query' => array(
                            array(
                            'taxonomy' => 'blog-cat',
                            'field' => 'id',
                            'terms' => $term_id
                             )
                          ),
            );
        }
        else{
             $args = array( 
                'posts_per_page'  =>   -1 ,
                'orderby'         => 'date',
                'order'           => 'DESC',
                'post_type'       => 'blog',
                'post_status'     => 'publish',
                'posts_per_page' => 2,
                'paged' => $paged  //very important
                
            );
        }
var_dump($args);
            $custom_query = new WP_Query($args);
            if ($custom_query->have_posts()) :
            while ( $custom_query->have_posts() ) :
                $custom_query->the_post();
                $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
            ?>   
            <div class="col-md-6">         
                <div class="card">
                    <div class="card-body">
                         <img class="card-img-top" src="<?php echo $url;?>" alt="Card image cap">
                        <h3 class="card-title"><?php the_title();?></h3>
                        <p class="card-text"><?php echo substr(get_the_excerpt(), 0, 110); ?></p>
                        <a href="<?php the_permalink();?>" class="btn btn-default float-left">More »</a>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>


    <?php if ($custom_query->max_num_pages > 1) :
          $orig_query = $wp_query;
          $wp_query = $custom_query;
          ?>
          <nav class="prev-next-posts">
              <?php
              if (function_exists('wp_bootstrap_pagination'))
                  wp_bootstrap_pagination();
              ?>
          </nav>
          <?php $wp_query = $orig_query; ?>
      <?php endif;
          wp_reset_postdata();
      else:
          echo '<p>' . __('Sorry, no posts matched your criteria.') . '</p>'; //ends pagination
      endif;  //ends loop
?>
        
    </div>

    </div>

    <!--/.Panel-->

    <!--Panel-->
    <div class="col-sm-4">
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
                        <li class="media">
                            <div class="media-left">
                                <img src="http://placehold.it/60x60" class="img-circle">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    Mauris Eu
                                    <br>
                                    <small>
                                        commented on <a href="#">Post Title</a>
                                    </small>
                                </h4>
                                <p>
                                    Vivamus pulvinar mauris eu placerat blandit. In euismod tellus vel ex vestibulum congue...
                                </p>
                            </div>
                        </li>
                        <li class="media">
                            <div class="media-left">
                                <img src="http://placehold.it/60x60" class="img-circle">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    Aenean Consect
                                    <br>
                                    <small>
                                        commented on <a href="#">Post Title</a>
                                    </small>
                                </h4>
                                <p>
                                    Curabitur vel malesuada tortor, sit amet ultricies mauris. Aenean consectetur ultricies luctus.
                                </p>
                            </div>
                        </li>
                        <li class="media">
                            <div class="media-left">
                               <img src="http://placehold.it/60x60" class="img-circle">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    Praesent Tinci
                                    <br>
                                    <small>
                                        commented on <a href="#">Post Title</a>
                                    </small>
                                </h4>
                                <p>
                                    Sed convallis dignissim magna et dignissim. Praesent tincidunt sapien eu gravida dignissim.
                                </p>
                            </div>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-default btn-block">More Events »</a>
               
            <!-- End fluid width widget --> 

            </div>
        </div>
        <div class="pt-3"></div>
         <div class="card">
            <div class="card-body">
                <h3 class="card-title">Recent Comments</h3>
               <!-- Begin fluid width widget -->
           
                    <ul class="media-list">
                        <li class="media">
                            <div class="media-body">
                                <h4 class="media-heading">
                                                <a href="#" class="text-info">
                                                    Ultricies Luctus
                                                </a>
                                            </h4>
                                <p class="margin-top-10 margin-bottom-20">
                                    Ut sit amet tincidunt risus. Aenean quis tempus tortor. Pellentesque commodo malesuada augue...
                                </p>
                            </div>
                        </li>
                        <li class="media">
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
                        </li>
                        <li class="media">
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="#" class="text-info">
                                        Media Heading
                                    </a>
                                </h4>
                                <p class="margin-top-10 margin-bottom-20">
                                    Donec venenatis, orci sit amet tempor dapibus, nisi elit imperdiet ex, nec lobortis ex magna eu felis...
                                </p>
                            </div>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-default btn-block">More Blog Posts »</a>
              

            </div>
        </div>
       
    </div>
    <!--/.Panel-->
</div>


    </div>
    <div class="pt-5"></div>

    <!-- /.container -->
<?php get_footer();?>