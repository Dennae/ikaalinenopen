<?php
/**
 * Component: Hero Flexible
 *
 * @example
 * X_Hero::render();
 *
 * @package axio
 */
class X_Hero extends X_Component {

  public static function frontend($data) {
    ?>

    <div <?php parent::render_attributes($data['attr']); ?>>

      <?php if (in_array($data['layout'], ['background', 'columns', 'stack'])) : ?>
        <div class="hero__media">
          <div class="hero__media__image">
            <?php echo $data['image']; ?>
          </div>
          <?php if ($data['layout'] == 'background') : ?>
            <div style="opacity:<?php echo $data['dimming'] / 100; ?>" class="hero__media__dimming"></div>
          <?php endif; ?>
        </div>
      <?php endif; ?>

      <div class="hero__container">
        <div class="hero__container__inner">

          <?php if (!empty($data['contents'])) : ?>

            <?php echo $data['contents']; ?>

          <?php else : ?>

            <h1><?php echo $data['title']; ?></h1>

            <?php if (!empty($data['meta'])) : ?>
              <div class="hero__meta"><?php echo $data['meta']; ?></div>
            <?php endif; ?>

            <?php if (!empty($data['description'])) : ?>
              <p class="hero__description"><?php echo $data['description']; ?></p>
            <?php endif; ?>

          <?php endif; ?>

        </div>
      </div>

    </div>

    <?php
      if (is_singular() && get_post_type() === 'post') {
        X_Blog_Filters::render();
      }
    ?>
    <?php
  }

  public static function backend($args = []) {

    $placeholders = [

      // required (nothing)

      // optional
      'attr'        => [],
      'fields'      => [],
      'width'       => 'full',
      'is_preview'  => false,

      // internal
      'layout'      => 'text',
      'align'       => 'center',
      'image_align' => 'right',
      'color'       => 'transparent',
      'height'      => 'auto',
      'menu'        => 'top',
      'dimming'     => 25,
      'title'       => '',
      'description' => '',
      'meta'        => '',
      'contents'    => '',
      'image_id'    => null,
      'image_size'  => 'hero-background',
      'image'       => '',

    ];
    $args = wp_parse_args($args, $placeholders);

    if (!isset($args['attr']['class'])) {
      $args['attr']['class'] = [];
    }

    // title
    if (is_singular('post')) {
      $args['title'] = self::get_the_archive_title();
    } else {
      $args['title'] = (is_singular()) ? get_the_title() : self::get_the_archive_title();
    }

    // description
    $post_archive_id = get_option('page_for_posts');
    if (is_singular('post') || !empty(get_queried_object()->ID) && get_queried_object()->ID == $post_archive_id) {
      $args['description'] = get_the_excerpt($post_archive_id);
    } else {
      $args['description'] = (is_singular()) ? get_post_meta(get_the_ID(), 'lead', true) : get_the_archive_description();
    }

    // meta
    /*if (is_singular() && get_post_type() === 'post') {
      $args['meta'] = x_get_posted_on();
    }*/

    // ACF fields
    $f = $args['fields'];
    if (!empty($f)) {

      if (isset($f['layout']) && !empty($f['layout'])) {
        $args['layout'] = $f['layout'];
      }

      if (isset($f['align_image']) && !empty($f['align_image'])) {
        $args['image_align'] = $f['align_image'];
      }
      if (isset($f['x_conf_colors']) && !empty($f['x_conf_colors'])) {
        $args['color'] = $f['x_conf_colors'];
      }
      if (isset($f['image']) && !empty($f['image'])) {
        $args['image_id'] = $f['image'];
      }
      if (isset($f['dimming'])) {
        $args['dimming'] = absint($f['dimming']);
      }

      if (isset($f['align_content']) && !empty($f['align_content'])) {
        if ($f['align_content'] !== 'auto') {
          $args['align'] = $f['align_content'];
        } else {
          if ($args['layout'] == 'text') {
            $args['align'] = 'center';
          } elseif ($args['layout'] == 'background') {
            $args['align'] = 'center';
          } elseif ($args['layout'] == 'columns') {
            if ($args['image_align'] == 'right') {
              $args['align'] = 'right';
            } else {
              $args['align'] = 'left';
            }
          } else {
            $args['align'] = 'center';
          }
        }
      }
      if (isset($f['height']) && !empty($f['height'])) {
        $args['height'] = $f['height'];
      }
      if (isset($f['menu']) && !empty($f['menu'])) {
        $args['menu'] = $f['menu'];
      }

    }

    // image id
    if (empty($args['image_id']) && is_singular() && has_post_thumbnail()) {
      $args['image_id'] = get_post_thumbnail_id();
    }

    if ($args['layout'] == 'columns') {
      $args['image_size'] = 'hero-columns';
    } elseif ($args['height'] == 'full') {
      $args['image_size'] = 'hero-full';
    }

    if (!empty($args['image_id'])) {
      $args['image'] = X_Image::get([
        'id'    => $args['image_id'],
        'size'  => $args['image_size'],
      ]);
    }

    $args['attr']['class'][] = 'hero';
    $args['attr']['class'][] = 'hero--layout-' . $args['layout'];
    $args['attr']['class'][] = 'hero--align-' . $args['align'];
    $args['attr']['class'][] = 'hero--height-' . $args['height'];
    $args['attr']['class'][] = 'hero--menu-' . $args['menu'];

    // execute animations automatically
    $args['attr']['class'][] = 'is-in-viewport';

    if ($args['layout'] == 'columns') {
      $args['attr']['class'][] = 'hero--image-align-' . $args['image_align'];
    }
    if ($args['layout'] == 'background') {
      $args['attr']['class'][] = 'is-dark-mode';
    }
    if (in_array($args['layout'], ['text', 'columns'])) {

      if (function_exists('x_conf_get_data_for_background_color')) {
        $bg_data = x_conf_get_data_for_background_color($args['color']);
        $args['attr']['class'][] = 'hero--background-' . $bg_data['id'];
        foreach ($bg_data['class'] as $class) {
          $args['attr']['class'][] = $class;
        }
      }

    }
    if ($args['is_preview']) {
      $args['attr']['class'][] = 'hero--env-editor';
    }

    return $args;

  }

  /**
   * Get archive title
   *
   * @return string the title
   */
  public static function get_the_archive_title() {

    $title = ask__('Title: Archives');

    if (is_tag() || is_category() || is_tax()) {
      $title = single_term_title('', false);
    } elseif (is_home() || is_singular('post')) {
      $title = ask__('Title: Home');
    } elseif (is_search()) {
      $title = ask__('Title: Search') . ': <span class="search-terms">' . get_search_query() . '</span>';
    } elseif (is_404()) {
      $title = ask__('Title: 404');
    }

    return $title;

  }

}
