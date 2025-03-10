<?php

namespace Musielak\Back\HTTP;

require 'HttpRequest.php';
require 'HttpResponse.php';
use Musielak\Back\HTTP\HttpRequest;

class testRequest{


    public function tesmort(){

        $request = new HttpRequest();

        if ($request->isMethod('POST')) {
            // Récupérer des données POST
            $username = $request->getPostParam('username');
            
            // Ou récupérer des données JSON
            $data = $request->getJsonParam();
            
            // Créer une réponse
            $response = new HttpResponse(['message' => 'Données reçues', 'data' => $data], 200);
            $response->json();
        } else {
            // Récupérer un paramètre GET
            $id = $request->getParam('id');
            
            // Faire quelque chose avec l'ID
            $response = new HttpResponse(['message' => 'ID reçu: ' . $id], 200);
            $response->json();
        }

    }

}
$test = new testRequest();
$test-> tesmort();