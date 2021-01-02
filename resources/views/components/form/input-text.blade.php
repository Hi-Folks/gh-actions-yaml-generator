@props([
    'label' => 'Field',
    'id',
    'name',
    'value' => '',
    'help' => '',
    'model' => '',
    ]
)

<div class="pl-2">
    <label for="{{ $id ?? $name }}" class="block  font-medium text-gray-700">{{ $label }}</label>
    <input wire:model.lazy="{{ $model }}" type="text" name="{{ $name }}" id="{{ $id ?? $name }}"

    class="text-xl    mt-1 focus:ring-indigo-500 focus:bg-indigo-100 focus:border-indigo-500 block w-full shadow-sm  border-gray-300 rounded-md">
    @if ($help !== "")
    <p class="mt-2 text-sm text-gray-500">
    {{ $help }}
    </p>
    @endif
</div>
