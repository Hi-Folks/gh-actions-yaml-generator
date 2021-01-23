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
                //->screenshot("test_name")
                ->check('onPush')
                ->check('onPullrequest')
                ->select('mysqlPasswordType', "hardcoded")
                ->pause(100)
                ->type('mysqlPassword' , 'TestPassword')
                //->screenshot("test_db")
                ->check('stepDusk')
                ->press('GENERATE YAML FILE')
                ->pause(1000)
                ->screenshot("test")
                ->assertDontSee('Error');
        });
    }
}
