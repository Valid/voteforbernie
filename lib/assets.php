<?php
namespace VoteForBernie\Wordpress\Assets;

function assets() {
  $vendorJs = WP_LOCAL_SERVER ? 'vendor.js' : 'vendor.min.js';
  $siteJs = WP_LOCAL_SERVER ? 'site.js' : 'site.min.js';
  $vendorCss = WP_LOCAL_SERVER ? 'vendor.css' : 'vendor.min.css';
  $siteCss = WP_LOCAL_SERVER ? 'style.css' : 'style.min.css';

  wp_enqueue_script('vfb_vendor_js', get_template_directory_uri() . "/dist/$vendorJs", array('jquery'), null, true);
  wp_enqueue_style('vfb_vendor_css', get_template_directory_uri() . "/dist/$vendorCss");
  wp_enqueue_script('vfb_site_js', get_template_directory_uri() . "/dist/$siteJs", array('vfb_vendor_js'), null, true);
  wp_enqueue_style('vfb_site_css', get_template_directory_uri() . "/dist/$siteCss");
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);

function replace_jquery() {
  if (!is_admin()) {
    // comment out the next two lines to load the local copy of jQuery
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-2.1.4.min.js', false, '2.1.4');
    wp_enqueue_script('jquery');
  }
}

add_action('init', __NAMESPACE__ . '\\replace_jquery');
