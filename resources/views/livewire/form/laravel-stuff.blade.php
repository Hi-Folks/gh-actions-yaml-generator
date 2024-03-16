<fieldset class="card bordered shadow-lg">
  <legend class="card-title">Laravel stuff</legend>
  <div class="md:grid md:grid-cols-2 md:gap-2">
    <div class="col-span-1 ">
      <x-form.input-conditional-checkbox
        model="matrixLaravel"
        name="matrixLaravel"
        label="Define Specific Laravel versions"
        id="matrixLaravel"
        value=1
        wire:model.live="matrixLaravel"
      >
        <x-form.input-select
          model="matrixLaravelVersions"
          name="matrixLaravelVersions"
          label="Laravel Versions"
          :list="['10.*'=>'10.*', '9.*'=>'9.*', '8.*'=>'8.*','7.*'=>'7.*','6.*'=>'6.*']"
          help="Select Laravel Versions (Multiple). This is useful if you are building a package and want to test your package with Laravel 10, 9, 8 , 7 and 6"
          multiselect=1>
        </x-form.input-select>


      </x-form.input-conditional-checkbox>

    </div>
    <div class="col-span-1 ">
      <x-form.input-conditional-checkbox
        model="stepCopyEnvTemplateFile"
        name="stepCopyEnvTemplateFile"
        label="Copy .env file"
        id="stepCopyEnvTemplateFile"
        value=1
        wire:model.live="stepCopyEnvTemplateFile"
      >
        <x-form.input-text
          model="stepEnvTemplateFile"
          name="stepEnvTemplateFile"
          label="Env template file"
          help="Define env template file to use in actions">
        </x-form.input-text>
      </x-form.input-conditional-checkbox>
    </div>
    <div class="col-span-1 ">
      <div class="pl-3 pb-2 mt-2 space-y-4">
        <x-form.input-checkbox
          model="stepFixStoragePermissions"
          name="stepFixStoragePermissions"
          label="Fix storage permission"
          help="Fix storage permission via chmod 777">
        </x-form.input-checkbox>
      </div>
    </div>
    <div class="col-span-1 ">
      <div class="pl-3 pb-2 mt-2 space-y-4">
        <x-form.input-checkbox
          model="stepRunMigrations"
          name="stepRunMigrations"
          label="Run migrations"
          help="Execute php artisan migrate">
        </x-form.input-checkbox>
      </div>
    </div>
    <div class="col-span-1 ">
      <div class="pl-3 pb-2 mt-2 space-y-4">
        <x-form.input-checkbox
          model="stepGenerateKey"
          name="stepGenerateKey"
          label="Generate key"
          help="Execute php artisan key:generate">
        </x-form.input-checkbox>
      </div>
    </div>
  </div>
</fieldset>
