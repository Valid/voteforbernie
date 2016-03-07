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

      <div class="map-intro">
        <div class="state-select">
          <p>We all <strong>#FeelTheBern</strong>, but feelings don't win elections</p>
          <p>Elections are won with votes, and our job is to Get Out The Vote</p>
          <p><strong>When voter turnout is high, Bernie wins.</strong></p>
          <h1 class="page-title">#<strong>Vote</strong>TheBern</h1>

          <div class="gotv-countdown">
            <h4 class="page-title countdown-title">Countdown to <strong>March 8</strong></h4>
            <div class="soon" data-due="2016-03-08T08:18:06+00:00" data-now="<?php echo date("c"); ?>" data-face="flip corners-sharp color-dark" data-event-complete="today"></div>
            <h4 class="page-title"><strong>Michigan</strong> and <strong>Mississippi</strong></h4>
          </div>
          <!--
          <p>What do to? <span class="no-mobile">your state by clicking it or</span>
            <select class="state-selector">
              <option>Select Your State</option>
              <?php foreach ($states as $state): ?>
                <option value="<?php echo $state->state; ?>"><?php echo $state->getTitle(); ?></option>
              <?php endforeach; ?>
            </select>
          </p> -->
          <!-- <p class="map-link np"><a href="<?php echo home_url(); ?>">Not registered to vote? <span>Find your state!</span></a></p> -->
        </div>

      </div>

      <section class="entry-content cf wrap" itemprop="articleBody">
        <div class="m-all t-1of2 d-1of2">
          <p>Yuuuuge 29-point victory in Maine! Victory in Kansas and Nebraska, too! Do you know what these states had in common? <strong>Voter turnout was high!</strong> Bernie has lost states, too. Do you know what those states had in common? <strong>Voter turnout was low!</strong> If we are going to win Michigan, it's clear what needs to happen. In every state where Bernie has won, there has been a concerted effort by ground-forces to Get Out The Vote all around the state, and <em>we need to do the same for Michigan!</em></p>

          <h3 class="page-title"><strong>Upcoming</strong> elections</h3>

          <p><em>Click each state to find out how to vote there!</em></p>

          <strong>March 8th:</strong>
            <li><a href="http://voteforbernie.org/state/michigan/" target="_blank" data-track="GOTV,Michigan">Michigan</a></li>
            <li><a href="http://voteforbernie.org/state/mississippi/" target="_blank" data-track="GOTV,Mississippi">Mississippi</a></li>
          <ul>

          </ul>

          <strong>March 1st-8th:</strong>
          <ul>
            <li><a href="http://voteforbernie.org/state/democrats-abroad/" target="_blank" data-track="GOTV,DemsAbroad">Democrats Abroad</a></li>
          </ul>

          <p>See the full <a href="http://voteforbernie.org/schedule" data-track="GOTV,schedule">primary schedule here</a>.</p>

          <p><strong>Democracy is not a spectator sport. Get Out The Vote!</strong></p>

        </div>
        <div class="m-all t-1of2 d-1of2">
          <blockquote class="twitter-tweet" data-link-color="#55acee">
            <p>The #PoliticalRevolution requires high voter turnout. It's up to us to #GetOutTheVote<br><br>

            Maine is voting TODAY! #GOTV @<br><br>

            http://voteforbernie.org/GOTV/</p> — Vote For Bernie (@vote_for_bernie)
            <a href="https://twitter.com/vote_for_bernie/status/706396217345855488"  data-track="GOTV,ReTweet">
              March 1, 2016
            </a>
          </blockquote>
        </div>

        <div class="m-all t-all d-all">
          <?php if(function_exists('add_social_button_in_content')) echo add_social_button_in_content(); ?>


          <div class="content canvass">
            <h3 class="page-title">This is how we win:</h3>

            <div class="m-all t-1of2 d-1of2">
              <h3 class="page-title"><strong>Canvass</strong> for Bernie</h3>
              <p>Tried and true: Knocking on doors has been the most effective method of Getting Out The Vote since forever. Everyone able should be canvassing like the election depends on it, <strong>because it does!</strong> If you've never canvassed before, you're certainly not alone. You can receive training and instructions on where and how to canvass from a Bernie Sanders campaign office.</p>

              <h3 class="page-title"><strong>New!</strong></h3>

              <p>Have an iPhone or Android device? Use the <strong>Field the Bern</strong> app to easily start canvassing for Bernie. Includes instructions for how to canvass and integrates data from <a href="http://voteforbernie.org">VoteForBernie.org</a> and <a href="http://feelthebern.org/">FeelTheBern.org</a>.</p>
              <a href="https://fieldthebern.com/" class="ui-btn cta" data-track="GOTV,FieldTheBern">Get the 'Field The Bern' app</a>
              <p>Willing to travel?</p>
              <a href="https://go.berniesanders.com/page/content/gtd/" class="ui-btn cta" data-track="GOTV,GTD">Go the Distance for Bernie</a>
            </div>
            <div class="m-all t-1of2 d-1of2">
              <a href="https://fieldthebern.com/" data-track="GOTV,FieldTheBernImg"><img src="http://voteforbernie.org/wp-content/uploads/2016/03/field-the-bern-app.png" alt="" /></a>
            </div>
          </div>
          <div class="content alt phonebank">
            <h3 class="page-title"><strong>Phonebank</strong> for Bernie</h3>
            <p>If you cannot canvass, the next best thing is phonebanking. All you have to do is call voters and let them know when and where they can vote. Training is provided!</p>
            <p><a href="https://go.berniesanders.com/page/content/phonebank" class="ui-btn cta" data-track="GOTV,Phonebank">Phonebank for Bernie</a></p>
          </div>
          <div class="content facebank">
            <h3 class="page-title"><strong>Facebank</strong> for Bernie</h3>
            <p>This is new... Facebook allows you to create very specific searches. In fact, you can search for everyone that has 'liked' Bernie Sanders (likely Bernie supporter) AND is your friend or friend of a friend AND is from a specific state. In this way, you can contact people who are Bernie supporters and remind them to vote!</p>
            <p><a href="http://berniefriendfinder.com/" class="ui-btn cta" data-track="GOTV,BernieFriendFinder">"Facebank" for Bernie</a></p>
          </div>

          <div class="content alt donate">
            <h3 class="page-title"><strong>Donate</strong> to Bernie</h3>
            <p>If you're unable to volunteer, consider giving a donation to Bernie's campaign. Bernie is the only Democratic candidate not using a Super PAC and relies on donations from us to support his campaign.</p>
            <?php echo wp_oembed_get('https://www.youtube.com/watch?v=50ZItA-vc9I'); ?>
            <p><strong>Over $40 Million Donated in February!</strong> We blew past the $40,000,000 goal for February, more than double what we raised in in January. Let's break some new records and keep donating!</p>
            <div class="inner-section">
              <a href="https://secure.berniesanders.com/page/outreach/view/grassroots-fundraising/VFB" data-track="GOTV,DonateImg"><img src="https://go.berniesanders.com/page/contribute_c/40m/graphic?todays-goal" alt=""></a>
            </div>
            <p><a href="https://secure.berniesanders.com/page/outreach/view/grassroots-fundraising/VFB" class="ui-btn cta" data-track="GOTV,Donate">Donate to Bernie's Campaign</a></p>
          </div>
          <div class="content volunteer">
            <h3 class="page-title"><strong>Volunteer</strong> for Bernie</h3>
            <p>Bernie needs to know where his support base is, so it is important to sign up as a volunteer with the official Bernie Sanders campaign.</p>
            <p><a href="https://secure.berniesanders.com/page/outreach/view/grassroots-fundraising/VFB" class="ui-btn cta" data-track="GOTV,Volunteer">Sign up as a volunteer</a></p>
          </div>
          <div class="content alt stay-informed">
            <h3 class="page-title"><strong>Stay informed!</strong></h3>
            <p>The primary season is well underway. Sign up to be reminded of deadlines in your state and other important information.</p>
            <?php echo yksemeProcessSnippet( "2da18e85f7" , "Keep me informed!" ); ?>
            <p>Did you know there is a community of over 100,000 Bernie supporters online?</p>
            <p><a href="http://SandersForPresident.reddit.com" class="ui-btn cta" data-track="GOTV,Reddit">Join the Conversation</a></p>
            <h2 class="page-title">#WeStand<strong>Together</strong></h2>
          </div>

          <?php if(function_exists('add_social_button_in_content')) echo add_social_button_in_content(); ?>

          <p class="map-link np"><a href="<?php echo home_url(); ?>">Not registered to vote? <span>Find your state!</span></a></p>
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
