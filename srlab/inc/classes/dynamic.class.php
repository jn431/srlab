<?php
/**
 * Dynamic Class
 * @package srlab
 * @author Jaein Lee
 */
namespace srlab\classes;
defined('ABSPATH') || exit;
if (!class_exists('srlab\classes\Dynamic')) :
	class Dynamic
	{
		function __construct()
		{
			add_action('wp_enqueue_scripts', [$this, 'sr_root_vars']);
			add_action('wp_enqueue_scripts', [$this, 'sr_mast']);
		}
		public function sr_root_vars()
		{
			ob_start(); ?>
			:root {
			--primary-color: #52c8ec;
			--secondary-color: #2779bf;
			--anchor-color: #16537e;
			--darken-primary-color: hsla(194, 60%, 42%, 1);
			--lighten-primary-color: hsla(194, 60%, 72%, 1);
			--primary-hsl: 194, 100%, 62%;
			--gutter-compact: 1100px;
			--gutter-contain: 88%;
			--header-height: 70px;
			}
			<?php
			$css = ob_get_contents();
			ob_end_clean();
			wp_add_inline_style('theme-style', $css);
		} // --- Dynamic Root Vars --- //
		public function sr_mast()
		{
			if (is_front_page()) {
				$mast = get_option("sr_fp_mast") ?? "";
			} else {
				return;
			}
			if (!$mast) {
				return;
			} else {
				ob_start();
			?>
				.mast {
				<?= isset($mast['pos']) ? "--mast-pos: {$mast['pos']};" : "--mast-pos: center center;"; ?>
				<?= $mast['font_color'] ? "--mast-color: {$mast['font_color']};" : ""; ?>
				<?= $mast['bg_color'] ? "--mast-bgcolor: {$mast['bg_color']};" : ""; ?>
				<?php if($mast['bg_img']) : ?>
					--mast-bg: url(<?= wp_get_attachment_url($mast['bg_img'], 'full'); ?>);
					background-image: var(--mast-bg, "url(../images/mast.jpg)");
					background-repeat: no-repeat;
					background-size: cover;
					background-position: var(--mast-pos, center center);
				<?php endif; ?>
				}
<?php
				$css = ob_get_contents();
				ob_end_clean();
				wp_add_inline_style('theme-style', $css);
			}
		}
	} // End Class
endif;
