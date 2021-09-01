<?php
namespace srlab\classes;
defined('ABSPATH') || exit;
if (!class_exists('srlab\classes\Form')) :
	class Form
	{
		// * Properties * //
		public $contact_fields = [
			'first_name' => [
				'label' => 'First Name',
				'required' => true,
				'input_type' => 'text',
				'input_attr' => 'class="input"',
				'width' => ''
			],
			'last_name' => [
				'label' => 'Last Name',
				'required' => true,
				'input_type' => 'text',
				'input_attr' => 'class="input"',
				'width' => ''
			],
			'email' => [
				'label' => 'Email',
				'required' => true,
				'input_type' => 'email',
				'input_attr' => 'class="input"',
				'width' => ''
			],
			'phone' => [
				'label' => 'Phone',
				'required' => false,
				'input_type' => 'tel',
				'input_attr' => 'class="input"',
				'width' => ''
			],
			'subject' => [
				'label' => 'Subject',
				'required' => true,
				'input_type' => 'text',
				'input_attr' => 'class="input"',
				'width' => 'form_full'
			],
			'message' => [
				'label' => 'Message',
				'required' => true,
				'input_type' => 'textarea',
				'input_attr' => 'rows="5" class="input"',
				'width' => 'form_full'
			],
		]; // $fields
		public function __construct()
		{
			add_action('init', [$this,  'sr_contact_cpt'], 0);
		}
		public function sr_contact_cpt()
		{
			// Register Custom Post Type
			$labels = array(
				'name'                  => _x('Inquiries', 'Post Type General Name', 'srlab'),
				'singular_name'         => _x('Inquiry', 'Post Type Singular Name', 'srlab'),
				'menu_name'             => __('Contact Inquiries', 'srlab'),
				'name_admin_bar'        => __('Inquiries', 'srlab'),
				'archives'              => __('Item Archives', 'srlab'),
				'attributes'            => __('Item Attributes', 'srlab'),
				'parent_item_colon'     => __('Parent Item:', 'srlab'),
				'all_items'             => __('All Inquiries', 'srlab'),
			);
			$args = array(
				'label'                 => __('Inquiry', 'srlab'),
				'labels'                => $labels,
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_menu'          => true,
				'menu_position'         => 30,
				'show_in_admin_bar'     => false,
				'show_in_nav_menus'     => false,
				'can_export'            => true,
				'has_archive'           => false,
				'exclude_from_search'   => true,
				'publicly_queryable'    => false,
				'capability_type'       => 'page',
				'supports'					=> ['title']
			);
			register_post_type('contact_inquiry', $args);
		}
		public function sr_form_input($id, $args)
		{
			$add_attrs = $args['input_attr'] ?? "";
			$attrs = "id='" . esc_attr($id) . "' name='" . esc_attr($id) . "' $add_attrs";
			if( $args['input_type'] === 'textarea') {
				$input = "<textarea $attrs></textarea>";
			} else if ( $args['input_type'] === "select") {
				$choices = [];
				$input = "<select $attrs>$choices</select>";
			} else {
				$input = "<input type='{$args['input_type']}' $attrs>";
			}
			$required = ($args['required'] === true) ? "<abbr class='required' title='required'>*</abbr>" : "";
			echo "<div class='" . trim("form-wrap {$args['width']}") . "'><label for='$id'>" . esc_html($args['label'], 'srlab') . " $required</label>";
			echo $input;
			echo "</div>";
		}
		public function sr_contact_form()
		{
			foreach ($this->contact_fields as $id => $args) :
				$this->sr_form_input($id, $args);
				//call_user_func([$this, 'sr_form_input'], );
			endforeach;
		}
	} // End Class
endif;
