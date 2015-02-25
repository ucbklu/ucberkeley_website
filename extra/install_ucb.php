<?php
/**
 * @file
 * Initiates an automated browser-based installation of Drupal provided that
 * all required url paramters are present.
 */

/**
 * Defines the root directory of the Drupal installation.
 */
define('DRUPAL_ROOT', getcwd());

/**
 * Global flag to indicate the site is in installation mode.
 */
define('MAINTENANCE_MODE', 'install');

// Exit early if running an incompatible PHP version to avoid fatal errors.
if (version_compare(PHP_VERSION, '5.2.4') < 0) {
  print 'Your PHP installation is too old. Drupal requires at least PHP 5.2.4. See the <a href="http://drupal.org/requirements">system requirements</a> page for more information.';
  exit;
}

if (count($_REQUEST)) {
// Start the installer.
  require_once DRUPAL_ROOT . '/includes/install.core.inc';
  set_time_limit(0); // This will take a while...
  $settings = $_REQUEST;
  array_walk_recursive($settings, 'our_urldecode');
  // don't use the pass that we sent insecurely
  $settings['forms']['install_configure_form']['account']['pass'] = drush_generate_password();
  install_drupal($settings);
}

function our_urldecode(&$value) {
  urldecode($value);
}

/**
 * Generate a random alphanumeric password.  Copied from user.module.
 */
function drush_generate_password($length = 10) {
  // This variable contains the list of allowable characters for the
  // password. Note that the number 0 and the letter 'O' have been
  // removed to avoid confusion between the two. The same is true
  // of 'I', 1, and 'l'.
  $allowable_characters = 'abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789';

  // Zero-based count of characters in the allowable list:
  $len = strlen($allowable_characters) - 1;

  // Declare the password as a blank string.
  $pass = '';

  // Loop the number of times specified by $length.
  for ($i = 0; $i < $length; $i++) {

    // Each iteration, pick a random character from the
    // allowable string and append it to the password:
    $pass .= $allowable_characters[mt_rand(0, $len)];
  }

  return $pass;
}