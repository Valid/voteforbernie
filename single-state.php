<?php
  use VoteForBernie\Wordpress\Models\StateModel;
  use VoteForBernie\Wordpress\Helpers\VoteInfoHelper;
  get_header();
  global $post;
  $state = new StateModel($post);
  $helper = new VoteInfoHelper();
?>
<div class="state-page wrap" data-state="<?php echo $state->getTitle(); ?>">

  <div class="state-header init">
    <h2 class="slab">
      <span>How to vote for Bernie Sanders</span>
      <strong class="state-name init">in <?php echo $state->getTitle(); ?></strong>
    </h2>
    <img class="svg" data-src="<?php echo get_template_directory_uri(); ?>/dist/images/svg/states/<?php echo $state->state; ?>.svg"/>
  </div>
  <p class="not-state np"><a href="<?php echo home_url(); ?>">Not from <?php echo $state->getTitle(); ?>? <span>Choose your state!</span></a></p>


  <div class="state-info <?php echo $state->state; ?> <?php echo $helper->getStatusClass($state); ?>">

    <div class="type m-all t-all d-all">
      <div class="slab"><p class="status-info"><?php echo $state->getTitle(); ?> has <strong class="status c-bb c-t init"><?php echo $state->status; ?></strong> <?php echo $state->type; ?></p></div>
      <p class="meaning c-t c-bo"><?php echo $helper->getExplanationText($state); ?></p>
    </div>

    <div class="share np m-all t-all d-all">
      <?php if ($state->status !== 'open') { ?>
        <h3>If you didn't know that, you're not alone.</h3>
        <p>People are planning to vote for Bernie in <?php echo $state->getTitle(); ?> and they <strong>will not be able to!</strong></p>
      <?php } else { ?>
        <blockquote cite="http://www.thenation.com/article/bernie-sanders-explains-the-new-math-of-2016-to-democratic-leaders/">
          <p>﻿“I think you're looking at the candidate who can substantially increase voter turnout all across the country.”</p>
        </blockquote>
        <p>Bernie Sanders will only win if we can <strong>get enough people to vote!</strong></p>
      <?php } ?>

      <p class="share-text">Help <strong>Get The Vote Out</strong> by sharing this page</p>
      <?php if(function_exists('add_social_button_in_content')) echo add_social_button_in_content(); ?>
      <!-- <p>You can also print this page, and it turns into a flier you can post or give out!</p> -->
    </div>

    <!-- <div class="leader"></div> -->

    <div class="info-wrapper m-all t-all d-all">
      <div class="m-1of2 t-1of3 d-1of3">
        <div class="what">
          <?php if ($state->hasDeadlineDate()) { ?>
            <h3>Register By</h3>

            <div class="date">
              <strong><?php echo date('F', strtotime($state->deadline_date)); ?></strong>
              <span><?php echo date('j', strtotime($state->deadline_date)); ?></span>
              <em>(<?php echo date('l', strtotime($state->deadline_date)); ?>)</em>
            </div>
            <p><?php echo $helper->getActionText($state); ?> by:
            <strong><?php echo $helper->formatDate($state->deadline_date); ?></strong>
            </p>
            <?php if ($state->hasAffiliationDeadline()) { ?>
              <p><strong>Not a Democrat?</strong> <?php echo $state->getTitle(); ?> has a <em>special deadline</em> for changing affiliation: <strong><?php echo $helper->formatDate($state->aff_deadline_date); ?>!</strong></p>
            <?php } ?>
          <?php } else { ?>
            <h3>No Registration!</h3>
            <p>Just be sure to vote!</p>
          <?php } ?>
        </div>
      </div>

      <div class="m-1of2 t-1of3 d-1of3">
        <div class="when">
          <h3><?php echo $state->getTypeText(); ?> On</h3>
          <div class="date">
            <strong><?php echo date('F', strtotime($state->getPrimaryDate())); ?></strong>
            <span><?php echo date('j', strtotime($state->getPrimaryDate())); ?></span>
            <em>(<?php echo date('l', strtotime($state->getPrimaryDate())); ?>)</em>
          </div>
          <p>The <?php echo $state->getTitle(); ?> <?php echo $state->getTypeText(); ?> will be on: <strong><?php echo $helper->formatDate($state->getPrimaryDate()); ?></strong></p>
        </div>
      </div>

      <div class="np m-all t-1of3 d-1of3 last-col">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Beside Dates -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-3203899049474789"
             data-ad-slot="4941207957"
             data-ad-format="rectangle,horizontal"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
      </div>
    </div>

    <div class="np m-all t-all d-all newsletter">
      <p>Dates and deadlines can change at any time!</p>
      <p>Sign up to be reminded of deadlines and important changes in <?php echo $state->getTitle(); ?></p>
      <div class="updated">
        <p>Oregon was last updated on February 1st, 2013 <a href="/contact" class="correction-btn ui-btn">submit correction</a></p>
        <?php echo do_shortcode( '[contact-form-7 id="157" title="Submit Correction" html_class="submit-correction"]' ); ?>
      </div>
      <?php echo yksemeProcessSnippet( "2da18e85f7" , "Keep me informed!" ); ?>
    </div>

    <div class="vote-content m-all t-3of4 d-4of5">
      <h3><?php echo $state->getTitle(); ?> Voter Information</h3>
      <p class="vote-explain">
      <?php if ($state->status !== 'open') { ?>
      <?php echo $state->getTitle(); ?> has <strong class="c-t"><?php echo $state->status; ?></strong> <?php echo $state->type; ?> &mdash;
        <?php echo $helper->getExplanationText($state); ?>
      <?php } else {
        if ($state->hasDeadlineDate()) { ?>
          Good news! Because <?php echo $state->getTitle(); ?> has <strong class="c-t"><?php echo $state->status; ?></strong> <?php echo $state->type; ?>, you can vote for Bernie regardless of your registered party. If you want to vote for Bernie, <strong><?php echo strtolower($helper->getActionText($state)); ?></strong>!</strong>

        <p><a class="ui-btn np" href="<?php echo $helper->getOnlineRegistrationLink($state); ?>" data-track="regBtn,<?php echo $state->state; ?>">
          <?php echo $helper->getActionText($state); ?> now!
        </a></p>
      <?php } else { ?>
        Good news! Because <?php echo $state->getTitle(); ?> doesn't have voter registration, you can vote for Bernie Sanders by just showing up!


        <p><a class="ui-btn np" href="<?php echo $state->state_link; ?>" data-track="StateLink,<?php echo $state->state; ?>" target="_blank">Official State Information</a></p>
      <?php }
      } ?></p>


      <?php if ($state->hasAffiliationDeadline()) { ?>
        <p class="warning">In <?php echo $state->getTitle(); ?>, you must be affiliated as a Democrat by <?php echo $helper->formatDate($state->aff_deadline_date); ?>, which is before the registration deadline!</p>
      <?php } else if ($state->hasDeadlineDate()) { ?>
        <?php if ($state->sameDayRegistration()) { ?>
          <p><?php echo $state->getTitle(); ?> has <strong>Same-Day Registration</strong> which allows you to register to vote at the <?php echo $state->type; ?> on !</p>
        <? } else { ?>
          <p>You have until <?php echo $helper->formatDate($state->deadline_date); ?> to register, but registration is open <strong>right now!</strong></p>
        <?php } ?>
      <?php } ?>

      <?php if ($state->hasCheckRegistrationLink()) { ?>
        <p>Not sure if you are registered, or what you're registered as? Check your <a href="<?php echo $state->check_registration_link ?>" data-track="ChkLnk,<?php echo $state->state; ?>" target="_blank">current registration status</a>.</p>
      <?php } ?>

      <?php if (false && $state->hasAbsenteeVoting()) { // Will re-enable after all absentee data is verified ?>
        <h4>Vote By Mail</h4>
        <p><strong>Being busy or working</strong> on election day is the <strong>most common reason</strong> for not voting according to the U.S. Census. This is completely understandable, and will continue to be a problem until <a href="http://www.sanders.senate.gov/democracyday" data-track="DemDay,<?php echo $state->state; ?>" target="_blank">election day becomes a national holiday</a>!</p>

        <p>Fortunately, you can use <a href="http://www.longdistancevoter.org/<?php echo strtolower(str_replace(' ', '_', $state->getTitle())) ?>" data-track="AbsBallot,<?php echo $state->state; ?>" target="_blank"><?php echo $state->getTitle(); ?>'s absentee ballot</a>, which allows you to vote by mail before the election!</p>

        <?php if ($state->absenteeExcuseRequired()) { ?>
          <p><?php echo $state->denonym; ?> are required to have <a href="http://www.longdistancevoter.org/absentee_voting_rules" data-track="AbsRules,<?php echo $state->state; ?>" target="_blank">an acceptable excuse</a> to use an absentee ballot.</p>
        <?php } ?>
      <?php } ?>

      <?php if (false && $state->hasEarlyVoting()) { ?>
        <h4>Early Voting</h4>
        <p><?php echo $state->getTitle(); ?> has Early Voting! This allows <?php echo $state->denonym; ?> to cast their vote in-person prior to election day.</p>

        <p>Early voting in <?php echo $state->getTitle(); ?> begins <?php echo date('F j', strtotime($state->early_voting_start)); ?> and ends on <?php echo date('F j', strtotime($state->early_voting_end)); ?>.</p>
      <?php } ?>

      <h4>College Students</h4>
      <p>If you are a college student <strong>not living in your home state</strong>, you can vote for Bernie in either your home state or in the state in which you are attending school!</p>

      <?php if ($state->under_18): ?>
        <h4>Only 17?</h4>
        <p>In <?php echo $state->getTitle(); ?>, you can still vote in <?php echo $state->getTitle(); ?>'s <?php echo $state->type; ?> if you will be 18 years old by November 8, 2016.</p>
      <?php endif; ?>

      <h4>Military/Overseas Voters</h4>
      <p>If you are a Military Voter or outside the United States, you can <a href="https://www.overseasvotefoundation.org/vote/VoterInformation.htm" data-track="Overseas,<?php echo $state->state; ?>" target="_blank">complete a ballot here</a>.</p>
      <?php //<p>You have until TODO to request your ballot, and it must be submitted by TODO.</p> ?>

      <?php if ($state->hasAdditionalNote()): ?>
        <h4>Did you know?</h4>

        <?php if ($state->hasAdditionalNote()): ?>
          <p class="note"><?php echo $state->additional_note; ?></p>
        <?php endif; ?>

      <?php endif; ?>

      <h4>More Information</h4>
      <p>If you have any questions about voting in <?php echo $state->getTitle(); ?> you contact your official elections office.</p>
      <ul>
        <li><a href="<?php echo $state->state_link; ?>" data-track="StateLink,<?php echo $state->state; ?>" target="_blank">Official <?php echo $state->getTitle(); ?> Elections Website</a></li>
        <li>Phone: <?php echo $state->state_phone; ?></li>
      </ul>
      <p>Find other Bernie supporters in <?php echo $state->getTitle(); ?> at <?php echo $state->discussion_link; ?></p>

    </div>

    <div class="np m-all t-1of4 d-1of5 last-col gaunit">
      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <!-- Beside Content -->
      <ins class="adsbygoogle"
           style="display:block"
           data-ad-client="ca-pub-3203899049474789"
           data-ad-slot="3464474750"
           data-ad-format="vertical"></ins>
      <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
      </script>
    </div>

    <div class="np m-all t-all d-all activism">
      <p>Will you help Bernie win?</p>
      <p><strong>"I've said it since day one: I can't do it alone." - <em>Bernie Sanders</em></strong></p>
      <p>This grassroots campaign depends on grassroots support <strong>like you!</strong> There are many opportunities to help out Bernie's campaign right now, and if you want more <a href="https://go.berniesanders.com/page/s/volunteer-for-bernie?source=voteforbernie" target="_blank">sign up as a volunteer</a> with the official campaign. Many of us don't have much time for volunteer work, and if you're not able to volunteer but still want Bernie to win, <a href="http://berniesanders.com/reddit" target="_blank">donate to his campaign!</a></p>

      <?php if ($state->hasCampaignNeed()) { ?>
        <h4>Bernie needs you in <?php echo $state->getTitle(); ?>!</h4>
        <?php echo $state->campaign_special_need; ?>
      <?php } ?>

      <h4>Attend or host a local event</h4>
      <p>There are Bernie events popping up all over the country!</p>

      <h4>Phone Bank for Bernie</h4>
      <p>Over 30,000 calls have been made so far, but we need to reach many more in early primary states. Find out how to <a href="https://docs.google.com/document/d/1n0RtTtYLQUIfA4Am4OzqLet83d-IS2ajbXkrHJgqz2A/edit">Phone-bank for Bernie</a>.</p>

      <div class="np m-all t-all d-all">
        <?php if(function_exists('add_social_button_in_content')) echo add_social_button_in_content(); ?>

        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- State Bottom -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-3203899049474789"
             data-ad-slot="8951090753"
             data-ad-format="auto"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
      </div>
    </div>

  </div>
</div>

<!-- <pre>
  <?php print_r($state); ?>
</pre> -->
<?php get_footer(); ?>
