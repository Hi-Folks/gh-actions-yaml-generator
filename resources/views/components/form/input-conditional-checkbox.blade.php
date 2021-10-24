@props([
    'label' => 'Field',
    'id',
    'name',
    'value' => '',
    'help' => '',
    'model' => '',
])

<div class="pl-3 pb-2 mt-2 "  x-data="{ show{{ $id }}: @entangle($attributes->wire('model')) }">
    <!-- div class="pl-3 pb-2 mt-2 space-y-4"-->
    <div>
        <x-form.input-checkbox
            model="{{ $model }}"
            name="{{ $name }}"
            label="{{ $label }}"
            value="{{ $value }}"
            help="{{ $help }}"
            >
        </x-form.input-checkbox>
    </div>

    <div class="pl-5 pt-2 pb-2 pr-5 bg-blue-50 rounded-2xl" x-show="show{{ $id }}">
        {{ $slot }}

    </div>
</div>
