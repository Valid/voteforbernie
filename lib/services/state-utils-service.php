<?php
namespace VoteForBernie\Wordpress\Services;

class StateUtilsService {
  const DEFAULT_STATUS_CLASS = 'other';

  public $states;
  protected static $statusClasses = array(
    'open' => 'open',
    'closed' => 'closed',
    'semi-closed' => 'other',
    'semi-open' => 'other',
    'caucuses' => 'caucus'
  );
  protected static $explanations = array(
    'open' => 'Explanation Open',
    'closed' => 'Explanation Closed',
    'semi-closed' => 'Explanation SemiClosed',
    'semi-open' => 'Explanation SemiOpen'
  );
  protected static $actions = array(
    'open' => 'Action Open',
    'closed' => 'Action Closed',
    'semi-closed' => 'Action SemiClosed',
    'semi-open' => 'Action SemiOpen'
  );

  private function loadStateField($postID) {
    $stateField = get_field_object('state');
    $this->states = $stateField['choices'];
  }

  public function getStateName ($state) {
    // lazy load due to context dependency on a postID
    // As this is a shared and injected service, we cannot instantiate with the context
    if (empty($this->states)) {
      $this->loadStateField($state->post->ID);
    }
    return $this->states[$state->stateCode];
  }

  public function getStatusClass($state) {
    if ($state->type == 'caucuses') {
      return 'caucus';
    } else if (isset(self::$statusClasses[$state->status])) {
      return self::$statusClasses[$state->status];
    } else {
      return self::DEFAULT_STATUS_CLASS;
    }
  }

  public function getExplanationText($state) {
    if ($state->hasSpecialExplanation()) {
      return $state->special_explanation;
    } else if ($this->hasStatusExplanation($state)) {
      return self::$explanations[$state->status];
    } else {
      return '';
    }
  }

  public function getActionText($state) {
    if ($this->hasActionText($state)) {
      return self::$actions[$state->status];
    } else {
      return '';
    }
  }

  public function hasStatusExplanation($state) {
    return isset(self::$explanations[$state->status]);
  }

  public function hasActionText($state) {
    return isset(self::$actions[$state->status]);
  }

  public function getTypeText($state) {
    return $state->type;
  }

  public function getDeadlineText($state) {

  }
}
