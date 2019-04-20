<?php

/**
 * Created by PhpStorm.
 * User: steph
 * Date: 06/04/2019
 * Time: 09:00
 */


class form_input
{
    public static function file_input($name,$file_path='../views/static/img/user_file'){
        $upload_stat=true;
        $image=self::checkInput($_FILES[$name]['name']);
        $imagePath=$file_path.basename($image);
        $imageExtension=pathinfo($imagePath,PATHINFO_EXTENSION);
        if($imageExtension!='jpg' && $imageExtension !='jpeg' && $imageExtension!='png'&& $imageExtension!='gif' && $imageExtension!='JPG' && $imageExtension !='JPEG' && $imageExtension!='PNG'&& $imageExtension!='GIF'){
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

    public static function checkArray(array $arr)
    {
        foreach($arr as $key =>$value){
            $arr[$key]=self::checkInput($value);
        }
        return $arr;
    }
    public static function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function toBase64($file_name)
    {
        $path=$_FILES[$file_name]['tmp_name'];
        $mime=mime_content_type($path);
        $data=file_get_contents($path);
        $base64='data:'.$mime.';base64,'.base64_encode($data);
       return $base64;
    }

    public static function crypt_steph($string)
    {
        $string=md5($string);
        $string=crypt($string,'$5$rounds=5000$adminpass$');
        $string=sha1($string);
        $string=hash('gost',$string);
        return $string;
    }
}
