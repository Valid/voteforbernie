<?php

// VoteForBernie includes
$vfb_includes = array(
  'lib/init.php',
  'lib/assets.php',
  'lib/models/post-model.php',
  'lib/models/state-model.php'
);

foreach ($vfb_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprtinf('Error locating %s for inclusion', $file), E_USER_ERROR);
  }
  require_once($filepath);
}

// cleanup global vars
unset($file, $filepath);
