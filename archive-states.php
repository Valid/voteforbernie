<?php
  use VoteForBernie\Wordpress\Models\StateModel;
  get_header();
  global $post;
?>
<?php while(have_posts()) : the_post(); ?>
  <?php $state = new StateModel($post);?>
  <pre>
    <?php print_r($state); ?>
  </pre>
<?php endwhile; ?>

<?php get_footer(); ?>
