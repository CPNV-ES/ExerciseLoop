<?php
require_once dirname(dirname(dirname(__FILE__))) . '/vendor/autoload.php';
require_once dirname(dirname(dirname(__FILE__))) . '/config/config.php';

use App\Models\States;
use PHPUnit\Framework\TestCase;

class StatesTest extends TestCase
{
    /**
     * @covers States::all()
     */
    public function testAll()
    {
        $this->assertEquals(3, count(States::all()));
    }

    /**
     * @covers States::find()
     */
    public function testFind_ifValueExist()
    {
        $this->assertInstanceOf(States::class, States::find(1));
    }

    /**
     * @covers States::find()
     */
    public function testFind_ifValueNotExist()
    {
        $this->assertNull(States::find(100));
    }

    /**
     * @covers States::slug()
     */
    public function testSlug_ifExist()
    {

        $this->assertEquals(1, States::slug('BUILD'));
    }

    /**
     * @covers  States::create()
     * @depends testDelete
     */
    public function testCreate()
    {
        $state = States::create(["name" => 'UnitTest', "slug" => "UNIT"]);

        $this->assertEquals('UnitTest', $state->name);
        $this->assertEquals("UNIT", $state->slug);
        $state->delete();
    }

    /**
     * @covers  States::save()
     * @depends testFind_ifValueExist
     */
    public function testSave()
    {
        $state = States::find(1);
        $name = $state->name;
        $state->name = "UnitTest";
        $state->save();
        $this->assertEquals('UnitTest',  States::find(1)->name);
        $state->name = $name;
        $state->save();
    }

    /**
     * @covers  States::delete()
     * @depends testFind_ifValueExist, testCreate
     */
    public function testDelete()
    {
        $state = States::create(["name" => 'UnitTest', "slug" => "UNIT"]);
        $id = $state->id;
        $state->delete();

        $this->assertNull(States::find($id));
    }

}