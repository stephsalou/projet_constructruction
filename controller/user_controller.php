<?php
session_start();
/**
 * Created by PhpStorm.
 * User: steph
 * Date: 13/04/2019
 * Time: 20:10
 */
require 'config.inc.php';
require '../database/database.php';
require '../autoload/autoload.php';
autoload::register();

if(isset($_POST) && !empty($_POST)){
$db=database::connect();
switch($_POST['action']){
    case 'register':
        $_POST=form_input::checkArray($_POST);
        if($_FILES['photo']['error']==0){
        $preview=form_input::toBase64('photo');
        }else{
            $preview=false;
        }
         extract($_POST,EXTR_OVERWRITE);
        $pass=md5($pass);
        $image=form_input::file_input('photo',FILE_PATH  );
        if($image['status']){
        $form_data=[
          $email,
            $pass,
            $username,
            $image['name']

        ];
        }else{
            $form_data=[
                $email,
                $pass,
                $username,
                'default_user.jpg'

            ];
        }
        $result=user::register($db,$form_data);
        if($result['status']){
            if($preview){
        $data=[
            'result'=>$result,
            'preview'=>$preview
        ];
            }else{
                $data=[
                    'result'=>$result,
                    'message'=>'impossible de vous inscrire',
                    'preview'=>$preview
                ];
            }
        }else{
            $data=[
                'result'=>false,
                'message'=>'impossible de vous inscrire'
            ];
        }
        echo json_encode($data);
        break;
    case 'connex':
        $_POST=form_input::checkArray($_POST);
        extract($_POST,EXTR_OVERWRITE);
        $password=md5($password);
        $cond=[
            "npq"=>'email=\''.$email.'\'',
            "and"=>'password=\''.$password.'\''
        ];
        $result=user::login($db,$cond,FILE_PATH);
        $_SESSION=$result['data'][0];
        echo json_encode($result);

}


}else if(isset($_GET) && !empty($_GET) && !empty($_SESSION)){
    if($_GET['logout']){
    session_destroy();
        $result=true;
    }else{
        $result=false;
    }
    echo json_encode($result);
}
