<?php

/**
 * @package    srlab
 * @author     Jaein Lee
 */
get_header(); ?>

<main class="page">
   <section class="pd">
         <?php if(function_exists('is_woocommerce')) :
            do_action("before_page_content");
         endif; ?>
			What's good
      <div class="compact">
         <?php if (have_posts()) : while (have_posts()) :  the_post(); ?>
               <section class="pd">
                  <h1 class="title <?= (is_account_page() && !is_user_logged_in()) ? "center" : ''; ?>"><?php the_title(); ?></h1>
                  <?php the_content(); ?>
               </section>
         <?php endwhile;
         else :
            get_template_part('template-parts/content', '404');
         endif;
         ?>
      </div>
   </section>
</main>
<?php get_footer(); ?>