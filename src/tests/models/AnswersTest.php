<?php

require_once dirname(dirname(dirname(__FILE__))) . '/vendor/autoload.php';
require_once dirname(dirname(dirname(__FILE__))) . '/config/config.php';

use App\Models\Answers;
use PHPUnit\Framework\TestCase;

class AnswersTest extends TestCase
{
    /**
     * @covers Answers::all()
     */
    public function testAll()
    {
        $this->assertEquals(6, count(Answers::all()));
    }

    /**
     * @covers Answers::find()
     */
    public function testFind_ifValueExist()
    {
        $this->assertInstanceOf(Answers::class, Answers::find(1));
    }

    /**
     * @covers Answers::find()
     */
    public function testFind_ifValueNotExist()
    {
        $this->assertNull(Answers::find(1000));
    }

    /**
     * @covers Answers::where()
     */
    public function testWhere_IfResultExist()
    {
        $this->assertEquals(3, count(Answers::where('question_id', 6)->get()));
        $this->assertEquals(2, count(Answers::where('submission_id', 1)->get()));
    }

    /**
     * @covers Answers::where()
     */
    public function testWhere_IfResultDontExist()
    {
        $this->assertEquals(0, count(Answers::where('question_id', 1000)->get()));
        $this->assertEquals(0, count(Answers::where('submission_id', 1000)->get()));
    }

    /**
     * @covers  Answers::create(array)
     * @depends testDelete
     */
    public function testCreate()
    {
        $answer = Answers::create(["answer" => 'UnitTest Answer', "question_id" => 1, "submission_id" => 1]);

        $this->assertEquals('UnitTest Answer', $answer->answer);
        $this->assertEquals(1, $answer->question_id);
        $this->assertEquals(1, $answer->submission_id);
        $answer->delete();
    }

    /**
     * @covers  Answers::save()
     * @depends testFind_ifValueExist, testDelete
     */
    public function testSave()
    {
        $answer =  Answers::create(["answer" => 'UnitTest Answer', "question_id" => 1, "submission_id" => 1]);
        $answer->answer = "UnitTest";
        $answer->save();

        $this->assertEquals("UnitTest", Answers::find($answer->id)->answer);
        $answer->delete();
    }

    /**
     * @covers  Answers::delete()
     * @depends testFind_ifValueExist, testCreate
     */
    public function testDelete()
    {
        $answer = Answers::create(['anwer' => 'test', 'question_id' => 1, 'submission_id' => 1]);
        $id = $answer->id;
        $answer->delete();

        $this->assertNull(Answers::find($id));
    }

}
