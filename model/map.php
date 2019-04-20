<?php

class map extends db_operation
{
    protected static $db_table='map';
    protected static $db_column='lat,lng,userId';
    public static function select_coordinate($db,array $cond=null)
    {
        if($cond==null){
        $cond=[
            'or'=>'status=0'
        ];
        }
        $result=self::selectJoin(self::$db_table,'*',$db,$cond);
        return $result;
    }

    public static function insert_coord($db,$coordinate){

        $result=db_operation::insertData(self::$db_table,self::$db_column,$coordinate,$db);

        return $result;

    }

    public static function set_status($db,$form_data,array $cond)
    {
        $result=db_operation::modifData(self::$db_table,'status',$cond,$form_data,$db);

        return $result;
    }

    public static function selectJoin($db_table, $db_column = '*', $db, array $cond = null, $file_path = '../views/static/img/user_file/')
    {
        if ($cond == null) {
            $sql = "SELECT " . $db_column . " FROM " . $db_table. " INNER JOIN user ON user.id=".$db_table.".userId ";
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
            $sql = "SELECT " . $db_column . " FROM " . $db_table . " INNER JOIN user ON user.id=".$db_table.".userId WHERE ";
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

    public static function delete_coord($db, array $cond)
    {
        $data=parent::deleteData(self::$db_table,$cond,$db);
        return $data;
    }

    public static function select_all_coordinate($db,array $cond=null)
    {
        $result=self::selectJoin(self::$db_table,'*',$db,$cond);
        return $result;
    }

}