<?php

if(!defined('WP_UNINSTALL_PLUGIN')) exit();

require_once(plugin_dir_path( __FILE__ ) . '/setup.php');

class PreviewCustomFieldsUninstall extends PreviewCustomFields {
  public static function init() {
    delete_option(self::$prefix . 'version');
  }
}

PreviewCustomFieldsUninstall::init();
