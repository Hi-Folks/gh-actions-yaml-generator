@props([
    'label' => 'Field',
    'id',
    'name',
    'value' => '',
    'help' => '',
    'model' => '',
    ]
)
<div class="px-2">
<div class="form-control">
  <label for="{{ $id ?? $name }}" class="label">
    <span class="label-text">{{ $label }}</span>
  </label>
  <input wire:model.lazy="{{ $model }}" type="text" name="{{ $name }}" id="{{ $id ?? $name }}"
         class="input input-bordered">
  @if ($help !== "")
    <p class="mt-2 text-sm text-gray-500">
      {{ $help }}
    </p>
  @endif

</div>
</div>
