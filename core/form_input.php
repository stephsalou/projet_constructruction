<?php

/**
 * Created by PhpStorm.
 * User: steph
 * Date: 06/04/2019
 * Time: 09:00
 */

/*var_dump($_FILES);
        $path=$_FILES['photo']['tmp_name'];
        $mime=mime_content_type($path);
        $data=file_get_contents($path);
        $base64='data:'.$mime.';base64,'.base64_encode($data);
        echo 'path='.$path."\n";
        echo 'type='.$mime."\n";
        //echo 'data='.$data."\n";
        var_dump($base64);*/
class form_input
{
    public static function file_input($name,$file_path='../views/static/img/user_file'){
        $upload_stat=true;
        $image=self::checkInput($_FILES[$name]['name']);
        $imagePath=$file_path.basename($image);
        $imageExtension=pathinfo($imagePath,PATHINFO_EXTENSION);
        if($imageExtension!='jpg' && $imageExtension !='jpeg' && $imageExtension!='png'&& $imageExtension!=gif){
            $result['message']="<div class=\"alert alert-error\">le format de votre fichier est invalide <i class=\"fas fa-user-times\" >&times</i></div>";
            $upload_stat=false;
            $result['status']=$upload_stat;
        }if(file_exists($imagePath)){
            $result['message']="<div class=\"alert alert-error\"> votre fichier existe deja <i class=\"fas fa-user-times\" >&times</i></div>";
            $upload_stat=false;
            $result['status']=$upload_stat;
        }
        if($_FILES[$name]['size'] > 500000){
            $result['message']= "<div class=\"alert alert-error\"> votre fichier est trop volumineux <i class=\"fas fa-user-times\" >&times</i></div>";
            $upload_stat=false;
            $result['status']=$upload_stat;
        }

        if($upload_stat){
            if(!move_uploaded_file($_FILES[$name]['tmp_name'],$imagePath)){
                $result['message']="<div class=\"alert alert-error\">l'upload de votre fichier a echouer <i class=\"fas fa-user-times\" >&times</i></div>";
                $result['status']=false;
            }else{
                $result['status']=$upload_stat;
                $result['name']=$image;
            }

        }
        return $result;
    }
    public static function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


}
