<?php function my_comments_callback( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    ?>    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    	 <div class="media comment-author"> 
    	 	<a class="media-left pull-left flip" href="#">
    	 <!-- 	comment author image -->

    	 <img class="img-thumbnail" src="images/blog/comment2.jpg" alt="">
    	 	<?php /*echo get_avatar( get_comment_author_email(), 32, $default_avatar );*/?> 
    	 </a>
	          <div class="media-body">
	            <h5 class="media-heading comment-heading"><b><?php comment_author();?></b>  says:</h5>
	            <div class="comment-date"><?php echo get_comment_date();?></div>
	            <p><?php comment_text(); ?></p>

	            <!-- Add additional class to the comment replay link -->
		        <?php 
		        $myclass = 'replay-icon pull-right text-theme-colored';
		        echo preg_replace( '/comment-reply-link/', 'comment-reply-link ' . $myclass, 
	        	get_comment_reply_link(array_merge( $args, array(
	        	'reply_text' =>__( '<i class="fa fa-commenting-o text-theme-colored"></i>Reply'),
	            'add_below' => $add_below, 
	            'depth' => $depth, 
	            'max_depth' => $args['max_depth']))), 1 );  
		         ?>
	        </div>
    	</li>
<?php } ?>

<style type="text/css">
/*********************Comment form customizations*************/
ul.comment-list >li.comment{
 
    background: #f7f8fa;;
    border: 3px solid #ddd;
    -moz-border-radius: 3px;
    border-radius: 3px;
    margin: 0 0 1.625em;
    padding: 1.625em;
    position: relative;
}
ul.children >li.comment{
 
    background: #f7f8fa;;
    border: 3px solid #ddd;
    -moz-border-radius: 3px;
    border-radius: 3px;
    margin: 0 0 1.625em;
    padding: 1.625em;
    position: relative;
}
label {
    display: none;
}
</style>
      <div class="comments-area">
        <h5 class="comments-title">Comments</h5>
        <?php if ( have_comments() ) : ?>
        <ul class="comment-list">
          <!-- list all comments -->
          	<?php wp_list_comments( array( 'callback' => 'my_comments_callback' ) );?>
          <!-- ends list all comments -->
        </ul>
    	<?php endif; ?>

      </div>


      <div class="comment-box">
        <div class="row">
          <div class="col-sm-12">
            <h5>Leave a Comment</h5>
            <div class="row">
 <?php
 ########## Overwrite the default comment form if user not loged in############
 if(!is_user_logged_in()){
 //Unset remove the default textarea from default comment form
 function wpsites_modify_comment_form_text_area($arg) {
    $arg['comment_field'] = '';
    return $arg;
}
add_filter('comment_form_defaults', 'wpsites_modify_comment_form_text_area');
add_filter('comment_form_defaults', 'wpsites_modify_comment_form_text_area');
  $commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
//change div and classes according to your theme
$fields =  array(
    'author' => '<div class="col-sm-6 pt-0 pb-0">
                  <div class="form-group">'.
        '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . 'placeholder="Enter Name*" required="required"/></div>',
    'email'  => '<div class="form-group">'.
        '<input class="form-control" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="Enter Email*" required="required"/></div>',
    'url'    => '<div class="form-group">' .
        '<input class="form-control" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="Enter Website*" /></div></div>',
     'comment_field'        => '<div class="col-sm-6">
                   <div class="form-group"> <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea></div></div>'
);
$comments_args = array(
    'fields' =>  $fields,
    'title_reply'=>'Please give us your valuable comment',
    'label_submit' => 'Send My Comment',
    'submit_button' => '<div class="col-sm-12">
                            <div class="form-group">
            <input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />
        </div></div>'
);
}
####################### Overwrite the default comment form ###################
?>
<?php comment_form($comments_args); ?>

    </div>
  </div>
</div>
</div>