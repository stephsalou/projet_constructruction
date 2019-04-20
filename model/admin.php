<?php

/**
 * Created by PhpStorm.
 * User: htdocs
 * Date: 20/04/2019
 * Time: 19:24
 */
class admin extends db_operation
{

    private static $db_table='admin';
    private static $db_column='username,password';
    public static function login($db,$cond)
    {
        $data=parent::selectData(self::$db_table,'*',$db,$cond);

        return $data;
    }

}