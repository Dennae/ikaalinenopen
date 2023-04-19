<?php
/**
 * Logo wall: Setup
 *
 * @package axio
 */

/**
 * Register block
 */
add_action('acf/init', function()
{
    // check function exists
    if (function_exists('acf_register_block')) {

        // register logo wall block
        acf_register_block([
            'name'              => 'logo-wall',
            'title'             => ask__('Logo wall: block title'),
            'render_template'   => dirname(__FILE__) . '/block.php',
            'keywords'          => ['logo', 'wall', 'acf'],
            'category'          => 'common',
            'icon'              => 'grid-view',
            'align'             => '',
            'mode'              => 'auto',
            'supports'          => [
                'align'             => ['wide'],
            ],
        ]);

    }
});

/**
 * Allow logowall block
 */
add_filter('allowed_block_types_all', function($blocks, $post) {

    $blocks[] = 'acf/logo-wall';
    return $blocks;

}, 11, 2);
  
/**
 * Localization
 */
add_filter('aucor_core_pll_register_strings', function($strings) {

    return array_merge($strings, [
      'Logo wall: block title'            => 'Logo wall',
      'Logo wall: admin text'             => 'Logoja ei ole lisätty. Klikkaa lohkosta ja paina "Add logo"',
    ]);
  
}, 10, 1);

/**
 * Load ACF fields
 */
add_filter('acf/settings/load_json', function ($paths) {

  $paths[] = dirname(__FILE__) . '/acf-json';
  return $paths;

});
