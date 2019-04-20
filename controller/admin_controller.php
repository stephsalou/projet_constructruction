<?php
session_start();
require 'config.inc.php';
require '../database/database.php';
require '../autoload/autoload.php';
autoload::register();

if(isset($_POST) && !empty($_POST)){
    $db=database::connect();
    switch($_POST['action']){
        case 'connex':
            $_POST=form_input::checkArray($_POST);
            extract($_POST,EXTR_OVERWRITE);
            $password=form_input::crypt_steph($password);
            $cond=[
                "npq"=>'username=\''.$username.'\'',
                "and"=>'password=\''.$password.'\''
            ];
            $result=admin::login($db,$cond);
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
