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

    steps:
    - uses: actions/checkout@v2

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
    - name: Install Dependencies
      if: steps.vendor-cache.outputs.cache-hit != 'true'
      run: composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist

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

    - name: Create Database
      run: |
        mkdir -p database
        touch database/database.sqlite
    - name: Execute tests (Unit and Feature tests) via PHPUnit
      env:
        DB_CONNECTION: sqlite
        DB_DATABASE: database/database.sqlite
      run: vendor/bin/phpunit --testdox
