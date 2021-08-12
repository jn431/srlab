<?php

/**
 * @package    srlab
 * @author     Jaein Lee
 */

use srlab\classes\Utility;

?>
<!DOCTYPE html>
<html lang="<?php bloginfo('language'); ?>">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header>
		<div class="contain header-wrap">
			<div class="logo-wrap">
				<a href="<?= home_url(); ?>" class="hdr-logo-link">
					<span class="visually-hidden"><?php bloginfo('name'); ?></span>
					<img src="<?= IMG_DIR; ?>logo.svg" width="300" height="33" class="hdr-logo">
				</a>
			</div>
			<nav id="primary">
				<?php wp_nav_menu(
					[
						'theme_location' => 'primary_menu',
						'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'menu_id' => '',
						'menu_class' => 'menu',
						'container' => '',
						'fallback_cb'	=> function () {
							echo "<ul class='menu'><li><a href='"  . admin_url('nav-menus.php') . "'>Set up primary menu</a></li></ul>";
						},
						'depth' => 2,
					]
				); ?>
			</nav>
			<nav id="aside">

				<?php if (!is_user_logged_in()) : ?>
					<a href="<?= home_url('login'); ?>" class="plain">Log In</a>
					<a href="<?= home_url('about'); ?>" class="cta b--more pri--btn">How it Works</a>
				<?php else :  ?>
					<?php if (function_exists('wc_get_page_id')) : ?>

						<a href="<?= get_permalink(wc_get_page_id('myaccount')); ?>" class="icon">
							<?php Utility::RenderSVG(THEME_PATH . "assets/svgs/account"); ?>
						</a>
						<a href="<?= get_permalink(wc_get_page_id('cart')); ?>" class="icon-cart icon">

							<?php Utility::RenderSVG(THEME_PATH . "assets/svgs/bag"); ?>

							<?php global $woocommerce;?><span class="cart-count"><?= $woocommerce->cart->cart_contents_count; ?></span>

						</a>

					<?php endif; //wc_get_page_id
					?>
				<?php endif; ?>
				</ul>
			</nav>
		</div>
	</header>