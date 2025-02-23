<?php

require_once './BDD.php';


try {

    $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
    
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connexion réussie =)';
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}