<?php

/**
 * @package    srlab
 * @author     Jaein Lee
 */
get_header();
$slides = get_option("sr_fp_slider");
?>

<main>
   <section class='fp-slider'>
      <?php
      foreach ($slides as $slide) :
         $ct = 8;
      ?>
         <div class="slide" data-title="<?= $slide['main_heading']; ?>">
            <div class="sl-content">
               <div class="text">
                  <h2>
                     <?php
                     $chars = str_split($slide['main_heading']);
                     foreach ($chars as $char) :
                        if ($char === " ") {
                           echo "&nbsp;";
                        } else {
                           echo "<span style='--delay: $ct'>$char</span>";
                        }
                        $ct++;
                     endforeach; ?>
                  </h2>
                  <?= isset($slide['blurb']) ? "<p>{$slide['blurb']}</p>" : ""; ?>
                  <?php if (!empty($slide['pages'])) : ?>
                     <div class="cta-links">
                        <?php foreach ($slide['pages'] as $id => $http) : ?>
                           <a href="<?= esc_url(get_the_permalink($id)); ?>" class="b--sm"><?= get_the_title($id); ?></a>
                        <?php endforeach; ?>
                     </div>
                  <?php endif; ?>
               </div>
               <div class="img-wrap"><?= wp_get_attachment_image($slide['imageID'], "full"); ?></div>
            </div><!-- Contain -->

         </div>
      <?php $ct = 1;
      endforeach;  ?>
   </section>
</main>
<?php get_footer(); ?>