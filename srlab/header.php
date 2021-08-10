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
				<ul class="menu">
					<?php if (!is_user_logged_in()) : ?>
						<li class="lvl-1"><a href="<?= home_url('login'); ?>" class="plain">Log In</a></li>
						<li class="lvl-1"><a href="<?= home_url('about'); ?>" class="cta b--more pri--btn">How it Works</a></li>
					<?php else :  ?>
						<?php if (function_exists('wc_get_page_id')) : ?>
							<li class="lvl-1">
								<a href="<?= get_permalink(wc_get_page_id('myaccount')); ?>">
									<?php Utility::RenderSVG(THEME_PATH . "assets/svgs/account"); ?>
								</a>
							</li>
							<li class="lvl-1">
								<a href="<?= get_permalink(wc_get_page_id('cart')); ?>" class="">
									<?php Utility::RenderSVG(THEME_PATH . "assets/svgs/bag"); ?>
								</a>
							</li>
						<?php endif; ?>
					<?php endif; ?>
				</ul>
			</nav>
		</div>
	</header>