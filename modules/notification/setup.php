<?php
/**
 * Setup: Notification
 *
 * @package axio
 */

/**
 * Register block
 */
add_action('acf/init', function () {

  if (function_exists('acf_register_block_type')) {
    acf_register_block_type([
      'name'              => 'notification',
      'title'             => __('Notification'),
      'description'       => '',
      'render_template'   => dirname(__FILE__) . '/block.php',
      'keywords'          => ['notification'],
      'post_types'        => ['page', 'post'],
      'category'          => 'common',
      'icon'              => 'id-alt',
      'align'             => 'left',
      'mode'              => 'auto',
      'supports'          => [
        'mode'                => false,
        'align'               => false,
        'multiple'            => true,
        'customClassName'     => false,
      ],
    ]);
  }

});

/**
 * Localization
 */
add_filter('aucor_core_pll_register_strings', function($strings) {

  return array_merge($strings, [
    'Notification' => 'Ilmoitukset',
  ]);

}, 10, 1);


/**
 * Allow service block
 */
add_filter('allowed_block_types_all', function($blocks, $post) {

  $blocks[] = 'acf/notification';

  return $blocks;

}, 11, 2);
