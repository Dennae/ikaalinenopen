<?php
/**
 * Links widget
 */
class X_Links_Widget extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'x_links_widget', // Base ID
      __('Links'),
      [
        'description' => '',
        'classname'   => 'widget-links'
      ]
    );
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget($args, $instance) {

      $links = get_field('links', 'widget_' . $args['widget_id']);
      if (empty($links)) {
      return;
      }

      echo $args['before_widget'];

      if (isset($instance['title']) && !empty($instance['title'])) {
      echo $args['before_title'] . apply_filters('widget_title', $instance['title'], $instance, $args['widget_id']). $args['after_title'];
      }

      if (is_array($links) && !empty($links)) {
      ?>
        <div class="widget-links__links">
      <?php foreach ($links as $link) : ?>
            <?php

              if (!isset($link['link'])) {
              continue;
              }
              $link = $link['link'];

              $link_title   = isset($link['title']) ? $link['title'] : '';
              $link_href    = isset($link['url']) ? $link['url'] : '';
              $link_target  = isset($link['target']) ? $link['target'] : '_self';

              if (!empty($link_title) && !empty($link_href)) :
            ?>
            <div class="widget-links__link">
              <a class="widget-links__item" href="<?php echo esc_attr($link_href); ?>" target="<?php echo esc_attr($link_target); ?>">
              <?php echo esc_html($link_title); ?>
              </a>
            </div>

            <?php endif; ?>


          <?php endforeach; ?>
        </div>
        <?php
      }

      echo $args['after_widget'];
  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form($instance) {

    $title = '';
    if (isset($instance['title'])) {
      $title = $instance['title'];
    }

    ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>
    <?php

  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update($new_instance, $old_instance) {

    $instance = array();
    $instance['title'] = (isset($new_instance['title']) && !empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

    return $instance;

  }

} // class ACF_Custom_Widget

// register widget
add_action('widgets_init', function() {

  register_widget('X_Links_Widget');

});
