<?php

/**
 * Theme Activation Setup
 * @package  srlab
 * @author   Jaein Lee
 *
 * [1] Create Primary Menu
 * [2] Set Base Options
 * [3] Create Homepage
 * [4] Create Homepage Mast Slider
 * [5] Set Site Footer Menus
 * [6] WooCommerce Programmatically Add Categories
 * [7] WooCommerce Default Store Options
 */

namespace srlab\classes;

use srlab\classes\Utility;

defined('ABSPATH') || exit;

if (!class_exists('srlab\classes\Setup')) :
   class Setup extends Theme
   {
      use Utility;

      public $author_id    = 1;
      public $status       = 'publish';
      public $type;
      public $default = [
			"address"   => "2355 160 St",
			"city"		=> "Surrey",
			"state"		=> "CA:BC",
			"zip"			=> "V3S 9N6"
		];

      public function sr_new_install()
      {
         $this->sr_base_settings();
         $this->sr_setup_menu();
         $this->sr_create_the_homepage();
         $this->sr_create_homepage_slider();
         $this->sr_setup_footer_menus();

         $this->Upload_Img("orthodontics.png");
         $this->Upload_Img("surgical-guides.png");
         $this->Upload_Img("training.png");
         // ! New installation add option to database ! //
         add_option('sr_theme', true);
      }

      public function sr_new_install_woo() {
         $this->sr_woo_setup();
      }

      /**
       * Create Primary Menu
       */
      public function sr_setup_menu()
      {
         $menu_exists = wp_get_nav_menu_object("Primary Menu");
         if (!$menu_exists) {
            $menu_id = wp_create_nav_menu("Primary Menu");

            // Set up default BuddyPress links and add them to the menu.
            wp_update_nav_menu_item($menu_id, 0, array(
               'menu-item-title' =>  __('Home'),
               'menu-item-classes' => 'home',
               'menu-item-url' => home_url('/'),
               'menu-item-status' => 'publish'
            ));

            wp_update_nav_menu_item($menu_id, 0, array(
               'menu-item-title' =>  __('About Us'),
               'menu-item-classes' => 'about-us',
               'menu-item-url' => home_url('/about-us/'),
               'menu-item-status' => 'publish'
            ));

            wp_update_nav_menu_item($menu_id, 0, array(
               'menu-item-title' =>  __('Shop'),
               'menu-item-classes' => 'shop',
               'menu-item-url' => home_url('/shop/'),
               'menu-item-status' => 'publish'
            ));

            wp_update_nav_menu_item($menu_id, 0, array(
               'menu-item-title' =>  __('Contact'),
               'menu-item-classes' => 'contact',
               'menu-item-url' => home_url('/contact/'),
               'menu-item-status' => 'publish'
            ));
            if (!has_nav_menu("primary_menu")) {
               $locations = get_theme_mod('nav_menu_locations');
               $locations["primary_menu"] = $menu_id;
               set_theme_mod('nav_menu_locations', $locations);
            }
         }
      }

      /**
       * Set Base Options
       */
      public function sr_base_settings()
      {
         // Thumbnail 360p
         update_option('thumbnail_size_w', 480);
         update_option('thumbnail_size_h', 360);
         // Medium 480p
         update_option('medium_size_w', 720);
         update_option('medium_size_h', 480);
         update_option('medium_crop', 1);
         // Medium Large 720p
         update_option('medium_large_size_w', 1280);
         update_option('medium_large_size_h', 720);
         update_option('medium_large_crop', 1);
         // Large 1080p
         update_option('large_size_w', 1920);
         update_option('large_size_h', 1080);
         update_option('large_crop', 1);

         update_option('blogname', Theme::$site_name);
         update_option('blogdescription', Theme::$slogan);
         update_option('permalink_structure', '/%postname%/');
         update_option('default_comment_status', 'closed');
         update_option('page_comments', 0);
         update_option('page_on_front', 1);
         update_option('users_can_register', 1);
         update_option('show_on_front', 'page');
      }

      /**
       * Create Homepage
       */
      public function sr_create_the_homepage()
      {
         if (get_page_by_title('home')) {
            $home = get_page_by_title('home');
         } else {
            $id = $this->create_a_page('Home', 'front-page.php', '');
            $home = get_page_by_title('Home');
         }
         update_option('page_on_front', $home->ID);
      }

      /**
       * Create Homepage Mast Slider
       */
      public function sr_create_homepage_slider()
      {
         $opt =
            [
               0 => [
                  "imageID"         => Utility::sr_get_attachment_by_name("orthodontics")->ID,
                  "main_heading"    => "Orthodontics",
                  "blurb"           => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis tellus id velit accumsan placerat non eu nisi. Morbi lacu,felis, auctor a lorem vel, facilisis pharetra nulla.",
                  "pages"           => [1 => 1, 2 => 2]
               ],
               1 => [
                  "imageID"         => Utility::sr_get_attachment_by_name("surgical-guides")->ID,
                  "main_heading"    => "Surgical Guides",
                  "blurb"           => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis tellus id velit accumsan placerat non eu nisi. Morbi lacu,felis, auctor a lorem vel, facilisis pharetra nulla.",
                  "pages"           => [1 => 1, 2 => 2]
               ],
               2 => [
                  "imageID"         => Utility::sr_get_attachment_by_name("training")->ID,
                  "main_heading"    => "Training And Education",
                  "blurb"           => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis tellus id velit accumsan placerat non eu nisi. Morbi lacu,felis, auctor a lorem vel, facilisis pharetra nulla.",
                  "pages"           => [1 => 1, 2 => 2]
               ]
            ];

         update_option("sr_fp_slider", $opt);
      }

      /**
       * Set Site Footer Menus
       */
      public function sr_setup_footer_menus()
      {
         $opt['menu'] = ['primary-menu', 'primary-menu'];
         update_option("sr_footer_menus", $opt);
      }

      /**
       * WooCommerce Default Store Options
       */
      public function sr_woo_setup()
		{
			update_option('woocommerce_store_address', $this->default['address']);
			update_option('woocommerce_store_city', $this->default['city']);
			update_option('woocommerce_default_country', $this->default['state']);
			update_option('woocommerce_store_postcode', $this->default['zip']);
			update_option('woocommerce_enable_reviews', false);
         update_option( 'woocommerce_shop_page_display', 'subcategories');
         update_option( 'woocommerce_catalog_rows', 6);
		}
   }
endif;
