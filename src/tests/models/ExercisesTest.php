<?php

require_once dirname(dirname(dirname(__FILE__))) . '/vendor/autoload.php';
require_once dirname(dirname(dirname(__FILE__))) . '/config/config.php';

use App\Models\Exercises;
use PHPUnit\Framework\TestCase;


class ExercisesTest extends TestCase
{

    /**
     * @covers Exercises::all()
     */
    public function testAll()
    {
        $this->assertEquals(5, count(Exercises::all()));
    }

    /**
     * @covers Exercises::find()
     */
    public function testFind_ifValueExist()
    {
        $this->assertInstanceOf(Exercises::class, Exercises::find(1));
    }

    /**
     * @covers Exercises::find()
     */
    public function testFind_ifValueNotExist()
    {
        $this->assertNull(Exercises::find(1000));
    }

    /**
     * @covers Exercises::where()
     */
    public function testWhere_ifResultExist()
    {
        $this->assertEquals(2, count(Exercises::where('state_id', 1)->get()));
    }

    /**
     * @covers Exercises::where()
     */
    public function testWhere_ifResultNotExist()
    {
        $this->assertEquals(0, count(Exercises::where('state_id', 200)->get()));
    }

    /**
     * @covers  Exercises::create()
     * @depends testDelete
     */
    public function testCreate()
    {
        $exercise = Exercises::create(["title" => 'UnitTest Exercise', "state_id" => 1]);

        $this->assertEquals('UnitTest Exercise', $exercise->title);
        $this->assertEquals(1, $exercise->state_id);
        $exercise->delete();
    }

    /**
     * @covers  Exercises::save()
     * @depends testFind_ifValueExist
     */
    public function testSave()
    {
        $exercise = Exercises::create(["title" => 'UnitTest Exercise', "state_id" => 1]);
        $exercise->title = "UnitTest Title";
        $exercise->save();
        $this->assertEquals("UnitTest Title", Exercises::find($exercise->id)->title);
        $exercise->delete();
    }

    /**
     * @covers  Exercises::delete()
     * @depends testFind_ifValueExist, testCreate
     */
    public function testDelete()
    {
        $exercise = Exercises::create(['title' => 'test', 'state_id' => 1]);
        $id = $exercise->id;
        $exercise->delete();
        $this->assertNull(Exercises::find($id));
    }
}
