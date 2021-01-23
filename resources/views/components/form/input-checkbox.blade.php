@props([
    'label' => 'Field',
    'id',
    'name',
    'value' => '',
    'help' => '',
    'model' => '',
    ]
)

<div class="flex items-start">
    <div class="flex items-center">
    <input  wire:model.lazy="{{ $model }}" id="{{ $id ?? $name }}" value="{{ $value }}" name="{{ $name }}" type="checkbox" class="focus:ring-indigo-500 h-5 w-5 text-indigo-600 border-gray-300 rounded">
    </div>
    <div class="ml-3 text-base">
    <label for="{{ $id ?? $name }}" class="font-medium text-gray-700">{{ $label }}</label>
    <p class="text-gray-500">{{ $help}}</p>
    </div>
</div>
