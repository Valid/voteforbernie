<?php
namespace VoteForBernie\Wordpress\Models;

class PostModel {
  public $post;

  public function __construct ($post, $customFields = array()) {
    if (is_object($post)) {
      $this->post = $post;
    } else {
      $this->post = get_post($post);
    }
    $this->buildCustomFields();
  }

  public function getTitle() {
    return apply_filters('the_title', get_the_title($this->post->ID));
  }

  public function getPermalink() {
    return get_permalink($this->post->ID);
  }

  private function buildCustomFields($fields) {
    foreach ($fields as $fieldName) {
      $fieldValue = get_field($fieldName, $this->post->ID);
      $this[$fieldName] = $fieldValue;
    }
  }
}
