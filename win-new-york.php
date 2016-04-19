<?php
  /* Template Name: WinNewYork */
?>

<?php get_header(); ?>

<div class="gotv-page">

  <main id="main" class="m-all t-all d-all cf" role="main">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

      <div class="map-intro">
        <div class="state-select">
          <p>We've come a long way, friends</p>
          <p><strong>but it will take all of us to</strong></p>
          <h1 class="page-title">#<strong>WinNewYork</strong></h1>


          <div class="gotv-countdown">
            <h4 class="page-title countdown-title">New York Primary <strong>is today!</strong></h4>
            <!-- <div class="soon" data-due="2016-04-19T00:00:00+00:00" data-now="<?php echo date("c"); ?>" data-face="flip corners-sharp color-dark" data-event-complete="today"></div> -->
          </div>
        </div>

      </div>

      <section class="entry-content cf wrap" itemprop="articleBody">
        <div class="m-all t-all d-all">
          <?php the_content(); ?>


        </div>

        <div class="m-all t-all d-all">
          <div class="content canvass">
            <h3 class="page-title"><strong>This</strong> is how we win New York</h3>
            <p>They are saying we need around 200,000 votes to win. The deadline to register is already passed, so we're only focusing on registered Democrats. Some of them might be for Bernie, some might be for Hillary, but <strong>many of them</strong> won't know much about Bernie at all. Let's fix that!</p>
            <p><a href="http://feelthebern.org/" target="_blank" data-track="link,FTB">Learn Bernie's stances here</a> if you don't know them already.
            <p>Then follow the steps below to help Bernie!</p>

            <div class="m-all t-1of2 d-1of2">
              <h3 class="page-title"><strong>Canvass</strong> for Bernie</h3>
              <p>Live in New York, Connecticut, Maryland, Delaware, Pennsylvania, or Rhode Island? Find the nearest Bernie office and sign up to canvass! Person-to-person contact has been shown many times to be very effective at getting out the vote.</p>

              <p><a href="http://map.berniesanders.com/#zipcode=&distance=50&sort=time&f%5B%5D=campaign-office" class="ui-btn cta" data-track="winny,map">Locate nearest Bernie office</a></p>


              <p>Want to get started right now? Grab the <a href="https://fieldthebern.com/" data-track="winny,FieldTheBern" target="_blank">'FieldTheBern' app</a>. No experience required! The app walks you through everything you need to know!</p>

            </div>
            <div class="m-all t-1of2 d-1of2">
              <a href="https://fieldthebern.com/" data-track="winny,FieldTheBernImg" target="_blank"><img src="http://voteforbernie.org/wp-content/uploads/2016/03/field-the-bern-app.png" alt="" /></a>
            </div>
          </div>
          <div class="content alt phonebank">
            <h3 class="page-title"><strong>Phonebank</strong> for Bernie</h3>
            <p>If you cannot canvass, the next best thing is phonebanking. We've made over 230,000 calls into New York already, join up!

            <p><a href="https://go.berniesanders.com/page/content/phonebank/" class="ui-btn cta" data-track="winny,Phonebank" target="_blank">Phonebank for Bernie</a></p>

            <a href="https://www.berniepb.com/" data-track="winny,BerniePBImg" target="_blank"><img src="http://voteforbernie.org/wp-content/uploads/2016/03/phonebank-for-bernie.gif" alt=""></a>

            <p>Don't forget to connect with BerniePB to track your calls! <a href="https://www.berniepb.com/" class="ui-btn cta" data-track="winny,BerniePB" target="_blank">Track your calls with BerniePB</a></p>
          </div>

          <div class="content facebank">
            <h3 class="page-title"><strong>Facebank</strong> for Bernie</h3>
            <p><strong>Are you on Facebook?</strong> A new tool created by grassroots supporters allows you to help remind people in voting states to vote in their primary, up to 500 a day! This is very effective if we all pitch in, and only takes a few minutes.</p>
            <p><a href="http://berniefriendfinder.com/" class="ui-btn cta" data-track="winny,BernieFriendFinder" target="_blank">"Facebank" for Bernie</a></p>
          </div>

          <div class="content alt donate">
            <h3 class="page-title"><strong>Donate</strong> to Bernie</h3>
            <p>If you're <strong>unable to volunteer</strong>, consider contributing to Bernie's campaign. Bernie is the <strong>only Democratic candidate</strong> not using a Super PAC and relies on donations from us to support his campaign.</p>
            <p>Bernie's campaign has received <strong>over 4 million contributions so far!</strong> No other candidate has had this many contributions this early in the race! Let's break another record and get to 5,000,000. Donate!</p>
            <p><a href="https://secure.berniesanders.com/page/outreach/view/grassroots-fundraising/VFB" class="ui-btn cta" data-track="winny,Donate" target="_blank">Donate to Bernie's Campaign</a></p>
          </div>
          <div class="content volunteer">
            <h3 class="page-title"><strong>Volunteer</strong> for Bernie</h3>
            <p>The information contained on this page is general-use, but to be truly effective, you should sign up to be a volunteer for Bernie's campaign.</p>
            <p><a href="https://go.berniesanders.com/page/s/volunteer-for-bernie" class="ui-btn cta" data-track="winny,Volunteer" target="_blank">Join the revolution.</a></p>
          </div>

          <div class="content alt stay-informed">
            <h3 class="page-title"><strong>Stay informed!</strong></h3>
            <p>The primary season is well underway. Sign up to be reminded of deadlines in your state and other important information.</p>
            <?php echo yksemeProcessSnippet( "2da18e85f7" , "Keep me informed!" ); ?>
            <p>Did you know there is a community of over 100,000 Bernie supporters online?</p>
            <p><a href="http://SandersForPresident.reddit.com" class="ui-btn cta" data-track="winny,Reddit" target="_blank">Join the Conversation</a></p>
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
