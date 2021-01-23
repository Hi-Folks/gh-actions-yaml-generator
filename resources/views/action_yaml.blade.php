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
@if ($stepNodejs)
    - name: Setup Node.js
      uses: actions/setup-node@v1
      with:
        node-version: '{{ $stepNodejsVersion }}'
@if ($stepCacheNpmModules)
    - name: Cache Node.js modules
      uses: actions/cache@v2
      with:
        # npm cache files are stored in `~/.npm` on Linux/macOS
        path: ~/.npm
        key: $@{{ runner.OS }}-node-$@{{ hashFiles('**/package-lock.json') }}
        restore-keys: |
          $@{{ runner.OS }}-node-
          $@{{ runner.OS }}-
@endif
    - name: Install NPM packages
      run: |
        npm ci
        npm run development
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
@if ($stepRunMigrations)
    - name: Run Migrations
@include('yaml.set_env')

      run: php artisan migrate
@endif
    - name: Create Database
      run: |
        mkdir -p database
        touch database/database.sqlite
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
        php artisan dusk:chrome-driver
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
