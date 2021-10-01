<?php

namespace App\Models;

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

    public static function whereSlug($slug)
    {
        return Exercises::where('state_id',States::where('slug', $slug)->first()->id);
    }
}
