<?php

namespace VoteForBernie\Wordpress\Init;

function custom_posts() {
  register_post_type('state', array(
    'labels' => array(
      'name' => 'States',
      'singular_name' => 'State'
    ),
    'rewrite' => array('slug' => 'state', 'with_front' => false),
    'public' => true
  ));
}
add_action('init', __NAMESPACE__ . '\\custom_posts');
