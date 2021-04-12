<?php

namespace App\Traits\Form;

trait LaravelStuff
{
    public $stepFixStoragePermissions; //true
    public $stepRunMigrations; // true
    public $stepGenerateKey; // true
    public $matrixLaravel; // false
    public $matrixLaravelVersions; // []
    public $matrixTestbenchDependencies;

    public function loadDefaultsLaravelStuff()
    {
        $this->stepFixStoragePermissions = true;
        $this->stepRunMigrations = true;
        $this->stepGenerateKey = true;
        $this->matrixLaravel = false;
        $this->matrixLaravelVersions = [];
        $this->matrixTestbenchDependencies = [
            "8.*" => "6.*",
            "7.*" => "5.*",
            "6.*" => "4.*"
        ]; // mapping laravel versions with testbench version as dependency
        // the key is the laravel ver, the value is the orchestratestbench version
    }

    public function loadLaravelStuffFromJson($j)
    {
        data_fill($j, "stepGenerateKey", true);
        $this->stepFixStoragePermissions = $j->stepFixStoragePermissions;
        $this->stepRunMigrations = $j->stepRunMigrations;
        $this->stepGenerateKey = $j->stepGenerateKey;
        $this->matrixLaravel = $j->matrixLaravel;
        $this->matrixLaravelVersions = $j->matrixLaravelVersions;
        $this->matrixTestbenchDependencies = (array)  $j->matrixTestbenchDependencies;
    }

    public function setDataLaravelStuff($data)
    {
        $data["stepFixStoragePermissions"] = $this->stepFixStoragePermissions;
        $data["stepRunMigrations"] = $this->stepRunMigrations;
        $data["stepGenerateKey"] = $this->stepGenerateKey;
        $data["matrixLaravel"] = $this->matrixLaravel;
        $data["matrixLaravelVersions"] = $this->matrixLaravelVersions;
        $data["matrixTestbenchDependencies"] = $this->matrixTestbenchDependencies;
        $data["matrixLaravelVersionsString"] = self::arrayToString($this->matrixLaravelVersions);

        return $data;
    }
}
