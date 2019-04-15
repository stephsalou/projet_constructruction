<?php
/**
 * Created by PhpStorm.
 * User: steph
 * Date: 13/04/2019
 * Time: 19:39
 */
class user extends db_operation
{
    private $db_table='user';
    private $db_column='email,password';
    public static function register($db,$insert_data){

        $data=parent::insertData(self::db_table,self::db_column,$insert_data,$db);

        return $data;
    }

}