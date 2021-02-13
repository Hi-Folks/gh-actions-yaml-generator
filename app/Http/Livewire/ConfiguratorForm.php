<?php

namespace App\Http\Livewire;

use App\Models\Configuration;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
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
    use WithRateLimiting;

    public $code = "";

    protected $queryString = ['code' => ['except' => '']];

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

    private function loadDefaults()
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
    }

    public function mount()
    {
        $this->fill(request()->only('code'));
        Log::debug(__METHOD__ . ' Code : ' . $this->code);
        $this->loadDefaults();
        if ($this->code != "") {
            $confModel = Configuration::getByCode($this->code);
            if ($confModel) {
                $j = json_decode($confModel->configuration);
                Log::debug(__METHOD__ . ' Name : ' . $j->name);
                $this->name = $j->name;
                $this->onPush = $j->on_push;
                $this->onPushBranches =  $j->on_push_branches;
                $this->onPullrequest = $j->on_pullrequest;
                $this->onPullrequestBranches = $j->on_pullrequest_branches;
                $this->manualTrigger = $j->manual_trigger;
                $this->mysqlService = $j->mysqlService;
                $this->mysqlDatabase = $j->mysqlDatabase;
                $this->mysqlPasswordType = $j->mysqlPasswordType;
                $this->mysqlPassword = $j->mysqlPassword;
                $this->mysqlVersion = $j->mysqlVersion;
                $this->mysqlDatabaseName = $j->mysqlDatabaseName;
                $this->mysqlDatabasePort = $j->mysqlDatabasePort;
                $this->stepEnvTemplateFile = $j->stepEnvTemplateFile;
                $this->stepPhpVersions = $j->stepPhpVersions;
                $this->stepNodejs = $j->stepNodejs;
                $this->stepNodejsVersion = $j->stepNodejsVersion;
                $this->stepCachePackages = $j->stepCachePackages;
                $this->stepCacheVendors = $j->stepCacheVendors;
                $this->stepCacheNpmModules  = $j->stepCacheNpmModules;
                $this->stepFixStoragePermissions = $j->stepFixStoragePermissions;
                $this->stepRunMigrations = $j->stepRunMigrations;
                $this->stepExecutePhpunit = $j->stepExecutePhpunit;
                $this->stepExecuteCodeSniffer = $j->stepExecuteCodeSniffer;
                $this->stepExecuteStaticAnalysis = $j->stepExecuteStaticAnalysis;
                $this->stepDusk = $j->stepDusk;
                $this->matrixLaravel = $j->matrixLaravel;
                $this->matrixLaravelVersions = $j->matrixLaravelVersions;
                $this->matrixTestbenchDependencies = (array)  $j->matrixTestbenchDependencies;
            }
        }
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
        try {
            $this->rateLimit(60);
        } catch (TooManyRequestsException $exception) {
            $this->addError('yaml', "Slow down! Please wait another " . $exception->secondsUntilAvailable . " seconds to generate a new yaml workflow.");
            return;
        }
        Log::debug('Code:' . $this->code);
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
            //$compressed = gzdeflate($json,  9);
            $hashCode = md5($json);
            Configuration::saveConfiguration($hashCode, json_encode($data));
            $this->code = $hashCode;
            $seconds = 60 * 60 * 6; // 6 hours
            $schema = Cache::remember('cache-schema-yaml', $seconds, function () {
                return Schema::import('https://json.schemastore.org/github-workflow');
            });
            $schema->in(json_decode($json));

            // Add Header to the View
            $dataHeader = [];
            $dataHeader["code"] = $this->code;
            $dataHeader["configurationUrl"] =  url("/") . "?code=" . $this->code;
            $stringHeaderResult = view('yaml.header', $dataHeader)->render();
            //

            $this->result = $stringHeaderResult . $stringResult;
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
