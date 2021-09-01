<?php
/**
 * Template Class
 * @package  srlab
 * @author   Jaein Lee
 */
namespace srlab\classes;
defined('ABSPATH') || exit;
if (!class_exists('srlab\classes\Template')) {
   class Template
   {
      public function __construct()
      {
         add_action('theme_social_media', [$this, 'sr_social_icons']);
      }
      /**
       * Display Social Media Icons
       */
      public function sr_social_icons()
      {
         $platforms = get_option('sr_social');
         if (Utility::count_array_with_values($platforms) === 0) {
            echo "<ul class='menu'><li><a href='"  . admin_url('customize.php') . "'>Add Social Media</a></li></ul>";
            return;
         } else {
            ob_start();
            echo "<h4>Connect with us</h4><div class='social-media'>";
            foreach ($platforms as $platform => $url) :
               if ($platform && $url) {
                  echo "<a href='$url' class='sm icon $platform' target='_blank'><span>$platform</span></a>";
               }
            endforeach;
            echo "</div>";
            ob_end_flush();
         }
      }
   } // --- Customizer --- //
}
