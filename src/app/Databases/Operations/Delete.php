<?php

namespace App\Databases\Operations;

use App\Databases\Query;
use App\Databases\Connector;

class Delete extends Query
{
    public function __construct(string $class, array $values)
    {
        $this->params = $values;

        parent::__construct($class);
        $this->buildQuery();
        $this->execute();
    }

    private function buildQuery()
    {
        $this->query = 'DELETE FROM ' . $this->table . ' WHERE ' . array_key_first($this->params) . ' = :' . array_key_first($this->params);
    }

    private function execute()
    {
        Connector::connect()->prepare($this->query)->execute($this->params);    
    }
}
