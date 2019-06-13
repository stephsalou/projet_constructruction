<?php
/**
 * Created by PhpStorm.
 * User: steph
 * Date: 13/04/2019
 * Time: 19:39
 */
class user extends db_query
{
    private static $db_table='user';
    private static $db_column='email,password,username,image';
    public static function register($db,$insert_data){

        $data=parent::insertData(self::$db_table,self::$db_column,$insert_data,$db);

        return $data;
    }

    public static function login($db,$cond,$path)
    {
        $data=parent::selectData(self::$db_table,'*',$db,$cond,$path);

        return $data;
    }

    public static function deleteUser($db,array $cond)
    {
        $data=parent::deleteData(self::$db_table,$cond,$db);
        return $data;
    }

    public static function updateUser($db, array $cond,$form_data)
    {
        $data=parent::modifData(self::$db_table,self::$db_column,$cond,$form_data,$db);
        return $data;
    }

    public static function select_all_user($db,$path)
    {
        $data=db_query::selectData(self::$db_table,'*',$db,null,$path);
        return $data;
    }

}
