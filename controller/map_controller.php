<?php
session_start();
/**
 * Created by PhpStorm.
 * User: htdocs
 * Date: 16/04/2019
 * Time: 19:33
 */
require 'config.inc.php';
require '../database/database.php';
require '../autoload/autoload.php';
autoload::register();

if(isset($_POST) && !empty($_POST)){
    $db=database::connect();
    $_POST=form_input::checkArray($_POST);
    extract($_POST,EXTR_OVERWRITE);
    switch($action){
        case 'insert':
            $data=[
                $lat,
                $lng,
                $_SESSION['id']
            ];
            $result=map::insert_coord($db,$data);
            echo json_encode($result);
            break;
        case 'select':
            $result=map::select_coordinate($db);
            echo json_encode($result);
            break;
        case 'selectUser':
            $cond=[
                'npq'=>'userId=\''.$id.'\''
            ];
            $result=map::select_coordinate($db,$cond);
            echo json_encode($result);
            break;

        case 'selectAll':
            $result=map::select_all_coordinate($db);
            echo json_encode($result);
            break;
        default:
            $result=[
                'status'=>false,
                'message'=>'option erroner'
            ];
            echo json_encode($result);
            break;

    }
}
