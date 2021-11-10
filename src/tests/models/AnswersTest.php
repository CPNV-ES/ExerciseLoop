<?php

use PHPUnit\Framework\TestCase;
use App\Models\Answers;

require './vendor/autoload.php';
require './config/config.php';

class AnswersTest extends TestCase
{
    protected function setUp(): void
    {
        // TODO DROP DB
    }

    public function testAll()
    {
        $this->assertEquals(6, count(Answers::all()));
    }

    public function testFind()
    {
        $this->assertInstanceOf(Answers::class, Answers::find(1));
        $this->assertNull(Answers::find(1000));
    }

    public function testWhere()
    {
        $this->assertEquals(3, count(Answers::where('question_id', 6)->get()));
        $this->assertEquals(2, count(Answers::where('submission_id', 1)->get()));
        $this->assertEquals(0, count(Answers::where('question_id', 1000)->get()));
        $this->assertEquals(0, count(Answers::where('submission_id', 1000)->get()));
    }


    public function testCreate()
    {
        $answer = Answers::create(["answer" => 'UnitTest Answer', "question_id" => 1, "submission_id" => 1]);

        $this->assertEquals('UnitTest Answer', $answer->answer);
        $this->assertEquals(1, $answer->question_id);
        $this->assertEquals(1, $answer->submission_id);
    }

    public function testSave()
    {
        $answer = Answers::find(1);
        $answer->answer = "UnitTest Answer";
        $answer->save();

        $this->assertEquals("UnitTest Answer", Answers::find(1)->answer);
    }

    public function testDelete()
    {
        $answer = Answers::find(1);
        $answer->delete();

        $this->assertNull(Answers::find(1));
    }
}
