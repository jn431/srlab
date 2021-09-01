<?php
/**
 * Admin Class
 * @package  srlab
 * @author   Jaein Lee
 */
namespace srlab\classes;
defined('ABSPATH') || exit;
if (!class_exists('srlab\classes\Admin')) :
	class Admin extends Theme
	{
		public function __construct()
		{
			add_action('admin_enqueue_scripts', [$this, 'sr_admin_style'], 50);
			add_action('admin_enqueue_scripts', [$this, 'sr_admin_js']);
			add_action('admin_init', [$this, 'sr_color_scheme']);
			add_filter('get_user_option_admin_color', [$this, 'sr_default_color_scheme'], 10, 2);
			// Global
			remove_action('welcome_panel', 'wp_welcome_panel');
			add_action('admin_head', [$this, 'sr_customizer_init']);
			add_action('admin_head-post.php', [$this, 'sr_admin_head_func']); // todo 1
			add_action('do_meta_boxes', [$this, 'sr_unset_dashboard_metaboxes']); // todo 2
			add_action('admin_enqueue_scripts', [$this, 'sr_adminmenu_depth']); // todo 3
			add_filter('tiny_mce_before_init', [$this, 'sr_tinymce_formats']);
			// Menus
			add_action('admin_menu', [$this, 'sr_remove_posts_menu']);
			add_filter('comments_open', '__return_false', 20, 2); // Disable comments
			add_filter('pings_open', '__return_false', 20, 2); // Disable pings
			// Theme Activation
			add_action('after_switch_theme', [$this, 'sr_theme_activation']);
		}
		/**
		 * Theme Activation
		 */
		public function sr_theme_activation()
		{
			$SETUP = new Setup;
			$SETUP->sr_new_install();
			$SETUP->sr_new_install_woo();
		}
		/**
		 * Generate :root from Customizer
		 * @uses Class:Customizer
		 * @return void
		 */
		public function sr_customizer_init()
		{
			$customizer = new Customizer;
			//$customizer\customizer_css();
		}
		/**
		 * Admin CSS Assets
		 */
		public function sr_admin_style()
		{
			// * Default Admin & ACF * //
			$scripts = [
				//'common' => [],
				//'buttons' => [],
				//'acf' => []
			];
			foreach ($scripts as $handle => $dep) {
				wp_deregister_style($handle);
				wp_enqueue_style($handle, CSS_DIR . 'admin/' . "{$handle}.min.css", $dep, VERSION);
			}
			wp_enqueue_style('theme-admin', CSS_DIR . 'admin/admin' . SUFFIX .  '.css', [], VERSION);
			ob_start(); ?>
			:root {
			--primary-color: #52c8ec;
			--secondary-color: #2779bf;
			--anchor-color: #16537e;
			--darken-primary-color: hsla(194, 60%, 42%, 1);
			--lighten-primary-color: #759197;
			--primary-hsl: 194, 100%, 62%;
			--gutter-compact: 1100px;
			--gutter-contain: 88%;
			}
<?php
			$css = ob_get_contents();
			ob_end_clean();
			wp_add_inline_style('theme-admin', $css);
		}
		/**
		 * Admin JS Assets
		 */
		public function sr_admin_js()
		{
			//wp_enqueue_script( 'theme-admin-js', JS_DIR . 'admin' . SUFFIX . '.js', [], VERSION, true ); // * admin.js * //
			//wp_enqueue_script( 'theme-customizer', JS_DIR . 'customizer' . SUFFIX . '.js', ['jquery', 'customize-preview'], VERSION, true ); // * customizer.js * //
		}
		/**
		 * Create Color Scheme
		 */
		public function sr_color_scheme()
		{
			wp_admin_css_color(
				"srlab",
				__("SR Lab", "srlab"),
				THEME_URI . 'assets/css/color_scheme/colors.css',
				["#52c8ec", "#2779bf", "#52c8ec", "#444444"]
			);
		}
		/**
		 * Set Default Color Scheme
		 * @param int $user_id
		 * @param array $color_scheme
		 */
		public function sr_default_color_scheme($user_id, $color_scheme)
		{
			global $_wp_admin_css_colors;
			if (!isset($_wp_admin_css_colors[$color_scheme])) {
				$color_scheme = "srlab";
			}
			return $color_scheme;
		}
		/**
		 * Dashboard Metaboxes - Unset
		 */
		public function sr_unset_dashboard_metaboxes()
		{
			global $wp_meta_boxes;
			$normal = [
				'dashboard_activity', 'dashboard_incoming_links', 'dashboard_plugins', 'dashboard_recent_comments', 'dashboard_right_now', 'dashboard_site_health', 'yoast_db_widget'
			];
			$side = ['dashboard_primary', 'dashboard_secondary', 'dashboard_quick_press', 'dashboard_recent_drafts'];
			if (get_current_screen()->id === "dashboard") {
				foreach ($normal as $n) {
					unset($wp_meta_boxes['dashboard']['normal']['core'][$n]);
				}
				foreach ($side as $s) {
					unset($wp_meta_boxes['dashboard']['side']['core'][$s]);
				}
			}
		}
		/**
		 * Remove "Posts" from admin menu
		 */
		public function sr_remove_posts_menu()
		{
			remove_menu_page('edit.php');
		}
		public function sr_admin_head_func()
		{
			global $wp_meta_boxes;
			if (get_current_screen()->id === 'page') {
				remove_meta_box('commentstatusdiv', 'page', 'normal');
				remove_meta_box('authordiv', 'page', 'normal');
				remove_meta_box('postimagediv', 'page', 'normal');
				if (get_the_title() === "Login") {
					remove_post_type_support('page', 'editor');
					remove_meta_box('submitdiv', 'page', 'normal');
					remove_meta_box('pageparentdiv', 'page', 'normal');
				}
			}
			remove_meta_box('commentsdiv', 'page', 'normal');
		}
		/**
		 * Appearance menus depth
		 * @param string $hook
		 */
		public function sr_adminmenu_depth($hook)
		{
			if ($hook != 'nav-menus.php') return;
			wp_add_inline_script('nav-menu', 'wpNavMenu.options.globalMaxDepth = 3;', 'after');
		}
		/**
		 * Set formatting options for tinymce
		 * @param array $in
		 */
		public function sr_tinymce_formats($in)
		{
			$in['paste_remove_spans'] = true;
			$in['toolbar1'] = 'bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,spellchecker, formatselect, forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help';
			$in['toolbar2'] = '';
			$in['block_formats'] = "Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;";
			return $in;
		}
		/**
		 * Disable Check Ontop
		 * Unable moving of checked items from heirarchy
		 * @param array $args
		 * @return array
		 */
		public function admin_disable_checked_ontop($args)
		{
			$args['checked_ontop'] = false;
			return $args;
		}
	}
endif;
