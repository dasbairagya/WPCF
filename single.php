<?php 
/*Template Name: Blog*/
get_header(); ?>
<img src="<?php echo get_field('banner_image','option');?>"> 
<style type="text/css">
  .card{
    border: 1px solid rgba(0,0,0,.125);
    box-shadow: 5px 5px 10px #ececec;
    margin-bottom: 10px;
  }
  .card-img-top {
    height: 450px;
    padding-bottom: 22px;
}
</style>
<div class="clearfix">
</div>
<div class="pt-5">
</div>
<div class="container">
  <div class="row">
    <div class="col-sm-8">
      <?php 
if ( have_posts() ) : 
while (have_posts() ) :
the_post();
$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
wpb_set_post_views($post->ID);
?>            
      <div class="card">
        <div class="card-body">
          <img class="card-img-top" src="<?php echo $url;?>" alt="Card image cap">
          <h3 class="card-title">
            <?php the_title();?>
          </h3>
          <p class="card-text">
            <?php echo substr(get_the_excerpt(), 0, 110); ?>
          </p>
            <?php if ( comments_open() || get_comments_number() ) :
                comments_template();
                endif; 
                ?>
        </div>

      </div>
      <?php endwhile; endif; ?>
    </div>
    <div class="col-sm-4">
      <?php get_sidebar();?>
    </div>
  </div>
</div>
<div class="pt-5">
</div>
<?php get_footer();?>
