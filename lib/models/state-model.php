<?php
namespace VoteForBernie\Wordpress\Models;

class StateModel extends PostModel {
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

  public function __construct ($post) {
    parent::__construct($post, self::$customFields);
  }
}
