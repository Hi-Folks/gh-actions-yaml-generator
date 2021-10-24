@props([
    'imageUrl' => '',
    'title' => '',
    'description' => '',
    ]
)
  <div class="card shadow-lg compact side bg-base-100">
    <div class="flex-row items-center space-x-4 card-body">
      <div>
        <div class="mx-auto  avatar">
          <div class="rounded-full w-14 h-14 shadow">
            <img width="32" src="{{ $imageUrl }}">
          </div>
        </div>
      </div>
      <div>
        <h2 class="card-title">{{ $title }}</h2>
        <p class="text-base-content text-opacity-40">{{ $description }}</p>
      </div>
    </div>
  </div>
