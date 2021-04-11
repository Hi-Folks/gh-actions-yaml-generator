<?php

namespace App\Traits\Form;

trait CodeQuality
{
    public $stepExecutePhpunit; //true
    public $stepExecuteCodeSniffer; //false
    public $stepInstallCodeSniffer; //true
    public $stepExecuteStaticAnalysis; // false
    public $stepInstallStaticAnalysis; //true
    public $stepDusk; // false

    public function loadDefaultsCodeQuality()
    {
        $this->stepExecutePhpunit = true;
        $this->stepExecuteCodeSniffer = false;
        $this->stepInstallCodeSniffer = true;
        $this->stepExecuteStaticAnalysis = false;
        $this->stepInstallStaticAnalysis = true;
        $this->stepDusk = false;
    }

    public function loadCodeQualityFromJson($j)
    {

        data_fill($j, "stepInstallCodeSniffer", true);
        data_fill($j, "stepInstallStaticAnalysis", true);
        $this->stepExecutePhpunit = $j->stepExecutePhpunit;
        $this->stepExecuteCodeSniffer = $j->stepExecuteCodeSniffer;
        $this->stepInstallCodeSniffer = $j->stepInstallCodeSniffer;
        $this->stepExecuteStaticAnalysis = $j->stepExecuteStaticAnalysis;
        $this->stepInstallStaticAnalysis = $j->stepInstallStaticAnalysis;
        $this->stepDusk = $j->stepDusk;
    }

    public function setDataCodeQuality($data)
    {
        $data["stepExecutePhpunit"] = $this->stepExecutePhpunit;
        $data["stepExecuteCodeSniffer"] = $this->stepExecuteCodeSniffer;
        $data["stepInstallCodeSniffer"] = $this->stepInstallCodeSniffer;
        $data["stepExecuteStaticAnalysis"] = $this->stepExecuteStaticAnalysis;
        $data["stepInstallStaticAnalysis"] = $this->stepInstallStaticAnalysis;
        $data["stepDusk"] = $this->stepDusk;

        return $data;
    }
}
