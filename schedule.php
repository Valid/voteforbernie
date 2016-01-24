<?php
/*
 Template Name: 2016 Democratic Primary Schedule
 *
*/

use VoteForBernie\Wordpress\Services\StateService;
use VoteForBernie\Wordpress\Helpers\VoteInfoHelper;
$stateService = new StateService();
$helper = new VoteInfoHelper();
$states = $stateService->getStatesByDate();
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
                    <div class="states wrap">
                    <?php // if(function_exists('add_social_button_in_content')) echo add_social_button_in_content(); ?>
                <table>
                  <tr>
                    <th>State</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Registration Deadline</th>
                    <th>Affiliation Deadline</th>
                    <th>To vote for Bernie:</th>
                  </tr>

                  <?php foreach ($states as $state): ?>


                    <tr>
                      <td><a href="<?php echo esc_url( get_permalink($state->post) ); ?>" title="How to vote in <?php echo $state->getTitle(); ?>" data-track="schedule,<?php echo $state->state; ?>"><?php echo $state->getTitle(); ?></a></td>
                      <td><?php echo $helper->formatDate($state->primary_date); ?></td>
                      <td><?php echo $state->status; ?> <?php echo $state->type; ?></td>
                      <td><?php echo $helper->formatDate($state->deadline_date); ?></td>
                      <td><?php if ($state->aff_deadline_date) { echo $helper->formatDate($state->aff_deadline_date); } ?></td>
                      <td><a href="<?php echo esc_url( get_permalink($state->post) ); ?>" data-track="scheduleBtn,<?php echo $state->state; ?>"><?php echo $helper->getActionText($state); ?><a/></td>
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
