@props([
'url' => '#',
]
)
<a class="text-indigo-600 hover:text-indigo-900" href="{{ $url }}">{{ $slot }}</a>
