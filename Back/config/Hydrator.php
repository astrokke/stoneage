<?php

namespace Stoneage\Back\config;


class Hydrator {


    public function hydrate(array $data , $object ){
        foreach ( $data as $key =>$value ){

            if(property_exists($object , $key)){
                $object-> $key ->$value;
            }
        }
        return $object;
    }

public function extract($object):array{

    $data=[];
    $property = get_object_vars($object);
    foreach($property as $key => $value){
        $data[$key] =$value;
    }
    return $data;
}


}