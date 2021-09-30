<?php

namespace App\Databases\Operations;

use App\Databases\Model;
use App\Databases\Query;
use App\Databases\Connector;

class Create extends Query
{
    public function __construct(string $class, array $values)
    {
        $this->params = $values;

        parent::__construct($class);
        $this->buildQuery();
    }

    private function buildQuery()
    {
        $query = 'INSERT INTO ' . $this->table . ' VALUES (null,';
        foreach ($this->params as $key => $_) {
            $query .= ':' . $key . ($key !== array_key_last($this->params) ? ',' : null);
        }
        $query .= ');';

        $this->query = $query;
    }

    public function execute(): int
    {
        $pdo = Connector::connect();
        $pdo->prepare($this->query)->execute($this->params);
        
        return $pdo->lastInsertId();
    }
}
