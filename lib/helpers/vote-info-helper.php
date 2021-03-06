<?php

namespace VoteForBernie\Wordpress\Helpers;

class VoteInfoHelper
{
    const DEFAULT_STATUS_CLASS = 'other';

    public $states;
    protected static $statusClasses = array(
    'open' => 'open',
    'closed' => 'closed',
    'semi-closed' => 'other',
    'semi-open' => 'other',
    'caucuses' => 'caucus',
  );
    protected static $explanations = array(
    'open' => '{$denonym} can vote for Bernie Sanders regardless of their registered party',
    'closed' => '{$denonym} <strong>must</strong> register as democrat to vote for Bernie!',
    'semi-closed' => '{$denonym} <strong>must</strong> register as democrat or undeclared to vote for Bernie!',
    'semi-open' => '{$denonym} registered as a republican <strong>cannot</strong> vote for Bernie Sanders!',
  );
    protected static $actions = array(
    'open' => 'Get registered to vote',
    'closed' => 'Register as a democrat',
    'semi-closed' => 'Register as a democrat or undeclared',
    'semi-open' => 'Register as a democrat or undeclared',
  );

    private function loadStateField($postID)
    {
        $stateField = get_field_object('state');
        $this->states = $stateField['choices'];
    }

    public function getStateName($state)
    {
        // lazy load due to context dependency on a postID
        // As this is a shared and injected service, we cannot instantiate with the context
        if (empty($this->states)) {
            $this->loadStateField($state->post->ID);
        }

        return $this->states[$state->stateCode];
    }

    public function getStateDescription($state)
    {
        $vars = array(
      '%%title%%' => $state->getTitle(),
      '%%cf_status%%' => $state->status,
      '%%cf_type%%' => $state->type,
      '%%cf_denonym%%' => $state->denonym,
    );

        return strtr(get_post_meta($state->post->ID, '_yoast_wpseo_metadesc', true), $vars);
    }

    public function getStatusClass($state)
    {
        if ($state->type == 'caucuses') {
            $extraClass = '';
            if (self::$statusClasses[$state->status] == 'other') {
                $extraClass = 'other ';
            }

            return $extraClass.self::$statusClasses[$state->status].'-caucus caucus';
        } elseif (isset(self::$statusClasses[$state->status])) {
            return self::$statusClasses[$state->status];
        } else {
            return self::DEFAULT_STATUS_CLASS;
        }
    }

    public function getExplanationText($state)
    {
        $explanationText = '';
        $denonym = $state->denonym;

        if ($state->hasSpecialExplanation()) {
            $explanationText .= $state->special_explanation;
        } elseif ($this->hasStatusExplanation($state)) {
            $explanationText .= self::$explanations[$state->status];
        }

        if ($state->hasExtraExplanation()) {
            $explanationText .= ' '.$state->extra_explanation;
        }

        return strtr($explanationText, array('{$denonym}' => $denonym));
    }

    public function getActionText($state)
    {
        if ($state->custom_action_text) {
            return $state->custom_action_text;
        } elseif ($this->hasActionText($state)) {
            return self::$actions[$state->status];
        } else {
            return '';
        }
    }

    public function getOnlineRegistrationLink($state)
    {
        if ($this->hasOnlineRegistration($state)) {
            return $state->register_link;
        } else {
            return 'http://www.rockthevote.com/register-to-vote/index.html?source=voteforbernie';
        }
    }

    public function hasOnlineRegistration($state)
    {
        return isset($state->online_reg);
    }

    public function hasStatusExplanation($state)
    {
        return isset(self::$explanations[$state->status]);
    }

    public function hasCustomText($state)
    {
        return isset($state->custom_action_text);
    }

    public function hasActionText($state)
    {
        return isset(self::$actions[$state->status]);
    }

    public function formatDate($date)
    {
        if (!empty($date)) {
            $dateObj = strtotime($date);
            $today = strtotime(date('Ymd', strtotime('now')));

            $diff = $dateObj - $today;
            $daysAway = floor($diff / 60 / 60 / 24);

            // return $daysAway;

            if ($daysAway == 0) {
                $fDate = date('D, F j', $dateObj).' <span class="now">(today!)</span>';
            } elseif ($daysAway == 1) {
                $fDate = date('D, F j', $dateObj).' <span class="now">(tomorrow!)</span>';
            } elseif ($daysAway < 0) {
                $fDate = '<span class="passed">'.$fDate = date('F j, Y', $dateObj).'</span>';
            } elseif ($daysAway < 7) {
                $fDate = date('D, F j', $dateObj).' <span class="looming">('.$daysAway.' more days!)</span>';
            } elseif ($daysAway < 30) {
                $fDate = date('D, F j', $dateObj).' <span class="near">('.$daysAway.' days away)</span>';
            } else {
                $fDate = date('F j, Y', $dateObj);
            }
        } else {
            $fDate = 'TBD';
        }

        return $fDate;
    }

    public function daysAway($date)
    {
        if (!empty($date)) {
            $dateObj = strtotime($date);
            $today = strtotime(date('Ymd', strtotime('now')));

            $diff = $dateObj - $today;
            $daysAway = floor($diff / 60 / 60 / 24);
        } else {
            $daysAway = null;
        }

        return $daysAway;
    }

    public function datePassed($date)
    {
        if (!empty($date)) {
            $dateObj = strtotime($date);
            $diff = $dateObj - strtotime('now');
            if ($diff < 0) {
                return true;
            } else {
                return false;
            }
        }
    }
}