<?php

namespace App\Databases;

class Query
{
    use \App\Traits\ClassToTable;

    protected string $class;
    protected string $table;
    protected ?array $params = null;

    public function __construct(string $class)
    {
        $this->class = $class;
        $this->table = $this->toTable($class);
    }
}
