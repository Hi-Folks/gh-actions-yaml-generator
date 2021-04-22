@props([
'title' => '',
'description' => '',
'icon' => 'laravel'
]
)

<div  class="bg-blue-100 pt-0 p-4 pt-4 bg-opacity-80 rounded-3xl grid grid-cols-6 space-x-6  shadow-md hover:shadow-xl">
  <div class="pt-4">
    <x-dynamic-component  class="m-1"  component="icons.{{ $icon }}"/>
  </div>
  <div  class="col-span-5">
    <p class="text-2xl font-bold text-gray-900">{{ $title }}</p>
    <p class=" text-gray-500 h-12 text-sm mb-3">{{ $description }}</p>
  </div>
  <div class="col-span-6">
    {{ $slot }}
  </div>
</div>

