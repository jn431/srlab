<?php
/**
 * Custom Controller
 * Type: dropdown_navmenus
 * @package  srlab
 * @author   Jaein Lee
 * @version  1.06
 */
namespace srlab\classes\Customizer;
defined('ABSPATH') || exit;
if (class_exists('WP_Customize_Control')) :
   class WP_Customize_Menu extends \WP_Customize_Control
   {
      public $type = 'dropdown_navmenus';
      protected $menus = [];
      /**
       * Construct
       */
      public function __construct($manager, $id, $args = [], $options = [])
      {
         parent::__construct($manager, $id, $args);
         //$this->menus = get_registered_nav_menus();
         $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
         foreach($menus as $menu) {
            $this->menus[$menu->slug] = $menu->name;
         }
      }
      /**
       * Render Dropdown
       */
      public function render_content()
      {
?>
         <div class="dropdown_navmenus">
            <?php if (isset($this->label)) { ?>
               <label for="<?php echo esc_attr($this->id); ?>" class="customize-control-title">
                  <?php echo esc_html($this->label); ?>
               </label>
            <?php } ?>
            <?php if (isset($this->description)) { ?>
               <span class="customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php } ?>
            <select name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>" <?php $this->link(); ?>>
               <?php if (isset($this->menus)) {
                  printf("<option value='' %s>- Display Menu -</option>", selected($this->value(), '', false));
                  foreach ($this->menus as $location => $name) {
                     printf(
                        '<option value="%s" %s>%s</option>',
                        $location,
                        selected($this->value(), $location, false),
                        $name
                     );
                  }
               }
               ?>
            </select>
         </div>
<?php      }
   }
endif;
