<?php
/**
 * Component: Logowall
 *
 * @example default
 * X_Logowall::render();
 *
 * @package axio
 */
class X_Logowall extends X_Component {

  public static function frontend($data) {
  ?>
    <?php if (!empty($data['items']) && !empty($data['items'][0])) : ?>

      <div <?php parent::render_attributes($data['attr']); ?>>
        <ul class="logowall__list columns--<?php echo $data['columns'] ?>">
          <?php 
            foreach ($data['items'] as $item) {
              echo '<li class="logo">' . $item . '</li>';
            }
          ?>
        </ul>
      </div>

    <?php elseif ($data['is_preview']) : ?>

      <div class="logowall-placeholder">
        <h3><?php ask_e('Logo wall: block title') ?></h3>
        <p><?php ask_e('Logo wall: admin text') ?></p>
      </div>

    <?php endif; ?>
  <?php
  }

  public static function backend($args = []) {

   $placeholders = [

      // required
      'items'       => [],
      'columns'     => '3',

      // optional
      'attr'        => [],
      'is_preview'  => false,

    ];

    $args = wp_parse_args($args, $placeholders);

    if (!empty(get_field('logowall_columns'))) {
      $args['columns'] = get_field('logowall_columns');
    }

    if (!empty(get_field('logowall_items'))) {
      $items = get_field('logowall_items');

      foreach ($items as $item) {
        $image_id = $item['logo'];
        $link = $item['link'];
        
        if (!empty($link)) {
          $item_el = '<a href="' . $link['url'] . '" aria-label="' . $link['title'] . '" ';
          $item_el .= !empty($link['target']) ? 'target="' . $link['target'] . '" ' : '';
          $item_el .= '>';
          $item_el .= X_Image::get(['id' => $image_id, 'size' => 'medium']);
          $item_el .= '</a>';
        } else {
          $item_el = X_Image::get(['id' => $image_id, 'size' => 'medium']);
        }

        $args['items'][] = $item_el;
      }
    }

    $args['attr']['class'][] = 'logowall';

    return $args;
  }
}
