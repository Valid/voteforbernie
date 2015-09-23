<?php

namespace VoteForBernie\Wordpress\Init;
use VoteForBernie\Wordpress\Models\StateModel;

function custom_posts() {
  register_post_type(StateModel::POST_TYPE, array(
    'labels' => array(
      'name' => 'States',
      'singular_name' => 'State'
    ),
    'rewrite' => array('slug' => 'state', 'with_front' => false),
    'public' => true
  ));
}
add_action('init', __NAMESPACE__ . '\\custom_posts');
