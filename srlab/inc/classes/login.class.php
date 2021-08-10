<?php
/**
 * Login
 * @package  srlab
 * @author   Jaein Lee
 * { Table of Contents }
 * login_styles
 * header_text
 * replace_header
 * replace_lostpass_text
 */

namespace srlab\classes;

defined('ABSPATH') || exit;

if (!class_exists('srlab\classes\Login')) :
   class Login extends Theme
   {
      function __construct()
      {
         add_action('login_enqueue_scripts', [$this, 'sr_login_styles']);
         add_filter('gettext', [$this, 'sr_replace_lostpass_text']);
         add_filter('login_headertext', [$this, 'sr_header_text']);
         add_filter('login_headerurl', fn () => home_url());
         add_action('login_message', [$this, 'sr_replace_header']);
         add_action('login_footer', fn () => printf("<div id='poweredby'>Dev by Jaein Lee @ <a href='%s'>Rebel Group Digital</a></div>", esc_url_raw("http://rebelgroupdigital.com")));
      }

      /**
       * Login styles
       */
      public function sr_login_styles()
      {
         wp_deregister_style('login');
         wp_enqueue_style('login', CSS_DIR . 'login.min.css', [], VERSION);
         wp_add_inline_style('login', '#nsl-custom-login-form-main .nsl-container-login-layout-below{padding: 0 !important}.nsl-container{text-align:center !important}.nsl-button-label-container{font-size:11px !important}');
      }

      public function sr_header_text() {
         if (locate_template('assets/images/logo.svg')) {
            return "<span class='visually-hidden'>" . get_bloginfo('name') . "</span><img src='" . IMG_DIR . "logo_login.svg' width='100' height='60'>";
         } else if (locate_template('assets/images/logo.png')) {
            return "<span class='visually-hidden'>" . get_bloginfo('name') . "</span><img src='" . IMG_DIR . "logo_login.png' width='100' height='60'>";
         } else {
            return get_bloginfo('name');
         }
      }

      public function sr_replace_header()
      {
         return;
      }

      public function sr_replace_lostpass_text($text)
      {
         if ($text === "Lost your password?")
            $text = "Reset Password";

         return $text;
      }
   }
endif;