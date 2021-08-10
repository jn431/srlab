<?php
/**
 * Customizer Class
 * @package  srlab
 * @author   Jaein Lee
 */

namespace srlab\classes;

require "customizer/wpc_ctrl_menu.class.php";
use srlab\classes\Utility;

defined('ABSPATH') || exit;

if (!class_exists('srlab\classes\Customizer')) :
   class Customizer
   {
      use Utility;

      //public static $variable;

      public function __construct()
      {
         add_action("customize_controls_enqueue_scripts", [$this, 'wpc_customizer_js']);  // Do not edit
         add_action("customize_preview_init", [$this, 'wpc_live_preview']);               // Do not edit
         add_action("customize_register", [$this, 'wpc_hide_sections'], 15);              // Do not edit
         add_action("customize_register", [customizer\WPC_Frontpage::class, 'sr_wpc_frontpage']);
         add_action("customize_register", [customizer\WPC_Footer::class, 'sr_wpc_footer']);
         add_action("customize_register", [customizer\WPC_Social::class, 'sr_wpc_social']);
      }

      /**
       * WPC Customize.JS
       */
      public function wpc_customizer_js()
      {
         // * customizer.js * //
         wp_enqueue_script('customizer', JS_DIR . 'customizer' . SUFFIX . '.js', ['jquery', 'customize-controls'], VERSION, true);
      }

      /**
       * WPC Customize-Preview.JS
       */
      public function wpc_live_preview()
      {
         // * customizer-preview.js * //
         wp_enqueue_script('customizer-previewer', JS_DIR . 'customizer-preview' . SUFFIX . '.js', ['jquery', 'customize-preview'], VERSION, true);
      }

      /**
       * WPC Hide
       * @param  object $wp_customize
       */
      public function wpc_hide_sections($wp_customize)
      {
         $wp_customize->remove_section('custom_css');
         $wp_customize->remove_section('static_front_page');
      }

      /**
       * Validate URL
       * @param bool $validity
       * @param string $value
       * @return false
       */
      public static function validate_url_input($validity, $value)
      {
         if ($value === "") {
            return true;
         } else if (filter_var($value, FILTER_VALIDATE_URL) === FALSE) {
            return new \WP_Error('invalid', __('Enter a valid url'));
         }
         return true;
      }  // --- validate_url_input --- //
   } // --- Customizer --- //
endif;