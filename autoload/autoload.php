<?php
/**
 * Created by PhpStorm.
 * User: Phanou
 * Date: 13/04/2019
 * Time: 19:35
 */

class autoload
{
    public static function autoloader($class){
        require '../model/'.$class.'.php';
    }
    public static function register(){
        spl_autoload_register(array(__CLASS__,'autoloader'));
    }
}