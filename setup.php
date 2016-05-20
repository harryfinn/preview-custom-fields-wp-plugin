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
  public static $prefix = 'pcf_',
                $custom_meta_keys = [];

  public static function init() {
    register_activation_hook(
      __FILE__,
      [__CLASS__, self::$prefix . 'activate_plugin']
    );
    add_action(
      'wp_creating_autosave',
      [__CLASS__, self::$prefix . 'autosave_preview_meta_fields']
    );
    add_action(
      'wp_before_creating_autosave',
      [__CLASS__, self::$prefix . 'autosave_preview_meta_fields']
    );
    add_action(
      '_wp_put_post_revision',
      [__CLASS__, self::$prefix . 'revision_preview_meta_fields']
    );
    add_filter(
      'get_post_metadata',
      [__CLASS__, self::$prefix . 'wp_preview_meta_filter'],
      10,
      4
    );
  }

  public function pcf_activate_plugin() {
    update_option(self::$prefix . 'version', '1.0.0');
  }

  public function pcf_autosave_preview_meta_fields($new_autosave) {
    $posted_data = !empty($_POST['data']) ? $_POST['data']['wp_autosave'] : $_POST;

    foreach(self::$custom_meta_keys as $key) {
      delete_metadata('post', $new_autosave['ID'], $key);

      if(!empty($posted_data['_cmb2_page_author_name'])) {
       add_metadata('post', $new_autosave['ID'], $key, $posted_data[$key]);
      }
    }
  }

  public function pcf_revision_preview_meta_fields($revision_id) {
    foreach(self::$custom_meta_keys as $key) {
      delete_metadata('post', $revision_id, $key);
      add_metadata('post', $revision_id, $key, $_POST[$key]);
    }
  }

  public function add_meta_keys(array $field_key_array) {
    foreach($field_key_array as $key) {
      self::$custom_meta_keys[] = $key;
    }
  }

  public function pcf_wp_preview_meta_filter($value, $object_id, $meta_key, $single) {
    if(empty($_GET['preview'])) return $value;

    $post = get_post();
    if(empty($post)
      || $post->ID != $object_id
      || !in_array($meta_key, self::$custom_meta_keys)
      || 'revision' == $post->post_type) {
      return $value;
    }

    $preview = wp_get_post_autosave($post->ID);
    if(!is_object($preview)) return $value;

    return get_post_meta($preview->ID, $meta_key, $single);
  }
}

PreviewCustomFields::init();
