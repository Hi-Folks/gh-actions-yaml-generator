<?php

namespace App\Traits\Form;

trait CodeQuality
{
    public bool $stepExecutePhpunit; //true

    public bool $stepExecutePestphp; //false

    public bool $stepSecurityCheck; //false

    public bool $stepExecuteCodeSniffer; //false

    public string $stepDirCodeSniffer; // app

    public bool $stepInstallCodeSniffer; //true

    public bool $stepExecuteStaticAnalysis; // false

    public string $stepDirStaticAnalysis; // app

    public string $stepToolStaticAnalysis; // phpstan|larastan|psalmlaravel

    public bool $stepInstallStaticAnalysis; //true

    public bool $stepDusk; // false

    public bool $stepPhpstanUseNeon; // false

    public bool $stepPsalmReport; // false

    public function loadDefaultsCodeQuality(): void
    {
        $this->stepExecutePhpunit = true;
        $this->stepExecutePestphp = false;
        $this->stepSecurityCheck = false;
        $this->stepExecuteCodeSniffer = false;
        $this->stepDirCodeSniffer = 'app';
        $this->stepInstallCodeSniffer = true;
        $this->stepExecuteStaticAnalysis = false;
        $this->stepDirStaticAnalysis = 'app';
        $this->stepToolStaticAnalysis = 'larastan';
        $this->stepInstallStaticAnalysis = true;
        $this->stepDusk = false;
        $this->stepPhpstanUseNeon = false;
        $this->stepPsalmReport = false;
    }

    public function loadCodeQualityFromJson(object $j): void
    {
        data_fill($j, 'stepDirCodeSniffer', 'app');
        data_fill($j, 'stepInstallCodeSniffer', true);
        data_fill($j, 'stepDirStaticAnalysis', 'app');
        data_fill($j, 'stepInstallStaticAnalysis', true);
        data_fill($j, 'stepToolStaticAnalysis', 'larastan');
        data_fill($j, 'stepExecutePestphp', false);
        data_fill($j, 'stepPhpstanUseNeon', false);
        data_fill($j, 'stepPsalmReport', false);
        data_fill($j, 'stepSecurityCheck', false);
        $this->stepExecutePhpunit = $j->stepExecutePhpunit;
        $this->stepExecutePestphp = $j->stepExecutePestphp;
        $this->stepExecuteCodeSniffer = $j->stepExecuteCodeSniffer;
        $this->stepDirCodeSniffer = $j->stepDirCodeSniffer;
        $this->stepInstallCodeSniffer = $j->stepInstallCodeSniffer;
        $this->stepExecuteStaticAnalysis = $j->stepExecuteStaticAnalysis;
        $this->stepDirStaticAnalysis = $j->stepDirStaticAnalysis;
        $this->stepToolStaticAnalysis = $j->stepToolStaticAnalysis;
        $this->stepInstallStaticAnalysis = $j->stepInstallStaticAnalysis;
        $this->stepDusk = $j->stepDusk;
        $this->stepPhpstanUseNeon = $j->stepPhpstanUseNeon;
        $this->stepPsalmReport = $j->stepPsalmReport;
        $this->stepSecurityCheck = $j->stepSecurityCheck;
    }

    /**
     * @param  array<mixed>  $data
     * @return array<mixed>
     */
    public function setDataCodeQuality(array $data): array
    {
        $data['stepExecutePhpunit'] = $this->stepExecutePhpunit;
        $data['stepExecutePestphp'] = $this->stepExecutePestphp;
        $data['stepExecuteCodeSniffer'] = $this->stepExecuteCodeSniffer;
        $data['stepDirCodeSniffer'] = $this->stepDirCodeSniffer;
        $data['stepInstallCodeSniffer'] = $this->stepInstallCodeSniffer;
        $data['stepExecuteStaticAnalysis'] = $this->stepExecuteStaticAnalysis;
        $data['stepDirStaticAnalysis'] = $this->stepDirStaticAnalysis;
        $data['stepToolStaticAnalysis'] = $this->stepToolStaticAnalysis;
        $data['stepInstallStaticAnalysis'] = $this->stepInstallStaticAnalysis;
        $data['stepDusk'] = $this->stepDusk;
        $data['stepPhpstanUseNeon'] = $this->stepPhpstanUseNeon;
        $data['stepPsalmReport'] = $this->stepPsalmReport;
        $data['stepSecurityCheck'] = $this->stepSecurityCheck;

        return $data;
    }
}
