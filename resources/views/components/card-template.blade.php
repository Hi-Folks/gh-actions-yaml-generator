@props([
'title' => '',
'description' => '',
'icon' => 'laravel'
]
)

<div  class="card shadow-lg compact side bg-base-100 col-span-3  xl:col-span-1">

  <div class=" card-body ">
  <div class="card-body  flex-row items-center space-x-2">
    <div>
      <div class="avatar">
        <div class="w-14 h-14">
          <x-dynamic-component  class="m-1"  component="icons.{{ $icon }}"/>
        </div>
      </div>
    </div>
    <div>
      <h2 class="card-title">{{ $title }}</h2>
      <p class="text-base-content text-opacity-40">{{ $description }}</p>
    </div>

  </div>
  <div class=" justify-end space-x-1 card-actions">
    {{ $slot }}
  </div>
  </div>
</div>

