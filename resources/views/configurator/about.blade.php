<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config("app.name") }} - {{ $title }}</title>
  <livewire:styles />
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

  <!-- This example requires Tailwind CSS v2.0+ -->
  <div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="lg:text-center">
        <img class="w-48  " src="{{ asset('ghygen-title.png') }}">
        <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">GHYGEN</h2>
        <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
          {{ $title }}
        </p>
        <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
          {{ $description }}
        </p>
      </div>

      <div class="mt-10">
        <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
          <div class="flex">
            <div class="flex-shrink-0">
              <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                <!-- Heroicon name: outline/database -->
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                </svg>
              </div>
            </div>
            <div class="ml-4">
              <dt class="text-lg leading-6 font-medium text-gray-900">
                MySql Service
              </dt>
              <dd class="mt-2 text-base text-gray-500">
                Setup Mysql Service, for launching tests. It allows execute migrations and configure environment parameters.
              </dd>
            </div>
          </div>

          <div class="flex">
            <div class="flex-shrink-0">
              <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                <!-- Heroicon name: outline/sparkels -->
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
              </div>
            </div>
            <div class="ml-4">
              <dt class="text-lg leading-6 font-medium text-gray-900">
                Triggering Events
              </dt>
              <dd class="mt-2 text-base text-gray-500">
                Select triggering events: manually or automatically, when the developer push the code on a specific branch, or a developer create a new Pull Request.
              </dd>
            </div>
          </div>

          <div class="flex">
            <div class="flex-shrink-0">
              <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                <!-- Heroicon name: outline/lightning-bolt -->
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                </svg>
              </div>
            </div>
            <div class="ml-4">
              <dt class="text-lg leading-6 font-medium text-gray-900">
                Matrix versions
              </dt>
              <dd class="mt-2 text-base text-gray-500">
                Select multiple PHP versions (8.3, 8.2, 8.1, 8.0, 7.4, 7.3), multiple Laravel versions (11, 10, 9, 8, 7, 6).
              </dd>
            </div>
          </div>

          <div class="flex">
            <div class="flex-shrink-0">
              <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                <!-- Heroicon name: outline/badge-check -->

                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                </svg>
              </div>
            </div>
            <div class="ml-4">
              <dt class="text-lg leading-6 font-medium text-gray-900">
                Quality Check
              </dt>
              <dd class="mt-2 text-base text-gray-500">
                Execute PHPunit/PestPHP tests, Code sniffer (PSR12) or Pint (PER / PSR12), Static code analysis.
              </dd>
            </div>
          </div>
        </dl>
      </div>
    </div>
  </div>



  <div>

    <main>
      <div class="max-w-7xl mx-auto py-1 sm:px-6 lg:px-8">
        <div class="">
          <article class="prose prose-xl">


            <p><strong>Ghygen</strong> allows you creating your <strong>Yaml</strong> file for <strong>GitHub Actions</strong>, for Laravel/PHP web application, so you can:</p>
            <ul>
              <li>select triggering events: manually or automatically, when the developer <em>push</em> the code on a specific branch, or a developer create a new <em>Pull Request</em>;</li>
              <li>select branches;</li>
              <li>enable caching for all vendors;</li>
              <li>enable <strong>caching</strong> PHP packages;</li>
              <li>select <strong>multiple</strong> PHP versions (8.3, 8.2, 8.1, 8.0, 7.4, 7.3);</li>
              <li>select <strong>multiple Laravel</strong> versions (11, 10, 9, 8, 7, 6), useful if you are developing a Laravel Package and you want to test it with multiple Laravel version;</li>
              <li>select <strong>Node</strong> version for NPM (npm run something);</li>
              <li>caching node packages;</li>
              <li>setup <strong>Mysql</strong> service;</li>
              <li>run migrations;</li>
              <li><strong>execute tests</strong> via phpunit;</li>
              <li>static <strong>code analysis</strong>;</li>
              <li>code sniffer (via phpcs for <strong>PSR12</strong> compatibility or Laravel Pint);</li>
              <li><strong>validate Yaml</strong> file;</li>
              <li>execute <strong>Browser Test</strong> via Laravel Dusk.</li>
            </ul>
            <p>If you want to download it you can clone the repository https://github.com/Hi-Folks/gh-actions-yaml-generator</p>
          </article>
        </div>
      </div>
    </main>
    <x-footer></x-footer>
  </div>
  <livewire:scripts />


</body>

</html>
