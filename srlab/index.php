<?php

/**
 * @package    srlab
 * @author     Jaein Lee
 */
get_header(); ?>

<main class="page">
   <section class="pd">
      <div class="contain">
         <?php if (have_posts()) : while (have_posts()) :  the_post(); ?>
               <section class="pd">
                  <?php the_title(); ?>

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