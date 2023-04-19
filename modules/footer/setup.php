<?php
/**
 * Setup: Footer
 *
 * @package axio
 */

/**
 * Place footer
 */
add_action('theme_footer', function() {

  X_Footer::render();

}, 100, 0);

/**
 * Register widget areas
 */
add_action('widgets_init', function () {

  register_sidebar([
    'name'          => __('Footer') . ' 1',
    'id'            => 'footer-1',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<p class="widget__title">',
    'after_title'   => '</p>',
  ]);

  register_sidebar([
    'name'          => __('Footer') . ' 2',
    'id'            => 'footer-2',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<p class="widget__title">',
    'after_title'   => '</p>',
  ]);

  register_sidebar([
    'name'          => __('Footer') . ' 3',
    'id'            => 'footer-3',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<p class="widget__title">',
    'after_title'   => '</p>',
  ]);

  // remove obsolete widgets
  unregister_widget('WP_Widget_Pages');
  unregister_widget('WP_Widget_Calendar');
  unregister_widget('WP_Widget_Archives');
  unregister_widget('WP_Widget_Links');
  unregister_widget('WP_Widget_Meta');
  unregister_widget('WP_Widget_Search');
  unregister_widget('WP_Widget_Categories');
  unregister_widget('WP_Widget_Recent_Posts');
  unregister_widget('WP_Widget_Recent_Comments');
  unregister_widget('WP_Widget_RSS');
  unregister_widget('WP_Widget_Tag_Cloud');
  unregister_widget('WP_Widget_Media_Gallery');
  unregister_widget('WP_Widget_Media_Video');
  unregister_widget('WP_Widget_Media_Audio');
  //unregister_widget('WP_Widget_Media_Image');
});

/**
 * Set CSS variables
 */
add_action('wp_enqueue_scripts', function() {

  if (!function_exists('x_conf_render_css_variables')) {
    return;
  }

  wp_add_inline_style('x-style', x_conf_render_css_variables([
    '--color-footer-bg'               => 'options_x_conf_module_footer_background',
    '--color-footer'                  => 'options_x_conf_module_footer_color',
  ]));

}, 9000);
