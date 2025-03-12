<?php

namespace Stoneage\Back\HTTP;




class  absctractController{


public function __construct( protected $request , protected $response)
{
    
}

public final function hash($password){

$hash_password = password_hash($password,PASSWORD_BCRYPT);
return $hash_password;
}

public final function render(string $path , array $data=[], int $status =200){
   
    HttpResponse::html($path, $data, $status);
}

public final function  json(array $data, int $status = 200){
HttpResponse::json($data,$status);
}

public final function redirect( string $url){
    HttpResponse::redirect($url);

}


}