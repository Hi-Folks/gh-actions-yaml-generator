<?php

use function Pest\Livewire\livewire;

test('form submit on pull request')
    ->livewire(ConfiguratorForm())
    ->set('name', 'Test')
    ->set('onPullrequest', true)
    ->call('submitForm')
    ->assertHasNoErrors('yaml');

test('form submit empty name')
    ->livewire(ConfiguratorForm())
    ->set('name', '')
    ->set('onPullrequest', true)
    ->call('submitForm')
    ->assertHasErrors('name');

test('form_submit on manual')
    ->livewire(ConfiguratorForm())
    ->set('name', 'Test')
    ->set('manualTrigger', true)
    ->set('onPush', false)
    ->call('submitForm')
    ->assertHasNoErrors('yaml');

test('form submit on events', function () {
    livewire(ConfiguratorForm())
        ->set('name', 'Test')
        ->set('manualTrigger', false)
        ->set('onPush', false)
        ->set('onPullrequest', false)
        ->call('submitForm')
        ->assertHasErrors('onEvents');

    livewire(ConfiguratorForm())
        ->set('name', 'Test')
        ->set('manualTrigger', false)
        ->set('onPush', true)
        ->set('onPullrequest', false)
        ->call('submitForm')
        ->assertHasNoErrors('onEvents');

    livewire(ConfiguratorForm())
        ->set('name', 'Test')
        ->set('manualTrigger', true)
        ->set('onPush', true)
        ->set('onPullrequest', false)
        ->call('submitForm')
        ->assertHasNoErrors('onEvents');

    livewire(ConfiguratorForm())
        ->set('name', 'Test')
        ->set('manualTrigger', true)
        ->set('onPush', true)
        ->set('onPullrequest', true)
        ->call('submitForm')
        ->assertHasNoErrors('onEvents');

    $hints = [
        "You selected all 3 options: 'on Push', 'on Pull Request', and 'Manual Trigger'. I suggest you to select 'Manual Trigger' OR 'on push / on pull request'.",

        "I selected automatically a 'Manual Trigger' for you.",
    ];

    livewire(ConfiguratorForm())
        ->set('name', 'Test')
        ->set('manualTrigger', true)
        ->set('onPush', true)
        ->set('onPullrequest', true)
        ->call('submitForm')
        ->assertSet('hints', $hints);

    livewire(ConfiguratorForm())
        ->set('name', 'Test')
        ->set('manualTrigger', false)
        ->set('onPush', true)
        ->set('onPullrequest', true)
        ->call('submitForm')
        ->assertSet('hints', []);
});

test('form submit tests')
    ->livewire(ConfiguratorForm())
    ->set('name', 'Test')
    ->set('manualTrigger', false)
    ->set('onPush', true)
    ->call('submitForm')
    ->assertSee(readAsset('on-push-branches.yaml'))
    ->assertSee(readAsset('mysql-service.yaml'));

test('form submit tests with mySQL')
    ->livewire(ConfiguratorForm())
    ->set('name', 'Test')
    ->set('manualTrigger', false)
    ->set('onPush', true)
    ->set('databaseType', 'mysql')
    ->call('submitForm')
    ->assertSee(readAsset('mysql-service.yaml'));

test('form_submit_test_matrix')
    ->livewire(ConfiguratorForm())
    ->set('name', 'Test')
    ->set('manualTrigger', false)
    ->set('onPush', true)
    ->set('matrixLaravel', true)
    ->set('matrixLaravelVersions', ['8.*' => '8.*'])
    ->set('stepPhpVersions', ['8.0', '7.4'])
    ->call('submitForm')
    ->assertSee(readAsset('on-push-branches.yaml'))
    ->assertSee(readAsset('mysql-service.yaml'))
    ->assertSee(readAsset('strategy-php-8-74.yaml'));

test('dependency stability level: "prefer-stable"')
    ->livewire(ConfiguratorForm())
    ->set('name', 'Test Dependency Level')
    ->set('dependencyStability', ['prefer-stable'])
    ->call('submitForm')
    ->assertSee("dependency-stability: [ 'prefer-stable' ]");

test('dependency stability level: "prefer-lowest" and "prefer-stable"')
    ->livewire(ConfiguratorForm())
    ->set('name', 'Test Dependency Level')
    ->set('dependencyStability', ['prefer-lowest', 'prefer-stable'])
    ->call('submitForm')
    ->assertSee("dependency-stability: [ 'prefer-lowest','prefer-stable' ]");

test('without dependency stability level:')
    ->livewire(ConfiguratorForm())
    ->set('name', 'Test Without Dependency Level')
    ->call('submitForm')
    ->assertSee("dependency-stability: [ 'prefer-none' ]");

test('form_codequality_tests', function () {
    livewire(ConfiguratorForm())
        ->set('name', 'Test')
        ->set('stepExecuteStaticAnalysis', true)
        ->set('stepInstallStaticAnalysis', false)
        ->call('submitForm')
        ->assertSee(readAsset('phpstan-noinstall.yaml'));

    livewire(ConfiguratorForm())
        ->set('name', 'Test')
        ->set('stepExecuteStaticAnalysis', true)
        ->set('stepInstallStaticAnalysis', true)
        ->call('submitForm')
        ->assertSee(readAsset('phpstan-install.yaml'));

    livewire(ConfiguratorForm())
        ->set('name', 'Test')
        ->set('stepExecuteStaticAnalysis', true)
        ->set('stepInstallStaticAnalysis', true)
        ->set('stepToolStaticAnalysis', 'larastan')
        ->call('submitForm')
        ->assertSee(readAsset('phpstan-install.yaml'));

    livewire(ConfiguratorForm())
        ->set('name', 'Test')
        ->set('stepExecuteStaticAnalysis', true)
        ->set('stepInstallStaticAnalysis', true)
        ->set('stepToolStaticAnalysis', 'phpstan')
        ->call('submitForm')
        ->assertDontSee('composer require --dev nunomaduro/larastan')
        ->assertSee('composer require --dev phpstan/phpstan');

    livewire(ConfiguratorForm())
        ->set('name', 'Test')
        ->set('stepExecuteStaticAnalysis', true)
        ->set('stepInstallStaticAnalysis', false)
        ->call('submitForm')
        ->assertDontSee('composer require --dev nunomaduro/larastan')
        ->assertDontSee('composer require --dev phpstan/phpstan');

    livewire(ConfiguratorForm())
        ->set('name', 'Test')
        ->set('stepExecuteStaticAnalysis', true)
        ->set('stepInstallStaticAnalysis', false)
        ->set('stepPhpstanUseNeon', true)
        ->call('submitForm')
        ->assertSee(readAsset('phpstan-conffile.yaml'));

    livewire(ConfiguratorForm())
        ->set('name', 'Test')
        ->set('stepExecuteCodeSniffer', true)
        ->set('stepInstallCodeSniffer', false)
        ->call('submitForm')
        ->assertSee(readAsset('phpcs-noinstall.yaml'));

    livewire(ConfiguratorForm())
        ->set('name', 'Test')
        ->set('stepExecuteCodeSniffer', true)
        ->set('stepInstallCodeSniffer', true)
        ->call('submitForm')
        ->assertSee(readAsset('phpcs-install.yaml'));

    livewire(ConfiguratorForm())
        ->set('name', 'Test')
        ->set('stepExecuteCodeSniffer', true)
        ->set('stepDirCodeSniffer', 'src')
        ->set('stepInstallCodeSniffer', true)
        ->call('submitForm')
        ->assertSee(readAsset('phpcs-srcdir.yaml'));
});

test('form_keygenerate_tests', function () {
    livewire(ConfiguratorForm())
        ->set('name', 'Test')
        ->set('stepGenerateKey', true)
        ->call('submitForm')
        ->assertSee(readAsset('generate-key.yaml'));

    livewire(ConfiguratorForm())
        ->set('name', 'Test')
        ->set('stepGenerateKey', false)
        ->call('submitForm')
        ->assertDontSee('run: php artisan key:generate');
});

test('form copy env')
    ->livewire(ConfiguratorForm())
    ->set('name', 'Test')
    ->set('stepCopyEnvTemplateFile', true)
    ->call('submitForm')
    ->assertSee(readAsset('copy-env.yaml'));

test('form copy env from ci')
    ->livewire(ConfiguratorForm())
    ->set('name', 'Test')
    ->set('stepCopyEnvTemplateFile', true)
    ->set('stepEnvTemplateFile', '.env.ci')
    ->call('submitForm')
    ->assertSee(str_replace('.env.example', '.env.ci', readAsset('copy-env.yaml')));

test('form copy env template')
    ->livewire(ConfiguratorForm())
    ->set('name', 'Test')
    ->set('stepCopyEnvTemplateFile', false)
    ->call('submitForm')
    ->assertDontSee('- name: Copy .env');

test('form branches wildcard')
    ->livewire(ConfiguratorForm())
    ->set('name', 'Test Wildcard')
    ->set('manualTrigger', false)
    ->set('onPush', true)
    ->set('onPushBranches', '*')
    ->call('submitForm')
    ->assertSee(readAsset('on-push-branches-wildcard.yaml'));
