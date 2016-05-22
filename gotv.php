<?php
  /* Template Name: GOTV */

  use VoteForBernie\Wordpress\Services\StateService;
  use VoteForBernie\Wordpress\Helpers\VoteInfoHelper;
  $stateService = new StateService();
  $helper = new VoteInfoHelper();
  $states = $stateService->getStates(); ?>

<?php get_header(); ?>

<div class="gotv-page">

  <main id="main" class="m-all t-all d-all cf" role="main">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

      <div class="map-intro vote-info">
        <div class="state-select">
          <!-- <p>The Revolution Is Calling. <strong>This is how we win.</strong></p> -->
<!--           <h2 class="page-title">The revolution is <strong>calling</strong></h2> -->

          <div class="gotv-countdown">
            <h4 class="page-title countdown-title"><strong>Countdown to Cali</strong></h4>
            <div class="soon" data-due="2016-05-23T23:00:00-08:00" data-now="<?php echo date("c"); ?>" data-face="flip corners-sharp color-dark" data-event-complete="today"></div>
            <p>California's registration deadline is on May 23rd &mdash; Get the word out!</p>
            <p><a href="http://voteforbernie.org/state/california/" class="ui-btn cta" data-track="GOTV,CAPage" target="_blank">See California's Information</a></p>
          </div>
        </div>
        <ul class="legend">
          <li class="closed" data-type="l-canvass">Canvass</li>
          <li class="open" data-type="l-phonebank">Phonebank</li>
        </ul>
        <div class="explanation-container">
          <ul class="explanations">
            <li class="l-canvass active">Find your local Bernie office and start knocking on doors!</li>
            <li class="l-phonebank">Start calling states that are voting soon!</li>
          </ul>
        </div>
      </div>

      <div class="map-container">
<script>
var statesData = {
<?php foreach ($states as $state): ?>
<?php echo $state->state; ?>: {
  name: '<?php echo $state->getTitle(); ?>',
  primaryDaysAway: '<?php echo $helper->daysAway($state->primary_date); ?>',
  registerDaysAway: '<?php echo $helper->daysAway($state->deadline_date); ?>'
},
<?php endforeach; ?>
}
</script>
        <div id="vmap" class="gotv-map"></div>
      </div>

      <section class="entry-content cf wrap" itemprop="articleBody">

        <div class="m-all t-all d-all">
          <?php if(function_exists('add_social_button_in_content')) echo add_social_button_in_content(); ?>


          <div class="content canvass">
            <h3 class="page-title"><strong>Canvass</strong> for Bernie</h3>
            <p>If you live in any of the action states, we need you to be physically knocking on doors if you're able!</p>

            <p>In a voting state or willing to travel?</p>
            <p><a href="http://map.berniesanders.com/#zipcode=&distance=50&sort=time&f%5B%5D=campaign-office&f%5B%5D=canvassing" class="ui-btn cta" data-track="GOTV,BernieJourney">Connect with the nearest Bernie office!</a></p>
          </div>
          <div class="content alt phonebank">
            <h3 class="page-title"><strong>Phonebank</strong> for Bernie</h3>
            <p>We need your help hitting our daily phonebanking goals! Never done it before? No problem! Live chat is provided for assistance.</p>

            <p>Ready to help?</p>

            <p><a href="https://go.berniesanders.com/page/content/phonebank" class="ui-btn cta" data-track="GOTV,BerniePB" target="_blank">Start phonebanking now!</a></p>
          </div>

          <div class="content facebank">
            <h3 class="page-title"><strong>Facebank</strong> for Bernie</h3>
            <p><strong>Are you on Facebook?</strong> A new tool created by grassroots supporters allows you to help remind people in voting states to vote in their primary, up to 500 a day! This is very effective if we all pitch in, and only takes a few minutes.</p>
            <p><a href="http://berniefriendfinder.com/" class="ui-btn cta" data-track="GOTV,BernieFriendFinder" target="_blank">"Facebank" for Bernie</a></p>
          </div>

          <div class="content alt donate">
            <h3 class="page-title"><strong>Donate</strong> to Bernie</h3>
            <p>If you're <strong>unable to volunteer</strong>, consider contributing to Bernie's campaign. Bernie is the <strong>only Democratic candidate</strong> not using a Super PAC and relies on donations from us to support his campaign.</p>
            <p><a href="https://secure.berniesanders.com/page/outreach/view/grassroots-fundraising/VFB" class="ui-btn cta" data-track="GOTV,Donate" target="_blank">Donate to Bernie's Campaign</a></p>
          </div>
          <div class="content follow">
            <h3 class="page-title"><strong>Volunteer</strong> for Bernie</h3>
            <p>The information contained on this page is general-use, but to be truly effective, you should sign up to be a volunteer for Bernie's campaign.</p>
            <p><a href="https://go.berniesanders.com/page/s/volunteer-for-bernie" class="ui-btn cta" data-track="GOTV,Volunteer" target="_blank">Join the revolution.</a></p>
          </div>
          <div class="content alt stay-informed">
            <h3 class="page-title"><strong>Stay informed!</strong></h3>
            <p>The primary season is well underway. Sign up to be reminded of deadlines in your state and other important information.</p>
            <?php echo yksemeProcessSnippet( "2da18e85f7" , "Keep me informed!" ); ?>
            <p>Did you know there is a community of over 230,000 Bernie supporters online?</p>
            <p><a href="http://SandersForPresident.reddit.com" class="ui-btn cta" data-track="GOTV,Reddit" target="_blank">Join the Conversation</a></p>
            <h2 class="page-title">#WeStand<strong>Together</strong></h2>
          </div>

          <?php if(function_exists('add_social_button_in_content')) echo add_social_button_in_content(); ?>

          <p class="map-link np"><a href="<?php echo home_url(); ?>">Know how to vote? <span>Find your state!</span></a></p>
        </div>
      </section>

    </article>

    <?php endwhile; else : ?>

    <article id="post-not-found" class="hentry cf">
      <header class="article-header">
        <h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
      </header>
      <section class="entry-content">
        <p>
          <?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?>
        </p>
      </section>
      <footer class="article-footer">
        <p>
          <?php _e( 'This is the error message in the page-custom.php template.', 'bonestheme' ); ?>
        </p>
      </footer>
    </article>

    <?php endif; ?>

  </main>

</div>

<?php get_footer(); ?>
