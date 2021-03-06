<?php
  use VoteForBernie\Wordpress\Models\StateModel;
use VoteForBernie\Wordpress\Helpers\VoteInfoHelper;

get_header();
  global $post;
  $state = new StateModel($post);
  $helper = new VoteInfoHelper();
?>
<div class="state-page wrap" data-state="<?php echo $state->getTitle(); ?>"
  data-state-code="<?php echo $state->state; ?>">

  <div class="state-header init">
    <h2 class="slab">
      <span>How to vote for Bernie Sanders</span>
      <strong class="state-name init">
        <?php if ($state->state == 'da') {
    ?>
        from Abroad
        <?php
} else {
        ?>
        in <?php echo $state->getTitle(); ?>
        <?php
    } ?>
      </strong>
    </h2>
    <img class="svg"
      data-src="<?php echo get_template_directory_uri(); ?>/dist/images/svg/states/<?php echo $state->state; ?>.svg" />
  </div>
  <p class="map-link np"><a href="<?php echo home_url(); ?>">
      <?php if ($state->state == 'da') {
        ?>
      Not living abroad?
      <?php
    } else {
        ?>
      Not from <?php echo $state->getTitle(); ?>?
      <?php
    } ?>
      <span>Choose your state!</span></a></p>


  <div class="state-info <?php echo $state->state; ?> <?php echo $helper->getStatusClass($state); ?>">


    <?php /* if ($state->hasVideo()) {
        ?>
    <div class="video-slot m-all t-all d-all">
      <h3>How to participate in <?php echo $state->getTitle(); ?> <?php echo $state->type; ?>:</h3>
      <?php echo wp_oembed_get($state->state_video); ?>
    </div>
    <?php
    } */ ?>

    <div class="info-wrapper m-all t-all d-all">
      <div class="m-1of2 t-1of3 d-1of3">
        <div class="what">
          <?php if ($state->hasRegistration()) {
        ?>
          <h3>Register By</h3>

          <div class="date">
            <?php if ($state->hasDeadlineDate()) {
            ?>
            <strong><?php echo date('F', strtotime($state->deadline_date)); ?></strong>
            <span><?php echo date('j', strtotime($state->deadline_date)); ?></span>
            <?php
                if (date('Y') !== date('Y', strtotime($state->deadline_date))) {
                    ?>
            <em>(<?php echo date('Y', strtotime($state->deadline_date)); ?>)</em>
            <?php
                } else {
                    ?>
            <em>(<?php echo date('l', strtotime($state->deadline_date)); ?>)</em>
            <?php
                }
        } else {
            echo 'TBD';
        } ?>
          </div>
          <?php /*
            <p><?php echo $helper->getActionText($state); ?> by:
          <strong><?php echo $helper->formatDate($state->deadline_date); ?></strong>
          </p>
          */ ?>
          <?php if ($state->hasSameDayRegistration()) {
            ?>
          <p><strong>Same-Day Registration</strong>
            <?php echo $state->getTitle(); ?> has <em>Same-Day Registration</em> on
            <?php echo date('F j', strtotime($state->getPrimaryDate())); ?>
            <?php if ($state->hasSameDayRegistrationRestriction()) {
                echo $state->same_day_registration_restriction;
            } ?>
          </p>
          <?php
        } ?>
          <?php if ($state->hasAffiliationDeadline() && !$helper->datePassed($state->aff_deadline_date)) {
            ?>
          <p><strong>Not a democrat?</strong> <?php echo $state->getTitle(); ?> has a <em>special deadline</em> for
            changing affiliation: <strong><?php echo $helper->formatDate($state->aff_deadline_date); ?></strong></p>
          <?php
        } ?>
          <?php
    } else {
        ?>
          <h3>No Registration!</h3>
          <p>You do not need to register in <?php echo $state->getTitle(); ?>, just be sure to vote!</p>
          <?php
    } ?>
        </div>
      </div>

      <div class="m-1of2 t-1of3 d-1of3">
        <div class="when">
          <h3><?php echo $state->getTypeText(); ?> On</h3>
          <div class="date">
            <strong><?php echo date('F', strtotime($state->getPrimaryDate())); ?></strong>
            <span><?php echo date('j', strtotime($state->getPrimaryDate())); ?></span>
            <?php
                if (date('Y') !== date('Y', strtotime($state->getPrimaryDate()))) {
                    ?>
            <em>(<?php echo date('Y', strtotime($state->getPrimaryDate())); ?>)</em>
            <?php
                } else {
                    ?>
            <em>(<?php echo date('l', strtotime($state->getPrimaryDate())); ?>)</em>
            <?php
                }
            ?>
          </div>
          <p><?php echo $state->getTitle(); ?> <?php echo $state->getTypeText(); ?>:
            <strong><?php echo $helper->formatDate($state->getPrimaryDate()); ?></strong></p>
        </div>
      </div>

      <div class="np m-all t-1of3 d-1of3 last-col">
        <div id="state-page-by-dates"></div>
      </div>
    </div>


    <?php if ($state->hasAdditionalNote()): ?>
    <div class="m-all t-all d-all">
      <p class="note"><?php echo $state->additional_note; ?></p>
    </div>
    <?php endif; ?>

    <div class="m-all t-all d-all">
      <?php if ($state->isTentative()): ?>
      <p class="tentative">While all dates are subject to change, the above dates are <strong>especially likely to
          change</strong> due to being based on the previous election. The final date will likely be close, but please
        sign up below for Voter Alerts in <?php echo $state->getTitle(); ?> and we'll email you the official dates when
        they are finalized.</p>
      <?php else: ?>
      <p class="tentative">It's still very early in the election season, and dates often change. Please sign up below
        for Voter Alerts in <?php echo $state->getTitle(); ?> and we'll send you an email if the dates change!</p>
      <?php endif; ?>
      <div class="newsletter">
        <?php if (function_exists('yksemeProcessSnippet')) {
                echo yksemeProcessSnippet('2da18e85f7', 'Keep me informed!');
            } ?>
      </div>
    </div>

    <div class="share np m-all t-all d-all">
      <div class="type m-all t-all d-all">
        <h3 class="status-info"><?php echo $state->getTitle(); ?> has <strong
            class="status c-bb c-t init"><?php echo $state->status; ?></strong> <?php echo $state->type; ?></h3>
        <p class="meaning"><?php echo $helper->getExplanationText($state); ?></p>
      </div>

      <div class="share-text-info">
        <?php if ($state->state == 'da') {
                ?>
        <h3>Didn't know you could vote from abroad?</h3>
        <p>Many Americans living outside the country don't know that they can participate.</p>
        <?php
            } elseif ($state->status !== 'open') {
                ?>
        <h3>Didn't know about <?php echo $state->status; ?> <?php echo $state->type; ?>? <strong>You're not
            alone.</strong></h3>
        <?php
            } else {
                ?>

        <blockquote
          cite="http://www.thenation.com/article/bernie-sanders-explains-the-new-math-of-2016-to-democratic-leaders/">
          <p>“I think you're looking at the candidate who can substantially increase voter turnout all across the
            country.”</p>
        </blockquote>
        <?php
            } ?>
      </div>
      <p class="share-text">Help <strong>Get Out The Vote in <?php echo $state->getTitle(); ?></strong> by sharing this
        page:</p>
      <?php // if(function_exists('add_social_button_in_content')) echo add_social_button_in_content();?>
      <?php echo do_shortcode('[social_warfare]'); ?>
      <!-- <p>You can also print this page, and it turns into a flier you can post or give out!</p> -->
    </div>

    <div class="vote-content m-all t-3of4 d-4of5">
      <?php if ($state->state == 'da') {
                ?>
      <h3>How to vote from abroad</h3>
      <?php
            } else {
                ?>
      <h3><?php echo $state->getTitle(); ?> Voter Information</h3>
      <?php
            } ?>
      <h4 id="register">Get Registered</h4>
      <?php if (!$state->hasRegistration()) {
                ?>
      <p>Good news! Because <?php echo $state->getTitle(); ?> doesn't have voter registration, you can vote for Bernie
        Sanders by just showing up and voting!</p>

      <p><a class="ui-btn np" href="<?php echo $state->state_link; ?>"
          data-track="StateLink,<?php echo $state->state; ?>" target="_blank">Official Voter Information</a></p>
      <?php
            } else {
                if ($state->status == 'open') {
                    ?>
      <p>Good news! Because <?php echo $state->getTitle(); ?> has <strong
          class="c-t"><?php echo $state->status; ?></strong> <?php echo $state->type; ?>, you can vote for Bernie
        regardless of your registered party. If you want to vote for Bernie,
        <strong><?php echo strtolower($helper->getActionText($state)); ?></strong>!</strong>
        <?php
                } else {
                    ?>
        <p><?php echo $state->getTitle(); ?> has <strong class="c-t"><?php echo $state->status; ?></strong>
          <?php echo $state->type; ?> &mdash; <?php echo $helper->getExplanationText($state); ?></p>
        <?php
                }

                if ($state->hasOnlineRegistration()) {
                    ?>
        <p><a class="ui-btn np" href="<?php echo $helper->getOnlineRegistrationLink($state); ?>"
            data-track="regBtn,<?php echo $state->state; ?>"><?php echo $helper->getActionText($state); ?> now!</a></p>
        <?php
                } else {
                    ?><p><?php echo $state->getTitle(); ?> does not have online registration, but you can <a
            href="/register-to-vote/" data-track="RegToVote,<?php echo $state->state; ?>">fill out a registration
            form</a> to print and mail in.</p>

        <p><a class="ui-btn np" href="/register-to-vote/"
            data-track="RegToVote,<?php echo $state->state; ?>"><?php echo $helper->getActionText($state); ?> now!</a>
        </p>

        <?php if ($state->hasRegistrationLink()) {
                        ?>
        <p>For more information, see <a href="<?php echo $helper->getOnlineRegistrationLink($state); ?>"
            data-track="moreInfo,<?php echo $state->state; ?>"><?php echo $state->getTitle(); ?> voting</a>.</p>

        <?php
                    }
                }
            } ?>


        <?php if ($state->hasAffiliationDeadline()) {
                ?>
        <p class="warning">In <?php echo $state->getTitle(); ?>, you must be affiliated as a democrat by
          <?php echo $helper->formatDate($state->aff_deadline_date); ?>, which is before the registration deadline!</p>
        <?php
            }
      if ($state->hasRegistration()) {
          ?>
        <?php if ($state->hasSameDayRegistration()) {
              ?>
        <p><?php echo $state->getTitle(); ?> has <strong>Same-Day Registration</strong> which allows you to register to
          vote at the <?php echo $state->type; ?> on
          <strong><?php echo $helper->formatDate($state->getPrimaryDate()); ?></strong>
          <?php if ($state->hasSameDayRegistrationRestriction()) {
                  echo $state->same_day_registration_restriction;
              } ?>
        </p>
        <?php
          } else {
              ?>
        <p>You <strong>must</strong> be registered by <?php echo $helper->formatDate($state->deadline_date); ?>.</p>
        <?php
          } ?>
        <?php
      } ?>

        <?php if ($state->hasCheckRegistrationLink()) {
          ?>
        <p>Not sure if you are registered, or what you're registered as? Check your <a
            href="<?php echo $state->check_registration_link; ?>" data-track="ChkLnk,<?php echo $state->state; ?>"
            target="_blank">current registration status online</a>.</p>
        <?php
      } ?>

        <?php /*
      <?php if ($state->hasCaucusLink()) { ?>
        <a class="ui-btn" href="<?php echo $state->bern_advisory_link ?>" target="_blank"
          data-track="howCaucus,<?php echo $state->state; ?>">Learn how to Caucus in
          <?php echo $state->getTitle(); ?>!</a>
        <?php } ?>
        */ ?>

        <?php if ($state->hasVoteHowTo()) {
          ?>
        <h4 id="vote">Go Vote!</h4>
        <?php echo $state->how_to_vote; ?>
        <?php
      } ?>


        <div id="state-page-under-register"></div>

        <?php if ($state->hasIDLaws()) {
          ?>
        <h4 id="id">Id Requirement</h4>
        <?php echo $state->voter_id; ?>
        <?php
      } ?>

        <?php if ($state->hasWorkLaws()) {
          ?>
        <h4 id="work">Voter Workplace Protection</h4>
        <?php echo $state->work_laws; ?>
        <?php
      } ?>

        <?php if ($state->hasEligibility()) {
          ?>
        <h4 id="eligible">Eligibility</h4>
        <p>To vote in the <?php echo $state->getTitle(); ?> <?php echo $state->getTypeText(); ?> you must meet the
          following criteria:
          <?php echo $state->eligibility; ?>
          <?php
      } ?>

          <?php if (false && $state->hasAbsenteeVoting()) { // Will re-enable after all absentee data is verified?>
          <h4>Vote By Mail</h4>
          <p><strong>Being busy or working</strong> on election day is the <strong>most common reason</strong> for not
            voting according to the U.S. Census. This is completely understandable, and will continue to be a problem
            until <a href="http://www.sanders.senate.gov/democracyday" data-track="DemDay,<?php echo $state->state; ?>"
              target="_blank">election day becomes a national holiday</a>!</p>

          <p>Fortunately, you can use <a
              href="http://www.longdistancevoter.org/<?php echo strtolower(str_replace(' ', '_', $state->getTitle())); ?>"
              data-track="AbsBallot,<?php echo $state->state; ?>" target="_blank"><?php echo $state->getTitle(); ?>'s
              absentee ballot</a>, which allows you to vote by mail before the election!</p>

          <?php if ($state->absenteeExcuseRequired()) {
          ?>
          <p><?php echo $state->denonym; ?> are required to have <a
              href="http://www.longdistancevoter.org/absentee_voting_rules"
              data-track="AbsRules,<?php echo $state->state; ?>" target="_blank">an acceptable excuse</a> to use an
            absentee ballot.</p>
          <?php
      } ?>
          <?php
      } ?>

          <?php if ($state->hasEarlyVoting()) {
          ?>
          <h4 id="early">Early Voting</h4>
          <p><strong>Vote Early in <?php echo $state->getTitle(); ?>!</strong> <?php echo $state->denonym; ?> can vote
            in-person <strong>before election day!</strong> If you'll be out of town on
            <?php echo date('F j', strtotime($state->getPrimaryDate())); ?> or simply find it more convenient, vote
            early!</p>

          <p><strong>Early voting in <?php echo $state->getTitle(); ?> begins
              <?php echo date('F j', strtotime($state->early_voting_start)); ?> and ends on
              <?php echo date('F j', strtotime($state->early_voting_end)); ?>.</strong></p>

          <?php echo $state->early_voting_info; ?>
          <?php
      } ?>

          <?php if ($state->under_18): ?>
          <h4 id="seventeen">Only 17?</h4>
          <p>You may still vote in <?php echo $state->getTitle(); ?>'s <?php echo $state->type; ?> if you will be 18
            years old by November 3, 2020.</p>
          <?php endif; ?>

          <?php if ($state->state != 'da') {
          ?>
          <h4 id="college">College Students</h4>
          <p>If you are a college student <strong>not living in your home state</strong>, you can vote for Bernie in
            either your home state or in the state in which you are attending school!</p>

          <?php if ($state->type != 'caucuses') {
              ?>
          <h4 id="overseas">Military/Overseas Voters</h4>
          <p>If you are a Military Voter or a US Citizen living abroad, you are able to <a
              href="https://www.overseasvotefoundation.org/vote/VoterInformation.htm"
              data-track="Overseas,<?php echo $state->state; ?>" target="_blank">request a ballot here</a> to vote for
            Bernie.</p>
          <?php
          } ?>


          <?php
      } ?>
          <?php //<p>You have until TODO to request your ballot, and it must be submitted by TODO.</p>?>
          <?php if ($state->hasDelegateInfo()) {
          ?>
          <h4 id="delegate">Become a Delegate for Bernie</h4>
          <div class="m-all t-all d-all">
            <p>Willing to go the extra mile to help Bernie get elected? We need <strong>2,373</strong> Bernie supporters
              to become a Delegate, travel to Milwaukee, Wisconsin, and cast their vote for Bernie Sanders at the
              Democratic National Convention. Interested?</p>
            <a href="#" class="delegate-button ui-btn">How to become a delegate in
              <?php echo $state->getTitle(); ?></a>
            <div class="delegate-info"><?php echo $state->delegate_info; ?></div>
          </div>
          <?php
      } ?>

          <h4 id="contact">More Information</h4>
          <p>If you have any questions about voting in <?php echo $state->getTitle(); ?> you may contact your state
            official elections office or Democratic party.</p>
          <ul>
            <?php if ($state->type != 'caucuses') {
          ?>
            <li><a href="<?php echo $state->state_link; ?>" data-track="StateLink,<?php echo $state->state; ?>"
                target="_blank">Official <?php echo $state->getTitle(); ?> Elections Website</a></li>
            <li>Phone: <?php echo $state->state_phone; ?></li>
            <?php
      } ?>
            <?php if ($state->dem_website) {
          ?>
            <li><a href="<?php echo $state->dem_website; ?>" data-track="DemLink,<?php echo $state->state; ?>"
                target="_blank"><?php echo $state->getTitle(); ?> Democratic Party</a>
              <?php
      } ?>
              <?php if ($state->dem_phone) {
          ?>
            <li>Phone: <?php echo $state->dem_phone; ?></li>
            <?php
      } ?>
          </ul>
    </div>


    <div class="np m-all t-all d-all newsletter">
      <?php if ($state->state != 'da') {
          ?>
      <p>Dates and deadlines can change at any time!</p>
      <p>Sign up below to be reminded of deadlines and be notified of important changes in
        <?php echo $state->getTitle(); ?></p>
      <?php if (function_exists('yksemeProcessSnippet')) {
              echo yksemeProcessSnippet('2da18e85f7', 'Keep me informed!');
          } ?>
      <?php
      } ?>
      <div class="updated">
        <p><?php echo $state->getTitle(); ?> was last updated on <?php the_modified_time('F j, Y'); ?> <a
            href="/contact" class="correction-btn ui-btn">submit correction</a></p>
        <?php echo do_shortcode('[contact-form-7 id="157" title="Submit Correction" html_class="submit-correction"]'); ?>
      </div>
    </div>

    <div id="gotv" class="np m-all t-all d-all activism">
      <div class="m-all t-all d-all">
        <h4>Join the GOTV Squad</h4>
        <p><strong>"I've said it since day one: I can't do it alone." - <em>Bernie Sanders</em></strong></p>
        <p>This grassroots campaign depends on grassroots supporters <strong>like you!</strong></p>
        <p>Everyone should sign up and volunteer for the <a
            href="https://act.berniesanders.com/signup/social-launch?source=vfb"
            data-track="volunteer,<?php echo $state->state; ?>" target="_blank">official Sanders 2020 campaign</a>, of
          course.</p>
        <p>If you are passionate about Getting Out The Vote like we are, you should also <a
            href="https://forms.gle/D93YTYvndrbuBM419" data-track="gotvsquad,<?php echo $state->state; ?>"
            target="_blank">join the GOTV Squad</a></p>

        <p><a href="https://forms.gle/D93YTYvndrbuBM419" class="ui-btn"
            data-track="gotvsquad,<?php echo $state->state; ?>" target="_blank">Join the GOTV Squad</a></p>

        <h4>Donate</h4>
        <p>Bernie continues to fund his campaign from small donations from people like us. Show your support by donating
          to the campaign!</p>

        <p><a class="ui-btn" href="/donate" data-track="donate,<?php echo $state->state; ?>">Donate to
            the Bernie Sanders Campaign</a>
        </p>

        <?php if ($state->hasCampaignNeed()) {
          ?>
        <h4>Bernie needs you in <?php echo $state->getTitle(); ?>!</h4>
        <?php echo $state->campaign_special_need; ?>
        <?php
      } ?>

        <div class="np m-all t-all d-all">
          <?php echo do_shortcode('[social_warfare]'); ?>
        </div>
      </div>
      <?php /*
      <div class="m-all t-1of2 d-1of2">
        <?php echo do_shortcode( '[add_eventon_list event_count="10" show_limit="yes" event_order="DESC" hide_past="yes" ]'); ?>
    </div>
    */?>
  </div>

</div>
</div>

<?php // echo do_shortcode('[fbcomments]');?>

<!-- <pre>
  <?php print_r($state); ?>
</pre> -->
<?php get_footer(); ?>