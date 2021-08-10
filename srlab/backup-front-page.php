<?php

/**
 * @package    srlab
 * @author     Jaein Lee
 */
get_header();
$mast = get_option("sr_fp_mast");
?>

<main>
   <section class='mast'>
      <div class="bg--overlay"></div>
      <div class="contain">
         <div class="l-2">
            <div class="col">
               <div class="content">
                  <?= $mast['super_heading'] ? "<span class='super line--left'>" . $mast['super_heading'] . "</span>" : "" ;?>
                  <h2 class="hd"><?= $mast['main_heading']; ?></h2>
               </div>
            </div>
            <div class="col">
               <?= wp_get_attachment_image($mast['img'], 'full', false, ['class' => 'mast-img']); ?>
            </div>
         </div>
      </div>
   </section>
   <section>
      <div class="svg-wrap">
         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1100 50"><path d="M1100,50H0L1100,0Z" class="poly"/></svg>
      </div>
   </section>

   <section class="pd">
      <div class="compact">
         <h2 class="title">Services</h2>
         <div class="grid gr-3">
            <div class="col box">
               <h3>Orthodontics</h3>
               <ul class="list">
                  <li>Something</li>
                  <li>Something</li>
                  <li>Something</li>
               </ul>
            </div>
            <div class="col box">
               <h3>Orthodontics</h3>
               <ul class="list">
                  <li>Something</li>
                  <li>Something</li>
                  <li>Something</li>
               </ul>
            </div>
            <div class="col box">
               <h3>Orthodontics</h3>
               <ul class="list">
                  <li>Something</li>
                  <li>Something</li>
                  <li>Something</li>
               </ul>
            </div>
         </div>
      </div>
   </section>
   <?php
   if (have_posts()) {
      while (have_posts()) :
         the_post();

      endwhile;
   } else {
      get_template_part('template-parts/content', '404');
   }
   ?>
</main>
<?php get_footer(); ?>