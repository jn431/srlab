<?php

/**
 * Front Page Customizer
 * @package  srlab
 * @author   Jaein Lee
 */

namespace srlab\classes\Customizer;

use srlab\classes\Customizer\WP_Customize_Menu;

defined('ABSPATH') || exit;

if (!class_exists('srlab\classes\Customizer\WPC_Footer')) :
	class WPC_Footer
	{

		public static function sr_wpc_footer($wp_customize)
		{
			$wp_customize->add_section(
				'sr_footer_menus',
				[
					'title' => __('Footer'),
					'panel'  => '',
					'priority' => 10,
					'capability' => 'edit_theme_options',
				]
			);

			for ($i = 0; $i <= 1; $i++) :
				$number = $i + 1;
				// * Footer Menu 1 * //
				$wp_customize->add_setting(
					"sr_footer_menus[menu][$i]",
					[
						'type'         => 'option',
						'transport'    => 'refresh',
						'capability'   => 'edit_theme_options',
					]
				);
				$wp_customize->add_control(new WP_Customize_Menu(
					$wp_customize,
					"sr_footer_menus[menu][$i]",
					[
						'type' => 'dropdown-navmenus',
						'priority' => 5,
						'label' => __("Column $number"),
						'section' => 'sr_footer_menus',
					]
				));
			endfor;
		}
	} // End Class
endif;
