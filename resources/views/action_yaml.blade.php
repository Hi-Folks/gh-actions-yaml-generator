name: {{ $name }}
@include('yaml.on')

jobs:
  laravel-tests:
    runs-on: ubuntu-latest
@include('yaml.mysql_service')

    strategy:
      matrix:
        operating-system: [ubuntu-latest]
        php-versions: {!! $stepPhpVersionsString !!}
        dependency-stability: [ prefer-stable ]
@if ($matrixLaravel)

        laravel: {!! $matrixLaravelVersionsString !!}
        include:
@foreach($matrixLaravelVersions as $lv)
          - laravel:  {{ $lv }}
            testbench: {{ $matrixTestbenchDependencies[$lv] }}
@endforeach
@endif

    name: P$@{{ matrix.php-versions }} - L$@{{ matrix.laravel }} - $@{{ matrix.dependency-stability }} - $@{{ matrix.operating-system}}

    steps:
    - uses: actions/checkout@v2
@if ($stepNodejs)
    - name: Setup Node.js
      uses: actions/setup-node@v1
      with:
        node-version: '{{ $stepNodejsVersion }}'
@if ($stepCacheNpmModules)
    - name: Cache node_modules directory
      uses: actions/cache@v2
      id: node_modules-cache
      with:
        path: node_modules
        key: $@{{ runner.OS }}-build-$@{{ hashFiles('**/package-lock.json') }}
    - name: Install NPM packages
      if: steps.node_modules-cache.outputs.cache-hit != 'true'
      run: npm ci
@else
    - name: Install NPM packages
      run: npm ci
@endif
    - name: Build frontend
      run: npm run development
@endif
    - name: Install PHP versions
      uses: shivammathur/setup-php@v2
      with:
        php-version: $@{{ matrix.php-versions }}
@if ($stepCachePackages)
    - name: Get Composer Cache Directory 2
      id: composer-cache
      run: |
        echo "::set-output name=dir::$(composer config cache-files-dir)"
    - uses: actions/cache@v2
      id: actions-cache
      with:
        path: $@{{ steps.composer-cache.outputs.dir }}
        key: $@{{ runner.os }}-composer-$@{{ hashFiles('**/composer.lock') }}
        restore-keys: |
          $@{{ runner.os }}-composer-
@endif
@if ($stepCacheVendors)
    - name: Cache PHP dependencies
      uses: actions/cache@v2
      id: vendor-cache
      with:
        path: vendor
        key: $@{{ runner.OS }}-build-$@{{ hashFiles('**/composer.lock') }}
@endif
    - name: Copy .env
      run: php -r "file_exists('.env') || copy('{{ $stepEnvTemplateFile }}', '.env');"
@if ($matrixLaravel)
    - name: Install Laravel Dependencies
      run: |
        composer require "laravel/framework:$@{{ matrix.laravel }}" "orchestra/testbench:$@{{ matrix.testbench }}" --no-interaction --no-update
        composer update --$@{{ matrix.dependency-stability }} --prefer-dist --no-interaction --no-suggest
@else
    - name: Install Dependencies
      if: steps.vendor-cache.outputs.cache-hit != 'true'
      run: composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist
@endif
@if ($stepNodejs)
    - name: Setup Node.js
      uses: actions/setup-node@v1
      with:
        node-version: '{{ $stepNodejsVersion }}'
@endif
    - name: Generate key
      run: php artisan key:generate
@if ($stepFixStoragePermissions)
    - name: Directory Permissions
      run: chmod -R 777 storage bootstrap/cache
@endif
@if ($stepRunMigrations)
    - name: Run Migrations
@include('yaml.set_env')

      run: php artisan migrate
@endif
    - name: Create Database
      run: |
        mkdir -p database
        touch database/database.sqlite

    - name: Show Laravel versions
      run: php artisan --version

@if ($stepExecutePhpunit)
    - name: Execute tests (Unit and Feature tests) via PHPUnit
@include('yaml.set_env')

      run: vendor/bin/phpunit --testdox
@endif

@if ($stepExecuteCodeSniffer)
    - name: Execute Code Sniffer via phpcs
      run: |
        composer require --dev squizlabs/php_codesniffer
        vendor/bin/phpcs --standard=PSR12 app
@endif

@if ($stepExecuteStaticAnalysis)
    - name: Execute Code Static Analysis (PHP Stan + Larastan)
      run: |
        composer require --dev nunomaduro/larastan
        vendor/bin/phpstan analyse app -c ./vendor/nunomaduro/larastan/extension.neon  --level=4 --no-progress
@endif




@if ($stepDusk)
    - name: Browser Test - upgrade and start Chrome Driver
      run: |
        composer require --dev laravel/dusk
        php artisan dusk:chrome-driver --detect
        ./vendor/laravel/dusk/bin/chromedriver-linux > /dev/null 2>&1 &
    - name: Run Dusk Tests
      run: |
        php artisan serve > /dev/null 2>&1 &
        chmod -R 0755 vendor/laravel/dusk/bin/
@if ( $mysqlService )
        php artisan migrate
@endif
        php artisan dusk
@include('yaml.set_env')
@endif
