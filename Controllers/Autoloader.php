<?php

namespace Controllers;

class Autoloader
{
    /**
     * Enregistre notre autoloader
     */
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
    /**
     * Inclue le fichier correspondant à notre classe
     * @param $class string Le nom de la classe à charger
     */
    static function autoload($class)
    {
        if (strpos($class, __NAMESPACE__ . '\\') === 0)
        {
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('\\', '/', $class);
            require $class . '.php';
        }

    }
}
//class Autoload {
//	public function __construct() {
//
//		spl_autoload_register(function ($class_name){
//			$models_path = './Models/' . $class_name . '.php';
//			$controllers_path = './Controllers/' . $class_name . '.php';
//			$views_path = './Views/' . $class_name . '.php';
//
//			if( file_exists($models_path) )  require_once($models_path);
//			if( file_exists($controllers_path) )  require_once($controllers_path);
//			if( file_exists($views_path) )  require_once($views_path);
//		});
//	}
//
//	// public function __destruct() {
//	// 	unset($this);
//	// }
//}


// function autoload($classname){
  
//     if (file_exists($file = __DIR__ . '/' . $classname . '.php')){
        
//         require $file;
//     }
// }

// spl_autoload_register('autoload');