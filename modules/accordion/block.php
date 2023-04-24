<?php
/**
 * ACF Block: Accordion
 *
 * @param array   $block The block settings and attributes.
 * @param string  $content The block inner HTML (empty).
 * @param bool    $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

$allowed_blocks = [
  'core/heading',
  'core/paragraph',
  'core/buttons',
  'core/list',
  'core/image',
  'core/gallery',
];

$placeholder_content = [
  ['core/paragraph'],
];

?>
<div class="wp-block-acf-accordion">
  <?php
    X_Accordion::render([
      'title'       => get_field('accordion_title'),
      'contents'    => '<InnerBlocks allowedBlocks="' . esc_attr(wp_json_encode($allowed_blocks)) . '" template="' . esc_attr(wp_json_encode($placeholder_content)) . '" />',
      'is_preview'  => $is_preview,
    ]);
  ?>
</div>
