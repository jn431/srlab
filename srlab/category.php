<?php
/**
 * @package    srlab
 * @author     Jaein Lee
 */
get_header(); ?>
<main class="page">
   <section class="sect">
      <div class="compact">
         <?php if (function_exists('is_woocommerce')) :  do_action("before_page_content");  endif; ?>
         <?php if (have_posts()) : while (have_posts()) :  the_post(); ?>
               <h1 class="hd--1 title <?= (is_account_page() && !is_user_logged_in()) ? "center" : ''; ?>"><?php the_title(); ?></h1>
               <?php the_content(); ?>
         <?php endwhile;
         endif;  ?>
      </div>
   </section>
</main>
<?php get_footer(); ?>