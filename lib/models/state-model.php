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
    'state_link',
    'state_phone',
    'check_registration_link',
    "register_link",
    'primary_date',
    'deadline_reference',
    'deadline_date',
    'aff_deadline_date',
    'deadline_note',
    'early_voting_type',
    'absentee_ballot_link',
    'absentee_app_deadline',
    'absentee_postmark_deadline',
    'absentee_note',
    'under_18',
    'registration_not_required',
    'discussion_link'
  );

  public function __construct ($post) {
    parent::__construct($post, self::$customFields);
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

  public function hasAbsenteeVoting() {
    return !empty($this->absentee_app_deadline);
  }

  public function hasEarlyVoting() {
    return $this->early_voting_type !== 'None';
  }

  public function hasAffiliationDeadline() {
    return !empty($this->aff_deadline_date);
  }
}
