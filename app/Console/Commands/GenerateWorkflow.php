<?php

namespace App\Console\Commands;

use App\Objects\GuesserFiles;
use App\Objects\ReportExecution;
use App\Objects\WorkflowGenerator;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class GenerateWorkflow extends Command
{
    private bool $saveFile;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ghygen:generate
    {--projectdir= : the directory of the project with composer.json}
    {--dry-run : show only the execution report (no workflow file is create or showed)}
    {--cache : enable caching packages in the workflow}
    {--envfile='.GuesserFiles::ENV_DEFAULT_TEMPLATE_FILE.' : the .env file to use in the workflow}
    {--prefer-stable : Prefer stable versions of dependencies}
    {--prefer-lowest : Prefer lowest versions of dependencies}
    {--save= : the yaml file to save the workflow}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate GitHub Actions workflow automatically from
    a project (repository, local filesystem) using composer.json, .env and package.json';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function title(string $title): void
    {
        $this->line(str_pad('', strlen($title) + 12, '*'), 'info');
        $this->line('***   '.$title.'   ***', 'info');
        $this->line(str_pad('', strlen($title) + 12, '*'), 'info');
        $this->newLine();
        $this->line('For auto generating the GitHub Actions Workflow,');
        $this->line("I'm going to analyze the project requirements...");
        $this->newLine();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $reportExecution = new ReportExecution();
        $this->saveFile = false;
        $dryRun = $this->option('dry-run');
        $projectdir = $this->option('projectdir');
        if (is_null($projectdir)) {
            $projectdir = '';
        } else {
            $projectdir = rtrim($projectdir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
        }
        $yamlFile = $this->option('save');
        $this->saveFile = ! is_null($yamlFile);
        if ($this->saveFile) {
            if ($yamlFile === 'auto') {
                $yamlFile = GuesserFiles::generateYamlFilename(GuesserFiles::getGithubWorkflowDirectory($projectdir));
            }
            if (file_exists($yamlFile)) {
                $this->alert('File '.$yamlFile.' exists');

                return;
            }
        }

        $cache = $this->option('cache');
        $optionEnvWorkflowFile = $this->option('envfile');

        $guesserFiles = new GuesserFiles();
        $guesserFiles->pathFiles($projectdir, $optionEnvWorkflowFile);

        //$this->line("Composer : " . $guesserFiles->getComposerPath());
        if (! $guesserFiles->composerExists()) {
            $this->error('Composer file not found');

            return -1;
        }

        $generator = new WorkflowGenerator();
        $generator->loadDefaults();

        if ($guesserFiles->composerExists()) { /** @phpstan-ignore-line */
            $reportExecution->addValueInfo('Composer file', 'Loaded');
            $composer = json_decode(file_get_contents($guesserFiles->getComposerPath()), true);
            $generator->name = Arr::get($composer, 'name', '');
            $reportExecution->addValueInfo('Project name', $generator->name);
            $yamlFile = GuesserFiles::generateYamlFilename(
                GuesserFiles::getGithubWorkflowDirectory($projectdir),
                $generator->name
            );

            $phpversion = Arr::get($composer, 'require.php', '8.0');

            $stepPhp = $generator->detectPhpVersion($phpversion);
            $reportExecution->addValueInfo('PHP versions', $stepPhp);

            $optionPreferSelected = $this->option('prefer-stable') || $this->option('prefer-lowest');
            if ($this->option('prefer-stable') && $this->option('prefer-lowest')) {
                $generator->dependencyStability = ['prefer-stable', 'prefer-lowest'];
            } elseif ($this->option('prefer-lowest')) {
                $generator->dependencyStability = ['prefer-lowest'];
            } elseif ($this->option('prefer-stable')) {
                $generator->dependencyStability = ['prefer-stable'];
            } else {
                $generator->dependencyStability = ['prefer-none'];
            }
            if ($optionPreferSelected) {
                $reportExecution->addValueInfo('Dependency stability', $generator->dependencyStability);
            } else {
                $reportExecution->addValueComment('Dependency stability', 'Not selected');
            }

            // detect packages
            $devPackages = Arr::get($composer, 'require-dev');
            // testbench
            $testbenchVersions = Arr::get($devPackages, 'orchestra/testbench', '');
            if ($testbenchVersions !== '') {
                $laravelVersions = GuesserFiles::detectLaravelVersionFromTestbench($testbenchVersions);
                $generator->matrixLaravel = true;
                $generator->matrixLaravelVersions = $laravelVersions;
                $reportExecution->addValueInfo('Laravel versions', $laravelVersions);
            } else {
                $reportExecution->addValueComment('Laravel', 'No testbench detected');
            }
            // squizlabs/php_codesniffer
            $phpCodesniffer = Arr::get($devPackages, 'squizlabs/php_codesniffer', '');
            if ($phpCodesniffer !== '') {
                $generator->stepExecuteCodeSniffer = true;
                $generator->stepInstallCodeSniffer = false;
                $reportExecution->addValueInfo('Code sniffer', 'Detected');
            } else {
                $reportExecution->addValueComment('Code sniffer', 'Not detected');
            }
            // nunomaduro/larastan
            $larastan = Arr::get($devPackages, 'nunomaduro/larastan', '');
            if ($larastan !== '') {
                $generator->stepExecuteStaticAnalysis = true;
                $generator->stepInstallStaticAnalysis = false;
                $generator->stepToolStaticAnalysis = 'larastan';
                $generator->stepPhpstanUseNeon = $guesserFiles->phpstanNeonExists();
                $reportExecution->addValueInfo('Static code analysis', 'Larastan and PHPStan');
            } else {
                $phpstan = Arr::get($devPackages, 'phpstan/phpstan', '');
                if ($phpstan !== '') {
                    $generator->stepExecuteStaticAnalysis = true;
                    $generator->stepInstallStaticAnalysis = false;
                    $generator->stepToolStaticAnalysis = 'phpstan';
                    $generator->stepPhpstanUseNeon = $guesserFiles->phpstanNeonExists();
                    $reportExecution->addValueInfo('Static code analysis', 'PHPStan');
                } else {
                    $reportExecution->addValueComment('Static code analysis', 'Not detected');
                }
            }
            $generator->stepDusk = false;
            // phpunit/phpunit
            $generator->stepExecutePhpunit = false;
            $phpunit = Arr::get($devPackages, 'phpunit/phpunit', '');
            if ($phpunit !== '') {
                $generator->stepExecutePhpunit = true;
                $reportExecution->addValueInfo('Automated test', 'PHPUnit');
            }
            // phpunit/phpunit
            $generator->stepExecutePestphp = false;
            $pestphp = Arr::get($devPackages, 'pestphp/pest', '');
            if ($pestphp !== '') {
                $generator->stepExecutePestphp = true;
                $reportExecution->addValueInfo('Automated test', 'PestPHP');
            }
            if ($pestphp === '' && $phpunit === '') {
                $reportExecution->addValueComment('Automated test', 'Not detected');
            }
        } else {
            $reportExecution->addValueComment('Composer file', 'not found');
        }

        $generator->detectCache($cache);
        if ($cache) {
            $reportExecution->addValueInfo('Caching packages', 'Yes cache');
        } else {
            $reportExecution->addValueComment('Caching packages', 'No cache');
        }

        $generator->databaseType = WorkflowGenerator::DB_TYPE_NONE;
        $generator->stepRunMigrations = false;

        if ($guesserFiles->envExists()) {
            $envArray = $generator->readDotEnv($guesserFiles->getEnvPath());
            $databaseType = Arr::get($envArray, 'DB_CONNECTION', '');

            $generator->databaseType = WorkflowGenerator::DB_TYPE_NONE;
            $generator->stepRunMigrations = false;
            if ($databaseType === 'mysql') {
                $generator->databaseType = WorkflowGenerator::DB_TYPE_MYSQL;
                $reportExecution->addValueInfo('Database', 'Mysql service');
            }
            if ($databaseType === 'sqlite') {
                $generator->databaseType = WorkflowGenerator::DB_TYPE_SQLITE;
                $reportExecution->addValueInfo('Database', 'SQLite');
            }
            if ($databaseType === 'postgresql') {
                $generator->databaseType = WorkflowGenerator::DB_TYPE_POSTGRESQL;
                $reportExecution->addValueInfo('Database', 'PostgreSQL service');
            }
            if ($generator->databaseType !== WorkflowGenerator::DB_TYPE_NONE) {
                $migrationFiles = scandir($guesserFiles->getMigrationsPath());
                if (count($migrationFiles) > 4) {
                    $generator->stepRunMigrations = true;
                    $reportExecution->addValueInfo('Migrations', 'Detected');
                } else {
                    $reportExecution->addValueComment('Migrations', 'Not detected');
                }
            } else {
                $reportExecution->addValueComment('Database', 'No database');
            }
        }
        if ($guesserFiles->packageExists()) {
            $generator->stepNodejs = true;
            $generator->stepNodejsVersion = '16.x';
            $versionFromNvmrc = $generator->readNvmrc($guesserFiles
            ->getNvmrcPath());
            if ($versionFromNvmrc !== '') {
                $generator->stepNodejsVersion = $versionFromNvmrc;
            }
            $reportExecution->addValueInfo('NodeJS/Npm', 'Detected, version '.$generator->stepNodejsVersion);
        } else {
            $reportExecution->addValueComment('NodeJS/Npm', 'Not Detected');
        }
        $appKey = '';
        $generator->stepGenerateKey = false;

        if ($guesserFiles->envDefaultTemplateExists()) {
            $generator->stepCopyEnvTemplateFile = true;
            $reportExecution->addValueInfo('.env file', 'Detected');
            $generator->stepEnvTemplateFile = $optionEnvWorkflowFile;
            // Generate Key
            $envArray = $generator->readDotEnv($guesserFiles->getEnvDefaultTemplatePath());
            $appKey = Arr::get($envArray, 'APP_KEY', '');

            $generator->stepGenerateKey = $appKey === '';
            if ($generator->stepGenerateKey) {
                $reportExecution->addValueInfo('Laravel App Key', 'Will be generated');
            }
        } else {
            $reportExecution->addValueComment('.env file', 'Not detected');
            $generator->stepCopyEnvTemplateFile = false;
        }
        $generator->stepFixStoragePermissions = false;
        if ($guesserFiles->artisanExists()) {
            //artisan file so:ENV_TEMPLATE_FILE_DEFAULT.
            // fix storage permissions
            $generator->stepFixStoragePermissions = true;
        }
        if ($generator->stepFixStoragePermissions) {
            $reportExecution->addValueInfo('Laravel Fix storage permission', 'Chmod will be executed');
        }

        $data = $generator->setData();

        $result = $generator->generate($data);
        if ($dryRun) {
            $this->title('Ghygen');
            $this->table(['Report', 'Status'], $reportExecution->toArrayLabelValue());
        } else {
            if ($this->saveFile) {
                try {
                    $size = file_put_contents($yamlFile, $result);
                    $this->title('Ghygen');
                    $this->table(['Report', 'status'], $reportExecution->toArrayLabelValue());
                    $this->info('File '.$yamlFile);
                    $this->info('File created ('.$size.' bytes)');
                } catch (\Exception $e) {
                    if (! GuesserFiles::existsGithubWorkflowDirectory($projectdir)) {
                        $this->error(
                            "Workflow directory doesn't exist : ".
                            GuesserFiles::getGithubWorkflowDirectory($projectdir)
                        );
                        $this->info(
                            'Hint: create Workflow directory: '.
                            GuesserFiles::getGithubWorkflowDirectory($projectdir)
                        );
                    } else {
                        $this->error($e->getMessage());
                    }
                }
            } else {
                $this->line($result);
            }
        }

        return 0;
    }
}
