<?php

test('database default')
    ->livewire(ConfiguratorForm())
    ->set('name', 'Test')
    ->call('submitForm')
    ->assertSee(readAsset('on-push-branches.yaml'))
    ->assertSee(readAsset('mysql-service.yaml'));

test('database default hints for migration')
    ->livewire(ConfiguratorForm())
    ->set('name', 'Test')
    ->set('stepRunMigrations', false)
    ->call('submitForm')
    ->assertSee(readAsset('on-push-branches.yaml'))
    ->assertSee(readAsset('mysql-service.yaml'))
    ->assertCount('hints', 1);

test('no database and no migrations')
    ->livewire(ConfiguratorForm())
    ->set('name', 'Test No Database')
    ->set('onPullrequest', true)
    ->set('databaseType', 'none')
    ->set('stepRunMigrations', false)
    ->call('submitForm')
    ->assertHasNoErrors('yaml')
    ->assertSet('hints', [])
    ->assertDontSee('image: mysql:')
    ->assertDontSee('DB_CONNECTION: sqlite');

test('generates hint - no database and migrations')
    ->livewire(ConfiguratorForm())
    ->set('name', 'Test No Database')
    ->set('onPullrequest', true)
    ->set('databaseType', 'none')
    ->call('submitForm')
    ->assertHasNoErrors('yaml')
    ->assertCount('hints', 1)
    ->assertDontSee('image: mysql:');

test('with sqlite database and migrations')
    ->livewire(ConfiguratorForm())
    ->set('name', 'Test No Database')
    ->set('onPullrequest', true)
    ->set('databaseType', 'sqlite')
    ->call('submitForm')
    ->assertHasNoErrors('yaml')
    ->assertCount('hints', 0)
    ->assertSee(readAsset('sqlite-migration.yaml'))
    ->assertDontSee('image: mysql:');

test('test postgresql with migration')
    ->livewire(ConfiguratorForm())
    ->set('name', 'Test Postgresql')
    ->set('onPullrequest', true)
    ->set('databaseType', 'postgresql')
    ->call('submitForm')
    ->assertHasNoErrors('yaml')
    ->assertCount('hints', 0)
    ->assertSee(readAsset('postgresql-service.yaml'))
    ->assertDontSee('image: mysql:');

test('postgresql with no migration')
    ->livewire(ConfiguratorForm())
    ->set('name', 'Test Postgresql')
    ->set('onPullrequest', true)
    ->set('databaseType', 'postgresql')
    ->set('stepRunMigrations', false)
    ->call('submitForm')
    ->assertHasNoErrors('yaml')
    ->assertCount('hints', 1)
    ->assertSee(readAsset('postgresql-service.yaml'))
    ->assertDontSee('image: mysql:');
