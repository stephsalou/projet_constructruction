<?php
/**
 * Created by PhpStorm.
 * User: Phanou
 * Date: 13/04/2019
 * Time: 19:42
 */

class core_loader
{

    public static function autoloader($class){
        require '../core/'.$class.'.php';
    }
    public static function autoload_register(){
        spl_autoload_register(array(__CLASS__,'autoloader'));
    }

}