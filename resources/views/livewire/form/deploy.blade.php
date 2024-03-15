<fieldset class="card bordered shadow-lg" x-data="{ showPloiService: {{ $stepDeployType === 'ploi'? 'true' : 'false' }},
 showVaporService: {{ $stepDeployType === 'vapor'? 'true' : 'false' }},
 showForgeService: {{ $stepDeployType === 'forge'? 'true' : 'false' }}
  }">
    <legend class="card-title">Deployment (Experimental feature)</legend>
    <x-form.input-select model="stepDeployType" name="stepDeployType" label="Select Deployment Step" :list="['none'=>'None', 'ploi'=>'Ploi', 'vapor' => 'Vapor', 'forge' => 'Forge']" help="Deployment: *None* if you don't want to deploy the code in your workflow. Otherwise select from available options" multiselect=0 onChange='showPloiService= $event.target.value==="ploi";showVaporService= $event.target.value==="vapor";showForgeService= $event.target.value==="forge";'>
    </x-form.input-select>

    <div x-show="showPloiService">
        <div class="md:grid md:grid-cols-3 md:gap-3">

            <div class="col-span-2">
                <x-form.input-select model="stepDeployWebhookType" name="stepDeployWebhookType" label="Ploi Webhook URL: Read from secret or hardcoded" :list="['secret'=>'From Secret', 'hardcoded' => 'Hardcoded']" help="Ploi Webhook URL: Read from secret or hardcoded" multiselect=0>
                </x-form.input-select>
            </div>
            <div class="col-span-1">
                <x-form.input-text model="stepDeployWebhookUrl" name="stepDeployWebhookUrl" label="Webhook URL" help="For secret, fill with the name of your parameter for example WEBHOOK_URL, for Hardcoded, fill with your webhook URL">
                </x-form.input-text>
            </div>
        </div>
    </div>
  <div x-show="showVaporService">
    <div class="card">
      <div class="card-body">
        You need to set a GitHub Secret in settings/secrets/actions/new named VAPOR_API_TOKEN.
        <br />
        Take a look the documentation about <a href="https://docs.vapor.build/1.0/projects/deployments.html#deploying-from-ci" target="_blank">Laravel Vapor, Deploying From CI</a>
      </div>
    </div>
  </div>

  <div x-show="showForgeService">
    <div class="card">
      <div class="card-body">
        You need to set some GitHub Secrets ("GitHub > Project Settings > Secrets"):
        FORGE_API_TOKEN and SSH_PRIVATE_KEY.
        <br />
        Take a look the documentation about <a href="https://forge.laravel.com/docs/1.0/sites/deployments.html#using-forge-cli" target="_blank">Forge, deploy with Forge CLI.</a>

        <div class="col-span-2">
          <x-form.input-text model="stepDeployForgeServerName" name="stepDeployForgeServerName" label="Forge Server Name" help="Forge Server Name">
          </x-form.input-text>
        </div>
        <div class="col-span-1">
          <x-form.input-text model="stepDeployForgeSiteName" name="stepDeployForgeSiteName" label="Forge Site Name" help="Forge Site Name">
          </x-form.input-text>
        </div>
      </div>
    </div>
  </div>

</fieldset>
