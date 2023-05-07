<?php

use App\Http\Livewire\ConfiguratorForm;

uses(
    Tests\TestCase::class,
    Illuminate\Foundation\Testing\DatabaseMigrations::class,
)->in('Feature');

/**
 *  ConfiguratorForm class name
 */
function ConfiguratorForm(): string
{
    return  ConfiguratorForm::class;
}

/**
 * Reads assets file content
 */
function readAsset(string $filename): string
{
    return file_get_contents(__DIR__.'/Feature/mock-asserts/'.$filename);
}
