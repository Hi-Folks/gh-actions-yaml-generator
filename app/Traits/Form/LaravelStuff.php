<?php

namespace App\Traits\Form;

use App\Objects\WorkflowGenerator;

trait LaravelStuff
{
    public bool $stepFixStoragePermissions; //true
    public bool $stepRunMigrations; // true
    public bool $stepGenerateKey; // true
    public string $stepEnvTemplateFile; // ".env.example"
    public bool $stepCopyEnvTemplateFile; // true
    public bool $matrixLaravel; // false
    /**
     * @var array<mixed> $matrixLaravelVersions
     */
    public $matrixLaravelVersions; // []
    /**
     * @var array<mixed> $matrixTestbenchDependencies
     */
    public array $matrixTestbenchDependencies;

    public function loadDefaultsLaravelStuff(): void
    {
        $this->stepFixStoragePermissions = true;
        $this->stepRunMigrations = true;
        $this->stepGenerateKey = true;
        $this->stepEnvTemplateFile = ".env.example";
        $this->stepCopyEnvTemplateFile = true;
        $this->matrixLaravel = false;
        $this->matrixLaravelVersions = [];
        $this->matrixTestbenchDependencies = [
            "9.*" => "7.*",
            "8.*" => "6.*",
            "7.*" => "5.*",
            "6.*" => "4.*"
        ]; // mapping laravel versions with testbench version as dependency
        // the key is the laravel ver, the value is the orchestratestbench version
    }

    public function loadLaravelStuffFromJson(object $j): void
    {
        data_fill($j, "stepGenerateKey", true);
        data_fill($j, "stepCopyEnvTemplateFile", true);
        $this->stepFixStoragePermissions = $j->stepFixStoragePermissions;
        $this->stepRunMigrations = $j->stepRunMigrations;
        $this->stepGenerateKey = $j->stepGenerateKey;
        $this->stepEnvTemplateFile = $j->stepEnvTemplateFile;
        $this->stepCopyEnvTemplateFile = $j->stepCopyEnvTemplateFile;
        $this->matrixLaravel = $j->matrixLaravel;
        $this->matrixLaravelVersions = $j->matrixLaravelVersions;
        $this->matrixTestbenchDependencies = (array)  $j->matrixTestbenchDependencies;
    }

    /**
     * @param array<mixed> $data
     * @return array<mixed>
     */
    public function setDataLaravelStuff(array $data): array
    {
        $data["stepFixStoragePermissions"] = $this->stepFixStoragePermissions;
        $data["stepRunMigrations"] = $this->stepRunMigrations;
        $data["stepGenerateKey"] = $this->stepGenerateKey;
        $data["stepEnvTemplateFile"] = $this->stepEnvTemplateFile;
        $data["stepCopyEnvTemplateFile"] = $this->stepCopyEnvTemplateFile;
        $data["matrixLaravel"] = $this->matrixLaravel;
        $data["matrixLaravelVersions"] = $this->matrixLaravelVersions;
        $data["matrixTestbenchDependencies"] = $this->matrixTestbenchDependencies;
        $data["matrixLaravelVersionsString"] = WorkflowGenerator::arrayToString($this->matrixLaravelVersions);

        return $data;
    }
}
