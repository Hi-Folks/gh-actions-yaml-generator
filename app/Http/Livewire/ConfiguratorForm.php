<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Swaggest\JsonSchema\Schema;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ConfiguratorForm
 *
 * @package App\Http\Livewire
 */
class ConfiguratorForm extends Component
{
    public $name;
    public $onPush;
    public $onPushBranches;
    public $onPullrequest;
    public $onPullrequestBranches;
    public $manualTrigger;
    public $mysqlService;
    public $mysqlDatabase;
    public $mysqlPasswordType; // 'skip
    public $mysqlPassword; // password
    public $mysqlVersion;
    public $mysqlDatabaseName;
    public $mysqlDatabasePort;
    public $stepEnvTemplateFile; // .env.ci
    public $stepPhpVersions; // 7.4
    public $stepNodejs; // false
    public $stepNodejsVersion; // 12.x
    public $stepCachePackages; //true
    public $stepCacheVendors; //true
    public $stepCacheNpmModules; // true
    public $stepFixStoragePermissions; //true
    public $stepRunMigrations; // true
    public $stepExecutePhpunit; //true
    public $stepExecuteCodeSniffer; //false
    public $stepExecuteStaticAnalysis; // false
    public $stepDusk; // false
    public $matrixLaravel; // false
    public $matrixLaravelVersions; // []
    public $matrixTestbenchDependencies;

    public $result;
    public $errorGeneration;

    public $hints;

    protected $rules = [
        'name' => 'required|string',
        'onPushBranches' => 'exclude_unless:onPush,1|required',
        'onPullrequestBranches' => 'exclude_unless:onPullrequest,1|required',
        'mysqlVersion' => 'exclude_unless:mysqlService,1|required',
        'mysqlDatabaseName' => 'exclude_unless:mysqlService,1|required',
        'mysqlDatabasePort' => 'exclude_unless:mysqlService,1|required|integer',
    ];

    public function mount()
    {
        $this->name = "Test Laravel Github action";
        $this->onPush = true;
        $this->onPushBranches = ["main", "develop", "features/**"];
        $this->onPullrequest = false;
        $this->onPullrequestBranches = ["main", "develop"];
        $this->manualTrigger = false;
        $this->mysqlService = true;
        $this->mysqlDatabase = "mysql";
        $this->mysqlPasswordType = "skip";
        $this->mysqlPassword = "DB_PASSWORD";

        $this->mysqlVersion = "5.7";
        $this->mysqlDatabaseName = "db_test_laravel";
        $this->mysqlDatabasePort = 33306;
        $this->stepEnvTemplateFile = ".env.example";
        $this->stepPhpVersions = ["8.0", "7.4"];
        $this->stepNodejs = false;
        $this->stepNodejsVersion = "14.x";
        $this->stepCachePackages = true;
        $this->stepCacheVendors = true;
        $this->stepCacheNpmModules  = true;
        $this->stepFixStoragePermissions = true;
        $this->stepRunMigrations = true;
        $this->stepExecutePhpunit = true;
        $this->stepExecuteCodeSniffer = false;
        $this->stepExecuteStaticAnalysis = false;
        $this->stepDusk = false;
        $this->matrixLaravel = false;
        $this->matrixLaravelVersions = [];
        $this->matrixTestbenchDependencies = [
          "8.*" => "6.*",
            "7.*" => "5.*",
            "6.*" => "4.*"
        ]; // mapping laravel versions with testbench version as dependency
        // the key is the laravel ver, the value is the orchestratestbench version

        $this->result = " ";
        $this->errorGeneration = "";

        $this->hints = [];
    }

    private static function split($somethingToSplit, $splitChars = ",")
    {
        if (\is_string($somethingToSplit)) {
            return array_map('trim', explode($splitChars, $somethingToSplit));
        }
        return $somethingToSplit;
    }

    private static function arrayToString($array)
    {
        return "[ " . implode(
            ",",
            array_map(
                function ($str) {
                    return "'$str'";
                },
                $array
            )
        ) . " ]";
    }

    private function compactThis(...$args)
    {
        $vars = get_object_vars($this);
        $retVal = [];
        foreach ($args as $arg) {
            if (key_exists($arg, $vars)) {
                $retVal[$arg] = $vars[$arg];
            } elseif (key_exists(Str::camel($arg), $vars)) {
                $retVal[$arg] = $vars[Str::camel($arg)];
            }
        }
        return $retVal;
    }

    public function updated($propertyName)
    {
        $this->result = " ";
    }


    public function submitForm()
    {
        $values = $this->getDataForValidation($this->rules);
        $this->validate();
        if (! $values["onPush"] && !  $values["onPullrequest"] && ! $values["manualTrigger"]) {
            $this->addError("onEvents", "You need to select at least one of GitHub event that triggers the workflow");
            return;
        }

        // Provide some suggestions
        $this->hints = [];
        if ($values["mysqlService"] and ! $values["stepRunMigrations"]) {
            $this->hints[] = "I suggest you to select run migration if you have MySqlService";
        }
        if (! $values["mysqlService"] and $values["stepRunMigrations"]) {
            $this->hints[] = "I suggest you to select Mysql Service if you want to run migrations";
        }
        if ($values["stepDusk"] and ! $values["stepNodejs"]) {
            $this->hints[] = "I suggest you to select 'Install node for NPM Build' if you have 'Execute Browser tests'";
        }
        if ($values["onPush"] and $values["onPullrequest"] and $values["manualTrigger"]) {
            $hint = "You selected all 3 options: 'on Push', 'on Pull Request', and 'Manual Trigger'.";
            $hint = $hint . " I suggest you to select 'Manual Trigger' OR 'on push / on pull request'.";
            $this->hints[] = $hint;
            $this->hints[] = "I selected automatically a 'Manual Trigger' for you.";
        }

        $data = $this->compactThis(
            "mysqlService",
            "mysqlDatabase",
            "mysqlVersion",
            "mysqlDatabaseName",
            "mysqlDatabasePort",
            "mysqlPassword",
            "mysqlPasswordType",
            "name",
            "on_push",
            "on_push_branches",
            "on_pullrequest",
            "on_pullrequest_branches",
            "manual_trigger",
            "stepEnvTemplateFile",
            "stepPhpVersions",
            "stepNodejs",
            "stepNodejsVersion",
            "stepCachePackages",
            "stepCacheVendors",
            "stepCacheNpmModules",
            "stepFixStoragePermissions",
            "stepRunMigrations",
            "stepExecutePhpunit",
            "stepExecuteCodeSniffer",
            "stepExecuteStaticAnalysis",
            "stepDusk",
            "matrixLaravel",
            "matrixLaravelVersions",
            "matrixTestbenchDependencies"
        );
        $data["stepPhpVersionsString"] = self::arrayToString($this->stepPhpVersions);
        $data["on_pullrequest_branches"] = self::split($this->onPullrequestBranches);
        $data["on_push_branches"] = self::split($this->onPushBranches);
        $data["matrixLaravelVersionsString"] = self::arrayToString($this->matrixLaravelVersions);

        $stringResult = view('action_yaml', $data)->render();
        $this->errorGeneration = "";
        try {
            $array = Yaml::parse($stringResult);
        } catch (ParseException $e) {
            $this->errorGeneration = $e->getMessage();
            $this->result = $stringResult;
            $this->addError('yaml', $e->getMessage());
            return;
        }
        try {
            $json = json_encode($array);
            $seconds = 60 * 60 * 6; // 6 hours
            $schema = Cache::remember('cache-schema-yaml', $seconds, function () {
                return Schema::import('https://json.schemastore.org/github-workflow');
            });

            $schema->in(json_decode($json));
            $this->result = $stringResult;
        } catch (\Exception $e) {
            $this->errorGeneration = $e->getMessage();
            $this->result = $stringResult;
            $this->addError('yaml', $e->getMessage());
            return;
        }
    }

    public function render()
    {
        return view('livewire.configurator-form');
    }
}
