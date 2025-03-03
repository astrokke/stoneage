<?php

namespace App\Controller;

require_once "./Back/config/app.php";

use App\Entity\User;
use APP\config\app;
use Database;
use PDO;

class UserController
{


    public function __construct(private PDO $pdo)
    {
        $database = new  Database();
        $this->pdo = $database->getConnection();
    }






    public function InscriptionUser(User $user)
    {

        if ($email = $user->getEmail()) {
            return false;
        }
        $query = "INSERT INTO users (nom , email , mdp ,avatar ,status ,role) VALUES (:nom ,:email ,mdp :avatar ,:status ,:role)";

        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([
            'nom' => $user->getNom(),
            'email' => $user->getEmail(),
            'mdp' => $user->getMdp(),
            'avatar' => $user->getAvatar(),
            'status' => $user->getStatus(),
            'role' => $user->getRole(),
        ]);
    }

    public function ConnexionUser(string $email, string $mdp): ?User
    {
        $query = "SELECT * FROM users Where email =:email  ";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([":email" => $email,]);

        $user = $stmt->fetchObject("User");
        if ($user && password_verify($mdp, $user->getMdp())) {
            return "vous etes connecté $user->getNom()";
        }

        return null;
    }
}
