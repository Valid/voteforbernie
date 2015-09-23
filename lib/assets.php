<?php
namespace VoteForBernie\Wordpress\Assets;

function assets() {
  wp_enqueue_script('vfb_vendor', get_template_directory_uri() . '/dist/vendor.js', array('jquery'), null, true);
  wp_enqueue_script('vfb_scripts', get_template_directory_uri() . '/dist/site.js', array('vfb_vendor'), null, true);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);
