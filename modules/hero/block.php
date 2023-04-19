<?php
/**
 * ACF Block: Hero Flexible
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

$align = isset($block['align']) ? $block['align'] : 'full';

$allowed_blocks = [
  'core/heading',
  'core/paragraph',
  'core/html',
  'core/columns',
  'core/image',
  'acf/buttons',
  'acf/icon',
  'acf/iframe',
];

$placeholder_content = [
  ['core/heading', [
    'placeholder' => __('Title'),
    'level'       => 1
  ]]
];


if ($is_preview) {
  $contents = '<InnerBlocks allowedBlocks="' . esc_attr(wp_json_encode($allowed_blocks)) . '" template="' . esc_attr(wp_json_encode($placeholder_content)) . '" />';
} else {
  $contents = $content;

}

?>
<div class="wp-block-hero align<?php echo esc_attr($align); ?>">
  <?php
    X_Hero::render([
      'contents'    => '<InnerBlocks allowedBlocks="' . esc_attr(wp_json_encode($allowed_blocks)) . '" template="' . esc_attr(wp_json_encode($placeholder_content)) . '" />',
      'fields'      => get_fields(),
      'width'       => $align,
      'is_preview'  => $is_preview,
    ]);
  ?>
</div>
