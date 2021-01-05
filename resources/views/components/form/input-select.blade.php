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

<div class="pl-2">
  <label for="{{ $id ?? $name }}" class="block  font-medium text-gray-700">{{ $label }}</label>
  <select @change="{{ $onChange }}" wire:model.lazy="{{ $model }}" class="{{ $multiselect ? 'form-multiselect' : 'form-select' }} block w-full mt-1 text-xl    mt-1 focus:ring-indigo-500 focus:bg-indigo-100 focus:border-indigo-500 block w-full shadow-sm  border-gray-300 rounded-md" {{ $multiselect ? 'multiple' : '' }} name="{{ $name }}" id="{{ $id ?? $name }}">
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
