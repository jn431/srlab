<?php

$size = isset($posted['mobile-button-size']) ? $posted['mobile-button-size'] : 50; // default: 50
$viewBox = $size * 2; // default: 50 * 2
$radius = $size - 10;

?>
<button type="button" class="wrap" id="mob-btn">
   <div class="stack">
      <div class="menu__line menu__line--1"></div>
      <div class="menu__line menu__line--2"></div>
      <div class="menu__line menu__line--3"></div>
   </div>
   <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 <?= $viewBox; ?> <?= $viewBox; ?>" width="<?= $size; ?>" height="<?= $size; ?>">
      <circle class="circle first" cx="<?= $size; ?>" cy="<?= $size; ?>" r="<?= $radius; ?>" />
   </svg>
</button>