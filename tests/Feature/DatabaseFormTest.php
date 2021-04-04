<?php

namespace Tests\Feature;

use App\Http\Livewire\ConfiguratorForm;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DatabaseFormTest extends TestCase
{
    use DatabaseMigrations;

    const DIR_MOCK ="tests/Feature/mock-asserts/";


    public function test_databasedefault()
    {
        Livewire::test(ConfiguratorForm::class)
            ->set("name","Test")
            ->call('submitForm')
            ->assertSee(file_get_contents(base_path(self::DIR_MOCK."on-push-branches.yaml")))
            ->assertSee(file_get_contents(base_path(self::DIR_MOCK."mysql-service.yaml")));
    }


    public function test_databasedefault_hintsformigration()
    {
        Livewire::test(ConfiguratorForm::class)
            ->set("name","Test")
            ->set("stepRunMigrations", false)
            ->call('submitForm')
            ->assertSee(file_get_contents(base_path(self::DIR_MOCK."on-push-branches.yaml")))
            ->assertSee(file_get_contents(base_path(self::DIR_MOCK."mysql-service.yaml")))
            ->assertCount("hints", 1);
    }

    /**
     * Testing with no database and no migrations.
     * @return void
     */
    public function test_nodatabase()
    {
        Livewire::test(ConfiguratorForm::class)
            ->set("name","Test No Database")
            ->set("onPullrequest", true)
            ->set("databaseType", "none")
            ->set("stepRunMigrations", false)
            ->call('submitForm')
            ->assertHasNoErrors('yaml')
            ->assertSet('hints', [])
            ->assertDontSee("image: mysql:")
            ->assertDontSee("DB_CONNECTION: sqlite");
    }

    /**
     * Testing with no database and migrations, it generates hint.
     * @return void
     */
    public function test_nodatabase_withmigration()
    {
        Livewire::test(ConfiguratorForm::class)
            ->set("name","Test No Database")
            ->set("onPullrequest", true)
            ->set("databaseType", "none")
            ->call('submitForm')
            ->assertHasNoErrors('yaml')
            ->assertCount('hints', 1)
            ->assertDontSee("image: mysql:");
    }

    /**
     * Testing with sqlite database and migrations
     * @return void
     */
    public function test_sqlite_withmigration()
    {
        Livewire::test(ConfiguratorForm::class)
            ->set("name","Test No Database")
            ->set("onPullrequest", true)
            ->set("databaseType", "sqlite")
            ->call('submitForm')
            ->assertHasNoErrors('yaml')
            ->assertCount('hints', 0)
            ->assertSee(file_get_contents(base_path(self::DIR_MOCK."sqlite-migration.yaml")))
            ->assertDontSee("image: mysql:");
    }



}
