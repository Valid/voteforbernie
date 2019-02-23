<?php
/*
 Template Name: We Want Debate Page
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header(); ?>

      <div id="content" class="debate-page">
        <div class="intro-text wrap">
          <p>The Democratic National Committee isn't playing fair. They've scheduled <strong>six debates</strong> between the 2016 Democratic Presidential Candidates, <strong>over 4 times fewer</strong> than the 26 held in the 2008 election cycle. This will severely limit voters' understanding of each candidate, especially those that aren't household names.</p>
          <p>To make matters worse, the DNC <strong>forbids</strong> candidates from participating in debates that are not organized by the DNC. This is <em>not about Bernie Sanders</em>. This is <em>not about Hillary Clinton</em>. This is about having <strong>well-informed voters</strong>, a cornerstone of democracy.</p>
          <p>Another cornerstone of democracy is <strong>getting involved</strong>!
          <br/>Make a difference right now by joining our #WeWantDebate campaign.</p>
          <p class="byline vcard">Last updated: <?php //the_modified_time(get_option('date_format')); ?>August 5, 2015</p>
        </div>

        <div id="inner-content" class="wrap cf">

            <main id="main" class="m-all t-all d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

              <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

              <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

                <header class="article-header">
                  <!-- <h1 class="page-title"><?php the_title(); ?></h1> -->

                </header>


                <section class="entry-content cf coming-soon" itemprop="articleBody">
                  <div class="page-content coming-soon m-all t-all d-all">
               <!-- <div class="section share-page">
                      <h2><span>Share this page</span></h2>
                      <?php //if(function_exists('add_social_button_in_content')) echo add_social_button_in_content(); ?>
                    </div>-->
<!--                <div class="clock-wrapper">
                      <div class="flip-counter clock"></div>
                      <p>This campaign starts on <strong>August 5th, 2015</strong>, at <strong>12:00PM PDT</strong>.</p>
                      <h4>Follow the steps below then come back on August 5th to tell the DNC that #WeWantDebate!</h4>
                    </div>
 -->
                    <div class="m-all t-1of2 d-1of2 section spread-word">
                      <h2><span>Step 1: Get the word out! <?php echo do_shortcode('[social_warfare]'); ?></span></h2>
                      <p>Retweet the below to let everyone know that the campaign is live, and that they can join us here.</p>
                      <blockquote class="twitter-tweet" data-link-color="#55acee">
                        <p>It has started! Let's tell @TheDemocrats that #WeWantDebate! Join thousands at http://voteforbernie.org/debate/ #FeelTheBern</p> — Vote For Bernie (@vote_for_bernie)
                        <a href="https://twitter.com/vote_for_bernie/status/628959240296595456">
                          August 5, 2015
                        </a>
                      </blockquote>
                      <p>Tweet one of the following, or <a href="https://twitter.com/intent/tweet?text=%23WeWantDebate+because+...+voteforbernie.org%2Fdebate%2F&amp;source=vote_for_bernie&amp;related=vote_for_bernie" target="_blank">write your own</a></p>
                      <a class="twitter-share" href="https://twitter.com/intent/tweet?text=%23WeWantDebate+because+%40TheDemocrats+shouldn%27t+be+able+to+decide+our+candidate+for+us%21+%40DWStweets+%40TulsiGabbard+voteforbernie.org%2Fdebate&amp;source=vote_for_bernie&amp;related=vote_for_bernie" target="_blank"><span>#WeWantDebate</span> because <span>@TheDemocrats</span> shouldn't be able to decide our candidate for us! <span>@DWStweets @TulsiGabbard voteforbernie.org/debate</span><em>Tweet This</em></a>
                      <a class="twitter-share" href="https://twitter.com/intent/tweet?text=%23WeWantDebate+because+6+is+not+enough!+In+the+2008+primary+there+were+26!+%40TheDemocrats+%40DWStweets+%40TulsiGabbard+voteforbernie.org%2Fdebate&amp;source=vote_for_bernie&amp;related=vote_for_bernie" target="_blank"><span>#WeWantDebate</span> because 6 is not enough! In the 2008 primary there were 26! <span>@TheDemocrats @DWStweets @TulsiGabbard voteforbernie.org/debate</span><em>Tweet This</em></a>
                      <a class="twitter-share" href="https://twitter.com/intent/tweet?text=%23WeWantDebate+because+...+voteforbernie.org%2Fdebate%2F&amp;source=vote_for_bernie&amp;related=vote_for_bernie" target="_blank"><span>#WeWantDebate</span> because <strong>[add your own reason]</strong> <span>voteforbernie.org/debate</span><em>Tweet This</em></a>
                      <ul>
                        <li>@TheDemocrats (DNC)</li>
                        <li>@DWStweets (DNC Chair, D Wasserman Schultz)</li>
                        <li>@TulsiGabbard (DNC Vice Chair, Tulsi Gabbard)</li>
                      </ul>

                    </div>
                    <div class="m-all t-1of2 d-1of2 section contact-dnc">
                      <h2><span>Step 2: Contact the DNC!</span></h2>
                      <p><strong>Call the DNC at (202) 863-8000</strong></p>
                      <p class="sample">Hello.<br/>My name is [Name] of [City, State] and I am calling the Democratic National Committee today regarding the upcoming Democratic primary debates. As of now, there are six primary debates planned; in the 2008 election cycle, there were twenty-six debates, which is over four times as many. I urge that the DNC increases the number of debates, as called for by Governor O'Malley and Senator Sanders, so that we may be better informed on the candidates. Thank you for your time.</p>
                      <p><strong>Send the DNC an email</strong> using their <a href="http://my.democrats.org/page/s/contact-the-democrats" target="_blank">official form</a></p>
                      <p class="sample">Dear Mrs. Wasserman Schultz,<br/><br/>
                        I am contacting you today in regards to the upcoming Democratic primary debates. As of now, there are six primary debates scheduled; in the 2008 election cycle, there were twenty-six debates, which shows a decrease in the number of debates by over four times. In an effort to become an informed voter, I feel I have exhausted my options for learning about each candidate's stances and opinions through their official campaign publications. However, seeing how candidates contrast each other when debating is a key part in deciding who to support. Six debates are far too few to make an informed decision about who should represent the Democratic Party in the 2016 general election, especially considering that these are the only debates in which the candidates can participate. I urge you to respect the requests of your supporters and of Senator Bernie Sanders and Governor Martin O'Malley by increasing the number of primary Democratic debates. The debates for the 2008 election cycle were fantastic as after twenty-six debates, I'm sure most can agree that the differences between the candidates were clear.<br/>
                        Thank you for representing the interests of the Democratic Party members.<br/><br/>
                        Sincerely,<br/>
                        [Name]
                      </p>
                    </div>

                    <div class="m-all t-all-d-all stay-involved">
                      <h2><span>Step 3: Stay involved!</span></h2>
<?php echo yksemeProcessSnippet( "2da18e85f7" , "Keep Me Informed!" ); ?>
                    </div>
                  </div>
                </section>


                <?php comments_template(); ?>

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

            <?php // get_sidebar(); ?>

        </div>

      </div>

<?php get_footer(); ?>
