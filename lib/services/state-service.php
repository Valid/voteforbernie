<?php
namespace VoteForBernie\Wordpress\Services;
use VoteForBernie\Wordpress\Models\StateModel;

class StateService {

  public function getStates () {
    $states = array();
    $statePosts = get_posts(array(
      'post_type' => StateModel::POST_TYPE,
      'posts_per_page' => -1,
      'order' => 'ASC'
    ));

    foreach ($statePosts as $statePost) {
      $states[] = new StateModel($statePost);
    }
    return $states;
  }

  public function getStatesByDate () {
    $states = array();
    $statePosts = get_posts(array(
      'post_type' => StateModel::POST_TYPE,
      'posts_per_page' => -1,
      'meta_key' => 'primary_date',
      'orderby' => 'meta_value_num',
      'order' => 'ASC'
    ));

    foreach ($statePosts as $statePost) {
      $states[] = new StateModel($statePost);
    }
    return $states;
  }

  public function determineMostRecentUpdate ($states) {
    foreach ($states as $state) {
      if (!isset($mostRecent)) {
        $mostRecent = $state->post->post_modified;
      } elseif ($state->post->post_modified > $mostRecent) {
        $mostRecent = $state->post->post_modified;
      }
    }
    return date('F d, Y', strtotime($mostRecent));
  }
}
