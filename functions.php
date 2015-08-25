<?php
function firstTheme(){ // add style file into the theme;
  wp_enqueue_style('style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'firstTheme');


// Get top ancestor id

function get_top_ancestor_id(){
  global $post;
  if($post->post_parent){
    $ancestors = array_reverse(get_post_ancestors($post->ID));
      return $ancestors[0];
  }
  return $post->ID;
}

// check page has children
function has_children(){
  global $post;
  $pages = get_pages('child_of=' .$post->ID);
    return count($pages);
}

//customize excerpt
function custom_excerpt_length(){
  return 30;
}
add_filter('excerpt_length', 'custom_excerpt_length'); // add a hook


//theme setup, add features to theme;
function WP_theme_setup(){
  // Navigation Menus (to register menus locations);
  // then we can control from WP admin;
  register_nav_menus(array(
    'primary' => __('Primary Menu'),
    'footer' => __('Footer Menu'),
  ));

  // add feature image support
  add_theme_support('post-thumbnails');
  add_image_size('small-thumbnail', 180, 120, true); // set feature image size;
  add_image_size('banner-image', 920, 210, array('left', 'top')); // set feature image size;
}
add_action('after_setup_theme', 'WP_theme_setup');


 ?>