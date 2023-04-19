<?php

/**
 * ACF Block: Logo wall
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

?>
<div class="wp-block-acf-logowall <?php echo $block['align'] ? 'align' . $block['align'] : ''; ?>">
  <?php X_Logowall::render([
    'is_preview' => $is_preview
  ]); ?>
</div>