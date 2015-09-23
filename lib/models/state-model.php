<?php
namespace VoteForBernie\Wordpress\Models;

class StateModel extends PostModel {
  const POST_TYPE = 'state';
  public static $customFields = array(
    'state',
    'denonym',
    'type',
    'status',
    'special_explanation',
    'exrtra_explanation',
    'additional_note',
    'vote_link',
    'primary_date',
    'deadline_reference',
    'deadline_date',
    'check_registration_link',
    'under_18',
    'registration_not_required',
    'discussion_link'
  );
  private $stateUtils;

  public function __construct ($post, $stateUtils) {
    parent::__construct($post, self::$customFields);
    $this->stateUtils = $stateUtils;
  }

  public function getStatusClass() {
    return $this->stateUtils->getStatusClass($this);
  }

  public function getExplanationText() {
    $explanationText = $this->stateUtils->getExplanationText($this);
    if ($this->hasExtraExplanation()) {
      $explanationText = $this->exrtra_explanation . ' ' . $explanationText;
    }
    return $explanationText;
  }

  public function getActionText() {
    return $this->stateUtils->getActionText($this);
  }

  public function getTypeText() {
    return $this->type === 'cacuses' ? 'Caucus' : 'Primary';
  }

  public function getPrimaryDate() {
    if (!empty($this->primary_date)) {
      return $this->primary_date;
    } else {
      return 'TBD';
    }
  }

  public function hasSpecialExplanation() {
    return !empty($this->special_explanation);
  }

  public function hasExtraExplanation() {
    return !empty($this->extra_explanation);
  }

  public function hasAdditionalNote() {
    return !empty($this->additional_note);
  }

  public function hasDeadlineDate() {
    return !empty($this->deadline_date);
  }
}
