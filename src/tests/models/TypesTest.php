<?php
require_once dirname(dirname(dirname(__FILE__))) . '/vendor/autoload.php';
require_once dirname(dirname(dirname(__FILE__))) . '/config/config.php';

use App\Models\Types;
use PHPUnit\Framework\TestCase;

class TypesTest extends TestCase
{
    /**
     * @covers Types::all()
     */
    public function testAll()
    {
        $this->assertEquals(3, count(Types::all()));
    }

    /**
     * @covers Types::find()
     */
    public function testFind_ifValueExist()
    {
        $this->assertInstanceOf(Types::class, Types::find(1));
    }

    /**
     * @covers Types::find()
     */
    public function testFind_ifValueNotExist()
    {
        $this->assertNull(Types::find(100));
    }

    /**
     * @covers Types::slug()
     */
    public function testSlug_ifExist()
    {

        $this->assertEquals(1, Types::slug('SHORT'));
    }

    /**
     * @covers  Types::create()
     * @depends testDelete
     */
    public function testCreate()
    {
        $type = Types::create(["name" => 'UnitTest', "slug" => "UNIT"]);

        $this->assertEquals('UnitTest', $type->name);
        $this->assertEquals("UNIT", $type->slug);
        $type->delete();
    }

    /**
     * @covers  Types::save()
     * @depends testFind_ifValueExist, testDelete
     */
    public function testSave()
    {
        $type = Types::create(["name" => 'UnitTest', "slug" => "UNIT"]);
        $type->name = "Test";
        $type->save();
        $this->assertEquals('Test', Types::find($type->id)->name);
        $type->delete();
    }


    /**
     * @covers  Types::delete()
     * @depends testFind_ifValueExist, testCreate
     */
    public function testDelete()
    {
        $type = Types::create(["name" => 'UnitTest', "slug" => "UNIT"]);
        $id = $type->id;
        $type->delete();

        $this->assertNull(Types::find($id));
    }
}