<?php

/**
 * @package    srlab
 * @author     Jaein Lee
 */
get_header();
$mast = get_option("sr_fp_mast");

$slides = [
   [
      "heading" => "Orthodontics",
      "tabname" => "1",
      "blurb"  => "Orthodontic services including orthodontic plans, model printing and aligner fabrication.",
      "imageID" => 39,
      "links" => [
         "Clinical Aligner Design" => "#",
         "Aligner Tray Fabrication" => "#",
         "Clinical Aligner Design & Fabrication" => "#",
      ]
   ],
   [
      "heading" => "Training And Education",
      "tabname" => "1",
      "blurb"  => "Training And Education services including software training.",
      "imageID" => 18,
      "links" => [
         "ITEM1" => "#",
         "ITEM2" => "#",
         "ITEM3" => "#",
      ]
   ],
   [
      "heading" => "Surgical Guides",
      "tabname" => "1",
      "blurb"  => "Surgical Guide services including treatment planning and surgical guide fabrication.",
      "imageID" => 38,
      "links" => [
         "ITEM1" => "#",
         "ITEM2" => "#",
         "ITEM3" => "#",
      ]
   ],
];
?>

<main>
   <section class='fp-slider'>

      <?php
      foreach ($slides as $slide) :
         $ct = 8;
      ?>
         <div class="slide" data-title="<?= $slide['tabname']; ?>">
            <div class="sl-content">
               <div class="text">
                  <h2>
                     <?php
                     $chars = str_split($slide['heading']);
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
                  <div class="cta-links">
                     <?php foreach ($slide['links'] as $text => $url) : ?>
                        <a href="<?= esc_url($url); ?>" class="btn"><?= $text; ?></a>
                     <?php endforeach; ?>
                  </div>
               </div>
               <div class="img-wrap"><?= wp_get_attachment_image($slide['imageID'], "full"); ?></div>
            </div><!-- Contain -->

         </div>
      <?php $ct = 1;
      endforeach;  ?>

   </section>
</main>
<?php get_footer(); ?>