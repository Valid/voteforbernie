<?php
  use VoteForBernie\Wordpress\Models\StateModel;
  use VoteForBernie\Wordpress\Helpers\VoteInfoHelper;
  get_header();
  global $post;
  $state = new StateModel($post);
  $helper = new VoteInfoHelper();
?>
<div class="state-page wrap" data-state="<?php echo $state->getTitle(); ?>" data-state-code="<?php echo $state->state; ?>">

  <div class="state-header init">
    <h2 class="slab">
      <span>How to vote for Bernie Sanders</span>
      <strong class="state-name init">
      <?php if ($state->state == 'da') { ?>
        from Abroad
      <?php } else { ?>
        in <?php echo $state->getTitle(); ?>
      <?php } ?>
      </strong>
    </h2>
    <img class="svg" data-src="<?php echo get_template_directory_uri(); ?>/dist/images/svg/states/<?php echo $state->state; ?>.svg"/>
  </div>
  <p class="map-link np"><a href="<?php echo home_url(); ?>">
  <?php if ($state->state == 'da') { ?>
    Not living abroad?
  <?php } else { ?>
    Not from <?php echo $state->getTitle(); ?>?
  <?php } ?>
  <span>Choose your state!</span></a></p>


  <div class="state-info <?php echo $state->state; ?> <?php echo $helper->getStatusClass($state); ?>">

    <div class="type m-all t-all d-all">
      <div class="slab"><p class="status-info"><?php echo $state->getTitle(); ?> has <strong class="status c-bb c-t init"><?php echo $state->status; ?></strong> <?php echo $state->type; ?></p></div>
      <p class="meaning"><?php echo $helper->getExplanationText($state); ?></p>
    </div>

    <?php if ($state->hasVideo()) { ?>
      <div class="video-slot m-all t-all d-all">
        <h3>How to participate in <?php echo $state->getTitle(); ?> <?php echo $state->type; ?>:</h3>
        <?php echo wp_oembed_get($state->state_video); ?>
      </div>
    <?php } ?>

    <div class="info-wrapper m-all t-all d-all">
      <div class="m-1of2 t-1of3 d-1of3">
        <div class="what">
          <?php if ($state->hasRegistration()) { ?>
            <h3>Register By</h3>

            <div class="date">
              <strong><?php echo date('F', strtotime($state->deadline_date)); ?></strong>
              <span><?php echo date('j', strtotime($state->deadline_date)); ?></span>
              <em>(<?php echo date('l', strtotime($state->deadline_date)); ?>)</em>
            </div>
            <p><?php echo $helper->getActionText($state); ?> by:
            <strong><?php echo $helper->formatDate($state->deadline_date); ?></strong>
            </p>
            <?php if ($state->hasSameDayRegistration()) { ?>
              <p><strong>Same-Day Registration</strong>
                <?php echo $state->getTitle(); ?> has <em>Same-Day Registration</em> on <?php echo date('F j', strtotime($state->getPrimaryDate())); ?>
                <?php if ($state->hasSameDayRegistrationRestriction()) {
                  echo $state->same_day_registration_restriction;
                } ?>
              </p>
            <?php } ?>
            <?php if ($state->hasAffiliationDeadline() && !$helper->datePassed($state->aff_deadline_date)) { ?>
              <p><strong>Not a democrat?</strong> <?php echo $state->getTitle(); ?> has a <em>special deadline</em> for changing affiliation: <strong><?php echo $helper->formatDate($state->aff_deadline_date); ?></strong></p>
            <?php } ?>
          <?php } else { ?>
            <h3>No Registration!</h3>
            <p>You do not need to register in <?php echo $state->getTitle(); ?>, just be sure to vote!</p>
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
          <p><?php echo $state->getTitle(); ?> <?php echo $state->getTypeText(); ?>: <strong><?php echo $helper->formatDate($state->getPrimaryDate()); ?></strong></p>
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

    <div class="share np m-all t-all d-all">
      <?php if ($state->state == 'da') { ?>
        <h3>Didn't know you could vote from abroad?</h3>
        <p>Many Americans living outside the country don't know that they can participate.</p>
      <?php } else if ($state->status !== 'open') { ?>
        <h3>Didn't know about <?php echo $state->status ?> <?php echo $state->type; ?>? You're not alone.</h3>
        <p>People are planning to vote for Bernie in <?php echo $state->getTitle(); ?>, but they <strong>will not be able to!</strong></p>
      <?php } else { ?>
        <blockquote cite="http://www.thenation.com/article/bernie-sanders-explains-the-new-math-of-2016-to-democratic-leaders/">
          <p>﻿“I think you're looking at the candidate who can substantially increase voter turnout all across the country.”</p>
        </blockquote>
        <p>Bernie Sanders will only win if we can <strong>get enough people to vote!</strong></p>
      <?php } ?>

      <p class="share-text">Help <strong>Get The Vote Out in <?php echo $state->getTitle(); ?></strong> by sharing this page:</p>
      <?php if(function_exists('add_social_button_in_content')) echo add_social_button_in_content(); ?>
      <!-- <p>You can also print this page, and it turns into a flier you can post or give out!</p> -->
    </div>

    <div class="vote-content m-all t-3of4 d-4of5">
      <?php if ($state->state == 'da') { ?>
        <h3>How to vote from abroad</h3>
      <?php } else { ?>
        <h3><?php echo $state->getTitle(); ?> Voter Information</h3>
      <?php } ?>
      <h4>Get Registered</h4>
      <?php if (!$state->hasRegistration()) { ?>
        <p>Good news! Because <?php echo $state->getTitle(); ?> doesn't have voter registration, you can vote for Bernie Sanders by just showing up and voting!</p>

        <p><a class="ui-btn np" href="<?php echo $state->state_link; ?>" data-track="StateLink,<?php echo $state->state; ?>" target="_blank">Official Voter Information</a></p>
      <?php } else {
      if ($state->status == 'open') { ?>
        <p>Good news! Because <?php echo $state->getTitle(); ?> has <strong class="c-t"><?php echo $state->status; ?></strong> <?php echo $state->type; ?>, you can vote for Bernie regardless of your registered party. If you want to vote for Bernie, <strong><?php echo strtolower($helper->getActionText($state)); ?></strong>!</strong>
      <?php } else { ?>
        <p><?php echo $state->getTitle(); ?> has <strong class="c-t"><?php echo $state->status; ?></strong> <?php echo $state->type; ?> &mdash; <?php echo $helper->getExplanationText($state); ?></p>
      <?php }

      if ($state->hasOnlineRegistration()) { ?>
        <p><a class="ui-btn np" href="<?php echo $helper->getOnlineRegistrationLink($state); ?>" data-track="regBtn,<?php echo $state->state; ?>"><?php echo $helper->getActionText($state); ?> now!</a></p>
      <?php } else {
        ?><p><?php echo $state->getTitle(); ?> does not have online registration, but you can <a href="/register-to-vote/" data-track="RegToVote,<?php echo $state->state; ?>">fill out a registration form</a> to print and mail in.</p>

        <p><a class="ui-btn np" href="/register-to-vote/" data-track="RegToVote,<?php echo $state->state; ?>"><?php echo $helper->getActionText($state); ?> now!</a></p>

        <?php if ($state->hasRegistrationLink()) { ?>
          <p>For more information, see <a href="<?php echo $helper->getOnlineRegistrationLink($state); ?>" data-track="moreInfo,<?php echo $state->state; ?>"><?php echo $state->getTitle(); ?> voting</a>.</p>

      <?php }
        }
      } ?>


      <?php if ($state->hasAffiliationDeadline()) { ?>
        <p class="warning">In <?php echo $state->getTitle(); ?>, you must be affiliated as a democrat by <?php echo $helper->formatDate($state->aff_deadline_date); ?>, which is before the registration deadline!</p>
      <?php }
      if ($state->hasRegistration()) { ?>
        <?php if ($state->hasSameDayRegistration()) { ?>
          <p><?php echo $state->getTitle(); ?> has <strong>Same-Day Registration</strong> which allows you to register to vote at the <?php echo $state->type; ?> on <strong><?php echo $helper->formatDate($state->getPrimaryDate()); ?></strong>
            <?php if ($state->hasSameDayRegistrationRestriction()) {
              echo $state->same_day_registration_restriction;
            } ?>
          </p>
        <?php } else { ?>
          <p>You <strong>must</strong> be registered by <?php echo $helper->formatDate($state->deadline_date); ?>.</p>
        <?php } ?>
      <?php } ?>

      <?php if ($state->hasCheckRegistrationLink()) { ?>
        <p>Not sure if you are registered, or what you're registered as? Check your <a href="<?php echo $state->check_registration_link ?>" data-track="ChkLnk,<?php echo $state->state; ?>" target="_blank">current registration status online</a>.</p>
      <?php } ?>

      <?php if ($state->hasCaucusLink()) { ?>
        <a class="ui-btn" href="<?php echo $state->bern_advisory_link ?>" target="_blank" data-track="howCaucus,<?php echo $state->state; ?>">Learn how to Caucus in <?php echo $state->getTitle(); ?>!</a>
      <?php } ?>

      <?php if($state->hasVoteHowTo()) { ?>
        <h4>Vote!</h4>
        <?php echo $state->how_to_vote; ?>
      <?php } ?>

      <?php if($state->hasEligibility()) { ?>
        <h4>Eligibility</h4>
        <p>To vote in the <?php echo $state->getTitle(); ?> <?php echo $state->getTypeText(); ?> you must meet the following criteria:
        <?php echo $state->eligibility; ?>
      <?php } ?>

      <?php if (false && $state->hasAbsenteeVoting()) { // Will re-enable after all absentee data is verified ?>
        <h4>Vote By Mail</h4>
        <p><strong>Being busy or working</strong> on election day is the <strong>most common reason</strong> for not voting according to the U.S. Census. This is completely understandable, and will continue to be a problem until <a href="http://www.sanders.senate.gov/democracyday" data-track="DemDay,<?php echo $state->state; ?>" target="_blank">election day becomes a national holiday</a>!</p>

        <p>Fortunately, you can use <a href="http://www.longdistancevoter.org/<?php echo strtolower(str_replace(' ', '_', $state->getTitle())) ?>" data-track="AbsBallot,<?php echo $state->state; ?>" target="_blank"><?php echo $state->getTitle(); ?>'s absentee ballot</a>, which allows you to vote by mail before the election!</p>

        <?php if ($state->absenteeExcuseRequired()) { ?>
          <p><?php echo $state->denonym; ?> are required to have <a href="http://www.longdistancevoter.org/absentee_voting_rules" data-track="AbsRules,<?php echo $state->state; ?>" target="_blank">an acceptable excuse</a> to use an absentee ballot.</p>
        <?php } ?>
      <?php } ?>

      <?php if ($state->hasEarlyVoting()) { ?>
        <h4>Early Voting</h4>
        <p><strong>Vote Early in <?php echo $state->getTitle(); ?>!</strong> <?php echo $state->denonym; ?> can vote in-person <strong>before election day!</strong> If you'll be out of town on <?php echo date('F j', strtotime($state->getPrimaryDate())); ?> or simply find it more convenient, vote early!</p>

        <p><strong>Early voting in <?php echo $state->getTitle(); ?> begins <?php echo date('F j', strtotime($state->early_voting_start)); ?> and ends on <?php echo date('F j', strtotime($state->early_voting_end)); ?>.</strong></p>

        <?php echo $state->early_voting_info; ?>
      <?php } ?>

      <?php if ($state->under_18): ?>
        <h4>Only 17?</h4>
        <p>You may still vote in <?php echo $state->getTitle(); ?>'s <?php echo $state->type; ?> if you will be 18 years old by November 8, 2016.</p>
      <?php endif; ?>

      <?php if ($state->state != 'da') { ?>
        <h4>College Students</h4>
        <p>If you are a college student <strong>not living in your home state</strong>, you can vote for Bernie in either your home state or in the state in which you are attending school!</p>

        <?php if ($state->type != 'caucuses') { ?>
          <h4>Military Voters</h4>
          <p>If you are a Military Voter living abroad, you are able to <a href="https://www.overseasvotefoundation.org/vote/VoterInformation.htm" data-track="Overseas,<?php echo $state->state; ?>" target="_blank">complete a ballot here</a> to vote for Bernie.</p>
        <?php } ?>


      <?php } ?>
      <?php //<p>You have until TODO to request your ballot, and it must be submitted by TODO.</p> ?>

      <?php if ($state->hasAdditionalNote()): ?>
        <h4>Did you know?</h4>

        <?php if ($state->hasAdditionalNote()): ?>
          <p class="note"><?php echo $state->additional_note; ?></p>
        <?php endif; ?>

      <?php endif; ?>

      <h4>More Information</h4>
      <p>If you have any questions about voting in <?php echo $state->getTitle(); ?> you may contact your official elections office.</p>
      <ul>
        <li><a href="<?php echo $state->state_link; ?>" data-track="StateLink,<?php echo $state->state; ?>" target="_blank">Official <?php echo $state->getTitle(); ?> Elections Website</a></li>
        <li>Phone: <?php echo $state->state_phone; ?></li>
      </ul>
      <p>Find other Bernie supporters and get help from <?php echo $state->discussion_link; ?></p>
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

    <div class="np m-all t-all d-all newsletter">
      <?php if ($state->state != 'da') { ?>
        <p>Dates and deadlines can change at any time!</p>
        <p>Sign up below to be reminded of deadlines and be notified of important changes in <?php echo $state->getTitle(); ?></p>
        <?php echo yksemeProcessSnippet( "2da18e85f7" , "Keep me informed!" ); ?>
      <?php } ?>
      <div class="updated">
        <p><?php echo $state->getTitle(); ?> was last updated on <?php the_modified_time('F j, Y'); ?> <a href="/contact" class="correction-btn ui-btn">submit correction</a></p>
        <?php echo do_shortcode( '[contact-form-7 id="157" title="Submit Correction" html_class="submit-correction"]' ); ?>
      </div>
    </div>

    <div id="getinvolved" class="np m-all t-all d-all activism">
      <p>Will you help Bernie win?</p>
      <p><strong>"I've said it since day one: I can't do it alone." - <em>Bernie Sanders</em></strong></p>
      <p>This grassroots campaign depends on grassroots support <strong>like you!</strong> There are many opportunities to help out Bernie's campaign right now, and if you want more, <a href="https://go.berniesanders.com/page/s/volunteer-for-bernie?source=voteforbernie" data-track="volunteer,<?php echo $state->state; ?>" target="_blank">sign up as a volunteer</a> with the official campaign.</p>

      <p>Many of us don't have much time for volunteer work, and if you're not able to volunteer but still want Bernie to win:</p>

      <p><a class="ui-btn" href="https://secure.berniesanders.com/page/outreach/view/grassroots-fundraising/VFB" data-track="donate,<?php echo $state->state; ?>" target="_blank">Donate to the Bernie Sanders Campaign</a></p>

      <?php if ($state->hasCampaignNeed()) { ?>
        <h4>Bernie needs you in <?php echo $state->getTitle(); ?>!</h4>
        <?php echo $state->campaign_special_need; ?>
      <?php } ?>

      <h4>Phone Bank for Bernie</h4>
      <p>Phonebanking is the single most important thing you can do for the campaign besides voting. Primaries are here, and we need to be calling people and letting them know about how to vote in their state. <strong>Don't be scared!</strong> I hear from many people that it's daunting to call strangers on the phone, but you will have a script to read and the typical call length is very short.</p>
      <p><a href="https://go.berniesanders.com/page/content/phonebank?source=voteforbernie" class="ui-btn" data-track="phonebank,<?php echo $state->state; ?>" target="_blank">Start Phonebanking for Bernie!</a></p>

      <h4>Attend or host a local event</h4>
      <p>Phone Banking, Canvassing, Voter Registration Drives, Carpools -- these are just a few of the volunteer-hosted events popping up around the nation in support of Bernie Sanders, and some probably in your city!</p>
      <p><a class="ui-btn" href="http://map.berniesanders.com/" data-track="attend,<?php echo $state->state; ?>" target="_blank">Find a local event to attend</a></p>
      <p>If you can't find any events nearby, you should <a href="https://go.berniesanders.com/page/event/create" data-track="host,<?php echo $state->state; ?>" target="_blank">host your own</a> &mdash; I've done it several times and it's been a great experience meeting local Bernie supporters!</p>

      <div class="np m-all t-all d-all">
        <?php if(function_exists('add_social_button_in_content')) echo add_social_button_in_content(); ?>
      </div>
    </div>

  </div>
</div>

<?php // echo do_shortcode('[fbcomments]'); ?>

<!-- <pre>
  <?php print_r($state); ?>
</pre> -->
<?php get_footer(); ?>
