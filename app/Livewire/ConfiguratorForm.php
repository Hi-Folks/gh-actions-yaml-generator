<?php

namespace App\Livewire;

use App\Models\Configuration;
use App\Objects\WorkflowGenerator;
use App\Traits\Form\BaseWorkflow;
use App\Traits\Form\CodeQuality;
use App\Traits\Form\Deploy;
use App\Traits\Form\LaravelStuff;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Swaggest\JsonSchema\Schema;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ConfiguratorForm
 */
class ConfiguratorForm extends Component
{
    use WithRateLimiting;
    use BaseWorkflow;
    use CodeQuality;
    use LaravelStuff;
    use Deploy;

    public string $code = '';

    public string $template = '';

    /**
     * @var array<mixed>
     */
    protected $queryString = [
        'code' => ['except' => ''],
        'template' => ['except' => ''],
    ];

    public string $result;

    public string $errorGeneration;

    /**
     * @var array<mixed>
     */
    public $hints;

    /**
     * @var array<mixed>
     */
    protected $rules = [
        'name' => 'required|string',
        'onPushBranches' => 'exclude_unless:onPush,1|required',
        'onPullrequestBranches' => 'exclude_unless:onPullrequest,1|required',
        'mysqlVersion' => 'exclude_unless:databaseType,'.WorkflowGenerator::DB_TYPE_MYSQL.'|required',
        'mysqlDatabaseName' => 'exclude_unless:databaseType,'.WorkflowGenerator::DB_TYPE_MYSQL.'|required',
        'mysqlDatabasePort' => 'exclude_unless:databaseType,'.WorkflowGenerator::DB_TYPE_MYSQL.'|required|integer',
        'postgresqlVersion' => 'exclude_unless:databaseType,'.WorkflowGenerator::DB_TYPE_POSTGRESQL.'|required',
        'postgresqlDatabaseName' => 'exclude_unless:databaseType,'.WorkflowGenerator::DB_TYPE_POSTGRESQL.'|required',
        'postgresqlDatabasePort' => 'exclude_unless:databaseType,'.WorkflowGenerator::DB_TYPE_POSTGRESQL.'|required|integer',

        'matrixLaravelVersions' => 'exclude_unless:matrixLaravel,1|required',
    ];

    private function loadDefaults(): void
    {
        $this->loadDefaultsBaseWorkflow();
        $this->loadDefaultsCodeQuality();
        $this->loadDefaultsLaravelStuff();
        $this->loadDefaultsDeploy();
    }

    private function loadFromJson(object $j): void
    {
        $this->loadBaseWorkflowFromJson($j);
        $this->loadCodeQualityFromJson($j);
        $this->loadLaravelStuffFromJson($j);
        $this->loadDeployFromJson($j);
    }

    public function mount(): void
    {
        $this->fill(request()->only('code'));
        Log::debug(__METHOD__.' Code : '.$this->code);
        $codeNotFound = false;
        $this->loadDefaults();
        if ($this->template != '') {
            $this->setTemplate($this->template);
        }
        if ($this->code != '') {
            $confModel = Configuration::getByCode($this->code);
            if ($confModel) {
                $j = $confModel->configuration;
                $this->loadFromJson($j);
            } else {
                $codeNotFound = true;
            }
        }
        $this->result = ' ';
        $this->errorGeneration = '';

        $this->hints = [];
        if ($codeNotFound) {
            $this->hints[] = 'The Code : '.$this->code.' was not found. So the default configuration was loaded.';
        }
    }

    public function updated(string $propertyName): void
    {
        $this->result = ' ';
    }

    public function templateLaravelApp()
    {
        $this->setTemplate("laravelapp");
    }
    public function setTemplate($x)
    {
        if (in_array($x, ['laravelapp', 'laravelpostgresql', 'laravelpackage', 'phppackage'])) {
            $this->template = $x;
            $this->code = '';
            $j = json_decode(file_get_contents(resource_path('templates/json/'.$x.'.json')));
            $this->loadFromJson($j);
        } else {
            $this->template = '';
        }
    }

    /**
     * @return void
     */
    public function submitForm()
    {
        try {
            $this->rateLimit(60);
        } catch (TooManyRequestsException $exception) {
            $this->addError(
                'yaml',
                'Slow down! Please wait another '.
                $exception->secondsUntilAvailable.
                ' seconds to generate a new yaml workflow.'
            );

            return;
        }
        Log::debug('Code:'.$this->code);
        $values = $this->getDataForValidation($this->rules);
        $this->validate();
        if (
            ! $values['onPush'] && ! $values['onPullrequest']
            && ! $values['manualTrigger'] && ! $values['onSchedule']
        ) {
            $this->addError('onEvents', 'You need to select at least one of GitHub event that triggers the workflow');

            return;
        }

        // Provide some suggestions
        $this->hints = [];
        if ($values['databaseType'] !== WorkflowGenerator::DB_TYPE_NONE and ! $values['stepRunMigrations']) {
            $this->hints[] = 'I suggest you to select run migration if you have a Database';
        }
        if ($values['databaseType'] === WorkflowGenerator::DB_TYPE_NONE and $values['stepRunMigrations']) {
            $this->hints[] = 'I suggest you to select a Database if you want to run migrations';
        }
        if ($values['stepDusk'] and ! $values['stepNodejs']) {
            $this->hints[] = "I suggest you to select 'Install node for NPM Build' if you have 'Execute Browser tests'";
        }
        if ($values['onPush'] and $values['onPullrequest'] and $values['manualTrigger']) {
            $hint = "You selected all 3 options: 'on Push', 'on Pull Request', and 'Manual Trigger'.";
            $hint = $hint." I suggest you to select 'Manual Trigger' OR 'on push / on pull request'.";
            $this->hints[] = $hint;
            $this->hints[] = "I selected automatically a 'Manual Trigger' for you.";
        }

        $data = $this->setDataBaseWorkflow([]);
        $data = $this->setDataCodeQuality($data);
        $data = $this->setDataLaravelStuff($data);
        $data = $this->setDeployData($data);

        $stringResult = view('action_yaml', $data)->render();
        $this->errorGeneration = '';
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
            Configuration::saveConfiguration($hashCode, $data);
            $this->code = $hashCode;
            $seconds = 60 * 60 * 3; // 3 hours
            $schema = Cache::remember('cache-schema-yaml', $seconds, function () {
                //return Schema::import('https://json.schemastore.org/github-workflow');
                return Schema::import(json_decode(file_get_contents(base_path('github-workflow.json'))));
            });
            $schema->in(json_decode($json));

            // Add Header to the View
            $dataHeader = [];
            $dataHeader['code'] = $this->code;
            $dataHeader['configurationUrl'] = url('/').'?code='.$this->code;
            $stringHeaderResult = view('yaml.header', $dataHeader)->render();
            //

            $this->result = $stringHeaderResult.$stringResult;
        } catch (\Exception $e) {
            $this->errorGeneration = $e->getMessage();
            $this->result = $stringResult;
            $this->addError('yaml', $e->getMessage());

            return;
        }
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.configurator-form');
    }
}
