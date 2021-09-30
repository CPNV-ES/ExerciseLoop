<?php

namespace App\Databases\Operations;

use App\Databases\Query;
use App\Databases\Connector;

class Update extends Query
{
    private array $conditions;

    public function __construct(string $class, array $values)
    {
        $this->params = $values;

        parent::__construct($class);
        $this->buildQuery();
        $this->execute();
    }

    private function buildQuery()
    {
        $this->conditions = array_splice($this->params, 0, 1); // Split conditions and columns in different arrays

        $query = 'UPDATE ' . $this->table . ' SET ';

        foreach ($this->params as $key => $_) {
            $query .= $key . ' = :' . $key . ($key !== array_key_last($this->params) ? ',' : null);
        }

        $query .= ' WHERE ' . array_key_first($this->conditions) . ' = :' . array_key_first($this->conditions); //  Conditions only look for primary id, loop it if multiple ids need to match

        $this->query = $query;
    }

    private function execute()
    {
        Connector::connect()->prepare($this->query)->execute(array_merge($this->params, $this->conditions)); // Array of all prepared statements
    }
}
