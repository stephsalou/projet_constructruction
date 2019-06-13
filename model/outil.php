<?php
/**
 * Created by PhpStorm.
 * User: htdocs
 * Date: 18/04/2019
 * Time: 17:41
 */
class outil extends db_query
{
    protected static $db_table='materiaux';
    protected  static $db_column='sable,ciment,gravier,bois,userId';
    public static function insertMatData($db, $formData)
    {
        $data=db_query::insertData(self::$db_table,self::$db_column,$formData,$db);

        return $data;

    }

    public static function selectMatData($db,array $cond=null)
    {

        $data=db_query::selectData(self::$db_table,'*',$db,$cond);

        return $data;

    }

    public static function deletMatData($db, array $cond)
    {
        $data=parent::deleteData(self::$db_table,$cond,$db);
        return $data;
    }

    
}