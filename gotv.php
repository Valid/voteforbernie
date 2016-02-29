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
        <h1 class="page-title">#<strong>Bern</strong>TheBallot</h1>
        <div class="state-select">
          <p>Bernie's campaign is unique. He doesn't have a Super PAC.</p>
          <p>He is relying on us, the young and working-class citizens of America to do something radical:</p>
          <h3>Get Out The Vote!</h3>

          <div class="gotv-countdown">
            <h4 class="page-title countdown-title">Countdown to <strong>Super Tuesday</strong></h4>
            <div class="soon" data-due="at 23:59" data-now="<?php echo date("c"); ?>" data-face="flip corners-sharp color-dark" data-event-complete="today"></div>
            <h4 class="page-title"><strong>March 1, 2016</strong></h4>
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
        <h3 class="page-title"><strong>What</strong> to do</h3>

          <div class="m-all t-1of2 d-1of2">
            <p>We need <strong>every able person</strong> to be helping get voter turnout up in Super Tuesday states. If you haven't volunteered yet, this is your chance. Bernie is fighting an uphill battle and needs the support of the grassroots community, and that means you.</p>
            <p>Super Tuesday states: <strong>Alabama, Arkansas, Colorado, Georgia, Massachusetts, Minnesota, Oklahoma, Tennessee, Texas, Virginia, Vermont, and American Samoa.</strong></p>
            <p><strong>Democracy is not a spectator sport.</strong></p>
          </div>
          <div class="m-all t-1of2 d-1of2">
            <blockquote class="twitter-tweet" data-link-color="#55acee">
              <p>Super Tuesday is TOMORROW. Let's #VoteTogether! Join the #BernTheBallot campaign at http://voteforbernie.org/GOTV #GOTV</p> — Vote For Bernie (@vote_for_bernie)
              <a href="https://twitter.com/vote_for_bernie/status/704378101141098496">
                February 29, 2016
              </a>
            </blockquote>
          </div>

          <?php if(function_exists('add_social_button_in_content')) echo add_social_button_in_content(); ?>
        <div class="content canvass">

          <h3>1. Canvas for Bernie</h3>
          <p>Tried and true. Knocking on doors has been the most effective method of Getting Out The Vote for a long time running. This is what everyone able <strong>should</strong> be doing. If you've never canvassed before, you're certainly not alone! You can receive training and instructions on where and how to canvass from a Bernie Sanders campaign office.</p>
          <p>In a Super Tuesday state and willing to knock on doors? <a href="http://map.berniesanders.com/go-the-distance/" class="ui-btn cta" data-track="GOTV,Canvas">Find your local office for Bernie</a></p>
          <p>Near a Super Tuesday state and willing to cross state lines? <a href="https://go.berniesanders.com/page/s/go-the-distance-for-bernie" class="ui-btn cta" data-track="GOTV,Canvas">Canvas for Bernie Out-Of-State</a></p>
        </div>
        <div class="content alt phonebank">
          <h3>2. Phonebank for Bernie</h3>
          <p>If you cannot canvas, the next best thing is phonebanking. All you have to do is call voters and let them know when and where they can vote. Training is provided!</p>
          <p><a href="https://go.berniesanders.com/page/content/phonebank" class="ui-btn cta" data-track="GOTV,Phonebank">Phonebank for Bernie</a></p>
        </div>
        <div class="content facebank">
          <h3>3. "Facebank" for Bernie</h3>
          <p>This is new... Facebook allows you to create very specific searches. In fact, you can search for everyone that has 'liked' Bernie Sanders (likely Bernie supporter) AND is your friend or friend of a friend AND is from a specific state. In this way, you can contact people who are Bernie supporters and remind them to vote!</p>
          <p><a href="http://berniefriendfinder.com/" class="ui-btn cta" data-track="GOTV,BernieFriendFinder">Facebank for Bernie</a></p>
        </div>

        <div class="content alt donate">
          <h3>4. Donate to Bernie</h3>
          <p>If you're unable to volunteer, consider giving a donation to Bernie's campaign. Bernie is the only Democratic candidate not using a SuperPac and relies on donations from us to support his campaign.</p>
          <p><a href="http://berniesanders.com/reddit" class="ui-btn cta" data-track="GOTV,Donate">Donate to Bernie's Campaign</a></p>
        </div>
        <div class="content stay-informed">
          <h3>5. Stay informed</h3>
          <p>The primary season is well underway. Sign up to be reminded of deadlines in your state and other important information.</p>
          <?php echo yksemeProcessSnippet( "2da18e85f7" , "Keep me informed!" ); ?>
          <p>Did you know there is a community of over 100,000 Bernie supporters online? Join us!</p>
          <p><a href="http://SandersForPresident.reddit.com" class="ui-btn cta" data-track="GOTV,Reddit">Join the Community</a></p>
        </div>

        <?php if(function_exists('add_social_button_in_content')) echo add_social_button_in_content(); ?>

        <p class="map-link np"><a href="<?php echo home_url(); ?>">Not registered to vote? <span>Find your state!</span></a></p>

        <h2 class="page-title">#WeStand<strong>Together</strong></h2>
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
