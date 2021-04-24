@props([
'onClick' => '',
'type' =>''
]
)
<button
  @if ($onClick !== '')
    wire:click="{{ $onClick }}"
  @endif
  @if ($type !== '')
    type="{{ $type }}"
  @endif
  {{ $attributes->whereStartsWith('data-') }}
  {{ $attributes->merge(['class' => 'm-1 uppercase inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500']) }}
        >
  {{ $slot }}
</button>
