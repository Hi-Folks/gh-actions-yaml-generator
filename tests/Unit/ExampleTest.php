<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\App;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(App::environment('testing'));
    }
}
