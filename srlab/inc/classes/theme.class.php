<?php

/**
 * Theme Class
 * @package  srlab
 * @author   Jaein Lee
 */

namespace srlab\classes;

use srlab\classes\Utility;

defined('ABSPATH') || exit;

if (!class_exists('srlab\classes\Theme')) {
   class Theme extends Assets
   {
      use Utility;

      public static $site_name  = "SR Lab";
      public static $theme_name = "srlab";
      public static $slogan     = "";
      public static $excerpt_length = 30;

      public function init()
      {
         // * User Logged In * //
         if (is_user_logged_in() || is_admin()) {
            add_action('init', [$this, 'sr_theme_adminbar']);
            add_action('get_header', function () {
               remove_action('wp_head', '_admin_bar_bump_cb');
            });
         }

         // * Theme Support
         add_action('after_setup_theme', [$this, 'sr_theme_support'], 15);

         // * Theme Style/Scripts
         add_action('wp_enqueue_scripts', [$this, 'sr_assets_styles']);
         add_action('wp_enqueue_scripts', [$this, 'sr_assets_scripts']);

         add_filter('body_class', [$this, 'sr_bodyclass'], 10, 2);
         add_action('header_class', [$this, 'sr__headerclass']);
         add_filter('intermediate_image_sizes', [$this, 'sr_image_sizes'], 15, 1);
      }

      /**
       * General theme set up and support
       */
      public function sr_theme_support()
      {
         //add_theme_support('post-thumbnails');
         add_theme_support('automatic-feed-links');
         add_theme_support('title-tag');
         add_image_size('thumbnail-small', 260, 260, true);
         add_image_size('thumbnail-wide', 400, 260, true);
         add_image_size('acf-thumbnail', 125, 125, true);
         add_filter('use_default_gallery_style', '__return_false');
         add_filter("excerpt_length", function () {
            return self::$excerpt_length;
         });

         register_nav_menus(
            [
               'primary_menu' => esc_html__('Primary', self::$theme_name),
               'social_menu'  => esc_html__('Social Menu', self::$theme_name),
            ]
         );

         add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);

         // Enable Shortcodes in widgets
         add_filter('widget_text', 'do_shortcode');
      }

      public function sr_theme_js_loader($tag, $handle, $src)
      {
         $handles = ['bx-script'];
         if (in_array($handle, $handles)) {
            $tag = str_replace("id='$handle-js'", "id='$handle-js' defer", $tag);
         }
         return $tag;
      }

      public static function sr_body_id($id = '')
      {
         if (is_front_page())
            $id = "home";

         if (!$id)
            return;

         echo 'id=' . esc_attr($id);
      }

      /**
       * Allowed body classes
       * @param   array $wp_classes
       * @param   array $extra_classes
       * @return  array
       */
      public function sr_bodyclass($wp_classes, $extra_classes)
      {
         if (function_exists('is_woocommerce')) {
            if (is_account_page()) {
               $extra_classes[] = "myaccount";
            }
         }
         $whitelist = [
            'home', 'page', 'single', 'logged-in', 'error404', 'admin-bar', 'woocommerce',
         ];
         $wp_classes = array_intersect($wp_classes, $whitelist);
         return array_merge($wp_classes, (array) $extra_classes);
      }

      /**
       * Unset unused image sizes
       * @param   array $sizes
       * @return  array
       */
      public function sr_image_sizes($sizes)
      {
         $sizes = ['thumbnail', 'medium', 'medium_large', 'large', 'thumbnail-wide', 'acf-thumbnail'];
         return $sizes;
      }
   } // -- Theme
}
