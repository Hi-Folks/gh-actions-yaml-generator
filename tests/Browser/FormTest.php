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
                ->press('GENERATE YAML FILE')
                ->pause(1000)
                ->screenshot("test")
                ->assertDontSee('Error');
        });
    }
}
