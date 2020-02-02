<?php
  /* Template Name: Free Stickers */
?>

<?php get_header(); ?>

<div class="stickers-page">

  <main id="main" role="main">


    <article>

      <div class="free-stickers">
        <div class="stickers-info">
          <p><strong>Help us keep the lights on and get</strong></p>
          <h1 class="page-title"><strong>Free Stickers!</strong></h1>
        </div>
      </div>
      <div class="donate-vfb">
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
          <input type="hidden" name="cmd" value="_donations" />
          <input type="hidden" name="business" value="XEBTC8M7A6UCG" />
          <input type="hidden" name="item_name" value="Getting Out The Vote! Help us increase voter turnout in 2020" />
          <input type="hidden" name="currency_code" value="USD" />
          <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0"
            name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
          <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
        </form>
        <p><strong>Can you help keep VoteForBernie.org running?</strong></p>
        <p>VoteForBernie has been funded out-of-pocket since 2015, helping over 3.5 million Americans register and vote
          in their primaries.</p>
        <p><strong>But now we need your help</strong> - The monthly cost of our "Voter Alerts" email that over 100,000
          people rely on as well as our server bandwidth have risen considerably as we've grown, and now we need your
          help.</p>
        <p>When you donate at least $10 (or $15 for international donations) to support VoteForBernie.org, we will send
          you 3 custom printed, high
          quality, die-cut stickers!</p>
        <img src="https://voteforbernie.org/wp-content/themes/voteforbernie/assets/images/vfb-stickers.jpg"
          alt="VoteForBernie.org Stickers" />
        <p>Be sure to select the option to share your address with us when making your donation so we know where to mail
          your stickers.</p>
        <p>Donate to VoteForBernie.org here:</p>
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
          <input type="hidden" name="cmd" value="_donations" />
          <input type="hidden" name="business" value="XEBTC8M7A6UCG" />
          <input type="hidden" name="item_name" value="Getting Out The Vote! Help us increase voter turnout in 2020" />
          <input type="hidden" name="currency_code" value="USD" />
          <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0"
            name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
          <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
        </form>
        <p>If you're wanting to donate to the official Bernie Sander's Campaign, you can <a
            href="https://secure.actblue.com/donate/voteforbernie?refcode=donate-page" rel="nofollow">donate using this
            link</a>.</p>


      </div>

      <?php echo do_shortcode('[social_warfare]'); ?>

      <p class="map-link np"><a href="<?php echo home_url(); ?>">Know how to vote? <span>Find your state!</span></a>
      </p>

    </article>

  </main>

</div>

<?php get_footer(); ?>