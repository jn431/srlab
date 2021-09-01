<?php
/**
 * @package    srlab
 * @author     Jaein Lee
 */
get_header(); ?>
<main class="page">
   <section class="sect">
      <div class="contain">
         <?php if (have_posts()) : while (have_posts()) :  the_post(); ?>
               <section class="sect">
                  <?php the_title(); ?>
                  <?php the_content(); ?>
               </section>
         <?php endwhile;
         endif;
         ?>
      </div>
   </section>
</main>
<?php get_footer(); ?>