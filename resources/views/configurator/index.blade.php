<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config("app.name") }} - {{ $title }}</title>
  <livewire:styles/>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="description" content="{{ $title }} {{ $description }}" />
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">

  <script src="{{ mix('js/app.js') }}" defer></script>
  <meta property="og:url" content="{{ config('app.url') }}"/>
  <meta property="og:type" content="website"/>
  <meta property="og:title" content="{{ config("app.name") }} - {{ $title }}"/>
  <meta property="og:description" content="{{ $description }}"/>
  <meta property="og:image"
        content="{{ asset('ghygen-title.png') }}"/>

</head>
<body class="antialiased">
<div>
  <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 ">
      <img class="w-48  " src="{{ asset('ghygen-title.png') }}">
      <h1 class="pl-20 text-gray-800">
        {{ $title }}
      </h1>
      <p class="pl-20 text-gray-500 text-sm">
        {{ $description }}
      </p>

    </div>
  </header>
  <main>
    <div class="max-w-7xl mx-auto py-1 sm:px-6 lg:px-8">
      <livewire:configurator-form/>
    </div>
  </main>
  <x-footer></x-footer>
</div>
<livewire:scripts/>


</body>
</html>
