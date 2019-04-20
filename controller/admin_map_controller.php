<?php
session_start();
require 'config.inc.php';
require '../database/database.php';
require '../autoload/autoload.php';
autoload::register();

if(!empty($_POST) && !empty($_POST) && !empty($_SESSION)){
    $db=database::connect();
    $_POST=form_input::checkArray($_POST);
    extract($_POST,EXTR_OVERWRITE);
    switch($action){
        case'success':
            $cond=[
                'npq'=>'id=\''.$markerId.'\''
            ];
            $data=map::set_status($db,[1],$cond);
            echo json_encode($data);
            break;
        case 'delete':
            $cond=[
                'npq'=>'id=\''.$markerId.'\''
            ];
            $data=map::delete_coord($db,$cond);
            echo json_encode($data);
            break;
        case'remove':
            $cond=[
                'npq'=>'id=\''.$markerId.'\''
            ];
            $data=map::set_status($db,[0],$cond);
            echo json_encode($data);
            break;
        default :
            $data=[
                'status'=>false,
                'message'=>'commande inexistante'
            ];
            echo json_encode($data);
    }
}