<?php
/*
 Template Name: Deadline Information By State Page
 *
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


        <div>

            <main id="main" class="m-all t-all d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

              <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

              <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

                <header class="article-header">
                  <h1 class="page-title"><?php the_title(); ?></h1>
                </header>

                <section class="entry-content cf" itemprop="articleBody">
                  <div class="page-content">
                    <div class="states">
                    <?php // if(function_exists('add_social_button_in_content')) echo add_social_button_in_content(); ?>

                <table>
                  <tr>
                    <th>State</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Primary/Caucus Date</th>
                    <th>Registration Deadline Date</th>
                    <th>Affiliation Deadline Date</th>
                    <th>Early Voting Begins</th>
                    <th>Early Voting Ends</th>
                    <th>Absentee Ballot Request Deadline</th>
                    <th>Absentee Ballot Postmark Deadling</th>
                    <th>Absentee Excuse Required</th>
                    <th>Overseas Application Deadline</th>
                    <th>Overseas Postmark Deadline</th>
                  </tr>

                  <?php foreach ($states as $state): ?>


                    <tr>
                      <td><a href="<?php echo home_url(); ?>/wp-admin/post.php?post=<?php echo $state->post->ID; ?>&amp;action=edit"><?php echo $state->getTitle(); ?></a></td>
                      <td><?php echo $state->type; ?></td>
                      <td><?php echo $state->status; ?></td>
                      <td><?php echo $helper->formatDate($state->primary_date); ?></td>
                      <td><?php echo $helper->formatDate($state->deadline_date); ?></td>
                      <td><?php echo $helper->formatDate($state->aff_deadline_date); ?></td>
                      <td><?php echo $helper->formatDate($state->early_voting_start); ?></td>
                      <td><?php echo $helper->formatDate($state->early_voting_end); ?></td>
                      <td><?php echo $helper->formatDate($state->absentee_app_deadline); ?></td>
                      <td><?php echo $helper->formatDate($state->absentee_postmark_deadline); ?></td>
                      <td><?php if ($state->absenteeExcuseRequired()) { ?>yes<?php } else {?>no<?php } ?></td>
                      <td><?php echo $helper->formatDate($state->overseas_app_deadline); ?></td>
                      <td><?php echo $helper->formatDate($state->overseas_postmark_deadline); ?></td>
                    </tr>
                  <?php endforeach; ?>
                </table>
              </div>
             </div>
             </section>

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

        </div>

      </div>

<?php get_footer(); ?>
