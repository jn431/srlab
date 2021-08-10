<?php

/**
 * Product Loop Start
 * @package    srlab
 * @version    3.3.0
 */

defined('ABSPATH') || exit;

/* $grid_class = (is_front_page())
? "fl-grid-" . esc_attr(wc_get_loop_prop('columns'))
: "grid gr-" . esc_attr(wc_get_loop_prop('columns')); */
$grid_class = "gr-2";
?>

<?= (is_shop()) ? "<div id='sf-products'>" : ''; ?>
<div class="products grid <?= $grid_class;?>">