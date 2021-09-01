<?php
/**
 * @package    srlab
 * @author     Jaein Lee
 */
use srlab\classes\Ecommerce;
use srlab\classes\Utility;
get_header();
?>
<main id="contact" class="page">
   <section>
      <h1 class="visually-hidden">Contact Us</h1>
      <div class="bg--overlay"></div>
      <div class="fl-wrap compact pd">
         <div class="col">
            <div class="wrap wh-text">
               <!-- <div class="bg--overlay"></div> -->
               <h2>Get in touch</h2>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vitae turpis quis nisl efficitur vehicula. Quisque vitae congue neque, nec ornare neque.</p>
               <address>
                  <?php $address = Ecommerce::sr_woo_store_address(); ?>
                  <h3 class="hdr">Location</h3>
                  <?= $address['add_1']; ?><br>
                  <?= ($address['add_2']) ? "{$address['add_2']}<br>" : ""; ?>
                  <?= "{$address['city']}, {$address['prov']}<br> {$address['zip']}"; ?><br>
               </address>
            </div>
         </div>
         <div class="col">
            <div class="wrap frm">
               <?php while (have_posts()) :  the_post();
                  get_template_part('template-parts/form', 'contact');
               endwhile;  ?>
            </div>
         </div>
      </div>
   </section>
</main>
<?php get_footer(); ?>