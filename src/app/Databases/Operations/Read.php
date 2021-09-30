<?php

namespace App\Databases\Operations;

use App\Databases\Model;
use App\Databases\Query;
use App\Databases\Connector;

class Read extends Query
{
    private array $columns;
    private ?array $conditions = null;
    private int $limit;
    private int $offset;
    protected string $query = '';
    protected bool $returnAsDirectObject = false;

    public function __construct(string $class, array $columns)
    {
        $this->columns = $columns;

        parent::__construct($class);
        return $this;
    }

    public function where($column, $value): self
    {
        $this->conditions[] = $column;
        $this->params[$column] = $value;

        return $this;
    }

    public function orderByAsc($column): void
    {
        // TODO
    }

    public function orderByDesc($column): void
    {
        // TODO
    }

    public function first(): Model | null
    {
        $this->limit = 1;
        $this->returnAsDirectObject = true;
        return $this->get();
    }

    public function limit($limit): void
    {
        $this->limit = $limit;
    }

    public function skip($offset): void
    {
        $this->offset = $offset;
    }

    /**
     *  @return Model[]|Model|null
     */
    public function get(): array | Model | null
    {
        $query = 'SELECT ';

        foreach ($this->columns as $column) {
            $query .= $column . ($column !== end($this->columns) ? ', ' : null);
        }

        $query .= ' FROM ' . $this->table;

        if (isset($this->conditions) && !empty($this->conditions)) {
            $query .= ' WHERE ';
            foreach ($this->conditions as $condition) {
                $query .= ($condition !== reset($this->conditions) ? ' AND ' : null) . $condition . ' = :' . $condition;
            }
        }

        if (isset($limit) && $limit != 0) {
            $query .= ' LIMIT :limit';
            $params['limit'] = $limit;
        }

        if (isset($offset) && $offset != 0) {
            $query .= ' OFFSET :offset';
            $params['offset'] = $offset;
        }

        $this->query = $query;
        return $this->execute($this, $this->returnAsDirectObject);
    }

    /**
     * @return Model[]|Model|null
     */
    private function execute(Query $query, ?bool $returnAsDirectObject = false):  array | Model | null
    {
        $stmt = Connector::connect()->prepare($query->query);
        $stmt->execute($query->params);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $query->class);
        $result = $stmt->fetchAll();

        return $returnAsDirectObject ? (empty($result) ? null : reset($result)) : $result;
    }
}
