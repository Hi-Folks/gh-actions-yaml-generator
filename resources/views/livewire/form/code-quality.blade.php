<fieldset class="border-2 border-blue-200 shadow-xl p-4 rounded-xl">
  <legend class="text-xl font-medium text-gray-900 px-2 pb-2">Code Quality</legend>
  <div class="md:grid md:grid-cols-2 md:gap-2">
    <div class="col-span-1 ">
      <div class="pl-3 pb-2 mt-2 space-y-4">
        <x-form.input-checkbox
          model="stepExecutePhpunit"
          name="stepExecutePhpunit"
          label="Execute Tests via phpunit"
          help="Execute Tests via phpunit">
        </x-form.input-checkbox>
      </div>
    </div>
    <div class="col-span-1 ">
      <div class="pl-3 pb-2 mt-2 space-y-4">
        <x-form.input-checkbox
          model="stepExecutePestphp"
          name="stepExecutePestphp"
          label="Execute Tests via PestPHP"
          help="Execute Tests via PestPHP">
        </x-form.input-checkbox>
      </div>
    </div>

    <div class="col-span-2 ">
      <div class="pl-3 pb-2 mt-2 space-y-4">
        <x-form.input-checkbox
          model="stepDusk"
          name="stepDusk"
          label="Execute Browser Test"
          help="Execute Browser Test via Laravel Dusk">
        </x-form.input-checkbox>
      </div>
    </div>
    <div class="col-span-1 ">
      <x-form.input-conditional-checkbox
        model="stepExecuteCodeSniffer"
        name="stepExecuteCodeSniffer"
        label="Execute Code Sniffer with phpcs"
        id="stepExecuteCodeSniffer"
        value=1
        wire:model="stepExecuteCodeSniffer"
      >
        <x-form.input-text
          model="stepDirCodeSniffer"
          name="stepDirCodeSniffer"
          label="Dir to check with phpcs"
          help=" ">
        </x-form.input-text>
        <x-form.input-checkbox
          model="stepInstallCodeSniffer"
          name="stepInstallCodeSniffer"
          label="Install Code Sniffer phpcs"
          help="Install Code Sniffer phpcs">
        </x-form.input-checkbox>
      </x-form.input-conditional-checkbox>

    </div>

    <div class="col-span-1 ">
      <x-form.input-conditional-checkbox
        model="stepExecuteStaticAnalysis"
        name="stepExecuteStaticAnalysis"
        label="Execute Code Static Analysis"
        id="stepExecuteStaticAnalysis"
        value=1
        wire:model="stepExecuteStaticAnalysis"
      >
        <x-form.input-select
          model="stepToolStaticAnalysis"
          name="stepToolStaticAnalysis"
          label="Select Static Code Analysis Tool"
          :list="[
            'larastan'=>'Larastan (for Laravel projects)',
            'phpstan'=>'PHPstan',
            'psalmlaravel' => 'Psalm for Laravel']"
          help="Select Code Analysis Tool, Larastan for Laravel project,
PHPstan for generic PHP projects, or Psalm with Laravel plugin"
          >
        </x-form.input-select>

        <x-form.input-text
          model="stepDirStaticAnalysis"
          name="stepDirStaticAnalysis"
          label="Dir to check with Static Code Analysis Tool"
          help=" ">
        </x-form.input-text>
        <x-form.input-checkbox
          model="stepInstallStaticAnalysis"
          name="stepInstallStaticAnalysis"
          label="Install Static Code Analysis Tool"
          help="Install Static Code Analysis Tool (larastan or phpstan or psalm)">
        </x-form.input-checkbox>
        <x-form.input-checkbox
          model="stepPhpstanUseNeon"
          name="stepPhpstanUseNeon"
          label="Use phpstan.neon"
          help="Use phpstan.neon file for PHPStan configuration">
        </x-form.input-checkbox>
      </x-form.input-conditional-checkbox>

    </div>



  </div>
</fieldset>
