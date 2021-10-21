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
        content="{{ asset('ghygen-github-actions-yaml-generator-laravel.png') }}"/>
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Ghygen">
  <meta name="twitter:description" content="Ghygen is a GitHub Actions configurator for your Laravel/PHP project. Setup Database Service, use multiple PHP version, use multiple Laravel versions, build frontend, cache packages, execute tests">
  <meta name="twitter:image" content="{{ asset('ghygen-github-actions-yaml-generator-laravel.png') }}">

</head>
<body class="antialiased">
<div>
  <header class=" ">
    <div class=" md:flex max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 ">
      <div>
      <img class="object-scale-down h-20 w-full  " alt="Ghygen, GitHub Actions configurator for your Laravel / PHP Application" src="{{ asset('ghygen-title.png') }}">
      </div>
      <div>
        <h1 class="md:pl-20 text-xl text-gray-900">
          {{ $title }}
        </h1>
        <p class="md:pl-24 pt-2 text-gray-600">
          {{ $description }}
        </p>
      </div>
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
