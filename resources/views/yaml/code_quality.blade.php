# Code quality
@if ($stepExecutePhpunit)
    - name: Execute tests (Unit and Feature tests) via PHPUnit
@include('yaml.set_env')

      run: vendor/bin/phpunit --testdox
@endif

@if ($stepExecutePestphp)
    - name: Execute tests (Unit and Feature tests) via PestPHP
@include('yaml.set_env')

      run: vendor/bin/pest
@endif

@if ($stepSecurityCheck)
    - uses: symfonycorp/security-checker-action@v4
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
@if ($stepToolStaticAnalysis == 'larastan')
    - name: Execute Code Static Analysis (PHP Stan + Larastan)
      run: |
@if ($stepInstallStaticAnalysis)
        composer require --dev nunomaduro/larastan
@endif
@if ($stepPhpstanUseNeon)
        vendor/bin/phpstan analyse -c ./phpstan.neon --no-progress
@else
        vendor/bin/phpstan analyse {{ $stepDirStaticAnalysis }} -c ./vendor/nunomaduro/larastan/extension.neon  --level=4 --no-progress
@endif
@elseif ($stepToolStaticAnalysis == 'psalmlaravel')
    - name: Execute Code Static Analysis (PSALM)
      run: |
@if ($stepInstallStaticAnalysis)
        composer require --dev vimeo/psalm
        ./vendor/bin/psalm --init
        composer require --dev psalm/plugin-laravel
        ./vendor/bin/psalm-plugin enable psalm/plugin-laravel
@endif
@if (! $stepPsalmReport)
        vendor/bin/psalm
@else
        vendor/bin/psalm --report=result.sarif
    - name: Upload SARIF file
      uses: github/codeql-action/upload-sarif@v2
      with:
        # Path to SARIF file relative to the root of the repository
        sarif_file: result.sarif
@endif

@else
    - name: Execute Code Static Analysis (PHP Stan)
      run: |
@if ($stepInstallStaticAnalysis)
        composer require --dev phpstan/phpstan
@endif
@if ($stepPhpstanUseNeon)
        vendor/bin/phpstan analyse -c ./phpstan.neon --no-progress
@else
        vendor/bin/phpstan analyse {{ $stepDirStaticAnalysis }} --level=4 --no-progress
@endif
@endif
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
