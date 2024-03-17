<?php

test('Ploi Deploy')
    ->livewire(ConfiguratorForm())
    ->set('name', 'Test')
    ->set('stepDeployType', 'ploi')
    ->set('stepDeployWebhookType', 'secret')
    ->call('submitForm')
    ->assertSee(readAsset('ploi-deploy.yaml'));

test('Vapor Deploy')
    ->livewire(ConfiguratorForm())
    ->set('name', 'Test')
    ->set('stepDeployType', 'vapor')
    ->call('submitForm')
    ->assertSee(readAsset('vapor-deploy.yaml'));

test('Forge Deploy')
    ->livewire(ConfiguratorForm())
    ->set('name', 'Test')
    ->set('stepDeployType', 'forge')
    ->set('stepDeployForgeServerName', 'servername')
    ->set('stepDeployForgeSiteName', 'sitename')
    ->call('submitForm')
    ->assertSee(readAsset('forge-deploy.yaml'));
