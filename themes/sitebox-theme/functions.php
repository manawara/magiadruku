<?php

function sitebox_assets() {
  $bundle_path = get_template_directory() . '/assets/js/main.js';
  $bundle_url  = get_template_directory_uri() . '/assets/js/main.js';

  // FRONTEND
  if (file_exists($bundle_path) && !is_admin()) {
    wp_enqueue_script(
      'sitebox-bundle',
      $bundle_url,
      [],
      filemtime($bundle_path),
      true
    );
  }
}
add_action('wp_enqueue_scripts', 'sitebox_assets');

function sitebox_editor_assets() {
  $bundle_path = get_template_directory() . '/assets/js/main.js';
  $bundle_url  = get_template_directory_uri() . '/assets/js/main.js';

  // GUTENBERG (edytor)
  if (file_exists($bundle_path)) {
    wp_enqueue_script(
      'sitebox-bundle',
      $bundle_url,
      ['wp-blocks', 'wp-element', 'wp-editor', 'wp-components'],
      filemtime($bundle_path),
      true
    );
  }
}
add_action('enqueue_block_editor_assets', 'sitebox_editor_assets');
