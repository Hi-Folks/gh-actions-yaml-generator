<?php

namespace App\Console\Commands;


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
    protected $signature = 'ghygen:generate';

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
        $composerFile = base_path("composer.json");
        $envFile = base_path(".env");
        $packageFile = base_path("packages.json");
        $this->line("Composer : " . $composerFile);
        $this->line("Env file : " . $envFile);
        $this->line("Package  : " . $packageFile);
        $generator = new WorkflowGenerator();
        $generator->loadDefaults();

        if (is_file($composerFile)) {
            $composer = json_decode(file_get_contents($composerFile), true);
            $generator->name = Arr::get($composer, 'name');
            $phpversion = Arr::get($composer, 'require.php', "");
            if ($phpversion !="") {
                echo $phpversion;
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
