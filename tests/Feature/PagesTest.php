<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagesTest extends TestCase
{
    use DatabaseMigrations;
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMainPage()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDashboardPage()
    {
        $response = $this->get('/dashboard');
        $response->assertStatus(200);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAboutPage()
    {
        $response = $this->get('/about');
        $response->assertStatus(200);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test404Page()
    {
        $response = $this->get('/itdoesntexist');
        $response->assertStatus(404);
    }
}
