<?php

/**
 * 404 Page
 * @package    srlab
 * @author     Jaein Lee
 */

use srlab\classes\Utility;

get_header(); ?>

<main class="error-404">
	<h1 class="visually-hidden">404</h1>
	<section class="pd">
		<div class="compact center">
			<strong>PAGE NOT FOUND</strong>
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 213 89" class="h1-404">
				<path class="shadow" d="M42 71H3V60l42-58h12v55h11v14H57v17H42V71zM42 58l0-28L22 58H42z" />
				<path class="shadow" d="M77 45c0-26 13-44 32-44s32 18 32 44c0 26-13 44-31 44S77 71 77 45zM124 45c0-18-6-30-15-30S94 27 94 45c0 18 6 30 15 30S124 63 124 45z" />
				<path class="shadow" d="M186 71h-38V60l42-58h12v55h11v14h-11v17H186V71zM186 58l0-28 -20 28H186z" />
				<path d="M39 68H0V57L42 1h12V55h11v13H54v16H39V68zM39 55L39 28 19 55H39z" />
				<path d="M74 43C74 17 87 0 106 0s32 17 32 43c0 26-13 43-31 43S74 68 74 43zM121 43c0-18-6-29-15-29S91 25 91 43c0 18 6 30 15 30S121 60 121 43z" />
				<path d="M183 68h-38V57l42-56h12V55h11v13h-11v16h-16V68zM183 55l0-27L163 55H183z" />
			</svg>

			<p>Oops! It appears that what you're looking for has been moved or deleted.</p>
			<div class="cta-links">
				<a href="<?= home_url(); ?>" class="btn pri--btn b--hero">Return to Homepage</a>
				<a href="<?= home_url('contact'); ?>" class="btn sec--btn b--hero">Contact Us</a>
			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>