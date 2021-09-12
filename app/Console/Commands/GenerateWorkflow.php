<?php

namespace App\Console\Commands;


use App\Objects\WorkflowGenerator;
use Composer\Semver\Semver;
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
    {--cache : enable caching packages in the workflow}';


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
        $cache = $this->option("cache");
        $composerFile = base_path("composer.json");
        $envFile = base_path(".env");
        $packageFile = base_path("packages.json");
        $migrationsDir = base_path("database" . DIRECTORY_SEPARATOR . "migrations");

        if ($projectdir !== "") {
            $composerFile = $projectdir . DIRECTORY_SEPARATOR . "composer.json";
            $envFile = $projectdir . DIRECTORY_SEPARATOR . ".env";
            $packageFile = $projectdir . DIRECTORY_SEPARATOR . "packages.json";
            $migrationsDir = $projectdir . DIRECTORY_SEPARATOR . "database" . DIRECTORY_SEPARATOR . "migrations";
        }
        $this->line("Composer : " . $composerFile);
        $this->line("Env file : " . $envFile);
        $this->line("Package  : " . $packageFile);
        if ( ! is_file($composerFile)) {
            $this->error("Composer file not found". getcwd());
            return -1;
        }
        $generator = new WorkflowGenerator();
        $generator->loadDefaults();

        if (is_file($composerFile)) {
            $composer = json_decode(file_get_contents($composerFile), true);
            $generator->name = Arr::get($composer, 'name');
            $phpversion = Arr::get($composer, 'require.php', "");
            $generator->detectPhpVersion($phpversion);



        }
        $generator->detectCache($cache);

        $generator->databaseType = WorkflowGenerator::DB_TYPE_NONE;
        $generator->stepRunMigrations = false;

        if (is_file($envFile)) {
            $envArray = $generator->readDotEnv($envFile);
            $databaseType = Arr::get($envArray, "DB_CONNECTION", "");
            $this->line("DATABASE:" . $databaseType);
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
                $migrationFiles = scandir($migrationsDir);
                if (count($migrationFiles) > 4 ) {
                    $generator->stepRunMigrations = true;
                }
            }
        }

        $data = $generator->setData();

        $result = $generator->generate($data);
        $this->line($result);

        /*
        foreach ($data as $key => $value) {

            if (is_string($value)) {
                $this->line($key . " - " . $value);
            } else {
                $this->line($key . " - no string value");
            }

        }
        */



        return 0;
    }
}
