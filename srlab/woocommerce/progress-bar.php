<div id="order-progress">
	<div data-step="review" <?= (is_checkout()) ? "class='active'" : ""; ?>>Order Review <span></span></div>
	<div data-step="billing">Billing <span></span></div>
	<?php if ( WC()->cart->needs_shipping() ) : ?> <div data-step="shipping">Shipping <span></span></div> <?php endif; ?>
	<div data-step="payment">Payment <span></span></div>
</div>