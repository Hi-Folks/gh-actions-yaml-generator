<fieldset class="border-2 border-blue-200 shadow-xl p-4 rounded-xl">
  <legend class="text-xl font-medium text-gray-900 px-2 pb-2">Laravel stuff</legend>
  <div class="md:grid md:grid-cols-2 md:gap-2">
    <div class="col-span-1 ">
      <x-form.input-conditional-checkbox
        model="matrixLaravel"
        name="matrixLaravel"
        label="Define Specific Laravel versions"
        id="matrixLaravel"
        value=1
        wire:model="matrixLaravel"
      >
        <x-form.input-select
          model="matrixLaravelVersions"
          name="matrixLaravelVersions"
          label="Laravel Versions"
          :list="['8.*'=>'8.*','7.*'=>'7.*','6.*'=>'6.*']"
          help="Select Laravel Versions (Multiple). This is useful if you are building a package and want to test your package with Laravel 8 , 7 and 6"
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
        wire:model="stepCopyEnvTemplateFile"
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
    <div class="col-span-1 ">
      <div class="pl-3 pb-2 mt-2 space-y-4">
        <x-form.input-select
          model="dependencyStability"
          name="dependencyStability"
          label="Dependency Stability Level"
          :list="[
            'prefer-lowest'=>'Prefer Lowest',
            'prefer-stable'=>'Prefer Stable']"
          help="Select the level of the stability for the Laravel dependency"
          multiselect=1>
          >
        </x-form.input-select>
      </div>
    </div>
  </div>
</fieldset>
