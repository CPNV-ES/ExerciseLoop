<?php

require_once dirname(dirname(dirname(__FILE__))) . '/vendor/autoload.php';
require_once dirname(dirname(dirname(__FILE__))) . '/config/config.php';

use App\Models\Submissions;
use PHPUnit\Framework\TestCase;

class SubmissionsTest extends TestCase
{
    /**
     * @covers Submissions::all()
     */
    public function testAll()
    {
        $this->assertEquals(5, count(Submissions::all()));
    }

    /**
     * @covers Submissions::find()
     */
    public function testFind_ifValueExist()
    {
        $this->assertInstanceOf(Submissions::class, Submissions::find(1));
    }

    /**
     * @covers Submissions::find()
     */
    public function testFind_ifValueNotExist()
    {
        $this->assertNull(Submissions::find(1000));
    }

    /**
     * @covers Submissions::where()
     */
    public function testWhere_ifResultExist()
    {
        $this->assertEquals(1, count(Submissions::where('path', 'skjjsa')->get()));
    }

    /**
     * @covers Submissions::where()
     */
    public function testWhere_ifResultNotExist()
    {
        $this->assertEquals(0, count(Submissions::where('path', 'aaaaa')->get()));
    }

    /**
     * @covers  Submissions::create()
     * @depends testDelete
     */
    public function testCreate()
    {
        $path = md5(uniqid(rand(), true));
        $submission = Submissions::create(['path' => $path, 'timestamp' => '2000-01-01 01:01:01']);

        $this->assertEquals($path, $submission->path);
        $this->assertEquals('2000-01-01 01:01:01', $submission->timestamp);
        $submission->delete();
    }

    /**
     * @covers  Submissions::save()
     * @depends testFind_ifValueExist, testDelete
     */
    public function testSave()
    {
        $path = md5(uniqid(rand(), true));
        $submission = Submissions::create(['path' => $path, 'timestamp' => '2000-01-01 01:01:01']);
        $submission->path = "UnitTestPath";
        $submission->save();

        $this->assertEquals("UnitTestPath", Submissions::find($submission->id)->path);
        $submission->delete();
    }

    /**
     * @covers  Submissions::delete()
     * @depends testFind_ifValueExist, testCreate
     */
    public function testDelete()
    {
        $path = md5(uniqid(rand(), true));
        $submission = Submissions::create(['path' => $path, 'timestamp' => '2000-01-01 01:01:01']);
        $id = $submission->id;
        $submission->delete();

        $this->assertNull(Submissions::find($id));
    }
}
