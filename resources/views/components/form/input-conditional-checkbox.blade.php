@props([
    'label' => 'Field',
    'id',
    'name',
    'value' => '',
    'help' => '',
    'model' => '',
])

<div x-data="{ show{{ $id }}: @entangle($attributes->wire('model')) }">
    <div class="pl-3 pb-2 mt-2 space-y-4">
        <x-form.input-checkbox
            model="{{ $model }}"
            name="{{ $name }}"
            label="{{ $label }}"
            value="{{ $value }}"
            help="{{ $help }}"
            >
        </x-form.input-checkbox>
    </div>
    <div x-show="show{{ $id }}">
        {{ $slot }}

    </div>
</div>
