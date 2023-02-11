<?php

namespace Tests\Unit;

use App\Objects\GuesserFiles;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class GuesserTest extends TestCase
{
    /**
     * Test for Testbench.
     *
     * @return void
     */
    public function testLaravelVersions()
    {
        $arr = GuesserFiles::detectLaravelVersionFromTestbench('xxx');
        $this->assertIsArray($arr);
        $this->assertCount(0, $arr, 'Invalid testbench version');

        $arr = GuesserFiles::detectLaravelVersionFromTestbench('4.*|5.*|6.*');
        $this->assertIsArray($arr);
        $this->assertCount(3, $arr);

        $arr = GuesserFiles::detectLaravelVersionFromTestbench('5.*|6.*');
        $this->assertIsArray($arr);
        $this->assertCount(2, $arr);
        $this->assertEquals('8.*', $arr[1]);

        $arr = GuesserFiles::detectLaravelVersionFromTestbench('7.*');
        $this->assertIsArray($arr);
        $this->assertCount(1, $arr);
        $this->assertEquals('9.*', $arr[0]);
    }

    /**
     * Test for path guesser.
     *
     * @return void
     */
    public function testPathGuesser()
    {
        $guesserFiles = new GuesserFiles();
        $guesserFiles->pathFiles('../test');

        $this->assertEquals($guesserFiles->getEnvDefaultTemplatePath(), '../test/.env.example');
    }
}
