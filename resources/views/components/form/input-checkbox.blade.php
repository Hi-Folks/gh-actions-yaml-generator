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
    <div class="flex items-center label">
      <label class="cursor-pointer label" for="{{ $id ?? $name }}" >
        <input wire:model.blur="{{ $model }}" id="{{ $id ?? $name }}" value="{{ $value }}" name="{{ $name }}" type="checkbox"  class="checkbox checkbox-accent">
        <span class="mx-1 label-text">{{ $label }}</span>
      </label>
    </div>
</div>
<p class=" text-base-content text-opacity-40">{{ $help}}</p>





