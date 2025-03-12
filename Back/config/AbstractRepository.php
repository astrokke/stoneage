<?php

namespace Stoneage\Back\config;

use Exception;
use Stoneage\Back\config\Database;
use PDOException;
use Stoneage\Back\config\QueryBuilder;
use PDO;

abstract class AbstractRepository{
    protected $db;
    protected $table;
    protected  QueryBuilder $querybuilder;


    public function __construct( Database $dbconnection ,string $table)
    {

        $this->db =$dbconnection->getConnection();
        $this->table =$table;
        $this->querybuilder = new QueryBuilder($this->table,);
    }

protected function executeAllQuery(array $queryData):array {
    try{
        $stmt=$this->db->prepare($queryData['query']);
        $stmt ->execute($queryData["values"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }catch(PDOException $e){
        die("elle est claquer ta requete le rho". $e->getmessage());
    }
}

protected function executeQueryOne(array $queryData): ?array {
    try {
        $stmt = $this->db->prepare($queryData['query']);
        $stmt->execute($queryData['values']);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result !== false ? $result : null;
    } catch (PDOException $e) {
        throw new Exception("Erreur d'exécution de la requête : " . $e->getMessage());
    }
}


// Exécute une requête sans retour de données (INSERT, UPDATE, DELETE)
protected function executeQuery(array $queryData) {
    try{
        $stmt= $this->db->prepare($queryData['query']);
        $stmt ->execute($queryData["values"]);
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }catch(PDOException $e){
        die("elle est claquer ta requete le rho". $e->getmessage());
    }
}

public function findAll( array $columns=["*"]):array{
    $this->querybuilder->reset()->select($columns);
    return $this->executeAllQuery($this->querybuilder->buildSelect());
}


public function findby (array $parameter ,$columns=["*"]):array{
    $this->querybuilder->reset()->select($columns);

    foreach($parameter as $columns=>$value){
        $this->querybuilder->where($columns, "=",$value);

    }

   return $this->executeAllQuery($this->querybuilder->buildSelect());

}

public function findById (int $id ,array $columns =['*']): ?array{
    $this->querybuilder->reset()->select($columns)->where('id' ,'=' ,$id);
    return $this ->executeQueryOne($this->querybuilder->buildSelect());
}


public function findOneBy(array $parameter, array $columns=["*"]): ?array{
    $this->querybuilder->reset()->select($columns);

    foreach($parameter as $columns=>$value){
        $this->querybuilder->where($columns, "=",$value);

    }
    $this->querybuilder->limit(1);
   $result= $this->executeAllQuery($this->querybuilder->buildSelect());
   return $result[0];
}

public function create(array $data):int {
    $this->querybuilder->reset();
    $queryData =$this->querybuilder->buildInsert($data);
    $this->executeQuery($queryData);
    return (int) $this->db->lastInsertId();
}

public function delete (int $id):int  {

$this->querybuilder->reset()->where("id","=",$id);
$queryData= $this->querybuilder->buildDelete();
return $this->executeQuery($queryData);


}

public function update(int $id ,array $data):int{

    $this->querybuilder->reset()->where("id","=",$id);
    $queryData =$this->querybuilder->buildUpdate($data);

    return $this->executeQuery($queryData);
}

public function executeCustomQuery( callable $builderfunction): array {
    $this->querybuilder->reset();
    $builderfunction($this->querybuilder);
    return $this->executeAllQuery($this->querybuilder->buildSelect());

}

}