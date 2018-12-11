<?php
// include('walker.php');
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 1200, 9999 );

add_action( 'after_setup_theme', 'woocommerce_support' );

function woocommerce_support() {

add_theme_support( 'woocommerce' );

}
/**
 * Menu Name Main Menu
 */
function create_menu(){
    register_nav_menu('primary','Main Menu');
    register_nav_menu('secondary','Footer Menu');
}
add_action('init','create_menu');
/**
 * Register Post Type blog
 */
add_action( 'init', 'codex_blog_init' );
function codex_blog_init() {
    $labels = array(
        'name'               => _x( 'Blogs', 'post type general name', 'your-plugin-textdomain' ),
        'singular_name'      => _x( 'Blog', 'post type singular name', 'your-plugin-textdomain' ),
        'add_new'            => 'Add Blog',
        'all_items'          => 'All Blog',
        'edit_item'          =>'Edit Blog',
    );
    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Description.', 'your-plugin-textdomain' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'blog' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'comments' )
    );
    register_post_type( 'blog', $args );
}
/**
 * Register taxonomy Type category
 */
add_action( 'init', 'create_category_taxonomy' );
function create_category_taxonomy() {
    register_taxonomy(
        'blog_cat',
        'blog',
        array(
            'label' => 'Category',
            'hierarchical' => true,
        )
    );
}

/*generate acf option page*/

if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Header Settings',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'theme-general-settings',
    ));    
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Contact Settings',
        'menu_title'    => 'Contact',
        'parent_slug'   => 'theme-general-settings',
    ));   
     acf_add_options_sub_page(array(
        'page_title'    => 'Theme Contact Settings',
        'menu_title'    => 'Home',
        'parent_slug'   => 'theme-general-settings',
    ));
    
}


/* 
---------------cpt loop---------------------
        <?php 
        global $post;
            $args = array( 
                'posts_per_page'  =>   -1 ,
                'orderby'         => 'date',
                'order'           => 'DESC',
                'post_type'       => 'cpt',
                'post_status'     => 'publish'
            );
            $the_query = new WP_Query( $args );
            while ( $the_query->have_posts() ) :
            $the_query->the_post();
            $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
        ?>

        <?php endwhile; ?>
---------------ACF repeater loop---------------
        <?php 
        global $post;
        $i=1;
        if( have_rows('slider') ): 
          while( have_rows('slider') ): the_row(); 
          $image = get_sub_field('slider_image');
          $title = get_sub_field('slider_title');
          $subtitle = get_sub_field('subtitle');
          $content1 = get_sub_field('slider_contetn1');
          $content2 = get_sub_field('slider_content2');
          $link = get_sub_field('link_button');
          $link1 = get_sub_field('link_button1');
          ?>

        <?php $i++ ;endwhile; endif;?> 
------------------Show nav menu--------------                
        <?php
        $args = array(
        'menu' => 'primary',
        'menu_class' => 'fp-nav-list-wrap',
        'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
        'walker' => new wp_bootstrap_navwalker()
        );
        wp_nav_menu($args);
        ?>

*/