<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7 wf-loading"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 wf-loading"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 wf-loading"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js wf-loading"><!--<![endif]-->

<head>
  <meta charset="utf-8">

  <?php // force Internet Explorer to use the latest rendering engine available ?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title><?php wp_title(''); ?></title>

  <?php // mobile meta (hooray!) ?>
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width, initial-scale=1"/>

  <style type="text/css">.wf-loading { opacity: 0; } .no-js.wf-loading { opacity: 1; pointer-events: initial; } .no-js.wf-loading:before { background: none; pointer-events: none; } .no-js .nav { max-height: none!important} .no-js .inner-content { opacity: 1; }</style>
  <script>document.documentElement.className = document.documentElement.className.replace('no-js', 'js');</script>

  <!-- Optimizely A/B testing snippet -->
  <script src="//cdn.optimizely.com/js/3517780176.js"></script>

  <?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
  <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/dist/images/icons/apple-touch-icon.png">
  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/dist/images/icons/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/dist/images/icons/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/dist/images/icons/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/dist/images/icons/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/dist/images/icons/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/dist/images/icons/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/dist/images/icons/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/dist/images/icons/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/dist/images/icons/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri(); ?>/dist/images/icons/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/dist/images/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/dist/images/icons/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/dist/images/icons/favicon-16x16.png">

  <link rel="manifest" href="/manifest.json">
    <!--[if IE]>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
    <![endif]-->
    <?php // or, set /favicon.ico for IE10 win ?>
    <meta name="msapplication-TileColor" content="#323944">
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/dist/images/icons/win8-tile-icon.png">
    <meta name="theme-color" content="#323944">

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">


    <?php // wordpress head functions ?>
    <?php wp_head(); ?>
    <?php // end of wordpress head ?>


    <?php // drop Google Analytics Here ?>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-64072805-1', 'auto');
      ga('send', 'pageview');

    </script>

    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '1615439018737096',
          xfbml      : true,
          version    : 'v2.4'
        });
      };

      (function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement(s); js.id = id;
       js.src = "//connect.facebook.net/en_US/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
   </script>

   <script>window.twttr = (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
    if (d.getElementById(id)) return t;
    js = d.createElement(s);
    js.id = id;
    js.src = "https://platform.twitter.com/widgets.js";
    fjs.parentNode.insertBefore(js, fjs);

    t._e = [];
    t.ready = function(f) {
      t._e.push(f);
    };

    return t;
    }(document, "script", "twitter-wjs"));</script>
  <?php // end analytics ?>
  </head>

  <body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
    <div id="fb-root"></div>
    <div class="container">
      <div class="header-wrapper">
        <header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">
          <div class="action-bar np">
            <?php // TODO: Pull from ACF ?>
            <?php // <strong>VoteForBernie Facelift &mdash;</strong> New look, new content, same goal: <strong>Get Out The Vote!</strong> <a href="/alerts/voteforbernie-two-point-oh">See What's New</a> ?>
            <?php // <strong>WE DID IT! &mdash;</strong> $1,000,000 raised for Bernie by the grassroots community! <a href="http://berniesanders.com/reddit" data-track="CTA,1mdonate">Donate to Bernie!</a> ?>
            <?php // <strong>#NotMeUs &mdash;</strong> echo daysAway('Feb 9, 2016') for New Hampshire! <a href="https://secure.berniesanders.com/page/outreach/view/grassroots-fundraising/VFB" data-track="ActionBar,nhDonate">Donate to Bernie</a> ?>
            <strong>#IowaCaucus &mdash;</strong> CNN Says Bernie Supporters will BREAK THE INTERNET with donations. PROVE THEM RIGHT <a href="https://secure.berniesanders.com/page/outreach/view/grassroots-fundraising/VFB" data-track="CTA,cnnDonate">Donate to Bernie!</a>
            <div class="fb-like vfb-like" data-href="http://voteforbernie.org/" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
          </div>
          <div id="inner-header" class="branding wrap">

            <h1 id="logo" class="h1" title="VoteForBernie.org" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo home_url(); ?>">VoteForBernie</a></h1>
            <a href="#" class="nav-toggle">
              <span>Expand Navigation</span>
              <span></span>
              <span></span>
            </a>
            <nav role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">


            <?php wp_nav_menu(array(
                       'container' => false,
                       'container_class' => 'menu cf',
                       'menu_class' => 'nav top-nav cf',
                       'theme_location' => 'header',
                       'before' => '',
                       'after' => '',
                       'link_before' => '',
                       'link_after' => ''
            )); ?>

            </nav>
          </div>
        </header>
      </div>
