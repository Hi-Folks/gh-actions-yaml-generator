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
    vendor/bin/phpstan analyse {{ $stepDirStaticAnalysis }} -c ./vendor/nunomaduro/larastan/extension.neon  --level=4 --no-progress
  @elseif ($stepToolStaticAnalysis == 'psalmlaravel')
    - name: Execute Code Static Analysis (PSALM)
    run: |
    @if ($stepInstallStaticAnalysis)
      composer require --dev vimeo/psalm
      ./vendor/bin/psalm --init
      composer require --dev psalm/plugin-laravel
      ./vendor/bin/psalm-plugin enable psalm/plugin-laravel
    @endif
    vendor/bin/psalm

  @else
    - name: Execute Code Static Analysis (PHP Stan)
    run: |

    @php ($phpstanNeon = '')
    @if ($stepPhpstanUseNeon)
      @php ($phpstanNeon = 'phpstan.neon')
    @endif

    @if ($stepInstallStaticAnalysis)
      composer require --dev phpstan/phpstan
    @endif

    vendor/bin/phpstan analyse {{ $stepDirStaticAnalysis }} {{ $phpStanNeon }} --level=4 --no-progress
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
