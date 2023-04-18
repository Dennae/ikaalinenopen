<?php
/**
 * Header
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package axio
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <?php wp_head(); ?>
</head>

<body <?php body_class('front-end'); ?> itemscope itemtype="https://schema.org/WebPage">

<?php do_action('theme_before_page'); ?>

<div id="page" class="site js-page">

  <a class="skip-to-content" href="#content"><?php ask_e('Accessibility: Skip to content'); ?></a>

  <?php do_action('theme_header'); ?>

  <div id="content" class="site-content" role="main" itemscope itemprop="mainContentOfPage">
