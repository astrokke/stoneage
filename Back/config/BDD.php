<?php





class Database
{

    private $user = 'root';
    private $pass = '';
    private $servername = 'localhost';
    private $dbname = 'stoneage';






    public  function getConnection()
    {
        try {

            $dbh = new PDO("mysql:host={$this->servername};dbname={$this->dbname}", $this->user, $this->pass);

            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'Connexion réussie =)';
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}
