<?php
/**
 * Hero: Data structures
 *
 * @package axio
 */

/**
 * Register image sizes
 */
add_action('after_setup_theme', function() {

  add_image_size('hero_l', 2000, 750, true);  // hero @1,33x 3:1
  add_image_size('hero_m', 1440, 640, true);  // hero @1x 9:4
  add_image_size('hero_s',  800, 500, true);  // hero mobile 8:5

  add_image_size('hero_full_l', 2000, 1125, true);  // hero @1,33x 16:9
  add_image_size('hero_full_m', 1440, 640,  true);  // hero @1x 9:4
  add_image_size('hero_full_s',  800, 1000, true);  // hero mobile 8:5

});

/**
 * Image sizing
 */
add_filter('theme_image_sizing', function($sizes) {

  $sizes['hero-background'] = [
    'primary'    => 'hero_m',
    'supporting' => ['hero_l', 'hero_m', 'hero_s'],
    'sizes'      => '100vw'
  ];

  $sizes['hero-full'] = [
    'primary'    => 'hero_full_l',
    'supporting' => ['hero_full_l', 'hero_full_m', 'hero_full_s'],
    'sizes'      => '100vw'
  ];

  $sizes['hero-columns'] = [
    'primary'    => 'large',
    'supporting' => ['full', 'wide_l', 'wide_m', 'large', 'medium'],
    'sizes'      => '(min-width: 720px) 50vw, 100vw'
  ];

  return $sizes;

});

/**
 * Action theme_hero if block was not used
 */
add_action('theme_hero', function () {
  if (!has_block('acf/hero')) {
    X_Hero::render();
  }
}, 100, 1);

/**
 * Register block
 */
add_action('acf/init', function () {

  // Check function exists.
  if (function_exists('acf_register_block_type')) {
    acf_register_block_type([
      'name'              => 'hero',
      'title'             => 'Hero Flexible',
      'render_template'   => dirname(__FILE__) . '/block.php',
      'multiple'          => false,
      'keywords'          => ['header', 'title', 'hero'],
      'category'          => 'common',
      'icon'              => 'slides',
      'mode'              => 'preview',
      'align'             => 'full',
      'supports'          => [
        'align'   => ['full', 'wide'],
        'mode'    => false,
        'jsx'     => true,
      ],
    ]);
  }

});

/**
 * Allow hero block
 */
add_filter('allowed_block_types_all', function($blocks, $post) {

  $blocks[] = 'acf/hero';
  return $blocks;

}, 11, 2);


/**
 * Auto append hero block
 */
add_action('init', function () {

  $post_type_object = get_post_type_object('page');
  $post_type_object->template = [
    ['acf/hero'],
    ['core/paragraph'],
  ];

});

/**
 * Localization
 */
add_filter('aucor_core_pll_register_strings', function($strings) {

  return array_merge($strings, [
    'Title: Home'                       => 'Blogi',
    'Title: Archives'                   => 'Arkisto',
    'Title: Search'                     => 'Haku',
    'Title: 404'                        => 'Hakemaasi sivua ei löytynyt',
  ]);

}, 10, 1);
