<?php
namespace VoteForBernie\Wordpress\Services;
use VoteForBernie\Wordpress\Models\StateModel;

class StateService {

  public function getStates () {
    $states = array();
    $stateUtilService = new StateUtilsService();
    $statePosts = get_posts(array(
      'post_type' => StateModel::POST_TYPE,
      'posts_per_page' => -1,
      'order' => 'ASC'
    ));

    foreach ($statePosts as $statePost) {
      $states[] = new StateModel($statePost, $stateUtilService);
    }
    return $states;
  }
}
