<?php


namespace Musielak\Back\HTTP;

use Exception;
use InvalidArgumentException;

class HttpResponse {

public function __construct( private array $data =[] , private int  $status = 200  )
{
    
}
    public function json() : void {

        $this->sanitizeData($this->data);
        http_response_code($this->status);
        //defini le code du status
        header("Content-Type: application/json; charset=utf-8");
        //sa doit etre en json et utiliser l'ancodage utf-8
        header("X-Content-Type-Options: nosniff");
        // interdit de sniffer (c'est pour la securiter en gros)
        header("Cache-Control:no-cache ,no-store, must-revalidate");
        // indique qu'il ne faut pas mettre en cache pratique pour les reponse dynamique
        header("Pragma:no-cache");
        // pas de cache masi pour les vieux navigateur
        header("Expire : 0");
        // ca expire direct
        echo json_encode($this->data ,JSON_PRETTY_PRINT| JSON_UNESCAPED_UNICODE |JSON_UNESCAPED_SLASHES );
        // convertie en json + formatage
    } 


    public function html( string $path ,array $data, int $status= 200):void{
        $fullpath = __DIR__."/../../templates/$path";
        // genere le chemain complet vers le dossier template 
        if(file_exists($fullpath) ){
            //verifie si le fichier existe

            http_response_code($status);
            // regarde le status de la response
            header("Content-Type:text/html ;charset=utf-8");
            // c'est du html de type utf-8
            header("X-Content-Type-Options: nosniff");
            // parei linterdie au sniffer
            $this->sanitizeData($this->data);
            // pareil on sanitize les data
            $data["view"] =$fullpath;
            // on transform les clef du tableau en variable $...
            extract($data);
            // on extrer les donner
            include __DIR__."/../../templates/base.php";
            // on rajoute le base.php
        }else{
            throw new InvalidArgumentException("la vue est introuvable:[$fullpath]");
            //si on trouve pas on balance une erreur avec le chemin 
        }



    }

    public function redirect(string $url , int $status = 302){
        http_response_code($status);
        header("location".$url ,true ,$status);
        exit;


    }

    public function sanitizeData(array &$data): void {
        // Parcourt chaque élément du tableau $data
        foreach ($data as $key => $value) {
            // Vérifie si la valeur est une chaîne de caractères
            if (is_string($value)) {
                // Échappe les caractères spéciaux pour éviter les attaques XSS
                $data[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            // Vérifie si la valeur est un entier ou un flottant
            } elseif (is_int($value) || is_float($value)) {
                // Convertit la valeur en chaîne de caractères
                $data[$key] = (string)$value;
            // Vérifie si la valeur est un tableau
            } elseif (is_array($value)) {
                // Appelle récursivement sanitizeData pour nettoyer les sous-tableaux
               $this->sanitizeData($data[$key]);
            // Vérifie si la valeur est un booléen
            } elseif (is_bool($value)) {
                // Convertit le booléen en chaîne 'true' ou 'false'
                $data[$key] = $value ? 'true' : 'false';
            // Vérifie si la valeur est nulle
            } elseif (is_null($value)) {
                // Remplace la valeur nulle par la chaîne 'null'
                $data[$key] = 'null';
            // Vérifie si la valeur est un objet
            } elseif (is_object($value)) {
                // Lance une exception si la valeur est un objet, car elle ne peut pas être sérialisée
                throw new \InvalidArgumentException('Impossible de sérialiser un objet');
            // Vérifie si la valeur est une ressource
            } elseif (is_resource($value)) {
                // Lance une exception si la valeur est une ressource, car elle ne peut pas être sérialisée
                throw new \InvalidArgumentException('Impossible de sérialiser une ressource');
            // Si la valeur est d'un type non géré
            } else {
                // Lance une exception pour indiquer que le type de données n'est pas géré
                throw new \InvalidArgumentException('Type de données non géré');
            }
        }
    }
}
