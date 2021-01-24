<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config("app.name") }} - GitHub Actions Yaml Generator</title>
  <livewire:styles/>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <link href="{{ mix('css/app.css') }}" rel="stylesheet">

  <script src="{{ mix('js/app.js') }}" defer></script>
  <meta property="og:url" content="{{ config('app.url') }}"/>
  <meta property="og:type" content="website"/>
  <meta property="og:title" content="{{ config("app.name") }} - GitHub Actions Yaml Generator"/>
  <meta property="og:description" content="Create your GitHub Actions workflow for Laravel applications."/>
  <meta property="og:image"
        content="https://raw.githubusercontent.com/Hi-Folks/gh-actions-yaml-generator/main/ghygen-github-actions-yaml-generator-laravel.png"/>

</head>
<body class="antialiased">
<div>
  <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 ">
      <img class="w-48  " src="ghygen-title.png">
      <h1 class="pl-20 text-gray-500">
        Github Actions Yaml Generator for Laravel
      </h1>
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
