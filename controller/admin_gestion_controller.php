<?php
session_start();
require 'config.inc.php';
require '../database/database.php';
require '../autoload/autoload.php';
autoload::register();

if(isset($_POST) && !empty($_POST) /*&& !empty($_SESSION)*/){
    $db=database::connect();
    $_POST=form_input::checkArray($_POST);

    extract($_POST,EXTR_OVERWRITE);
    switch($action){
        case 'delete':
            $cond=[
              'id'=>'id=\''.$id.'\''
            ];
            $result=outil::deletMatData($db,$cond);
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
            echo json_encode($data);
    }

}else if(isset($_GET) && !empty($_GET) && !empty($_SESSION) ){
    $_GET=form_input::checkArray($_GET);
    $cond=null;
    $data=outil::selectMatData($db,$cond);
    echo json_encode($data);
}else{
    $data=[
        'status'=>false,
        'message'=>'impossible de sauvegarder vos donnes'
    ];
    echo json_encode($data);
}