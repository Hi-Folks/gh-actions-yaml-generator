@props([
'align' => 'center',
]
)
<td class="px-6 py-4 text-{{ $align }} whitespace-nowrap">
  {{ $slot }}
</td>
