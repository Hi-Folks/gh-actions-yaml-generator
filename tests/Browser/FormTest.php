<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FormTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Ghygen');
            $browser->type('name' , 'Test123')
                ->screenshot("test_name")
                ->check('onPush')
                ->check('onPullrequest')
                ->select('mysqlPasswordType', "hardcoded")
                ->pause(500)
                ->type('mysqlPassword' , 'TestPassword')
                ->screenshot("test_db")
                ->pause(500)
                ->press('Generate Yaml File')
                ->pause(1000)
                ->screenshot("test")
                ->assertSee('name: Test123');
        });
    }
}
