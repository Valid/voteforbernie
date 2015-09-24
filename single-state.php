<?php
  use VoteForBernie\Wordpress\Models\StateModel;
  get_header();
  global $post;
  $state = new StateModel($post);
?>

<pre>
  <?php print_r($state); ?>
</pre>

<?php get_footer(); ?>
