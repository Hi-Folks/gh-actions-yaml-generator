<?php

namespace App\Traits\Form;

trait Deploy
{
    public $stepDeployType;
    public $stepDeployWebhookType;
    public $stepDeployWebhookUrl;
    //public $stepDeployApiToken;

    public function loadDefaultsDeploy(): void
    {
        $this->stepDeployType = 'none';
        $this->stepDeployWebhookType = 'secret';
        $this->stepDeployWebhookUrl = "WEBHOOK_URL";
        //$this->stepDeployApiToken = "VAPOR_API_TOKEN";
    }

    public function loadDeployFromJson($j): void
    {
        data_fill($j, "stepDeployType", 'none');
        data_fill($j, "stepDeployWebhookType", 'secret');
        data_fill($j, "stepDeployWebhookUrl", 'WEBHOOK_URL');
        //data_fill($j, "stepDeployApiToken", 'VAPOR_API_TOKEN');

        $this->stepDeployType = $j->stepDeployType;
        $this->stepDeployWebhookType = $j->stepDeployWebhookType;
        $this->stepDeployWebhookUrl = $j->stepDeployWebhookUrl;
        //$this->stepDeployApiToken = $j->stepDeployApiToken;
    }

    public function setDeployData($data)
    {
        $data["stepDeployType"] = $this->stepDeployType;
        $data["stepDeployWebhookType"] = $this->stepDeployWebhookType;
        $data["stepDeployWebhookUrl"] = $this->stepDeployWebhookUrl;
        //$data["stepDeployApiToken"] = $this->stepDeployApiToken;

        return $data;
    }
}
