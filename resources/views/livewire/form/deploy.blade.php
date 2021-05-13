<fieldset class="border-2 border-blue-200 shadow-xl p-4 rounded-xl" x-data="{ showPloiService: {{ $deployType === 'ploi' ? 'true' : 'false' }}}">
    <legend class="text-xl font-medium text-gray-900 px-2 pb-2">Deployment</legend>
    <x-form.input-select model="deployType" name="deployType" label="Select Deployment Step" :list="['none'=>'None', 'ploi'=>'Ploi']" help="Deployment: *None* if you don't want to deploy the code in your workflow. Otherwise select from available options" multiselect=0 onChange='showPloiService= $event.target.value==="ploi";'>
    </x-form.input-select>

    <div x-show="showPloiService">
        <div class="md:grid md:grid-cols-3 md:gap-3">

            <div class="col-span-2">
                <x-form.input-select model="webhookType" name="webhookType" label="Ploi Webhook URL: Read from secret or hardcoded" :list="['secret'=>'From Secret', 'hardcoded' => 'Hardcoded']" help="Ploi Webhook URL: Read from secret or hardcoded" multiselect=0>
                </x-form.input-select>
            </div>
            <div class="col-span-1">
                <x-form.input-text model="webhookUrl" name="webhookUrl" label="Webhook URL" help="For secret, fill with the name of your parameter for example WEBHOOK_URL, for Hardcoded, fill with your webhook URL">
                </x-form.input-text>
            </div>
        </div>
    </div>

</fieldset>