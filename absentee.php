<?php
/*
 Template Name: Absentee Voting
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

                <iframe src="https://votebymail.longdistancevoter.org/?partner_key=d9666fe0a0b6013358af396eca8e5c5c" scrolling="auto" frameborder="0" width="100%" height="1000"></iframe>

            <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

             <section class="entry-content cf" itemprop="articleBody">
               <div class="page-content">
                <div class="m-all t-all d-all sign-up-notice newsletter">
                  <p>Stay informed!</p>
                  <p>Sign up to receive (very infrequent) voter alerts for your state</p>
                  <?php echo yksemeProcessSnippet( "2da18e85f7" , "Keep me informed!" ); ?>
                  <p class="map-link np"><a href="<?php echo home_url(); ?>">Don't know your deadlines? <span>Find your state!</span></a></p>
                  <?php if(function_exists('add_social_button_in_content')) echo add_social_button_in_content(); ?>
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
