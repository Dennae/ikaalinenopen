<?php
/**
 * Component: Header
 *
 * @example
 * X_Header::render();
 *
 * @package axio
 */
class X_Header extends X_Component {

  public static function frontend($data) {
    ?>
    <header <?php parent::render_attributes($data['attr']); ?>>

      <div class="site-header__inner">

        <div class="site-header__branding">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="site-header__title" rel="home" itemprop="headline">
            <?php $header_logo = get_field('header_logo', 'option'); ?>
            <?php if (!empty( $header_logo )) : ?>
              <img class="site-header__logo" src="<?php echo esc_url($header_logo['url']); ?>" alt="<?php echo esc_attr($header_logo['alt']); ?>" />
            <?php endif; ?>
          </a>
        </div>

        <?php X_Menu_Toggle::render(); ?>

        <div class="site-header__menus">
          <?php
            X_Menu_Additional::render([
              'attr' => [
                'class' => ['site-header__additional', 'desktop-menu']
              ],
              'type' => 'desktop'
            ]);
          ?>

          <?php
            X_Menu_Primary::render([
              'attr' => [
                'class' => ['site-header__main', 'desktop-menu']
              ],
              'type' => 'desktop'
            ]);
          ?>

        </div>

      </div>

    </header>
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
    $args['attr']['class'][] = 'site-header';

    // id
    $args['attr']['id'] = 'masthead';

    // Schema.org
    $args['attr']['itemscope'] = null;
    $args['attr']['itemtype']  = 'https://schema.org/WPHeader';

    return $args;

  }

}
