<?php

use PHPUnit\Framework\TestCase;
use App\Models\Exercises;

class ExercisesTest extends TestCase
{
    protected function setUp(): void
    {
        // TODO DROP DB
    }
    
    public function testAll()
    {
        $this->assertEquals(5, count(Exercises::all()));
    }

    public function testFind()
    {
        $this->assertInstanceOf(Exercises::class, Exercises::find(1));
        $this->assertNull(Exercises::find(1000));
    }

    public function testWhere()
    {
        $this->assertEquals(2, count(Exercises::where('state_id', 1)->get()));
        $this->assertEquals(0, count(Exercises::where('state_id', 200)->get()));
    }


    public function testCreate()
    {
        $exercise = Exercises::create(["title" => 'UnitTest Exercise', "state_id" => 1]);

        $this->assertEquals('UnitTest Exercise', $exercise->title);
        $this->assertEquals(1, $exercise->state_id);
    }

    public function testSave()
    {
        $exercise = Exercises::find(1);
        $exercise->title = "UnitTest Title";
        $exercise->save();

        $this->assertEquals("UnitTest Title", Exercises::find(1)->title);
    }
    
    public function testDelete()
    {
        $exercise = Exercises::find(1);
        $exercise->delete();

        $this->assertNull(Exercises::find(1));
    }
}
