<?php

// VoteForBernie includes
$vfb_includes = array(
  'lib/init.php',
  'lib/assets.php',
  // 'lib/shortcodes.php',
  'lib/models/post-model.php',
  'lib/models/state-model.php',
  'lib/services/state-service.php',
  'lib/helpers/vote-info-helper.php',
  'lib/comments.php'
);

foreach ($vfb_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprtinf('Error locating %s for inclusion', $file), E_USER_ERROR);
  }
  require_once($filepath);
}

if( function_exists('acf_add_options_page') ) {

  acf_add_options_page(array(
    'page_title'  => 'Action Bar'
  ));

}

function daysAway($date) {
  $dateObj = strtotime($date);
  $diff = $dateObj - strtotime('now');
  $daysAway = floor($diff/60/60/24 + 1);

  $s = ($daysAway != 1 ? 's' : '');

  if ($daysAway == 0) {
    $fDate = 'today!';
  } else {
    $fDate = $daysAway . ' day' . $s;

    if ($diff < 0) {
      $fDate .= ' ago';
    } else {
      $fDate .= ' to go';
    }
  }

  return $fDate;
}

// cleanup global vars
unset($file, $filepath);
