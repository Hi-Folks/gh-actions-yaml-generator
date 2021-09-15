<?php

namespace Tests\Unit;

use App\Objects\GuesserFiles;
use Illuminate\Support\Facades\App;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class GuesserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLaravelVersions()
    {
        $arr = GuesserFiles::detectLaravelVersionFromTestbench("xxx");
        $this->assertIsArray($arr);
        $this->assertCount(0, $arr, "Invalid testbench version");

        $arr = GuesserFiles::detectLaravelVersionFromTestbench("4.*|5.*|6.*");
        $this->assertIsArray($arr);
        $this->assertCount(3, $arr);

        $arr = GuesserFiles::detectLaravelVersionFromTestbench("5.*|6.*");
        $this->assertIsArray($arr);
        $this->assertCount(2, $arr);
        $this->assertEquals("8.*", $arr[1]);

    }
}
