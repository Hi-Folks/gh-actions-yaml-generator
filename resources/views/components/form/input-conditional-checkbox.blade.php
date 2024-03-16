@props([
    'label' => 'Field',
    'id',
    'name',
    'value' => '',
    'help' => '',
    'model' => '',
])

<div class="card bordered shadow pl-3 pb-2 m-2 space-y-4  "  x-data="{ show{{ $id }}: @entangle($attributes->wire('model')).live }">
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

    <div class="" x-show="show{{ $id }}">
        {{ $slot }}

    </div>
</div>
