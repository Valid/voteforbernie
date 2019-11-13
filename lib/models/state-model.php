<?php

namespace VoteForBernie\Wordpress\Models;

function isValidDate($myDateString)
{
    return (bool) strtotime($myDateString);
}

class StateModel extends PostModel
{
    const POST_TYPE = 'state';
    public static $customFields = array(
    'state',
    'denonym',
    'type',
    'state_video',
    'bern_advisory_link',
    'status',
    'how_to_vote',
    'voter_id',
    'work_laws',
    'eligibility',
    'campaign_special_need',
    'special_explanation',
    'extra_explanation',
    'custom_action_text',
    'additional_note',
    'state_link',
    'state_phone',
    'dem_website',
    'dem_phone',
    'no_registration',
    'tentative',
    'check_registration_link',
    'register_link',
    'online_reg',
    'same_day_registration',
    'same_day_registration_restriction',
    'primary_date',
    'deadline_date',
    'aff_deadline_date',
    'has_early_voting',
    'early_voting_info',
    'early_voting_start',
    'early_voting_end',
    'absentee_app_deadline',
    'absentee_postmark_deadline',
    'absentee_excuse_required',
    'overseas_app_deadline',
    'overseas_postmark_deadline',
    'under_18',
    'discussion_link',
    'delegate_info',
  );

    public function __construct($post)
    {
        parent::__construct($post, self::$customFields);
    }

    public function getTypeText()
    {
        return $this->type === 'caucuses' ? 'Caucus' : 'Primary';
    }

    public function getPrimaryDate()
    {
        if (!empty($this->primary_date) && isValidDate($this->primary_date)) {
            return $this->primary_date;
        } else {
            return 'TBD';
        }
    }

    public function hasRegistrationLink()
    {
        return empty($this->register_link);
    }

    public function hasRegistration()
    {
        return empty($this->no_registration);
    }

    public function isTentative()
    {
        return !empty($this->tentative);
    }

    public function hasVideo()
    {
        return !empty($this->state_video);
    }

    public function hasCaucusLink()
    {
        return !empty($this->bern_advisory_link);
    }

    public function hasSpecialExplanation()
    {
        return !empty($this->special_explanation);
    }

    public function hasExtraExplanation()
    {
        return !empty($this->extra_explanation);
    }

    public function hasAdditionalNote()
    {
        return !empty($this->additional_note);
    }

    public function hasDeadlineDate()
    {
        return !empty($this->deadline_date) && isValidDate($this->deadline_date);
    }

    public function hasAbsenteeVoting()
    {
        return !empty($this->absentee_app_deadline);
    }

    public function absenteeExcuseRequired()
    {
        return !empty($this->absentee_excuse_required);
    }

    public function hasEarlyVoting()
    {
        return !empty($this->early_voting_info);
    }

    public function hasDelegateInfo()
    {
        return !empty($this->delegate_info);
    }

    public function hasAffiliationDeadline()
    {
        return !empty($this->aff_deadline_date) && isValidDate($this->aff_deadline_date);
    }

    public function hasCampaignNeed()
    {
        return !empty($this->campaign_special_need);
    }

    public function hasVoteHowTo()
    {
        return !empty($this->how_to_vote);
    }

    public function hasIDLaws()
    {
        return !empty($this->voter_id);
    }

    public function hasWorkLaws()
    {
        return !empty($this->work_laws);
    }

    public function hasEligibility()
    {
        return !empty($this->eligibility);
    }

    public function hasCheckRegistrationLink()
    {
        return !empty($this->check_registration_link);
    }

    public function hasOnlineRegistration()
    {
        return !empty($this->online_reg);
    }

    public function hasSameDayRegistration()
    {
        return !empty($this->same_day_registration);
    }

    public function hasSameDayRegistrationRestriction()
    {
        return !empty($this->same_day_registration_restriction);
    }
}