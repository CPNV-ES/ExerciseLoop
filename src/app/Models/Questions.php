<?php

namespace App\Models;

use App\Databases\Model;

// Class name need to match with database table
class Questions extends Model
{
    // Primary index as to be in first in variables declaration
    // Object properties visibility need to be protected for parent access
    // Object properties name need to match with database columns
    protected int $id;
    protected string $question;
    protected int $exercise_id;
    protected int $type_id;

    public function answer()
    {
        return Answers::where('question_id', $this->id)->get();
    }
}
