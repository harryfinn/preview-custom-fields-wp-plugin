<?php
/**
* Plugin Name: Preview custom fields
* Plugin URI: https://harryfinn.co.uk
* Description: Allows for any post type supporting revisions to correctly store
* a revisioned version of all custom meta data for use when previewing items via
* the frontend .
* Version: 1.0.0
* Author: Harry Finn
* Author URI: https://harryfinn.co.uk
* License: GPL v3
*/

if(!defined('ABSPATH')) exit;

class PreviewCustomFields {
  public static $prefix = 'pcf_';

  public static function init() {
    register_activation_hook(
      __FILE__,
      [__CLASS__, self::$prefix . 'activate_plugin']
    );
  }

  public function pcf_activate_plugin() {
    update_option(self::$prefix . 'version', '1.0.0');
  }
}

PreviewCustomFields::init();
