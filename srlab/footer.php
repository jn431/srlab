<?php
use srlab\classes\Utility;
/**
 * @package    srlab
 * @author     Jaein Lee
 */
$menus = get_option('sr_footer_menus')['menu'];
?>
<footer>
	<section class="pd">
		<div class="grid gr-4 contain">
			<div class="col">
				<?php Utility::RenderSVG(THEME_PATH . "assets/images/logo"); ?>
			</div>
			<?php for ($i = 0; $i <= 1; $i++) : ?>
				<div class="col">
					<?php
					${"MENU" . $i} = wp_get_nav_menus($menus[$i])[0];
					if (${"MENU" . $i}) {
						echo "<h4>" . ${"MENU" . $i}->name . "</h4>";
						wp_nav_menu(
							[
								'menu_class' => 'menu',
								'items_wrap' => '<ul id="%1$s" data-title="1" class="%2$s">%3$s</ul>',
								'menu_id' => '',
								'container' => '',
								'menu' => $menus[$i],
								'fallback_cb' => false
							]
						);
					}
					?>
				</div>
			<?php endfor; ?>
			<div class="col">
				<?php do_action('theme_social_media'); ?>
			</div>
		</div>
	</section>
	<section id="copyright">
		<div class="contain fl-wrap c-2">
			<div class="col"><?= get_bloginfo('name') . " &copy; " . date('Y'); ?></div>
			<div class="col privacy">
				<a href="<?php echo esc_attr(esc_url(get_privacy_policy_url())); ?>"><?php esc_html_e('Privacy Policy', 'srlab') ?></a>
			</div>
		</div>
	</section>
</footer>
<?php wp_footer(); ?>
</body>
</html>