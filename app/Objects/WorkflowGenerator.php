<?php

namespace App\Objects;

use App\Traits\Form\BaseWorkflow;
use App\Traits\Form\CodeQuality;
use App\Traits\Form\Deploy;
use App\Traits\Form\LaravelStuff;
use Illuminate\Support\Str;

class WorkflowGenerator
{
    use BaseWorkflow;
    use CodeQuality;
    use LaravelStuff;
    use Deploy;

    public const DB_TYPE_NONE = "none";
    public const DB_TYPE_MYSQL = "mysql";
    public const DB_TYPE_SQLITE = "sqlite";
    public const DB_TYPE_POSTGRESQL = "postgresql";

    public function loadDefaults()
    {
        $this->loadDefaultsBaseWorkflow();
        $this->loadDefaultsCodeQuality();
        $this->loadDefaultsLaravelStuff();
        $this->loadDefaultsDeploy();
    }

    private function compactThis(string ...$args): array
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

    private static function arrayToString($array): string
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

    private static function split($somethingToSplit, $splitChars = ",")
    {
        if (\is_string($somethingToSplit)) {
            return array_map('trim', explode($splitChars, $somethingToSplit));
        }
        return $somethingToSplit;
    }


    public function setData()
    {
        $data = [];
        $data = $this->setDataBaseWorkflow($data);
        $data = $this->setDataCodeQuality($data);
        $data = $this->setDataLaravelStuff($data);
        $data = $this->setDeployData($data);
        return $data;
    }

    public function generate($data)
    {
        $stringResult = view('action_yaml', $data)->render();
        return $stringResult;
    }

}
