<?php
namespace VoteForBernie\Wordpress\Models;

class StateModel extends PostModel {
  const POST_TYPE = 'state';
  public static $customFields = array(
    'state',
    'denonym',
    'type',
    'status',
    'campaign_special_need',
    'special_explanation',
    'exrtra_explanation',
    'additional_note',
    'state_link',
    'state_phone',
    'check_registration_link',
    'register_link',
    'online_reg',
    'primary_date',
    'deadline_date',
    'deadline_note',
    'aff_deadline_date',
    'early_voting_start',
    'early_voting_end',
    'absentee_app_deadline',
    'absentee_postmark_deadline',
    'absentee_excuse_required',
    'overseas_app_deadline',
    'overseas_postmark_deadline',
    'under_18',
    'discussion_link'
  );

  public function __construct ($post) {
    parent::__construct($post, self::$customFields);
  }

  public function getTypeText() {
    return $this->type === 'caucuses' ? 'Caucus' : 'Primary';
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

  public function absenteeExcuseRequired() {
    return !empty($this->absentee_excuse_required);
  }

  public function hasEarlyVoting() {
    return !empty($this->early_voting_end);
  }

  public function hasAffiliationDeadline() {
    return !empty($this->aff_deadline_date);
  }

  public function hasCampaignNeed() {
    return !empty($this->campaign_special_need);
  }
}
