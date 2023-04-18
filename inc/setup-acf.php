<?php
/**
 * Setup ACF (Advanced Custom Fields Pro plugin)
 *
 * @package axio
 */


/**
 * Add ACF fields options page
 */
if (function_exists('acf_add_options_page')) {

  // Main Theme Settings Page
  $parent = acf_add_options_page( array(
    'page_title'  => __('Ikaalinen Asetukset'),
    'menu_title'  => __('Ikaalinen Asetukset'),
    'menu_slug'   => 'theme-settings',
    'capability'	=> 'edit_posts',
    'redirect'    => 'Ikaalinen Asetukset',
  ) );

  //
  // Global Options
  // Same options on all languages.
  //

  acf_add_options_sub_page( array(
    'page_title' => __('Yleinen'),
    'menu_title' => __('Yleinen', 'text-domain'),
    'menu_slug'  => 'general-options',
    'parent'     => $parent['menu_slug']
  ) );

}

/**
 * Save ACF fields as JSON at theme root /acf-json/
 */
add_filter('acf/settings/save_json', function() {

  return get_template_directory() . '/acf-json';

}, 100);

/**
 * Load ACF fields as JSON from theme root /acf-json/
 */
add_filter('acf/settings/load_json', function($paths) {

  $paths[] = get_template_directory() . '/acf-json';
  return $paths;

}, 100);
