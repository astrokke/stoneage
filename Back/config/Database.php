<?php

namespace Stoneage\Back\config;

use PDO;
use PDOException;

class Database
{
    private string $user;
    private string $pass;
    private string $servername;
    private string $dbname;

    
   
    public function __construct(array $config = [])
    {
        $this->user = $config['user'] ?? 'root';
        $this->pass = $config['password'] ?? '';
        $this->servername = $config['host'] ?? 'localhost';
        $this->dbname = $config['dbname'] ?? 'stoneage';
    }

    public function getConnection()
    {
        try {
            $dbh = new PDO("mysql:host={$this->servername};dbname={$this->dbname}", $this->user, $this->pass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbh;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return null;
        }
    }
}
