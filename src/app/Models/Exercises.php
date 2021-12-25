<?php

namespace App\Models;

use App\Databases\Connector;
use App\Databases\Model;

// Class name need to match with database table
class Exercises extends Model
{
    // Primary index as to be in first in variables declaration
    // Object properties visibility need to be protected for parent access
    // Object properties name need to match with database columns
    protected int $id;
    protected string $title;
    protected int $state_id;

    public function questions()
    {
        return Questions::where('exercise_id', $this->id)->get();
    }

    public function state()
    {
        return States::find($this->state_id);
    }

    public function submissions()
    {
        $query = "SELECT s.id, s.path, s.timestamp 
        FROM submissions as s 
        INNER JOIN answers a on s.id = a.submission_id 
        INNER JOIN questions q on a.question_id = q.id 
        INNER JOIN exercises e on q.exercise_id = e.id 
        WHERE e.id=:id GROUP BY s.id";

        $stmt = Connector::getInstance()->pdo()->prepare($query);
        $stmt->execute(['id' => $this->id]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Submissions::class);
        $result = $stmt->fetchAll();

        return $result;
    }

    public function isBuild()
    {
        return $this->state()->slug === 'BUILD';
    }

    public function isAnswerable()
    {
        return $this->state()->slug === 'ANSWER';
    }

    public function isClosed()
    {
        return $this->state()->slug === 'CLOSE';
    }
}
