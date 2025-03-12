<?php

namespace Stoneage\Back\HTTP;

require 'HttpResponse.php'; // Assurez-vous que le chemin est correct

use Stoneage\Back\HTTP\HttpResponse;

class testResponse {
    public function __construct() {
        $data = [
            "message" => "salut la compagnie",
            
        ];

        $response = new HttpResponse($data, 200);
       $response ->html("base.php" ,$data);
    }
}

new testResponse();