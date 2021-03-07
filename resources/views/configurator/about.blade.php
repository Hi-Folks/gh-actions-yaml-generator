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
              Select multiple PHP versions (8.0, 7.4, 7.3), multiple Laravel versions (8, 7, 6).
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
              Execute PHPunit tests,  Code sniffer (PSR12), Static code analysis.
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


          <p><strong>Ghygen</strong> allows you creating your <strong>Yaml</strong> file for <strong>GitHub Actions</strong>, for Laravel/PHP web application,  so you can:</p>
          <ul>
            <li>select triggering events: manually or automatically, when the developer <em>push</em> the code on a specific branch, or a developer create a new <em>Pull Request</em>;</li>
            <li>select branches;</li>
            <li>enable caching for all vendors;</li>
            <li>enable <strong>caching</strong> PHP packages;</li>
            <li>select <strong>multiple</strong> PHP versions (8.0, 7.4, 7.3);</li>
            <li>select <strong>multiple Laravel</strong> versions (8, 7, 6), useful if you are developing a Laravel Package and you want to test it with multiple Laravel version;</li>
            <li>select <strong>Node</strong> version for NPM (npm run something);</li>
            <li>caching node packages;</li>
            <li>setup <strong>Mysql</strong> service;</li>
            <li>run migrations;</li>
            <li><strong>execute tests</strong> via phpunit;</li>
            <li>static <strong>code analysis</strong>;</li>
            <li>code sniffer (via phpcs for <strong>PSR12</strong> compatibility);</li>
            <li><strong>validate Yaml</strong> file;</li>
            <li>execute <strong>Browser Test</strong> via Laravel Dusk.</li>
          </ul>
          <p>This is a Work In Progress, we are adding new features...</p>
          <p>If you want to test and use quickly this tool, I deployed the codebase (main branch) on Digital Ocean Platform:</p>
          <ul>
            <li><a href="https://ghygen.hi-folks.dev/" rel="nofollow">Ghygen Demo</a>.</li>
          </ul>
          <p>If you want to start using it locally you can clone the repo and install it following the instructions below.</p>
          <h2>Install</h2>
          <p>Clone source code, enter the new directory and perform a couple of instructions:</p>
          <div class="highlight highlight-source-shell"><pre>git clone https://github.com/Hi-Folks/gh-actions-yaml-generator.git
cd gh-actions-yaml-generator
cp .env.example .env
composer install
php artisan key:generate
npm i
npm run production</pre></div>
          <p>Then create your database and update the .env file with the right values for DB_* .</p>
          <p>Once your Database is configured you can execute the migrations:</p>
          <div class="highlight highlight-source-shell"><pre>php artisan migrate</pre>
          <p>Start development server</p>
          <div class="highlight highlight-source-shell"><pre>php artisan serve</pre></div>
          <p>Open the browser to the URL: <a href="http://127.0.0.1:8000" rel="nofollow">http://127.0.0.1:8000</a></p>
          <h2>Usage</h2>
          <p>Follow these steps:</p>
          <ul>
            <li>access to the form (by default the URL is <a href="http://127.0.0.1:8000" rel="nofollow">http://127.0.0.1:8000</a> if you run php artisan serve);</li>
            <li>fill the form;</li>
            <li>click on "Generate Yaml File" button.</li>
          </ul>
          <p><img src="https://raw.githubusercontent.com/Hi-Folks/gh-actions-yaml-generator/main/github-actions-generator-laravel.png" alt="github-actions-generator-laravel" title="github-actions-generator-laravel" style="max-width:100%;"></p>
          <p>Next, copy the content of your generated Yaml in a new file in your Laravel project <em>.github/workflows/laravel_workflow.yaml</em> .</p>
          <p>Commit and push the new file.</p>
          <p>If you configured "On - Push" you will see the running Actions in your Actions section of your GitHub project.</p>
        </article>
      </div>
    </div>
  </main>
  <x-footer></x-footer>
</div>
<livewire:scripts/>


</body>
</html>
