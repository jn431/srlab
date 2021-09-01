<?php
use srlab\classes\Utility;
/**
 * @package    srlab
 * @author     Jaein Lee
 */
$menus = get_option('sr_footer_menus')['menu'];
?>
<footer>
	<section id="copyright">
		<div class="contain fl-wrap l-2">
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