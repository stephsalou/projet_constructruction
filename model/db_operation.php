<?php

/**
 * Created by PhpStorm.
 * User: steph
 * Date: 13/04/2019
 * Time: 19:44
 */
class db_operation
{
    /**
     * @param $db_table
     * @param $db_table_column
     * @param $form_data
     * @param $db
     * @return array
     */
    public static function insertData($db_table, $db_table_column, $form_data, $db)
    {
        $arr=explode(',',$db_table_column);
        foreach($arr as $keys => $value){
            if($keys==0){
                $db_unknow='?';
            }else{
                $db_unknow.=',?';
            }
        }
        unset($arr);
        $inser = $db->prepare("INSERT INTO " . $db_table . "(" . $db_table_column . ") VALUES(" . $db_unknow . ")");
        $result = $inser->execute($form_data);
        if ($result) {
            $response =[
                'status'=>$result,
                'data'=>$db->lastInsertId()
            ];
        } else {
            $response =[
                'status'=>$result,
                'data'=>'erreur d\'insertion '
            ];
        }
        return $response;
    }

    /**
     * @param $db_table
     * @param string $db_column
     * @param $db
     * @param array|null $cond
     * @param string $file_path chemin de stockage des image utilisateur
     * @return array
     */
    public static function selectData($db_table, $db_column = '*', $db, array $cond = null,$file_path='../views/static/img/user_file/')
    {
        if ($cond == null) {
            $sql = "SELECT " . $db_column . " FROM " . $db_table;
            $data = $db->query($sql, PDO::FETCH_ASSOC);
            $c = $data->columnCount();
            for ($i = 0; $i < $c; $i++) {
                $colMeta[$i] = $data->getColumnMeta($i);
                $colName[$i] = $colMeta[$i]['name'];
            }
            $data = $data->fetchAll();
            if (isset($data[0]['image'])) {
                for ($j = 0; $j < sizeof($data); $j++) {
                    $path[$j] = $file_path.$data[$j]['image'];
                    $data[$j]['image'] = $path[$j];
                }
            }
            $result = array(
                'data' => $data,
                'column' => $colName
            );
        } else {
            $i = 0;
            $sql = "SELECT " . $db_column . " FROM " . $db_table . " WHERE ";
            foreach ($cond as $key => $condition ) {
                if ($i == 0)
                    $sql .= $condition;
                else
                    $sql .=' '.$key.' '. $condition;

                $i++;
            }
            $data = $db->query($sql, PDO::FETCH_ASSOC);
            if($data){
            $c = $data->columnCount();
            for ($i = 0; $i < $c; $i++) {
                $colMeta[$i] = $data->getColumnMeta($i);
                $colName[$i] = $colMeta[$i]['name'];
            }
            $data = $data->fetchAll();
            if (isset($data[0]['image'])) {
                for ($j = 0; $j < sizeof($data); $j++) {
                    $path[$j] = $file_path.$data[$j]['image'];
                    $data[$j]['image'] = $path[$j];
                }
            }
            $result = array(
                'data' => $data,
                'column' => $colName
            );
            }else{
                $result = array(
                    'status' => false,
                    'message' => 'erreur'
                );
            }
        }
        return $result;

    }

    /**
     * @param $db_table
     * @param array $cond
     * @param $db
     * @return bool
     */
    public static function deleteData($db_table, array $cond, $db)
    {
        if ($cond) {
            $result = true;
            $i = 0;
            $sql = "DELETE FROM " . $db_table . " WHERE ";
            foreach ($cond as $key => $condition ) {
                if ($i == 0)
                    $sql .= $condition;
                else
                    $sql .=' '.$key.' '. $condition;

                $i++;
            }
            try {
                $db->query($sql);
            } catch (PDOException  $e) {
                $result = false;
            }

        }
        return $result;
    }

    /**
     * @param $db_table
     * @param $db_table_column
     * @param array $cond
     * @param $form_data
     * @param $db
     * @return mixed
     */
    public static function modifData($db_table, $db_table_column,array $cond, $form_data, $db)
    {
        $j=0;
        $sql="UPDATE ".$db_table." SET ";
        $arr=explode(',',$db_table_column);
        foreach ($arr as $column ){
            if($j==0){
                $sql.=$column.'= ? ';
            }else{
                $sql.=' , '.$column.'= ? ';
            }
            $j++;
        }
        unset($arr);
        $j = 0;
        $sql .=" WHERE ";
        foreach ($cond as $key => $condition ) {
            if ($j == 0)
                $sql .= $condition;
            else
                $sql .=' '.$key.' '. $condition;

            $j++;
        }

        $update =$db->prepare($sql);
        $result=$update->execute($form_data);
        return $result;
    }

   /* public static function selectJoin($db_table, $db_column = '*', $db, array $cond = null,array $join, $file_path = '../views/static/img/user_file/')
    {

    }*/



}