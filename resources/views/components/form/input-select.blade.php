@props([
'label' => 'Field',
'id',
'name',
'value' => '',
'list' => [],
'help' => '',
'model' => '',
'multiselect' => 0,
'onChange' => ''
]
)



<div class="p-4 form-control w-full max-w-xs">
  <label for="{{ $id ?? $name }}" class="label">
    <span class="label-text">{{ $label }}</span>
    <!--a href="#" class="label-text-alt">
      Pick wisely
    </a-->
  </label>

  <select @change="{{ $onChange }}" wire:model.live.blur="{{ $model }}" class="{{ $multiselect ? 'form-multiselect' : 'form-select' }} select select-bordered w-full max-w-xs" {{ $multiselect ? 'multiple' : '' }} name="{{ $name }}" id="{{ $id ?? $name }}">
    @foreach( $list as $key=> $item)
    <option value="{{ $key }}">{{  $item }}</option>
    @endforeach
  </select>
  @if ($help !== "")
    <p class="mt-2 text-sm text-gray-500">
      {{ $help }}
    </p>
  @endif
</div>
