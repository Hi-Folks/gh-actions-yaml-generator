@props([
'title' => '',
'description' => '',
'icon' => 'laravel'
]
)

<div  class="bg-blue-100 p-4 bg-opacity-80 rounded-3xl grid grid-cols-6 space-x-12 items-center shadow-md hover:shadow-xl">
  <div>
    <x-dynamic-component component="icons.{{ $icon }}" class="mt-4" />

  </div>
  <div  class="col-span-5">
    <p class="text-2xl font-bold text-gray-900">{{ $title }}</p>
    <p class="h-16 text-gray-500 text-sm mb-3">{{ $description }}</p>
  </div>
  <div class="col-span-6">
    {{ $slot }}
  </div>
</div>

