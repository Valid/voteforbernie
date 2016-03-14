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
          <p>Bernie asked us to help with the political revolution</p>
          <p><strong>It's time to step it up.</strong></p>
          <h1 class="page-title">#<strong>Bern</strong>TheBallot</h1>

          <div class="gotv-countdown">
            <h4 class="page-title countdown-title">Countdown to <strong>March 15</strong></h4>
            <div class="soon" data-due="2016-03-15T08:18:06+00:00" data-now="<?php echo date("c"); ?>" data-face="flip corners-sharp color-dark" data-event-complete="today"></div>
          </div>
        </div>

      </div>

      <section class="entry-content cf wrap" itemprop="articleBody">
        <div class="m-all t-1of2 d-1of2">
          <p>The time has come for another #SuperTuesday. Five states and the Northern Mariana Islands are voting on March 15th, and <strong>we need every Bernie supporter around the country to help Get Out The Vote!</strong> We made history in Michigan last Tuesday because so many of us dedicated energy toward it. We can do the same this Tuesday, but <strong>there is still a lot of work to do!</strong>  Millions of dollars of SuperPAC money is flooding into these states for Hillary. Bernie doesn't have a SuperPAC, he has us - grassroots support. We are who Bernie is fighting for, let's do our part in getting others to the polls. Remember: <strong>When voter turnout is high, Bernie wins!</strong></p>

          <h3 class="page-title">Upcoming</h3>

          <p><em>Click each state to find out how to vote there</em></p>

          <strong>March 15th:</strong>
          <ul>
            <li><a href="http://voteforbernie.org/state/florida/" target="_blank" data-track="GOTV,Florida">Florida</a></li>
            <li><a href="http://voteforbernie.org/state/illinois/" target="_blank" data-track="GOTV,Illinois">Illinois</a></li>
            <li><a href="http://voteforbernie.org/state/missouri/" target="_blank" data-track="GOTV,Missouri">Missouri</a></li>
            <li><a href="http://voteforbernie.org/state/north-carolina/" target="_blank" data-track="GOTV,North Carolina">North Carolina</a></li>
            <li><a href="http://voteforbernie.org/state/ohio/" target="_blank" data-track="GOTV,Ohio">Ohio</a></li>
            <li><a href="https://vote.berniesanders.com/NMI/" target="_blank" data-track="GOTV,NMI">Northern Mariana Islands</a></li>
          </ul>


          <p>See the full <a href="http://voteforbernie.org/schedule" data-track="GOTV,schedule">primary schedule here</a>.</p>

          <p><strong>Democracy is not a spectator sport. Get Out The Vote!</strong></p>

        </div>
        <div class="m-all t-1of2 d-1of2">
          <blockquote class="twitter-tweet" data-link-color="#55acee">
            <p>March 15th is #SuperTuesday mk II<br><br>

5 states+1 territory at stake. EVERYONE should be helping GOTV!<br><br>

#BernTheBallot @ voteforbernie.org/GOTV</p> — Vote For Bernie (@vote_for_bernie)
            <a href="https://twitter.com/vote_for_bernie/status/709493461020377088" data-track="GOTV,ReTweet">
              March 14, 2016
            </a>
          </blockquote>
        </div>

        <div class="m-all t-all d-all">
          <?php if(function_exists('add_social_button_in_content')) echo add_social_button_in_content(); ?>


          <div class="content canvass">
            <h3 class="page-title">This is how we win:</h3>

            <div class="m-all t-1of2 d-1of2">
              <h3 class="page-title"><strong>Canvass</strong> for Bernie</h3>
              <p>If you live in or around any of the voting states, we need you to be physically knocking on doors if you're able. It's perhaps a bit old-fashioned, but it's effective.</p>
              <p>Get the <a href="https://fieldthebern.com/" data-track="GOTV,FieldTheBern" target="_blank">'FieldTheBern' app</a>, featuring information from both <a href="http://voteforbernie.org">VoteForBernie.org</a> and <a href="http://feelthebern.org/" target="_blank">FeelTheBern.org</a>. No experience required! The app walks you through everything you need to know, and you can canvass in your own neighborhood.</p>

              <p>In a voting state or willing to travel? <a href="https://go.berniesanders.com/page/s/bernie-journey" class="ui-btn cta" data-track="GOTV,BernieJourney">Go on a Bernie Journey!</a></p>

              <p><a href="https://fieldthebern.com/" class="ui-btn cta" data-track="GOTV,FieldTheBern" target="_blank">Get the 'Field The Bern' app</a></p>

            </div>
            <div class="m-all t-1of2 d-1of2">
              <a href="https://fieldthebern.com/" data-track="GOTV,FieldTheBernImg" target="_blank"><img src="http://voteforbernie.org/wp-content/uploads/2016/03/field-the-bern-app.png" alt="" /></a>
            </div>
          </div>
          <div class="content alt phonebank">
            <h3 class="page-title"><strong>Phonebank</strong> for Bernie</h3>
            <p>If you cannot canvass, the next best thing is phonebanking. All you have to do is call voters and let them know when and where they can vote, not convincing them to vote for Bernie. No experience necessary! If you're nervous or not sure where to start, there are <a href="http://organize.berniesanders.com/slack/callforbernie/" data-track="GOTV,callforbernie" target="_blank">experts standing by</a> to help you get started!</p>

            <p><a href="https://go.berniesanders.com/page/content/phonebank/" class="ui-btn cta" data-track="GOTV,Phonebank" target="_blank">Phonebank for Bernie</a></p>

            <a href="https://www.berniepb.com/" data=track="GOTV,BerniePBImg" target="_blank"><img src="http://voteforbernie.org/wp-content/uploads/2016/03/phonebank-for-bernie.gif" alt=""></a>

            <p>Track and gamify your phonebanking! <a href="https://www.berniepb.com/" class="ui-btn cta" data-track="GOTV,BerniePB" target="_blank">Track your calls with BerniePB!</a></p>
          </div>

          <div class="content facebank">
            <h3 class="page-title"><strong>Facebank</strong> for Bernie</h3>
            <p><strong>Are you on Facebook?</strong> A new tool created by grassroots supporters allows you to help remind people in voting states to vote in their primary, up to 500 a day! This is very effective if we all pitch in, and only takes a few minutes.</p>
            <p><a href="http://feelthebern.events/" class="ui-btn cta" data-track="GOTV,FacebankEvents" target="_blank">"Facebank" for Bernie</a></p>
          </div>

          <div class="content alt donate">
            <h3 class="page-title"><strong>Donate</strong> to Bernie</h3>
            <p>If you're <strong>unable to volunteer</strong>, consider contributing to Bernie's campaign. Bernie is the <strong>only Democratic candidate</strong> not using a Super PAC and relies on donations from us to support his campaign.</p>
            <p>Bernie's campaign has received <strong>over 4 million contributions so far!</strong> No other candidate has had this many contributions this early in the race! Let's break another record and get to 5,000,000. Donate!</p>
            <p><a href="https://secure.berniesanders.com/page/outreach/view/grassroots-fundraising/VFB" class="ui-btn cta" data-track="GOTV,Donate" target="_blank">Donate to Bernie's Campaign</a></p>
          </div>
          <div class="content volunteer">
            <h3 class="page-title"><strong>Volunteer</strong> for Bernie</h3>
            <p>The information contained on this page is general-use, but to be truly effective, you should sign up to be a volunteer for Bernie's campaign.</p>
            <p><a href="https://go.berniesanders.com/page/s/volunteer-for-bernie" class="ui-btn cta" data-track="GOTV,Volunteer" target="_blank">Join the revolution.</a></p>
          </div>
          <div class="content alt stay-informed">
            <h3 class="page-title"><strong>Stay informed!</strong></h3>
            <p>The primary season is well underway. Sign up to be reminded of deadlines in your state and other important information.</p>
            <?php echo yksemeProcessSnippet( "2da18e85f7" , "Keep me informed!" ); ?>
            <p>Did you know there is a community of over 100,000 Bernie supporters online?</p>
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
