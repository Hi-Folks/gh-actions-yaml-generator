@props([
    'type' => '',
    'id' => '',
    'onClick' => '',
    'classType' => 'primary'
    ]
)

<button
@if ( $id != '' )
id="{{ $id }}"
@endif
  @if ($onClick != '')
    wire:click="{{ $onClick }}"
  @endif
@if ($type !== '')
type="{{ $type }}"
  @endif
  {{ $attributes->whereStartsWith('data-') }}
{{ $attributes->merge(['class' => 'btn btn-outline   ' . $type . '']) }}
>{{ $slot }}</button>
