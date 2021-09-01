<?php
/**
 * Assets Class
 * @package  srlab
 * @author   Jaein Lee
 */
namespace srlab\classes;
use srlab\classes\Utility;
defined('ABSPATH') || exit;
if (!class_exists('srlab\classes\Assets')) :
	class Assets
	{
		use Utility;
		/**
		 * Override Adminbar
		 */
		public function sr_theme_adminbar()
		{
			wp_deregister_style('admin-bar');
			wp_enqueue_style('admin-bar', CSS_DIR . 'admin/adminbar.min.css', ['dashicons'], VERSION);
		}
		/**
		 * Theme Styles - Enqueue/Register CSS
		 */
		public function sr_assets_styles()
		{
			// ! main.css ! //
			wp_enqueue_style(
				'theme-style',
				CSS_DIR . 'main' . SUFFIX . '.css',
				['dashicons'],
				VERSION
			);
			// : viewport : //
			if (locate_template('assets/css/highvp.min.css') && SUFFIX !== "") :
				wp_enqueue_style(
					'theme-hvp-style',
					CSS_DIR . 'highvp.min.css',
					[],
					VERSION,
					'(min-width: 768px)'
				);
			endif; // --- highvp.css production only --- //
			// * override select2 * //
			wp_deregister_style('select2');
			wp_register_style('select2', CSS_DIR . 'vendors/select2' . SUFFIX . '.css', [], VERSION);
			// * slick.css * //
			wp_register_style('slick-style', CSS_DIR . 'misc/slick.css', ['theme-style'], VERSION);
			if (is_front_page()) {
				wp_enqueue_style('slick-style');
			}
		} // --- assets_styles --- //
		/**
		 * Theme Enqueue/Register Scripts
		 */
		public function sr_assets_scripts()
		{
			// * jQuery
			wp_deregister_script('jquery');
			wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.5.1.min.js', [], '3.5.1');
			wp_script_add_data('jquery', ['integrity', 'crossorigin'], ['sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=', 'anonymous']);
			if (locate_template("assets/js/main.js")) {
				// * Main.js (alias: theme-js) * //
				wp_enqueue_script('theme-js', JS_DIR . 'main' . SUFFIX . '.js', [], VERSION, true);
				// * Javascript {object} php_url_js
				//wp_localize_script('theme-js', 'url', $php_url_js);
			}
			// * Slick * //
			if (locate_template("assets/js/slick.min.js")) {
				wp_enqueue_script('slick-js', JS_DIR . 'slick.min.js', [], VERSION, true);
			}
		}
		function add_type_to_script($tag, $handle, $source)
		{
			if ('theme-js' === $handle) {
				$tag = str_replace("type='text/javascript'", "type='module' defer", $tag);
				//$tag = '<script type="text/javascript" src="' . $source . '" type="module"></script>';
			}
			return $tag;
		}
	}
endif; // --- !Exists --- //
