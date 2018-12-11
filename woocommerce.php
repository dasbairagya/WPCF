<?php get_header();?>

<style type="text/css">
.item {
    width: 18%;
    display: inline-block;
    margin-left: 19px;
}
.mb-5x{margin-bottom: 40px;}
.item-price{width: 100%;}

</style>
		<!-- Featured Brands -->
		<div class="feature-brands">
			<div class="container-fluid">
				<!-- <div class="row">
					<div class="col-md-12">
						<div class="title-box">
							<h4 class="box_header"><span>F</span> Featured Brands</h4>
							
						</div>
					</div>
				</div> -->
				<div class="row">
					<?php if( is_single() ) { ?>
					<div class="col-md-2"><?php get_sidebar();?></div>
					<div class="col-md-10 col-sm-10 col-xs-12">
						<div class="row">
							<div class="modtitle bread-crumb radius">
							<h3><span><a href="<?php echo home_url( );?>">Home</a> <span><?php the_title();?></span></span></h3>
					        </div>

				        </div>
				        <div class="mb-5x"></div>
				<?php } else{ ?>
					<div class="col-md-12 col-lg-12">
					<?php } ?>
					    	<?php if ( have_posts() ) : ?>
                                <?php woocommerce_content(); ?>
                            <?php endif; ?>
					<!-- <div class="owl-carousel product_carousel"> 				    	
							<div class="item">
								<div class="product-item custom-slide-btn">
		                            <div class="product-item-inner">
		                                <div class="product-img-wrap">
		                                    <a href="single-product.html"><img src="<?php echo get_template_directory_uri();?>/images/product-img/1.jpg" alt=""></a>
		                                </div>
		                                <div class="product-item-label label-new">
		                                    <span>New</span>
		                                </div>
		                                <div class="hot-meta">
		                                    <span>-20%</span>
		                                </div>
		                                <div class="sale-section">
		                                    <span>Sale</span>
		                                </div>
		                                <div class="product-button">
		                                    <a href="single-product.html"><i class="fa fa-shopping-bag"></i></a>
		                                    <a href="single-product.html"><i class="fa fa-heart"></i></a>
		                                    <a href="single-product.html"><i class="fa fa-eye"></i></a>
		                                </div>
		                            </div>
		                            <div class="product-detail">
		                                <h3><a href="single-product.html">United Colors of Benetton</a></h3>
		                                <h5 class="item-price">$39.00</h5>
		                                <div class="rating">
		                                     <i class="fa fa-star"></i>
		                                     <i class="fa fa-star"></i>
		                                     <i class="fa fa-star"></i>
		                                     <i class="fa fa-star-o"></i>
		                                     <i class="fa fa-star-o"></i>
		                                </div>
		                                <a href="#" class="btn-product btn-add-cart" title="Add to Bag">
                                            <i class="fa fa-shopping-cart"></i>
                                            <span>Add to Card</span>
                                        </a>
		                            </div>
		                        </div>
		                    </div>
					   </div>   -->  


					</div>    
				</div>
			</div>
	    </div>

<?php get_footer();?>