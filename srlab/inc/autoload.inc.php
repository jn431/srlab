<?php 
/**
 * Autoloader
 * @author   Jaein Lee
 * @final
 */

namespace srlab\inc;

defined('ABSPATH') || exit;

if (!class_exists('Autoload')) {
   class Autoload
   {
      public function __construct($prefix)
      {
         $this->SPL_Load();
         $this->prefix = $prefix;
      }

      private function SPL_Load()
      {
         spl_autoload_register([$this, 'class_loader']);
      }

      /**
       * Dev/Live environment class loader
       * @param   string    $class_name
       */
      private function class_loader($class_name)
      {
         $dev = '';
         $live = DIRECTORY_SEPARATOR;

         $class_name = str_replace($this->prefix, $dev, $class_name);

         if (false !== strpos($class_name, __NAMESPACE__))
            return false;

         $file = THEME_PATH . 'inc/classes/' . $class_name . ".class.php";
         $file = strtolower(str_replace('\\', '/', $file));

         if (file_exists($file))
            require_once($file);
      }
   }
}