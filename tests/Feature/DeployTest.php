<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\ConfiguratorForm;

class DeployTest extends TestCase
{

    use DatabaseMigrations;

    const DIR_MOCK ="tests/Feature/mock-asserts/";

    public function testPloiDeploy(): void
    {
        Livewire::test(ConfiguratorForm::class)
            ->set("name","Test")
            ->set("stepDeployType","ploi")
            ->set("stepDeployWebhookType","secret")
            ->call('submitForm')
            ->assertSee(file_get_contents(base_path(self::DIR_MOCK."ploi-deploy.yaml")));

    }
    public function testVaporDeploy(): void
    {
        Livewire::test(ConfiguratorForm::class)
            ->set("name","Test")
            ->set("stepDeployType","vapor")

            ->call('submitForm')
            ->assertSee(file_get_contents(base_path(self::DIR_MOCK."vapor-deploy.yaml")));

    }

}
