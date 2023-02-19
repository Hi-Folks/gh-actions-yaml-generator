<?php

use function Pest\Laravel\get;

it('loads page', function (string $route) {
    get(route($route))->assertOK();
})->with(['index', 'about', 'dashboard']);

it('can properly loads the index form', function () {
    get(route('index'))
        ->AssertSee('Select a workflow template')
        ->AssertSee('On - GitHub event that triggers the workflow')
        ->AssertSee('Select a workflow template')
        ->assertOK();
});

test('not found page')
    ->get('/it-does-not-exist')
    ->assertSee('Not Found')
    ->AssertNotFound();
