<?php


namespace Musielak\Back\config;


final class QueryBuilder {


   




    public function __construct
    ( 
        private string $table,
        private array $conditions = [],
        private array $values = [],
        private array $orderBy = [],
        private ?int $limit = null,
        private ?int $offset = null,
        private array $joins = [],
        private array $columns = ['*'],
    )
    {}


 


    
public function buildUpdate(array $data): array {
    $setStatements = [];
    $values = [];
    
    foreach ($data as $column => $value) {
        $setStatements[] = "$column = ?";
        $values[] = $value;
    }
    
    $query = "UPDATE {$this->table} SET " . implode(', ', $setStatements);
    
    if (!empty($this->conditions)) {
        $query .= ' WHERE ' . implode(' ', $this->conditions);
        $values = array_merge($values, $this->values);
    }
    
    return ['query' => $query, 'values' => $values];
}

public function buildDelete(): array {
    $query = "DELETE FROM {$this->table}";
    
    if (!empty($this->conditions)) {
        $query .= ' WHERE ' . implode(' ', $this->conditions);
    }
    
    return ['query' => $query, 'values' => $this->values];
}

public function buildSelect(): array {
    // Construisez votre requête comme d'habitude
    $columns = implode(', ', $this->columns);
    $query = "SELECT $columns FROM {$this->table}";
    
    if(!empty($this->joins)) {
        $query .= ' ' . implode(' ', $this->joins);
    }
    
    if(!empty($this->conditions)) {
        $query .= ' WHERE ' . implode(' AND ', $this->conditions);
    }
    
    if(!empty($this->orderBy)) {
        $query .= ' ORDER BY ' . implode(', ', $this->orderBy);
    }
    
    if($this->limit !== null) {
        $query .= " LIMIT {$this->limit}";
        
        if($this->offset !== null) {
            $query .= " OFFSET {$this->offset}";
        }
    }
    
    // Ajouter ces lignes pour déboguer
    echo "Requête SQL générée : " . $query . "\n";
    echo "Valeurs : " . print_r($this->values, true) . "\n";
    
    return ['query' => $query, 'values' => $this->values];
}

    public function buildInsert(array $data):array
    {
        // transform le tableaux de collone en string separer par des virgules
        $columns = implode(',',array_keys($data));
        $placeholders =implode(',',array_fill(0,count($data),'?'));
        // insert dans la table
        $query = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";

       
       return ['query'=>$query,'values'=>array_values($data)];


    }


    public function select (array $columns=['*']):self{
        // selectione la colone 
        $this->columns = $columns;
        return $this;
    }

    public function where (string $columns ,string $operator , mixed $value):self{
        // met a jours le tableaux condition 
        $this->conditions[]="$columns $operator ?";
        // ajouute la valeur pour la requette preparée
        $this->values[] = $value;
        return $this;
    }


    public function orWhere(string $column, string $operator, mixed $value): self {
        if (empty($this->conditions)) {
            return $this->where($column, $operator, $value);
        }
        
        $this->conditions[] = "OR $column $operator ?";
        $this->values[] = $value;
        return $this;
    }

    public function andWhere(string $column, string $operator, mixed $value): self {
        if (empty($this->conditions)) {
            return $this->where($column, $operator, $value);
        }
        
        $this->conditions[] = "AND $column $operator ?";
        $this->values[] = $value;
        return $this;
    }

    public function orderBy(string $column, string $direction = 'ASC'): self {
        $this->orderBy[] = "$column $direction";
        return $this;
    }

    public function limit(int $limit): self {
        $this->limit = $limit;
        return $this;
    }

    public function offset(int $offset): self {
        $this->offset = $offset;
        return $this;
    }

    public function join(string $table, string $onCondition, string $type = 'INNER'): self {
        $this->joins[] = "$type JOIN $table ON $onCondition";
        return $this;
    }


    // reste le querry builder
    public function reset(): self
    {
        $this->conditions = [];
        $this->values = [];
        $this->orderBy = [];
        $this->limit = null;
        $this->offset = null;
        $this->joins = [];
        $this->columns = ['*'];
        
        return $this;
    }
}