<?php
/**
 * Utility
 * @package  srlab
 * @author   Jaein Lee
 *
 * { Table of Contents }
 * static render_svg
 * static count_array_with_values
 * check_plugin_active
 * get_attachment_id_by_slug
 * get_menu_by_location
 * get_temp_name
 * create_a_page
 * upload_img
 * create_a_menu
 * HEXtoRGB
 * HEXtoHSL
 */

namespace srlab\classes;

defined('ABSPATH') || exit;

if (!trait_exists('srlab\classes\Utility')) :
   trait Utility
   {
      /**
       * SVG Support
       * @param string $name
       */
      public static function RenderSVG($filepathname)
      {
         $svg = $filepathname . '.svg';
         echo file_get_contents($svg);
      }

      /**
       * Render SVG w/ Params
       * @access  public static
       * @param   string   $location
       * @param   array    $params
       * @return  string
       */
      public static function RenderFILE($location, $params)
      {
         if (!is_array($params))
            return;
         $svg = THEME_PATH . 'assets/svgs/' . $location;
         ob_start();
         include $svg;
         return ob_get_clean();
      }

      /**
       * Count non empty associative array
       * @access public static
       * @param  array $array
       * @return int
       */
      public static function count_array_with_values($array)
      {
         if (!is_array($array))
            return 0;
         else
            return count(array_filter($array, function ($x) {
               return isset($x);
            }));
      }

      /**
       * Check if plugin is active
       * @access  public static
       * @param   string  $plugin_name
       * @return  boolean
       */
      public static function check_plugin_active($plugin_name)
      {
         if (!in_array($plugin_name, apply_filters('active_plugins', get_option('active_plugins')))) {
            return false;
         } else {
            return true;
         }
      }
      /**
       * Get attachment URL by SLUG
       * @param  string $slug - 'logo.png'
       * @return string|false
       */
      public function get_attachment_id_by_slug($slug)
      {
         $args = array(
            'post_type' => 'attachment',
            'name' => sanitize_title($slug),
            'posts_per_page' => 1,
            'post_status' => 'inherit',
         );
         $post = get_posts($args);

         $attachment = $post ? array_pop($post) : null;
         return $attachment ? $attachment->ID : '';
      } // --- Get_attachment_id_by_slug --- //

      /**
       * Get menu by location name
       * @param  string  $id
       * @param  string  $get term_id/name/slug/wp_term
       * @return string
       */
      public function get_menu_by_location($id, $get = 'name')
      {
         $menus = get_nav_menu_locations();
         // ['location_name'] => int(id)
         $menu = get_term($menus[$id], 'nav_menu');
         if ($menu === false) {
            return;
         }

         return $menu->$get;
      }

      /**
       * Extract pagename "temp-{home}.php'
       * @param object $post
       * @return string
       */
      public function get_temp_name($post = null)
      {
         if ($post !== null) {

            $template = (get_page_template_slug($post)) ?: '';
         } else {
            $template = get_page_template_slug();
         }

         if (!$template || strpos($template, 'page-templates') === false) {
            return '';
         }

         return str_replace(['page-templates/temp-', '.php'], ['', ''], $template);
      }

      /**
       * Create page
       *
       * @param string $name
       * @param string $content
       * @param string $template
       */
      public function create_a_page($name, $template, $content = '')
      {
         $name = wp_strip_all_tags($name);
         $exists = (get_page_by_title($name)) ? get_page_by_title($name, 'ARRAY_A') : null;

         if ($exists && $exists['post_status'] === 'publish') {
            return;
         }

         $post_data = array(
            'post_title'    => $name,
            'post_content'  => $content,
            'post_status'   => "publish",
            'post_type'     => "page",
            'post_author'   => 1,
            'post_category' => null,
            'page_template' => $template
         );
         $id = wp_insert_post($post_data, true);
         return $id;
      }

      /**
       * Programmatically Upload Image - Include path and file ext
       * @param string $filepathname - logos/beach.png
       */
      public function Upload_Img($filepathname)
      {
         $image_url = IMG_DIR . $filepathname;
         $upload_dir = wp_upload_dir();
         $image_data = file_get_contents($image_url);
         $filename = basename($image_url);

         if (wp_mkdir_p($upload_dir['path'])) {
            $file = $upload_dir['path'] . '/' . $filename;
         } else {
            $file = $upload_dir['basedir'] . '/' . $filename;
         }
         if (file_exists($file)) {
            return;
         }

         file_put_contents($file, $image_data);
         $wp_filetype = wp_check_filetype($filename, null);
         $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => sanitize_file_name($filename),
            'post_content' => "",
            'post_status' => 'inherit'
         );
         $attach_id = wp_insert_attachment($attachment, $file);
         require_once(ABSPATH . 'wp-admin/includes/image.php');
         $attach_data = wp_generate_attachment_metadata($attach_id, $file);
         wp_update_attachment_metadata($attach_id, $attach_data);
      }

      /**
       * Template create menu
       *
       * @param   string   $menu_name
       * @param   array    $array
       */
      public function create_a_menu($menu_name, $array)
      {

         $defaults = array(
            'menu'                 => '',
            'container'            => '',
            'container_class'      => 'menu-wrapper',
            'menu_class'           => 'menu',
            'menu_id'              => $menu_name,
            'echo'                 => true,
            'before'               => '',
            'after'                => '',
            'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'depth'                => 2,
            'theme_location'       => $menu_name,
         );

         if (null !== $array)
            $defaults = array_merge($defaults, $array);

         wp_nav_menu($defaults);
      }

      /**
       * Convert #HEX to RGB
       * @param  string $hex
       * @param  bool $alpha
       * @return array $rgb
       */
      public function HEXtoRGB($hex, $alpha = false)
      {
         $hex      = str_replace('#', '', $hex);
         $length   = strlen($hex);
         $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
         $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
         $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
         if ($alpha) {
            $rgb['a'] = $alpha;
         }
         return $rgb;
      }

      /**
       * Convert #HEX to HSL
       * ( hue, saturation%, lightness% )
       * @param   string  $hex - #000
       * @return  array
       */
      public function HEXtoHSL($hex)
      {
         $hex = str_replace("#", "", $hex);
         $r = hexdec(substr($hex, 0, 2)) / 255;
         $g = hexdec(substr($hex, 2, 2)) / 255;
         $b = hexdec(substr($hex, 4, 2)) / 255;

         $cmin = min($r, $g, $b);
         $cmax = max($r, $g, $b);
         $delta = $cmax - $cmin;

         if ($delta === 0) {
            $hue = 0;
         } elseif ($cmax === $r) {
            $hue = (($g - $b) / $delta) % 6;
         } elseif ($cmax === $g) {
            $hue = ($b - $r) / $delta + 2;
         } else {
            $hue = ($r - $g) / $delta + 4;
         }

         $hue = round($hue * 60);
         if ($hue < 0) {
            $hue += 360;
            $hue = round($hue);
         }

         $lightness = (($cmax + $cmin) / 2) * 100;
         $lightness = round($lightness);

         $sat = $delta === 0 ? 0 : ($delta / (1 - abs(2 * $lightness - 1))) * 100;
         if ($sat < 0) {
            $sat += 100;
            $sat = round($sat);
         }

         return [
            'hue' => $hue,
            'sat' => $sat,
            'lightness' => round($lightness),
            'hsl' => "hsl(${hue}, ${sat}%, ${lightness}%)"
         ];
      }
   }
endif; // !exists