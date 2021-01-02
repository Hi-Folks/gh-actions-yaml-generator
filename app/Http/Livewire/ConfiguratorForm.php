<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;

/**
 * Class ConfiguratorForm
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
    public $mysqlVersion;
    public $mysqlDatabaseName;
    public $mysqlDatabasePort;

    public $stepEnvTemplateFile; // .env.ci
    public $stepPhpVersions; // 7.4
    public $stepNodejs; // false
    public $stepNodejsVersion; // 12.x

    public $stepCachePackages; //true
    public $stepCacheVendors; //true

    public $stepFixStoragePermissions; //true

    public $stepDusk; // false





    public $result;



    public function mount()
    {
        $this->name="Test Laravel Github action";
        $this->onPush = true;
        $this->onPushBranches = ["main", "develop", "feature/**"];
        $this->onPullrequest= false;
        $this->onPullrequestBranches = ["main", "develop"];
        $this->manualTrigger = false;
        $this->mysqlService = true;
        $this->mysqlDatabase="mysql";
        $this->mysqlVersion="5.7";
        $this->mysqlDatabaseName = "db_test_laravel";
        $this->mysqlDatabasePort = 33306;

        $this->stepEnvTemplateFile= ".env.ci";
        $this->stepPhpVersions= ["8.0", "7.4"];
        $this->stepNodejs = false;
        $this->stepNodejsVersion ="12.x";

        $this->stepCachePackages =true;
        $this->stepCacheVendors = true;

        $this->stepFixStoragePermissions = true;

        $this->stepDusk = false;
        $this->result = "";
    }

    private static function split($somethingToSplit, $splitChars=",")
    {
        if (\is_string( $somethingToSplit)) {
            return array_map('trim', explode($splitChars, $somethingToSplit));
        }
        return $somethingToSplit;
    }

    private static function arrayToString($array) {
        return "[ " . implode(",", array_map(function ($str) { return "'$str'"; }, $array)) . " ]";
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

        /*$data =[
            "mysqlService" => $this->mysqlService,
            "mysqlDatabase" => $this->mysqlDatabase,
            "mysqlVersion" => $this->mysqlVersion,
            "mysqlDatabaseName" => $this->mysqlDatabaseName,
            "mysqlDatabasePort" => $this->mysqlDatabasePort,

            "name" => $this->name,
            "on_push" => $this->onPush,
            "on_push_branches" => self::split($this->onPushBranches),
            "on_pullrequest" => $this->onPullrequest,
            "on_pullrequest_branches" => self::split($this->onPullrequestBranches),
            "on_workflow_dispatch" => $this->manualTrigger
        ];*/

        $data = $this->compactThis(
            "mysqlService",
            "mysqlDatabase",
            "mysqlVersion",
            "mysqlDatabaseName",
            "mysqlDatabasePort",
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
            "stepFixStoragePermissions",
            "stepDusk"


        );
        $data["stepPhpVersionsString"] = self::arrayToString($this->stepPhpVersions);

        $this->result = view('action_yaml', $data)->render();
    }

    public function render()
    {
        return view('livewire.configurator-form');
    }
}
