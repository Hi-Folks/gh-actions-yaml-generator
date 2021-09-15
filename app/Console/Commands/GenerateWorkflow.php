<?php

namespace App\Console\Commands;

use App\Objects\GuesserFiles;
use App\Objects\WorkflowGenerator;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class GenerateWorkflow extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ghygen:generate
    {--projectdir= : the directory of the project with composer.json}
    {--cache : enable caching packages in the workflow}
    {--envfile=' . GuesserFiles::ENV_DEFAULT_TEMPLATE_FILE . ' : the .env file to use in the workflow}
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

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $projectdir = $this->option("projectdir");
        if (is_null($projectdir)) {
            $projectdir = "";
        }
        $cache = $this->option("cache");
        $optionEnvWorkflowFile = $this->option("envfile");

        $guesserFiles = new GuesserFiles();
        $guesserFiles->pathFiles($projectdir, $optionEnvWorkflowFile);

        //$this->line("Composer : " . $guesserFiles->getComposerPath());
        if (! $guesserFiles->composerExists()) {
            $this->error("Composer file not found");
            return -1;
        }
        $generator = new WorkflowGenerator();
        $generator->loadDefaults();

        if ($guesserFiles->composerExists()) {
            $composer = json_decode(file_get_contents($guesserFiles->getComposerPath()), true);
            $generator->name = Arr::get($composer, 'name');
            $phpversion = Arr::get($composer, 'require.php', "");
            $generator->detectPhpVersion($phpversion);

            // detect packages
            $devPackages = Arr::get($composer, 'require-dev');
            // testbench
            $testbenchVersions = Arr::get($devPackages, "orchestra/testbench", "");
            if ($testbenchVersions !== "") {
                $laravelVersions = GuesserFiles::detectLaravelVersionFromTestbench($testbenchVersions);
                $generator->matrixLaravel = true;
                $generator->matrixLaravelVersions = $laravelVersions;
            }
            // squizlabs/php_codesniffer
            $phpCodesniffer = Arr::get($devPackages, "squizlabs/php_codesniffer", "");
            if ($phpCodesniffer !== "") {
                $generator->stepExecuteCodeSniffer = true;
                $generator->stepInstallCodeSniffer = false;
            }
            // nunomaduro/larastan
            $larastan = Arr::get($devPackages, "nunomaduro/larastan", "");
            if ($larastan !== "") {
                $generator->stepExecuteStaticAnalysis = true;
                $generator->stepInstallStaticAnalysis = false;
                $generator->stepToolStaticAnalysis = "larastan";
            } else {
                $phpstan = Arr::get($devPackages, "phpstan/phpstan", "");
                if ($phpstan !== "") {
                    $generator->stepExecuteStaticAnalysis = true;
                    $generator->stepInstallStaticAnalysis = false;
                    $generator->stepToolStaticAnalysis = "phpstan";
                }
            }
            $generator->stepDusk = false;
            // phpunit/phpunit
            $generator->stepExecutePhpunit = false;
            $phpunit = Arr::get($devPackages, "phpunit/phpunit", "");
            if ($phpunit !== "") {
                $generator->stepExecutePhpunit = true;
            }
            // phpunit/phpunit
            $generator->stepExecutePestphp = false;
            $pestphp = Arr::get($devPackages, "pestphp/pest", "");
            if ($pestphp !== "") {
                $generator->stepExecutePestphp = true;
            }
        }
        $generator->detectCache($cache);

        $generator->databaseType = WorkflowGenerator::DB_TYPE_NONE;
        $generator->stepRunMigrations = false;

        if ($guesserFiles->envExists()) {
            $envArray = $generator->readDotEnv($guesserFiles->getEnvPath());
            $databaseType = Arr::get($envArray, "DB_CONNECTION", "");


            $generator->databaseType = WorkflowGenerator::DB_TYPE_NONE;
            $generator->stepRunMigrations = false;
            if ($databaseType === "mysql") {
                $generator->databaseType = WorkflowGenerator::DB_TYPE_MYSQL;
            }
            if ($databaseType === "sqlite") {
                $generator->databaseType = WorkflowGenerator::DB_TYPE_SQLITE;
            }
            if ($databaseType === "postgresql") {
                $generator->databaseType = WorkflowGenerator::DB_TYPE_POSTGRESQL;
            }
            if ($generator->databaseType !== WorkflowGenerator::DB_TYPE_NONE) {
                $migrationFiles = scandir($guesserFiles->getMigrationsPath());
                if (count($migrationFiles) > 4) {
                    $generator->stepRunMigrations = true;
                }
            }
        }
        if ($guesserFiles->packageExists()) {
            $generator->stepNodejs = true;
            $generator->stepNodejsVersion = "16.x";
            $versionFromNvmrc = $generator->readNvmrc($guesserFiles
            ->getNvmrcPath());
            if ($versionFromNvmrc !== "") {
                $generator->stepNodejsVersion = $versionFromNvmrc;
            }
        }
        $appKey = "";
        $generator->stepGenerateKey = false;

        if ($guesserFiles->envDefaultTemplateExists()) {
            $generator->stepCopyEnvTemplateFile = true;
            $generator->stepEnvTemplateFile = $optionEnvWorkflowFile;
            // Generate Key
            $envArray = $generator->readDotEnv($guesserFiles->getEnvDefaultTemplatePath());
            $appKey = Arr::get($envArray, "APP_KEY", "");

            $generator->stepGenerateKey = $appKey === "";
        } else {
            $generator->stepCopyEnvTemplateFile = false;
        }
        $generator->stepFixStoragePermissions = false;
        if ($guesserFiles->artisanExists()) {
            //artisan file so:ENV_TEMPLATE_FILE_DEFAULT.
            // fix storage permissions
            $generator->stepFixStoragePermissions = true;
        }


        $data = $generator->setData();

        $result = $generator->generate($data);
        $this->line($result);





        return 0;
    }
}
