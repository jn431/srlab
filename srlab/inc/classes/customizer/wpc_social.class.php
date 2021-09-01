<?php
/**
 * Front Page Customizer
 * @package  srlab
 * @author   Jaein Lee
 */
namespace srlab\classes\Customizer;
use srlab\classes\Customizer\WP_Customize_Menu;
defined('ABSPATH') || exit;
if (!class_exists('srlab\classes\Customizer\WPC_Social')) :
	class WPC_Social
	{
		public static function sr_wpc_social($wp_customize)
		{
			$wp_customize->add_section(
				'sr_social',
				[
					'title' => __('Social Media'),
					'panel'  => '',
					'priority' => 20,
					'capability' => 'edit_theme_options',
				]
			);
			$platforms = ['facebook', 'instagram', 'twitter'];
			foreach ($platforms as $platform) :
				$label = \ucfirst($platform);
				$wp_customize->add_setting( "sr_social[$platform]", [
					'default' => '',
					'type' => 'option',
					'transport' => 'refresh',
					'sanitize_callback' => 'esc_url_raw',
				]);
				$wp_customize->add_control(
					"sr_social[$platform]", [
					'type' => "url",
					'label' => __($label, 'srlab'),
					'section' => "sr_social",
					'input_attrs' => [
						'placeholder' => 'https://platform.com/user'
					]
				] );
			endforeach;
		}
	} // End Class
endif;
