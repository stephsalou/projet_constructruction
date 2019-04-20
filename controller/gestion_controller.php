<?php
session_start();
require 'config.inc.php';
require '../database/database.php';
require '../autoload/autoload.php';
autoload::register();
$db=database::connect();
if(isset($_POST) && !empty($_POST) && !empty($_SESSION)){

    $_POST=form_input::checkArray($_POST);

    extract($_POST,EXTR_OVERWRITE);
    switch($action){
        case 'insert':
            $formData=[
              $sable,
              $ciment,
              $gravier,
              $bois,
              $_SESSION['id']
            ];
            $result=outil::insertMatData($db,$formData);
            if($result['status']){
                    $data=[
                        'status'=>$result['status'] ,
                        'data'=>$result['data']
                    ];
            }else{
                $data=[
                    'status'=>false,
                    'message'=>'impossible de sauvegarder vos donnees'
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
        $cond=[
            'id'=>'userId=\''.$_SESSION['id'].'\''
        ];
        $data=outil::selectMatData($db,$cond);
        echo json_encode($data);
}else{
    $data=[
        'status'=>false,
        'message'=>'impossible de sauvegarder vos donnes'
    ];
    echo json_encode($data);
}
database::disconnect();