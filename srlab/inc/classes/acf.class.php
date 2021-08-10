<?php
/**
 * ACF Class
 * @package  srlab
 * @author   Jaein Lee
 */

namespace srlab\classes;

defined('ABSPATH') || exit;

if (!class_exists('srlab\classes\ACF')) :
	class ACF
	{
		function __construct()
		{
			add_action('acf/init', [$this, 'acf_admin_option_page']);
			add_filter('acf/load_field/name=footer_menu', [$this, 'acf_admin_option_menu_list']);
			add_filter('acf/settings/save_json', [$this, 'acf_json_save']);
			add_filter('acf/settings/load_json', [$this, 'acf_json_load']);
		}

		/**
		 * Create theme options page
		 */
		public function acf_admin_option_page() {
			if (function_exists('acf_add_options_page')) {
				acf_add_options_page([
					'page_title' => 'Theme General Settings',
					'menu_title' => 'Theme Settings',
					'menu_slug' => 'theme-general-settings',
					'capability' => 'edit_posts',
					'redirect' => false
				]);
			}
		}

		/**
		 * Get menu names
		 * @param string $field
		 * @return array $field
		 */
		public function acf_admin_option_menu_list($field) {
		$field['choices'] = [];
		$choices = get_registered_nav_menus();

			foreach ($choices as $choice => $val) {
				$val = $val;
				$name = $choice;
				$field['choices'][$choice] = $val;
			}
			return $field;
		}

		public function acf_json_load($paths) {
			unset($paths[0]);
			$paths = [THEME_PATH . 'assets/json/'];
			return $paths;
		}

		public function acf_save_json($path) {
			$path = THEME_PATH . 'assets/json/';
			return $path;
		}
	}
endif;