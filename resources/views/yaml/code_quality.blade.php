# Code quality
@if ($stepExecutePhpunit)
    - name: Execute tests (Unit and Feature tests) via PHPUnit
@include('yaml.set_env')

      run: vendor/bin/phpunit --testdox
@endif

@if ($stepExecuteCodeSniffer)
    - name: Execute Code Sniffer via phpcs
      run: |
@if ($stepInstallCodeSniffer)
        composer require --dev squizlabs/php_codesniffer
@endif
        vendor/bin/phpcs --standard=PSR12 {{ $stepDirCodeSniffer }}
@endif

@if ($stepExecuteStaticAnalysis)
    - name: Execute Code Static Analysis (PHP Stan + Larastan)
      run: |
@if ($stepInstallStaticAnalysis)
        composer require --dev nunomaduro/larastan
@endif
        vendor/bin/phpstan analyse {{ $stepDirStaticAnalysis }} -c ./vendor/nunomaduro/larastan/extension.neon  --level=4 --no-progress
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
@if ( $stepRunMigrations )
        php artisan migrate
@endif
        php artisan dusk
@include('yaml.set_env')
@endif
