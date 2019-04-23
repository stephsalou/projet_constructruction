<?php
session_start();
require 'config.inc.php';
require '../database/database.php';
require '../autoload/autoload.php';
autoload::register();
$db=database::connect();
if(isset($_POST) && !empty($_POST) && !empty($_SESSION)){

    switch($_POST['action']){
        case 'delete':
            $_POST=form_input::checkArray($_POST);
            extract($_POST,EXTR_OVERWRITE);
            $cond=[
                'npq'=>'id=\''.$userId.'\''
            ];
            $result=user::deleteUser($db,$cond);
            if($result){
            $data=[
                'status'=>true,
                'data'=>$result['data']
            ];
        }else{
            $data=[
                'status'=>false,
                'message'=>'impossible de supprimer les donnees'
            ];
            }
            echo json_encode($data);
            break;
        default:
            $data=[
                'status'=>false,
                'message'=>'operation impossible'
            ];
    }


}else{
    function allUsers( $db){
    $data=user::select_all_user($db,FILE_PATH);
    return $data;
    }
        echo json_encode(allUsers($db));
}
