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

date_default_timezone_set('America/New_York');
?>

<?php get_header(); ?>

<div class="schedule-page">


  <div>

    <main id="main" class="m-all t-all d-all cf" role="main" itemscope itemprop="mainContentOfPage"
      itemtype="http://schema.org/Blog">

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope
        itemtype="http://schema.org/BlogPosting">
        <header class="article-header">
          <h2 class="page-title">Primary <strong>Schedule</strong> and <strong>Deadlines</strong></h2>
        </header>

        <?php
/*
        <div class="map-container">
          <div id="vmap" class="schedule-map"></div>
        </div>
*/
?>


        <section class="entry-content cf" itemprop="articleBody">
          <div class="page-content">
            <div class="states wrap">
              <table class="state-table tablesorter tablesaw tablesaw-stack" data-tablesaw-mode="stack"
                data-sortlist="[[4,0]]">
                <thead>
                  <tr>
                    <th scope="col" data-tablesaw-priority="persist">State</th>
                    <th scope="col" data-tablesaw-priority="persist">type</th>
                    <th scope="col" data-tablesaw-priority="4">Affiliate By</th>
                    <th scope="col" data-tablesaw-priority="3">Register By</th>
                    <th scope="col" data-tablesaw-priority="2">Primary / Caucus Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($states as $state): ?>
                  <tr class="state-data <?php echo $state->state; ?>" data-code="<?php echo $state->state; ?>">
                    <td class="name"><a href="<?php echo esc_url(get_permalink($state->post)); ?>"
                        title="How to vote in <?php echo $state->getTitle(); ?>"
                        data-track="schedule,<?php echo $state->state; ?>"><?php echo $state->getTitle(); ?></a></td>
                    <td class="type"><?php echo $state->status; ?> <?php echo strtolower($state->getTypeText()); ?></td>
                    <td class="aff" data-text="<?php echo $helper->daysAway($state->aff_deadline_date); ?>"><?php if ($state->aff_deadline_date) {
    echo $helper->formatDate($state->aff_deadline_date);
} ?></td>
                    <td class="reg" data-text="<?php echo $helper->daysAway($state->deadline_date); ?>">
                      <?php echo $helper->formatDate($state->deadline_date); ?></td>
                    <td class="prim" data-text="<?php echo $helper->daysAway($state->primary_date); ?>">
                      <?php echo $helper->formatDate($state->primary_date); ?></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <?php echo do_shortcode('[social_warfare]'); ?>
            <p class="map-link np"><a href="<?php echo home_url(); ?>">Not registered to vote? <span>Find your
                  state!</span></a></p>
          </div>
        </section>

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

  </div>

</div>

<?php get_footer(); ?>