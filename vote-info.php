<?php
/*
 Template Name: Vote Information By State Page
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/

use VoteForBernie\Wordpress\Services\StateService;
use VoteForBernie\Wordpress\Helpers\VoteInfoHelper;
$stateService = new StateService();
$helper = new VoteInfoHelper();
$states = $stateService->getStates();
?>

<?php get_header(); ?>
      <div id="content" class="vote-info">

        <div class="map-intro">
          <ul class="legend">
            <li class="closed">Closed Primary</li>
            <li class="open">Open Primary</li>
            <li class="closed-caucus">Closed Caucus</li>
            <li class="open-caucus">Open Caucus</li>
            <li class="other">Other</li>
          </ul>
          <div class="inner-content explanation-container">
            <!-- <h3>You want to vote for Bernie Sanders <strong>but will you be able to?</strong></h3> -->
            <ul class="explanations">
              <li class="closed active">Voters in Closed Primary states <strong>must</strong> register as Democrat to vote for Bernie</li>
              <li class="open">Voters in Open Primary states can vote for Bernie regardless of political affiliation</li>
              <li class="closed-caucus">Voters in Closed Caucus states <strong>must</strong> affiliate as Democrat to vote for Bernie</li>
              <li class="open-caucus">Voters in Open Caucus states can vote for Bernie regardless of political affiliation</li>
              <li class="other">Independents can vote for Bernie in Semi-Closed states, while in Semi-Open states everyone except Republicans can</li>
            </ul>
            <div class="state-select">
              <p>Learn how to vote for Bernie in your state by <span class="no-mobile">clicking it or</span>
                <select class="state-selector">
                  <option>Select Your State</option>
                  <?php foreach ($states as $state): ?>
                    <option value="<?php echo $state->state; ?>"><?php echo $state->getTitle(); ?></option>
                  <?php endforeach; ?>
                </select>
              </p>
            </div>
          </div>
        </div>
        <div class="map-container">
          <div id="vmap"></div>
        </div>

        <div id="inner-content" class="wrap cf">

            <main id="main" class="m-all t-all d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

              <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

              <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

                <header class="article-header">
                  <!-- <h1 class="page-title"><?php the_title(); ?></h1> -->
                  <div class="sign-up-notice">
                    <p class="tentative">All dates are tentative and subject to change at any time.<br/>If you want to receive important updates for your state, sign up for the email list.</p>
                    <?php echo yksemeProcessSnippet( "2da18e85f7" , "Keep me informed!" ); ?>
                    <p class="byline vcard">Last updated: <?php //the_modified_time(get_option('date_format')); ?>, if you find any mistakes, <a href="/contact/">contact us</a>.</p>
                  </div>
                </header>

                <section class="entry-content cf" itemprop="articleBody">
                  <div class="page-content m-all t-all d-all">
                    <div class="states">
                    <?php if(function_exists('add_social_button_in_content')) echo add_social_button_in_content(); ?>

                  <?php foreach ($states as $state): ?>

                  <div id="<?php echo $state->state; ?>"
                        class="state <?php echo $state->state; ?> <?php echo $helper->getStatusClass($state); ?>">
                    <h3><?php echo $state->getTitle(); ?></h3>
                    <div class="state-info cf">
                      <div class="m-all t-2of3 d-2of3">
                        <p class="primaries">
                          <?php echo $state->getTitle(); ?>
                          has
                          <strong class="status"><?php echo $state->status; ?></strong>
                          <?php echo $state->type; ?>.
                        </p>
                        <p class="explain"><?php echo $helper->getExplanationText($state); ?></p>
                        <p class="advice">
                          <?php echo $state->denonym; ?> for Bernie:
                          <a href="<?php echo $state->vote_link ?>"
                            data-track="Vote Link, <?php echo $state->state; ?>"
                            target="_blank"><?php echo $helper->getActionText($state); ?></a></p>
                        <?php if ($state->under_18): ?>
                          <p class="explain"><strong>Only 17?</strong> If you will be 18 by November 8, 2016, you can vote in the primaries!</p>
                        <?php endif; ?>
                        <?php if ($state->hasAdditionalNote()): ?>
                          <p class="explain"><?php echo $state->additional_note; ?></p>
                        <?php endif; ?>

                        <?php if ($state->state === 'ny') {
                          $today = time();
                          $oct9 = mktime(0,0,0,10,9,2015);
                          $daysLeft = round(($oct9 - $today)/86400);
                          ?>

                          <div class="callout">
                            <p>There are only <strong><?php echo $daysLeft ?> days left</strong> to update your registration to Democrat!<br/>
                            If you miss the deadline, <strong>you will not be able to vote for Bernie!</strong>.</p>
                            <p class="explain">Check your <a href="https://voterlookup.elections.state.ny.us/votersearch.aspx" data-track="Check Registration, <?php echo $stateCode; ?>" target="_blank">current registration status online</a><br/>
                            If you are not already affiliated as a democrat, <a href="http://dmv.ny.gov/more-info/electronic-voter-registration-application" data-track="Online Register, <?php echo $stateCode; ?>" target="_blank">update your NY registration online</a>. <a href="http://www.ifyouwantbernie.com/NY/" target="_blank">more info</a></p>
                          </div>
                        <?php } ?>
                      </div>
                      <div class="resources m-all t-1of3 d-1of3">
                        <p>
                          <?php echo $state->getTypeText(); ?>:
                          <strong><?php echo $state->getPrimaryDate(); ?></strong>
                        </p>
                        <p>
                          Deadline:
                          <?php if ($state->hasDeadlineDate()): ?>
                            <time title="<?php echo $state->deadline_reference; ?>">
                              <?php echo $state->deadline_date; ?>
                            </time>
                          <?php else: ?>
                            <?php echo $state->deadline_reference; ?>
                          <?php endif; ?>
                        </p>
                        <ul>
                          <li>Discussion: <?php echo $state->discussion_link; ?></li>
                          <!-- <li><a href="<?php echo $state->check_registration_link; ?>" data-track="Check Registration, <?php echo $state->state; ?>">Check your current registration</a></li> -->
                        </ul>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>

                  <?php if(function_exists('add_social_button_in_content')) echo add_social_button_in_content(); ?>
                  </div>

                    <?php // the_content(); ?>
                  </div>
                </section>

                <?php // comments_template(); ?>

              </article>

              <?php endwhile; else : ?>

                  <article id="post-not-found" class="hentry cf">
                      <header class="article-header">
                        <h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
                    </header>
                      <section class="entry-content">
                        <p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
                    </section>
                    <footer class="article-footer">
                        <p><?php _e( 'This is the error message in the page-custom.php template.', 'bonestheme' ); ?></p>
                    </footer>
                  </article>

              <?php endif; ?>

            </main>

            <?php // get_sidebar(); ?>

        </div>

      </div>

<?php get_footer(); ?>
