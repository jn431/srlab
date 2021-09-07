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
				<?php
				$item_login = '<li class="mobile-item"><a href="http://www.google.com">My Account</a></li>';
				wp_nav_menu(
					[
						'theme_location' => 'primary_menu',
						'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s ' . $item_login . '</ul>',
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
					<button type="button" href="<?= home_url('login'); ?>" id="login-btn" class="plain">Log In</button>
					<a href="<?= home_url('about'); ?>" class="cta b--more pri--btn">How it Works</a>

					<div id="login-panel">
						<?php wc_get_template('myaccount/form-login.php'); ?>
					</div>
				<?php else :  ?>
					<?php if (function_exists('wc_get_page_id')) : ?>
						<a href="<?= get_permalink(wc_get_page_id('myaccount')); ?>" class="icon">
							<?php Utility::RenderSVG(THEME_PATH . "assets/svgs/account"); ?>
						</a>
						<a href="<?= get_permalink(wc_get_page_id('cart')); ?>" class="icon-cart icon">
							<?php Utility::RenderSVG(THEME_PATH . "assets/svgs/bag"); ?>
							<?php global $woocommerce; ?><span class="cart-count"><?= $woocommerce->cart->cart_contents_count; ?></span>
						</a>
					<?php endif; //wc_get_page_id
					?>
				<?php endif; ?>
				</ul>

				<?php
				$size = isset($posted['mobile-button-size']) ? $posted['mobile-button-size'] : 50; // default: 50
				$viewBox = $size * 2; // default: 50 * 2
				$radius = $size - 10;
				?>
				<button type="button" class="wrap" id="mob-btn">
					<div class="lines">
						<div class="menu__line menu__line--1"></div>
						<div class="menu__line menu__line--2"></div>
						<div class="menu__line menu__line--3"></div>
					</div>
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 <?= $viewBox; ?> <?= $viewBox; ?>" width="<?= $size; ?>" height="<?= $size; ?>">
						<circle class="circle first" cx="<?= $size; ?>" cy="<?= $size; ?>" r="<?= $radius; ?>" />
					</svg>
				</button>
			</nav>
		</div>
	</header>