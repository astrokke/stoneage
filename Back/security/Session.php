<?php

namespace Stoneage\Back\security;

use Stoneage\Back\interface\UserInterface;
use Stoneage\Back\config\AbstractRepository;
use Stoneage\Back\config\Database;
use Stoneage\Back\Model\User;

class Session {

public static function isConnected()
{
    if(isset($_SESSION['USER']));
}

public static function Disconected(){
unset($_SESSION["USER"]);
session_destroy();    
}

 public static function authenticate(string $identfier , string $username , string $password):void{

    if (class_exists(User::class) && in_array(UserInterface::class, class_implements(User::class))) {
        
        $db =new Database();
        $repository = new AbstractRepository($db, User::TABLE);

        $result =$repository->findBy([$identfier =>$username]);

        if($result && !empty($result)){
            $user =$result[0];

            
            if (password_verify($password, $user->getPassword())) {
                $_SESSION['USER'] = $user; // Connecte l'utilisateur
            } else {
                throw new \Exception('Mot de passe incorrect');
            }
        } else {
            throw new \Exception("L'utilisateur n'existe pas");
        }
        
    } 
    else {
        throw new \Exception("Le modèle d'utilisateur n'existe pas ou n'implémente pas l'interface UserInterface");
 }
 }
 
 public static function hasRole(array $roles): bool
    {
        if (isset($_SESSION['USER']) && $_SESSION['USER'] instanceof UserInterface) {
            $userRoles = $_SESSION['USER']->getRoles();

            foreach ($roles as $role) {
                if (in_array($role, $userRoles)) {
                    return true;
                }
            }
        }
        return false;
    }
}