<?php

namespace App\Traits\Form;

trait Deploy
{
    public string $stepDeployType;

    public string $stepDeployWebhookType;

    public string $stepDeployWebhookUrl;

    public string $stepDeployForgeServerName;

    public string $stepDeployForgeSiteName;
    //public $stepDeployApiToken;

    public function loadDefaultsDeploy(): void
    {
        $this->stepDeployType = 'none';
        $this->stepDeployWebhookType = 'secret';
        $this->stepDeployWebhookUrl = 'WEBHOOK_URL';
        $this->stepDeployForgeServerName = '';
        $this->stepDeployForgeSiteName = '';

        //$this->stepDeployApiToken = "VAPOR_API_TOKEN";
    }

    public function loadDeployFromJson(object $j): void
    {
        data_fill($j, 'stepDeployType', 'none');
        data_fill($j, 'stepDeployWebhookType', 'secret');
        data_fill($j, 'stepDeployWebhookUrl', 'WEBHOOK_URL');
        data_fill($j, 'stepDeployForgeServerName', '');
        data_fill($j, 'stepDeployForgeSiteName', '');
        //data_fill($j, "stepDeployApiToken", 'VAPOR_API_TOKEN');

        $this->stepDeployType = $j->stepDeployType;
        $this->stepDeployWebhookType = $j->stepDeployWebhookType;
        $this->stepDeployForgeServerName = $j->stepDeployForgeServerName;
        $this->stepDeployForgeSiteName = $j->stepDeployForgeSiteName;
        //$this->stepDeployApiToken = $j->stepDeployApiToken;
    }

    /**
     * @param  array<mixed>  $data
     * @return array<mixed>
     */
    public function setDeployData(array $data)
    {
        $data['stepDeployType'] = $this->stepDeployType;
        $data['stepDeployWebhookType'] = $this->stepDeployWebhookType;
        $data['stepDeployWebhookUrl'] = $this->stepDeployWebhookUrl;
        $data['stepDeployForgeSiteName'] = $this->stepDeployForgeSiteName;
        $data['stepDeployForgeServerName'] = $this->stepDeployForgeServerName;
        //$data["stepDeployApiToken"] = $this->stepDeployApiToken;

        return $data;
    }
}
