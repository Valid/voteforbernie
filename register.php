<?php
/*
 Template Name: Register to Vote
 *
*/
?>

<?php get_header(); ?>

      <div class="register-page">


        <div>

            <main id="main" class="m-all t-all d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

              <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!--                 <header class="article-header">
                  <h2 class="page-title"><strong>Register</strong> to vote!</h2>
                </header> -->

                <iframe src="https://register2.rockthevote.com/registrants/map/?source=iframe&partner=29411" width="100%" height="1200" marginheight="0" frameborder="0"></iframe>

            <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

             <section class="entry-content cf" itemprop="articleBody">
               <div class="page-content">
                <div class="m-all t-all d-all sign-up-notice newsletter">
                  <p>Don't forget to vote!</p>
                  <p>After you register, you still need to vote in your state!</p>
                  <?php echo yksemeProcessSnippet( "2da18e85f7" , "Keep me informed!" ); ?>
                  <p class="map-link np"><a href="<?php echo home_url(); ?>">Don't know your deadlines? <span>Find your state!</span></a></p>
                  <?php echo do_shortcode('[social_warfare]'); ?>
                </div>
               </div>
             </section>

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

        </div>

      </div>

<?php get_footer(); ?>
