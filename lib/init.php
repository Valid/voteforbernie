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

function sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
}
add_action('widgets_init', __NAMESPACE__ . '\\sidebars');
