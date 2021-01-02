@props([
'label' => 'Field',
'id',
'name',
'value' => '',
'list' => [],
'help' => '',
'model' => '',
]
)

<div class="pl-2">
  <label for="{{ $id ?? $name }}" class="block  font-medium text-gray-700">{{ $label }}</label>

  <select wire:model.lazy="{{ $model }}" class="form-multiselect block w-full mt-1 text-xl    mt-1 focus:ring-indigo-500 focus:bg-indigo-100 focus:border-indigo-500 block w-full shadow-sm  border-gray-300 rounded-md" multiple name="{{ $name }}" id="{{ $id ?? $name }}">
    @foreach( $list as $item)
    <option>{{  $item }}</option>
    @endforeach
  </select>
  @if ($help !== "")
    <p class="mt-2 text-sm text-gray-500">
      {{ $help }}
    </p>
  @endif
</div>
