<?php

namespace App\Models;

use App\Databases\Model;

// Class name need to match with database table
class Submissions extends Model
{
    // Primary index as to be in first in variables declaration
    // Object properties visibility need to be protected for parent access
    // Object properties name need to match with database columns
    protected int $id;
    protected string $path;
    protected string $timestamp;

    public function answers()
    {
        return Answers::where('submission_id', $this->id)->get();
    }

    public function answer(int $questionId)
    {
        return Answers::where('question_id', $questionId)
        ->where('submission_id', $this->id)
        ->first();
    }
}
