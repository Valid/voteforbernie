<?php
  /* Template Name: Donate */
?>

<?php get_header(); ?>

<div class="gotv-page">

  <main id="main" role="main">


    <article>

      <div class="map-intro">
        <div class="state-select">
          <p>A campaign funded by folks like you and me</p>
          <p><strong>No billionaire donors. No super pacs.</strong></p>
          <h1 class="page-title"><strong>Just Us.</strong></h1>


          <p>Donate to Bernie's Campaign here:</p>
          <a href="https://secure.actblue.com/donate/voteforbernie?refcode=donate-page" rel="nofollow"
            title="Donate to Bernie 2020" class="ui-btn cta">Donate to Bernie's Campaign</a>
        </div>
        <div class="donate-vfb">
          <p>Donations using the above link <strong>do not</strong> benefit VoteForBernie.org, they go to Bernie
            Sander's 2020 campaign.</p>

          <p><strong>Can you help keep VoteForBernie.org running?</strong></p>
          <p>Please consider donating to VoteForBernie to keep help pay for the
            server, hosting, and email alerts that are required to keep this service running by using the button below.
          </p>

          <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_donations" />
            <input type="hidden" name="business" value="XEBTC8M7A6UCG" />
            <input type="hidden" name="item_name"
              value="Getting Out The Vote! Help us increase voter turnout in 2020" />
            <input type="hidden" name="currency_code" value="USD" />
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0"
              name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
            <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
          </form>
        </div>

      </div>

      <div class="m-all t-all">
        <div class="content alt stay-informed">
          <h3 class="page-title"><strong>Stay informed!</strong></h3>
          <p>Sign up to be reminded of deadlines in your state and other
            important information.</p>
          <?php if (function_exists('yksemeProcessSnippet')) {
    echo yksemeProcessSnippet('2da18e85f7', 'Keep me informed!');
} ?>
          <h2 class="page-title">#NotMe<strong>Us</strong></h2>
        </div>
      </div>
      </section>


      <?php echo do_shortcode('[social_warfare]'); ?>

      <p class="map-link np"><a href="<?php echo home_url(); ?>">Know how to vote? <span>Find your state!</span></a>
      </p>

    </article>

  </main>

</div>

<?php get_footer(); ?>