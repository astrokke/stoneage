<?php
// test_repository.php
// Placer ce fichier à la racine de votre projet

namespace Musielak\Back\src;



require_once  __DIR__."/Bootstrap.php"; // Assurez-vous que l'autoload est correctement configuré

use Exception;
use Musielak\Back\config\Database;
use Musielak\Back\src\Repository\UserRepository;

// Connexion à la base de données
$dbConfig = [
    'host' => 'localhost',
    'dbname' => 'stoneage',
    'user' => 'root',
    'password' => ''
];

try {
    // Initialiser la connexion
    $db = new Database($dbConfig);
    
    // Créer le repository
    $userRepo = new UserRepository($db);
    
    
    
    echo "Insertion des utilisateurs de test...\n";
    $insertedIds = $userRepo->insertTestUsers();
    echo "Utilisateurs insérés avec les IDs: " . implode(', ', $insertedIds) . "\n";
    
    // Test des méthodes du repository
    echo "\nTest findAll():\n";
    $allUsers = $userRepo->findAll();
    printUsers($allUsers);
    
    echo "\nTest findById():\n";
    $user = $userRepo->findById($insertedIds[0]);
    printUser($user);
    
    echo "\nTest findByEmail():\n";
    $userByEmail = $userRepo->findByEmail('user@example.com');
    printUser($userByEmail);
    
    echo "\nTest findActiveUsers():\n";
    $activeUsers = $userRepo->findAllUsers();
    printUsers($activeUsers);
    
    echo "\nTest findByRole('admin'):\n";
    $adminUsers = $userRepo->findByRole('admin');
    printUsers($adminUsers);
    
    echo "\nTest update():\n";
    $userRepo->update($insertedIds[1], ['nom' => 'Updated User Name']);
    $updatedUser = $userRepo->findById($insertedIds[1]);
    printUser($updatedUser);
    
    // Si vous voulez tester la suppression, décommentez cette ligne
    // echo "\nTest delete():\n";
    // $userRepo->delete($insertedIds[2]);
    // $remainingUsers = $userRepo->findAll();
    // printUsers($remainingUsers);
    
    echo "\nTous les tests ont été exécutés avec succès!\n";
    
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage();
}

// Fonction pour afficher un utilisateur
function printUser(?array $user): void {
    if ($user) {
        echo "ID: {$user['id']}, Nom: {$user['nom']}, email: {$user['email']}, Rôle: {$user['role']}, Statut: {$user['status']}\n";
    } else {
        echo "Aucun utilisateur trouvé\n";
    }
}

// Fonction pour afficher plusieurs utilisateurs
function printUsers(array $users): void {
    if (empty($users)) {
        echo "Aucun utilisateur trouvé\n";
        return;
    }
    
    foreach ($users as $user) {
        printUser($user);
    }
}