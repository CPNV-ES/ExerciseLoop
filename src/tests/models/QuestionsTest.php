<?php

use PHPUnit\Framework\TestCase;
use App\Models\Questions;

class QuestionsTest extends TestCase
{
    protected function setUp(): void
    {
        // TODO DROP DB
    }
    
    public function testAll()
    {
        $this->assertEquals(6, count(Questions::all()));
    }

    public function testFind()
    {
        $this->assertInstanceOf(Questions::class, Questions::find(1));
        $this->assertNull(Questions::find(1000));
    }

    public function testWhere()
    {
        $this->assertEquals(1, count(Questions::where('exercise_id', 2)->get()));
        $this->assertEquals(1, count(Questions::where('type_id', 1)->get()));
    }

    public function testCreate()
    {
        $question = Questions::create(["question" => "test", "exercise_id" => 1, "type_id" => 1]);
        
        $this->assertEquals("test", $question->question);
        $this->assertEquals(1, $question->exercise_id);
        $this->assertEquals(1, $question->type_id);
    }

    public function testSave()
    {
        $question = Questions::find(1);
        $question->question = "Test";
        $question->save();

        $this->assertEquals("Test", Questions::find(1)->question);
    }

    public function testDelete()
    {
        $question = Questions::find(1);
        $question->delete();

        $this->assertNull(Questions::find(1));
    }
}
