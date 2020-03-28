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
$mostRecentStateUpdate = $stateService->determineMostRecentUpdate($states);
?>

<?php get_header(); ?>
<div class="vote-info">
  <div class="map-intro">
    <h2 class="page-title">Will <em>you</em> be able to <strong>Vote for Bernie?</strong></h2>
    <div class="state-select">

      <select class="state-selector">
        <option></option>
        <?php foreach ($states as $state): ?>
        <option value="<?php echo $state->state; ?>"><?php echo $state->getTitle(); ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <ul class="legend">
      <li class="closed" data-type="closed">Closed Primary</li>
      <li class="open" data-type="open">Open Primary</li>
      <li class="closed-caucus" data-type="closed-caucus">Closed Caucus</li>
      <li class="open-caucus" data-type="open-caucus">Open Caucus</li>
      <li class="other" data-type="other">Other</li>
    </ul>
    <div class="explanation-container">
      <ul class="explanations">
        <li class="closed active">Voters in Closed Primary states <strong>must</strong> register as democrat to vote for
          Bernie</li>
        <li class="open">Voters in Open Primary states can vote for Bernie regardless of political affiliation</li>
        <li class="closed-caucus">Voters in Closed Caucus states <strong>must</strong> affiliate as democrat to vote for
          Bernie</li>
        <li class="open-caucus">Voters in Open Caucus states can vote for Bernie regardless of political affiliation
        </li>
        <li class="other">Semi-Open? Semi-Closed? Click your state to find out how to vote for Bernie Sanders</li>
      </ul>
    </div>
  </div>
  <div class="map-container">
    <div id="vmap" class="primary-map"></div>
  </div>


  <div class="inner-content">

    <main id="main" class="m-all t-all d-all cf" role="main" itemscope itemprop="mainContentOfPage"
      itemtype="http://schema.org/Blog">

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope
        itemtype="http://schema.org/BlogPosting">

        <header class="article-header">
          <h2 class="page-title"><strong>Why</strong> is voting in the primaries important?</h2>
          <div class="m-all t-all d-all">
            <?php the_content(); ?>
          </div>

          <div class="m-all t-all d-all sign-up-notice newsletter">
            <div id="front-page-in-state"></div>


            <p>Dates and deadlines can change at any time.</p>
            <p>Sign up to be reminded of deadlines and important changes in your state</p>
            <?php if (function_exists('yksemeProcessSnippet')) {
    echo yksemeProcessSnippet('2da18e85f7', 'Keep me informed!');
} ?>
            <p class="tentative">Last updated on <?php echo $mostRecentStateUpdate; ?>.</p>
          </div>
        </header>

        <section class="m-all t-all d-all entry-content cf" itemprop="articleBody">
          <div class="page-content">
            <div class="states">
              <?php // if(function_exists('add_social_button_in_content')) echo add_social_button_in_content();?>

              <?php foreach ($states as $state): ?>

              <div id="state-<?php echo $state->state; ?>"
                class="state state-info <?php echo $state->state; ?> <?php echo $helper->getStatusClass($state); ?>"
                data-type="<?php echo explode(' ', $helper->getStatusClass($state))[0]; ?>"
                data-code="<?php echo $state->state; ?>">

                <div class="state-wrapper cf">

                  <div class="m-all t-all d-all">
                    <div class="state-title">
                      <img class="svg"
                        data-src="<?php echo get_template_directory_uri(); ?>/dist/images/svg/states/<?php echo $state->state; ?>.svg" />
                      <h3><a href="<?php echo esc_url(get_permalink($state->post)); ?>"
                          title="<?php echo $state->getTitle(); ?> Voter Information"
                          data-track="stateTitle,<?php echo $state->state; ?>"><?php echo $state->getTitle(); ?></a>
                      </h3>
                    </div>
                  </div>
                  <div class="state-content c-bo m-all t-all d-all">
                    <div class="wr m-all t-3of4 d-3of4">
                      <p>
                        <?php echo $state->getTitle(); ?>
                        has
                        <strong class="c-t"><?php echo $state->status; ?></strong>
                        <?php echo $state->type; ?>.
                      </p>
                      <p class="exp"><?php echo $helper->getExplanationText($state); ?></p>

                      <!-- <p><?php echo $state->denonym; ?> for Bernie:</p> -->
                      <!-- <a href="<?php echo esc_url(get_permalink($state->post)); ?>" data-track="actTxt,<?php echo $state->state; ?>">
                            <?php echo strtolower($helper->getActionText($state)); ?></a> to vote for Bernie. -->
                      <a class="ui-btn" href="<?php echo esc_url(get_permalink($state->post)); ?>"
                        data-track="howTo,<?php echo $state->state; ?>">How to vote in
                        <?php echo $state->getTitle(); ?></a>
                      <?php /*

                      <?php if ($state->hasOnlineRegistration() || $state->under_18 || $state->hasAdditionalNote()): ?>
                      <div class="extra">
                        <?php if ($state->hasOnlineRegistration()) {
    ?>
                        <p><strong>Online Registration Available!</strong></p>
                        <?php
} ?>
                        <?php if ($state->under_18): ?>
                        <p class="only17"><strong>Only 17?</strong> If you will be 18 by November 3, 2020, you can vote
                          in the <?php echo $state->type; ?>!</p>
                        <?php endif; ?>
                        <?php if ($state->hasAdditionalNote()): ?>
                        <p class="note"><?php echo $state->additional_note; ?></p>
                        <?php endif; ?>
                      </div>
                      <?php endif; ?>
                      */ ?>
                    </div>
                    <div class="resources m-all t-1of4 d-1of4">
                      <div class="m-1of2 t-all d-all">
                        <h4><?php echo $state->getTypeText(); ?> On</h4>
                        <p><?php echo $helper->formatDate($state->primary_date); ?></p>
                      </div>

                      <?php if ($state->hasRegistration()) {
    ?>
                      <div class="m-1of2 t-all d-all">
                        <h4>Register By</h4>
                        <p>
                          <?php if ($state->hasDeadlineDate()) {
        echo $helper->formatDate($state->deadline_date);
    } else {
        echo 'TBD';
    } ?>
                        </p>
                      </div>
                      <?php
} ?>

                      <?php if ($state->hasAffiliationDeadline()) {
        ?>
                      <div class="m-all t-all d-all">
                        <h4>Affiliate By</h4>
                        <p><?php echo $helper->formatDate($state->aff_deadline_date); ?></p>
                      </div>
                      <?php
    } ?>

                      <?php /* if ($state->hasSameDayRegistration()) {
        ?>
                      <p>Same-Day Registration!</p>
                      <?php
    } */ ?>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>

              <?php echo do_shortcode('[social_warfare]'); ?>
            </div>

            <?php // the_content();?>
          </div>
        </section>

        <?php // echo do_shortcode( '[contact-form-7 id="242" title="Submit Correction" html_class="submit-correction"]' );?>
        <?php // comments_template();?>

      </article>

      <?php endwhile; else : ?>

      <article id="post-not-found" class="hentry cf">
        <header class="article-header">
          <h1><?php _e('Oops, Post Not Found!', 'bonestheme'); ?></h1>
        </header>
        <section class="entry-content">
          <p><?php _e('Uh Oh. Something is missing. Try double checking things.', 'bonestheme'); ?></p>
        </section>
        <footer class="article-footer">
          <p><?php _e('This is the error message in the page-custom.php template.', 'bonestheme'); ?></p>
        </footer>
      </article>

      <?php endif; ?>

    </main>

    <?php // get_sidebar();?>

  </div>

</div>
<div class="to-map"><a href="#" title="Back to the map!">Back to top</a></div>

<?php get_footer(); ?>