<?php
/**
 * Front Page Customizer
 * @package  srlab
 * @author   Jaein Lee
 */
namespace srlab\classes\Customizer;
defined('ABSPATH') || exit;
if (!class_exists('srlab\classes\Customizer\WPC_Frontpage')) :
	class WPC_Frontpage
	{
		public static function sr_wpc_frontpage($wp_customize)
		{
			$wp_customize->add_panel("sr_fp_slider", [
				'priority' 		=> 10,
				'capability' 	=> 'edit_theme_options',
				'title' 			=> 'Home Slider',
				'description' 	=> '',
			]);
			for ($i = 0; $i <= 2; $i++) {
				$number = $i + 1;
				$wp_customize->add_section("sr_fp_slider[$i]", [
					'priority' 		=> 1,
					'title' 			=> __("Slide $number", 'srlab'),
					'description' 	=> __('', 'srlab'),
					'panel' 			=> "sr_fp_slider",
					'capability' 	=> 'edit_theme_options'
				]);
				// : Frontpage Mast BG Image : //
				$wp_customize->add_setting("sr_fp_slider[$i][imageID]", [
					'default' 	=> 38,
					'type' 		=> 'option',
					'transport' => 'refresh',
					'sanitize_callback' => 'sanitize_text_field',
				]);
				$wp_customize->add_control(
					new \WP_Customize_Cropped_Image_Control(
						$wp_customize,
						"sr_fp_slider[$i][imageID]",
						[
							'label' 		=> __('Image', 'srlab'),
							'section' 	=> "sr_fp_slider[$i]",
							'flex_height' => true,
							'flex_width' => true
						]
					)
				);
				// : Main Heading : //
				$wp_customize->add_setting("sr_fp_slider[$i][main_heading]", [
					'default' => 'Orthodontics',
					'type' => 'option',
					'transport' => 'refresh',
					'sanitize_callback' => 'sanitize_text_field',
				]);
				$wp_customize->add_control(
					"sr_fp_slider[$i][main_heading]",
					[
						'type' => "text",
						'label' => __('Main Heading', 'srlab'),
						'section' => "sr_fp_slider[$i]",
						'input_attrs' => [
							'maxlength' => '150',
						]
					]
				);
				// : Super Heading : //
				$wp_customize->add_setting("sr_fp_slider[$i][super_heading]", [
					'default' => '',
					'type' => 'option',
					'transport' => 'refresh',
					'sanitize_callback' => 'sanitize_text_field',
				]);
				$wp_customize->add_control(
					"sr_fp_slider[$i][super_heading]",
					[
						'type' => "text",
						'label' => __('Super Heading', 'srlab'),
						'section' => "sr_fp_slider[$i]",
						'input_attrs' => [
							'maxlength' => '90',
						]
					]
				);
				// : Blurb Text : //
				$wp_customize->add_setting("sr_fp_slider[$i][blurb]", [
					'default' => 'Orthodontic services including orthodontic plans, model printing and aligner fabrication.',
					'type' => 'option',
					'transport' => 'refresh',
					'sanitize_callback' => 'sanitize_text_field',
				]);
				$wp_customize->add_control(
					"sr_fp_slider[$i][blurb]",
					[
						'type' => "textarea",
						'label' => __('Blurb Text', 'srlab'),
						'section' => "sr_fp_slider[$i]",
						'input_attrs' => [
							'maxlength' => '250',
						]
					]
				);
				for($ct = 0; $ct <= 3; $ct++) {
					$wp_customize->add_setting( "sr_fp_slider[$i][pages][$ct]", [
						'default' => '',
						'type' => 'option',
						'transport' => 'refresh',
					]);
					$wp_customize->add_control(
						"sr_fp_slider[$i][pages][$ct]", [
						'type' => "dropdown-pages",
						'label' => __('Service Page', 'srlab'),
						'section' => "sr_fp_slider[$i]",
					] );
				}
			}
		}
	} // End Class
endif;
