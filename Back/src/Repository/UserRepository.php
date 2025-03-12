<?php

namespace Musielak\Back\src\Repository;

use Musielak\Back\config\AbstractRepository;
use Musielak\Back\config\Database;

class UserRepository extends AbstractRepository{


    public function __construct(Database $dbConnection)
    {
        parent::__construct($dbConnection, 'users');
    }


    public function findbyEmail(string $email): ?array {
        return $this->findOneBy(["email" => $email]);
    }

    public function findAllUsers():array{
        return $this->executeCustomQuery(function($qb){
            $qb->select(['id', 'nom', 'email', 'role', 'status'])
                ->orderBy('nom', 'ASC' );
        }) ;
           
        
    }

    public function findByRole(string $role): array {
        return $this->findBy(['role' => $role]);
    }

    public function insertTestUsers(): array {
        $users = [
            [
                'nom' => 'Admin User',
                'email' => 'admin@example.com',
                'mdp' => password_hash('admin123', PASSWORD_DEFAULT),
                'status' => 'actif',
                'role' => 'admin'
            ],
            [
                'nom' => 'Regular User',
                'email' => 'user@example.com',
                'mdp' => password_hash('user123', PASSWORD_DEFAULT),
                'status' => 'actif',
                'role' => 'utilisateur'
            ],
            [
                'nom' => 'Inactive User',
                'email' => 'inactive@example.com',
                'mdp' => password_hash('inactive123', PASSWORD_DEFAULT),
                'status' => 'inactif',
                'role' => 'utilisateur'
            ]
        ];
        
        $insertedIds = [];
        foreach ($users as $user) {
            $insertedIds[] = $this->create($user);
        }
        
        return $insertedIds;
    }
}