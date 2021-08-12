<?php

/**
 * Template Name: eCommerce Page
 * @package    srlab
 * @author     Jaein Lee
 */
get_header(); ?>

<main class="page ecommerce">
   <section class="pd">
      <?php if (function_exists('is_woocommerce')) :
         do_action("before_page_content");
      endif; ?>
      <div class="compact">
         <?php if (have_posts()) : while (have_posts()) :  the_post(); ?>
               <h1 class="visually-hidden"><?php the_title(); ?></h1>
               <?php the_content(); ?>
         <?php endwhile;
         else :
            get_template_part('template-parts/content', '404');
         endif;
         ?>
      </div>
   </section>
</main>
<?php get_footer(); ?>