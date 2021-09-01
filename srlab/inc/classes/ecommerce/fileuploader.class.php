<?php
namespace srlab\classes\Ecommerce;
defined('ABSPATH') || exit;
if (!class_exists('srlab\classes\Ecommerce\File_Uploader')) :
	class File_Uploader
	{
		public function __construct()
		{
			add_action('woocommerce_before_add_to_cart_button', [$this, 'sr_fileUpload']);
			add_filter('woocommerce_add_cart_item_data', [$this, 'sr_add_custom_fields_data_as_custom_cart_item_data'], 10, 2);
			add_filter('woocommerce_get_item_data', [$this, 'sr_display_custom_item_data'], 10, 2);
			add_action( 'woocommerce_checkout_create_order_line_item', [$this, 'sr_custom_field_update_order_item_meta'], 20, 4 );
			add_action( 'woocommerce_after_order_itemmeta', [$this, 'sr_backend_logo_link_after_order_itemmeta'], 20, 3 );
		}
		public function sr_fileUpload()
		{
			//woocommerce_before_add_to_cart_button
			$options = array(__("Front Side"), __("Back Side"), __("Both Sides"));
?>
			<div class="upload-logo">
				<p><strong><?php _e("Add a Logo option"); ?>: </strong>
					<a href="#" class="button"><?php _e("Yes"); ?></a>
					<input type="hidden" name="upload_active" value="">
				</p>
				<div id="hidden-inputs" style="display:none">
					<p><label for="radio_field"><?php
															echo __("Where you want the logo?") . ' <br>';
															// Loop though each $options array
															foreach ($options as $key => $option) {
																$atts = $key == 0 ? 'name="side_field" checked="checked"' : 'name="side_field"'; ?>
								<input type="radio" <?php echo $atts; ?> value="<?php echo $option; ?>"><span> <?php echo $option . '</span> ';
																																		}
																																			?>
						</label></p>
					<p><label for="file_field"><?php echo __("Upload logo") . ': '; ?>
							<input type='file' name='image' accept='image/*'>
						</label></p>
				</div>
			</div>
			<script type="text/javascript">
				jQuery(function($) {
					var a = '.upload-logo',
						b = a + ' a.button',
						c = a + ' #hidden-inputs',
						d = a + ' input[type=hidden]';
					$(b).click(function(e) {
						e.preventDefault();
						if (!$(this).hasClass('on')) {
							$(this).addClass('on');
							$(c).show();
							$(d).val('1');
						} else {
							$(this).removeClass('on');
							$(c).hide('fast');
							$(d).val('');
						}
					});
				});
			</script>
<?php
		}
		public function sr_add_custom_fields_data_as_custom_cart_item_data($cart_item, $product_id)
		{
			if (isset($_POST['upload_active']) && $_POST['upload_active'] && isset($_FILES['image'])) {
				$upload = wp_upload_bits($_FILES['image']['name'], null, file_get_contents($_FILES['image']['tmp_name']));
				$filetype = wp_check_filetype(basename($upload['file']), null);
				$upload_dir = wp_upload_dir();
				$upl_base_url = is_ssl() ? str_replace('http://', 'https://', $upload_dir['baseurl']) : $upload_dir['baseurl'];
				$base_name = basename($upload['file']);
				$cart_item['custom_file'] = array(
					'guid'      => $upl_base_url . '/' . _wp_relative_upload_path($upload['file']),
					'file_type' => $filetype['type'],
					'file_name' => $base_name,
					'title'     => preg_replace('/\.[^.]+$/', '', $base_name),
					'side'      => isset($_POST['side_field']) ? sanitize_text_field($_POST['side_field']) : '',
					'key'       => md5(microtime() . rand()),
				);
			}
			return $cart_item;
		}
		public function sr_display_custom_item_data($cart_item_data, $cart_item)
		{
			if (isset($cart_item['custom_file']['title'])) {
				$cart_item_data[] = array(
					'name' => __('Logo', 'woocommerce'),
					'value' =>  $cart_item['custom_file']['title']
				);
			}
			if (isset($cart_item['custom_file']['side'])) {
				$cart_item_data[] = array(
					'name' => __('Side', 'woocommerce'),
					'value' =>  $cart_item['custom_file']['side']
				);
			}
			return $cart_item_data;
		}
		public function sr_custom_field_update_order_item_meta( $item, $cart_item_key, $values, $order ) {
			if ( isset( $values['custom_file'] ) ){
				 $item->update_meta_data( __('Logo'),  $values['custom_file']['title'] );
				 $item->update_meta_data( __('Side'),  $values['custom_file']['side'] );
				 $item->update_meta_data( '_logo_file_data',  $values['custom_file'] );
			}
	  }
	  public function sr_backend_logo_link_after_order_itemmeta( $item_id, $item, $product ) {
		// Only in backend for order line items (avoiding errors)
		if( is_admin() && $item->is_type('line_item') && $item->get_meta('_logo_file_data') ){
			 $file_data = $item->get_meta( '_logo_file_data' );
			 echo '<p><a href="'.$file_data['guid'].'" target="_blank" class="button">'.__("Open Logo") . '</a></p>';
			 echo '<p>Link: <textarea type="text" class="input" readonly>'.$file_data['guid'].'</textarea></p>';
		}
  }
	} // End Class
endif;
