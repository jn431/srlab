<?php

/**
 * Global Functions
 * @package  srlab
 * @author   Jaein Lee
 */

namespace srlab;

defined('ABSPATH') || exit;
defined('THEME_URI') || define('THEME_URI', trailingslashit(get_template_directory_uri()));
defined('THEME_PATH') || define('THEME_PATH', trailingslashit(str_replace('\\', '/', get_template_directory())));
defined('DIRECTORY_SEPARATOR') || define('DIRECTORY_SEPARATOR', '/');
define('ADMIN_AJAX', admin_url('admin-ajax.php'));
defined('PLUGIN_DIR') || define('PLUGIN_DIR', trailingslashit(WP_PLUGIN_DIR));
defined('CSS_DIR') || define('CSS_DIR', trailingslashit(get_template_directory_uri() . '/assets/css/'));
defined('JS_DIR') || define('JS_DIR', trailingslashit(get_template_directory_uri() . '/assets/js/'));
defined('IMG_DIR') || define('IMG_DIR', trailingslashit(get_template_directory_uri() . '/assets/images/'));

//* constants *//
require_once THEME_PATH . 'inc/autoload.inc.php';
include_once THEME_PATH . 'inc/optimize.inc.php';

$site = [
	"name" => "SR Lab",
	"text_domain" => "srlab",
	"version" => "1.0.0"
];

// ~ theme version ~ //
defined('VERSION') || define('VERSION', $site['version']);
// ~ dev bool ~ //
define('JL_DEV', true);

// Add suffix in live environment
if (defined('JL_DEV') && JL_DEV === true) {
	define('SUFFIX', '');
} else {
	define('SUFFIX', '.min');
}

// * traits/utility * //
require_once 'inc/classes/utility.trait.php';

//* constant classes *//
use srlab\inc\Autoload as Autoload;
use srlab\classes\Admin;
use srlab\classes\Customizer;
use srlab\classes\Theme;
use srlab\classes\ACF;
use srlab\classes\Dynamic;
use srlab\classes\Login;
use srlab\classes\Ecommerce;
use srlab\classes\Template;

new Autoload('srlab\\classes'); // Set namespace

$THEME = new Theme;
$THEME->init();
new Dynamic;
new Customizer;

if (in_array('woocommerce/woocommerce.php', get_option('active_plugins'))) {
	new Ecommerce;
}

if (!is_admin()) {
	new Template;
} else {
	new Admin;
	new ACF;
}

if (in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-admin.php'))) {
	new Login;
}
