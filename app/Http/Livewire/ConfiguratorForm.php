<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;
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

    public $result;
    public $errorGeneration;

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
        $this->result = "";
        $this->errorGeneration = "";
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

    public function submitForm()
    {
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
            "stepDusk"
        );
        $data["stepPhpVersionsString"] = self::arrayToString($this->stepPhpVersions);
        $data["on_pullrequest_branches"] = self::split($this->onPullrequestBranches);
        $data["on_push_branches"] = self::split($this->onPushBranches);

        $stringResult = view('action_yaml', $data)->render();

        try {
            Yaml::parse($stringResult);
            $this->errorGeneration = "";
            $this->result = $stringResult;
        } catch (ParseException $e) {
            $this->errorGeneration = $e->getMessage();
            $this->result = $stringResult;
        }
    }

    public function render()
    {
        return view('livewire.configurator-form');
    }
}
