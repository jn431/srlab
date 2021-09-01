<?php
/**
 * @package     srlab
 * @version     3.3.0
 */
defined('ABSPATH') || exit;
global $product;
if( $product->is_type('variable') !== true ) :
?>
<p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); ?></p>
<?php endif; ?>