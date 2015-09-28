<?php
namespace VoteForBernie\Wordpress\Helpers;

class VoteInfoHelper {
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
    'open' => 'You can vote for Bernie Sanders regardless of registered party.',
    'closed' => 'If you are <strong>not</strong> registered as a democrat, you <strong>cannot</strong> vote for Bernie Sanders.',
    'semi-closed' => 'If you are <strong>not</strong> registered as a democrat or undeclared, you <strong>cannot</strong> vote for Bernie Sanders.',
    'semi-open' => 'If you are registered as a republican, you <strong>cannot</strong> vote for Bernie Sanders.'
  );
  protected static $actions = array(
    'open' => 'Just register to vote!',
    'closed' => 'Register as a democrat',
    'semi-closed' => 'Register as a democrat or undeclared',
    'semi-open' => 'Register as a democrat or undeclared'
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
      return 'caucus '. self::$statusClasses[$state->status] . '-caucus';
    } else if (isset(self::$statusClasses[$state->status])) {
      return self::$statusClasses[$state->status];
    } else {
      return self::DEFAULT_STATUS_CLASS;
    }
  }

  public function getExplanationText($state) {
    $explanationText = '';
    if ($state->hasExtraExplanation()) {
      $explanationText = $state->extra_explanation . ' ';
    }

    if ($state->hasSpecialExplanation()) {
      $explanationText .= $state->special_explanation;
    } else if ($this->hasStatusExplanation($state)) {
      $explanationText .= self::$explanations[$state->status];
    }
    return $explanationText;
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
}
