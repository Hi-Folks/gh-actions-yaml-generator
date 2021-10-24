@props([
    'type' => 'secondary',
    'id' => '',
    'onClick' => '',
    ]
)

<button
@if ( $id != '' )
id="{{ $id }}"
@endif
  @if ($onClick != '')
    wire:click="{{ $onClick }}"
  @endif
  {{ $attributes->whereStartsWith('data-') }}
{{ $attributes->merge(['class' => 'btn btn-outline   ' . $type . '']) }}
>{{ $slot }}</button> 
