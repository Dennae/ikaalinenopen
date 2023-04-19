<?php
/**
 * Component: Footer
 *
 * @example
 * X_Footer::render();
 *
 * @package axio
 */
class X_Footer extends X_Component {

  public static function frontend($data) {
    ?>
    <footer <?php parent::render_attributes($data['attr']); ?>>

      <div class="site-footer__container">

        <?php if (is_active_sidebar('footer-1')) : ?>
          <div class="site-footer__column site-footer__column--1">
            <?php dynamic_sidebar('footer-1'); ?>
          </div>
        <?php endif; ?>
        <?php if (is_active_sidebar('footer-2')) : ?>
          <div class="site-footer__column site-footer__column--2">
            <?php dynamic_sidebar('footer-2'); ?>

            <?php if (class_exists('X_Menu_Social')) : ?>
              <div class="site-footer__social">
                <?php X_Menu_Social::render(); ?>
              </div>

            <?php endif; ?>
          </div>
        <?php endif; ?>
        <?php if (is_active_sidebar('footer-3')) : ?>
          <div class="site-footer__column site-footer__column--3">
            <?php dynamic_sidebar('footer-3'); ?>
          </div>
        <?php endif; ?>

      </div>

    </footer>
    <?php
  }

  public static function backend($args = []) {

    $placeholders = [
      // optional
      'attr'           => [],

    ];
    $args = wp_parse_args($args, $placeholders);

    // classes
    if (!isset($args['attr']['class'])) {
      $args['attr']['class'] = [];
    }
    $args['attr']['class'][] = 'site-footer';

    $column_count = 0;

    if (is_active_sidebar('footer-1')) {
      $column_count++;
      $args['attr']['class'][] = 'site-footer--has-main-column';
    }
    if (is_active_sidebar('footer-2')) {
      $column_count++;
    }
    if (is_active_sidebar('footer-3')) {
      $column_count++;
    }
    if (is_active_sidebar('footer-4')) {
      $column_count++;
    }

    $args['attr']['class'][] = 'site-footer--columns-' . $column_count;

    // id
    $args['attr']['id'] = 'colophon';

    // Schema.org
    $args['attr']['itemscope'] = null;
    $args['attr']['itemtype']  = 'https://schema.org/WPFooter';

    return $args;

  }

}
