<?php

use PHPUnit\Framework\TestCase;
use App\Models\Submissions;

class SubmissionsTest extends TestCase
{
    public function testAll()
    {
        $this->assertEquals(5, count(Submissions::all()));
    }

    public function testFind()
    {
        $this->assertInstanceOf(Submissions::class, Submissions::find(1));
        $this->assertNull(Submissions::find( 1000));
    }

    public function testWhere()
    {
        $this->assertEquals(1, count(Submissions::where('path','skjjsa')->get()));
    }


    public function testCreate()
    {
        $path = md5(uniqid(rand(), true));
        $submission = Submissions::create(['path' => $path, 'timestamp' => '2000-01-01 01:01:01']);

        $this->assertEquals($path, $submission->path);
        $this->assertEquals('2000-01-01 01:01:01', $submission->timestamp);
    }

    public function testSave()
    {
        $submission = Submissions::find(1);
        $submission->path = "UnitTestPath";
        $submission->save();

        $this->assertEquals("UnitTestPath", Submissions::find(1)->path);
    }

    public function testDelete()
    {
        $submission = Submissions::find(1);
        $submission->delete();

        $this->assertNull(Submissions::find(1));
    }
}
