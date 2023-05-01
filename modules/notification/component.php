<?php
/**
 * Component: Notification
 *
 * @example
 * X_Notification::render([
 *  'id'   => get_the_ID(),
 * ]);
 *
 * @package axio
 */
class X_Notification extends X_Component {

  public static function frontend($data) {

  ?>
    <div <?php parent::render_attributes($data['attr']); ?>>
      <div class="notification__content">
        <div class="notification__text">
          <?php if (!empty($data['delivery_title'])) : ?>
            <div class="notification__title">
              <?php echo $data['delivery_title']; ?>
            </div>
          <?php endif; ?>
          <?php if (!empty($data['delivery_details'])) : ?>
            <div class="notification__details">
              <?php echo $data['delivery_details']; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <?php

    }

  public static function backend($args = []) {

      $placeholders = [

      // required

      // optional
      'attr'                      => [],

      // internal
      'delivery_title'            => '',
      'delivery_details'          => '',

      ];

      $args = wp_parse_args($args, $placeholders);

      $title = get_field('delivery_title');
      $args['delivery_title'] = $title;

      $text = get_field('delivery_details');
      $args['delivery_details'] = $text;

      $args['attr']['class'][]  = 'notification';

      return $args;
  }
    }
