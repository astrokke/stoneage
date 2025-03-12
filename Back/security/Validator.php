<?php

namespace Stoneage\Back\security;

use DateTime;

class Validator {

    public static function emailValidator($email){
        return filter_var($email ,FILTER_VALIDATE_EMAIL);
    }

    public static function numberValidator($number){
        return is_numeric($number);
    }

    public function stringValidator($string, $minLength = 1, $maxLength = 255){

        $Length =strlen($string);
        return $Length>= $minLength &&  $Length <=$maxLength ;
    }

    public function dateValidator($date ,$format ='d-m-Y'){
        $d =DateTime::createFromFormat($format, $date);
        return $d && $d -> $format === $date;
    }
}