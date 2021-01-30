<?php

namespace Tests\Feature;

use App\Http\Livewire\ConfiguratorForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class YamlFormTest extends TestCase
{

    /**
     * @description Loading form page.
     *
     * @return void
     */
    public function test_load_form()
    {
        $response = $this->get('/');
        //$response->assertStatus(200);
        dd($response->getContent());
    }


    /**
     * Form Test using pull request option.
     * @return void
     */
    public function test_form_submit_onpullrequest()
    {
        Livewire::test(ConfiguratorForm::class)
            ->set("name","Test")
            ->set("onPullrequest", true)
            ->call('submitForm')
            ->assertHasNoErrors('yaml');
    }

    /**
     * Form Test: using manual triggering option.
     *
     * @return void
     */
    public function test_form_submit_onmanual()
    {
        Livewire::test(ConfiguratorForm::class)
            ->set("name","Test")
            ->set("manualTrigger", true)
            ->set("onPush", false)
            ->call('submitForm')
            ->assertHasNoErrors('yaml');
    }

}
