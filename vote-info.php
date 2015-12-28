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
          <ul class="legend">
            <li class="closed" data-type="closed">Closed Primary</li>
            <li class="open" data-type="open">Open Primary</li>
            <li class="closed-caucus" data-type="closed-caucus">Closed Caucus</li>
            <li class="open-caucus" data-type="open-caucus">Open Caucus</li>
            <li class="other" data-type="other">Other</li>
          </ul>
          <div class="explanation-container">
            <ul class="explanations">
              <li class="closed active">Voters in Closed Primary states <strong>must</strong> register as Democrat to vote for Bernie</li>
              <li class="open">Voters in Open Primary states can vote for Bernie regardless of political affiliation</li>
              <li class="closed-caucus">Voters in Closed Caucus states <strong>must</strong> affiliate as Democrat to vote for Bernie</li>
              <li class="open-caucus">Voters in Open Caucus states can vote for Bernie regardless of political affiliation</li>
              <li class="other">Semi-Open? Semi-Closed? Click your state to find out how to vote for Bernie Sanders</li>
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


        <div class="inner-content">

            <main id="main" class="m-all t-all d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

              <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

              <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

                <header class="article-header">
                  <h1 class="page-title"><?php the_title(); ?></h1>
                  <p><?php the_content(); ?></p>
                  <div class="sign-up-notice newsletter">
                    <p>Dates and deadlines can change at any time.</p>
                    <p>Sign up to be reminded of deadlines and important changes in your state</p>
                    <?php echo yksemeProcessSnippet( "2da18e85f7" , "Keep me informed!" ); ?>
                    <p class="tentative">Last updated on <?php echo $mostRecentStateUpdate ?>.</p>

                    <div class="one-percent-here-i-come">
                      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                      <!-- Below The Newsletter -->
                      <ins class="adsbygoogle"
                           style="display:block"
                           data-ad-client="ca-pub-3203899049474789"
                           data-ad-slot="8132117151"
                           data-ad-format="auto"></ins>
                      <script>
                      (adsbygoogle = window.adsbygoogle || []).push({});
                      </script>
                    </div>
                  </div>
                </header>

                <section class="entry-content cf" itemprop="articleBody">
                  <div class="page-content">
                    <div class="states">
                    <?php // if(function_exists('add_social_button_in_content')) echo add_social_button_in_content(); ?>

                  <?php foreach ($states as $state): ?>

                  <div id="state-<?php echo $state->state; ?>"
                        class="state state-info <?php echo $state->state; ?> <?php echo $helper->getStatusClass($state); ?>" data-type="<?php echo explode(' ', $helper->getStatusClass($state))[0]; ?>" data-code="<?php echo $state->state; ?>">

                    <div class="state-wrapper cf">

                      <div class="m-all t-all d-all">
                        <div class="state-title">
                          <h3><a href="<?php echo esc_url( get_permalink($state->post) ); ?>" data-track="stateTitle,<?php echo $state->state; ?>"><?php echo $state->getTitle(); ?></a></h3>
                          <img class="svg" data-src="<?php echo get_template_directory_uri(); ?>/dist/images/svg/states/<?php echo $state->state; ?>.svg"/>
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
                            <!-- <a href="<?php echo esc_url( get_permalink($state->post) ); ?>" data-track="actTxt,<?php echo $state->state; ?>">
                            <?php echo strtolower($helper->getActionText($state)); ?></a> to vote for Bernie. -->
                          <a class="ui-btn" href="<?php echo esc_url( get_permalink($state->post) ); ?>" data-track="actBtn,<?php echo $state->state; ?>">
                          <?php echo $helper->getActionText($state); ?></a>


                          <?php if ($state->under_18 || $state->hasAdditionalNote()): ?>
                            <div class="extra">
                              <?php if ($state->under_18): ?>
                                <p class="only17"><strong>Only 17?</strong> If you will be 18 by November 8, 2016, you can vote in the <?php echo $state->type; ?>!</p>
                              <?php endif; ?>
                              <?php if ($state->hasAdditionalNote()): ?>
                                <p class="note"><?php echo $state->additional_note; ?></p>
                              <?php endif; ?>
                            </div>
                          <?php endif; ?>
                        </div>

                        <div class="resources m-all t-1of4 d-1of4">
                          <div class="m-1of2 t-all d-all">
                            <h4><?php echo $state->getTypeText(); ?> On</h4>
                            <p><?php echo $helper->formatDate($state->primary_date); ?></p>
                          </div>

                          <div class="m-1of2 t-all d-all">
                            <h4>Register By</h4>
                            <p><?php echo $helper->formatDate($state->deadline_date); ?></p>
                          </div>

                          <?php if ($state->hasAffiliationDeadline()) { ?>
                            <div class="m-all t-all d-all">
                              <h4>Affiliate By</h4>
                              <p><?php echo $helper->formatDate($state->aff_deadline_date); ?></p>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>

                  <?php if(function_exists('add_social_button_in_content')) echo add_social_button_in_content(); ?>
                  </div>

                    <?php // the_content(); ?>
                  </div>
                </section>

                <?php // echo do_shortcode( '[contact-form-7 id="242" title="Submit Correction" html_class="submit-correction"]' ); ?>
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
      <div class="to-map"><a href="#" title="Back to the map!">Back to top</a></div>

<?php get_footer(); ?>
