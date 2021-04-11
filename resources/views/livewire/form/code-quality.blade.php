<fieldset class="border-2 shadow-2xl p-4 rounded-2xl">
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
          model="stepExecuteCodeSniffer"
          name="stepExecuteCodeSniffer"
          label="Execute Code Sniffer with phpcs"
          help="Execute Code Sniffer with phpcs">
        </x-form.input-checkbox>
      </div>
    </div>

    <div class="col-span-1 ">
      <div class="pl-3 pb-2 mt-2 space-y-4">
        <x-form.input-checkbox
          model="stepExecuteStaticAnalysis"
          name="stepExecuteStaticAnalysis"
          label="Execute Code Static Analysis"
          help="Execute Code Static Analysis via phpstan and larastan">
        </x-form.input-checkbox>
      </div>
    </div>


    <div class="col-span-1 ">
      <div class="pl-3 pb-2 mt-2 space-y-4">
        <x-form.input-checkbox
          model="stepDusk"
          name="stepDusk"
          label="Execute Browser Test"
          help="Execute Browser Test via Laravel Dusk">
        </x-form.input-checkbox>
      </div>
    </div>
  </div>
</fieldset>
