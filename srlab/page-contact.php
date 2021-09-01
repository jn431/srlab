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
   <section class="pd">
      <h1 class="visually-hidden">Contact Us</h1>
      <div class="compact fl-wrap">
         <div class="col">
            <div class="wrap">
               <h2 class="hdr">Get in touch</h2>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vitae turpis quis nisl efficitur vehicula. Quisque vitae congue neque, nec ornare neque.</p>
               <ul class="info">
                  <li class="address">
                     <a href="#">
                        <?php Utility::RenderSVG(THEME_PATH . 'assets/svgs/blip.min'); ?>
                        <address>
                           <?php $address = Ecommerce::sr_woo_store_address(); ?>
                           <?= $address['add_1']; ?>
                           <?= ($address['add_2']) ? "{$address['add_2']}" : ""; ?>
                           <?= "{$address['city']}, {$address['prov']} {$address['zip']}"; ?><br>
                        </address>
                     </a>
                  </li>
                  <li class="email">
                     <a href="mailto:<?php bloginfo('admin_email'); ?>">
                        <?php Utility::RenderSVG(THEME_PATH . 'assets/svgs/envelop.min'); bloginfo('admin_email'); ?>
                     </a>
                  </li>
                  <?php if (get_option('woocommerce_store_phone_number')) :
                        $phone = get_option('woocommerce_store_phone_number');
                     ?>
                     <li class="phone">
                        <a href="">
                           <?php Utility::RenderSVG(THEME_PATH . 'assets/svgs/phone.min'); echo $phone; ?>
                        </a>
                     </li>
                  <?php endif; ?>
               </ul>
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