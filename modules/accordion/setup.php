<?php
/**
 * Accordion: Setup
 *
 * @package axio
 */

/**
 * Register block
 */
add_action('acf/init', function () {

  if (function_exists('acf_register_block_type')) {
    acf_register_block_type([
      'name'              => 'accordion',
      'title'             => 'Accordion',
      'render_template'   => dirname(__FILE__) . '/block.php',
      'multiple'          => true,
      'keywords'          => ['header', 'title', 'accordion'],
      'category'          => 'common',
      'icon'              => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20"><path d="M17 9v2h-6v6H9v-6H3V9h6V3h2v6h6z" fill="currentColor"/></svg>',
      'mode'              => 'preview',
      'supports'          => [
        'align' => false,
        'jsx'   => true,
      ]
    ]);
  }

});

/**
 * Allow accordion block
 */
add_filter('allowed_block_types_all', function($blocks, $post) {

  $blocks[] = 'acf/accordion';
  return $blocks;

}, 11, 2);

/**
 * Localization
 */
add_filter('aucor_core_pll_register_strings', function($strings) {

  return array_merge($strings, [
    'Accordion: Add title'       => 'Lisää otsikko',
  ]);

}, 10, 1);
