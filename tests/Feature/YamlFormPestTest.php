<?php

// Temporary for Live
use App\Http\Livewire\ConfiguratorForm;

uses(Illuminate\Foundation\Testing\DatabaseMigrations::class);

test('form submit on pull request')->livewire(ConfiguratorForm::class)
            ->set("name", "Test")
            ->set("onPullrequest", true)
            ->call('submitForm')
            ->assertHasNoErrors('yaml');
