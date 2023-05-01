<?php
/**
 * ACF Block: Notification
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 *
 * @package axio
 */

$show_notification = get_field('show_notification');

?>
<?php if ($show_notification) : ?>
  <div class="wp-block-notification">
    <?php X_Notification::render(); ?>
  </div>
 <?php endif; ?>
