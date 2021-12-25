<?php

require_once dirname(dirname(dirname(__FILE__))) . '/vendor/autoload.php';
require_once dirname(dirname(dirname(__FILE__))) . '/config/config.php';

use App\Models\Questions;
use PHPUnit\Framework\TestCase;

class QuestionsTest extends TestCase
{
    /**
     * @covers Questions::all()
     */
    public function testAll()
    {
        $this->assertEquals(6, count(Questions::all()));
    }

    /**
     * @covers Questions::find()
     */
    public function testFind_ifValueExist()
    {
        $this->assertInstanceOf(Questions::class, Questions::find(1));
    }

    /**
     * @covers Questions::find()
     */
    public function testFind_ifValueNotExist()
    {
        $this->assertNull(Questions::find(1000));
    }

    /**
     * @covers Questions::where()
     */
    public function testWhere_IfResultExist()
    {
        $this->assertEquals(1, count(Questions::where('exercise_id', 2)->get()));
        $this->assertEquals(1, count(Questions::where('type_id', 1)->get()));
    }

    /**
     * @covers Questions::where()
     */
    public function testWhere_IfResultNotExist()
    {
        $this->assertEquals(0, count(Questions::where('exercise_id', 1000)->get()));
        $this->assertEquals(0, count(Questions::where('type_id', 1000)->get()));
    }

    /**
     * @covers   Questions::create()
     * @depends  testDelete
     */
    public function testCreate()
    {
        $question = Questions::create(["question" => "test", "exercise_id" => 1, "type_id" => 1]);

        $this->assertEquals("test", $question->question);
        $this->assertEquals(1, $question->exercise_id);
        $this->assertEquals(1, $question->type_id);
        $question->delete();
    }

    /**
     * @covers   Questions::save()
     * @depends  testFind_ifValueExist
     */
    public function testSave()
    {
        $question = Questions::create(["question" => "unitTest", "exercise_id" => 1, "type_id" => 1]);
        $question->question = "Test";
        $question->save();

        $this->assertEquals("Test", Questions::find($question->id)->question);
        $question->delete();
    }

    /**
     * @covers Questions::delete()
     * @depends  testFind_ifValueExist, testCreate
     */
    public function testDelete()
    {
        $question = Questions::create(["question" => "test", "exercise_id" => 1, "type_id" => 3]);
        $id = $question->id;
        $question->delete();

        $this->assertNull(Questions::find($id));
    }
}
