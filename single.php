<?php get_header(); ?>

<div id="content">
  <div id="inner-content" class="wrap cf">
    <main id="main" class="m-all t-all d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

          <header class="article-header entry-header">
            <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>
          </header>

          <section class="entry-content cf" itemprop="articleBody">
            <p class="byline entry-meta vcard">
            <?php echo 'Posted on <time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>:'; ?>
            </p>
            <?php
              the_content();
              // if(function_exists('add_social_button_in_content')) echo add_social_button_in_content();
              // echo yksemeProcessSnippet( "2da18e85f7" , "Keep me informed!" );
              ?>
          </section>
          <footer class="article-footer">
            <?php printf( __( 'filed under', 'bonestheme' ).': %1$s', get_the_category_list(', ') ); ?>
            <?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>
          </footer>
          <?php echo do_shortcode('[fbcomments]'); ?>
          <?php //comments_template(); ?>

        </article>


      <?php endwhile; ?>

      <?php else : ?>
        <article id="post-not-found" class="hentry cf">
            <header class="article-header">
              <h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
            </header>
            <section class="entry-content">
              <p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
            </section>
            <footer class="article-footer">
                <p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
            </footer>
        </article>
      <?php endif; ?>

    </main>
    <?php // get_sidebar(); ?>
  </div>
</div>
<?php get_footer(); ?>
