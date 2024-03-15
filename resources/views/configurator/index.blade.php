<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config("app.name") }} - {{ $title }}</title>
    @livewireStyles
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="{{ $title }} {{ $description }}" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <meta property="og:url" content="{{ config('app.url') }}" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="{{ config("app.name") }} - {{ $title }}" />
  <meta property="og:description" content="{{ $description }}" />
  <meta property="og:image" content="{{ asset('ghygen-github-actions-yaml-generator-laravel.png') }}" />
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Ghygen">
  <meta name="twitter:description" content="Ghygen is a GitHub Actions configurator for your Laravel/PHP project. Setup Database Service, use multiple PHP version, use multiple Laravel versions, build frontend, cache packages, execute tests">
  <meta name="twitter:image" content="{{ asset('ghygen-github-actions-yaml-generator-laravel.png') }}">

</head>

<body class="antialiased">
  <div>


    <main>
      <div class="max-w-7xl mx-auto py-1 sm:px-6 lg:px-8">
        <x-daisyui.header imageUrl="{{ asset('ghygen-square.png') }}" title="Ghygen is a GitHub Actions configurator for your Laravel/PHP project." description="Setup Database Service, use multiple PHP version, use multiple Laravel versions, build frontend, cache packages, execute Browser, Functional, and Unit tests…"></x-daisyui.header>
        <livewire:configurator-form />
      </div>
    </main>
    <x-footer></x-footer>
  </div>
  @livewireScripts


</body>

</html>
