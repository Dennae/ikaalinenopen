<?php
/**
 * Component: Accordion
 *
 * @package axio
 */

class X_Accordion extends X_Component {

  public static function frontend($data) {

    if (empty($data['contents']) && !$data['is_preview']) {
      return '';
    }

  ?>
    <div <?php parent::render_attributes($data['attr']); ?>>
      <button class="accordion__header js-accordion-header" type="button" aria-expanded="false" aria-selected="false">
        <?php if (!empty($data['title'])) : ?>
          <h3 class="accordion__header__title">
            <?php echo $data['title']; ?>
          </h3>
        <?php elseif ($data['is_preview']) : ?>
          <h3 class="accordion__header__title placeholder">
            <?php echo ask__('Accordion: Add title'); ?>
          </h3>
        <?php endif; ?>
        <div class="accordion__header__icon">
          <?php X_SVG::render(['name' => 'plus']); ?>
          <?php X_SVG::render(['name' => 'minus']); ?>
        </div>
      </button>
      <div class="accordion__panel js-accordion-panel" <?php echo $data['is_preview'] ? 'aria-hidden="true"' : ''; ?>>
        <div class="accordion__panel__content inner-blocks">
          <?php echo $data['contents']; ?>
        </div>
      </div>
    </div>
    <?php
  }

  public static function backend($args = []) {

    $placeholders = [

      // required
      'title'                         => '',
      'contents'                      => '',

      // optional
      'attr'                          => [],
      'is_preview'                    => false,

    ];

    $args = wp_parse_args($args, $placeholders);

    if (!isset($args['attr']['class'])) {
      $args['attr']['class'] = [];
    }
    $args['attr']['class'][] = 'accordion';

    return $args;
  }
}
