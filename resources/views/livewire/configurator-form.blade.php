<div x-data="{ yaml: '' }">

  <div class="">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

        <div  class="bg-white p-4 bg-opacity-80 rounded-3xl flex space-x-12 items-center shadow-md hover:shadow-xl">
          <div>
            <svg class="h-32 w-32" viewBox="0 0 50 52" xmlns="http://www.w3.org/2000/svg"><title>Logomark</title><path d="M49.626 11.564a.809.809 0 0 1 .028.209v10.972a.8.8 0 0 1-.402.694l-9.209 5.302V39.25c0 .286-.152.55-.4.694L20.42 51.01c-.044.025-.092.041-.14.058-.018.006-.035.017-.054.022a.805.805 0 0 1-.41 0c-.022-.006-.042-.018-.063-.026-.044-.016-.09-.03-.132-.054L.402 39.944A.801.801 0 0 1 0 39.25V6.334c0-.072.01-.142.028-.21.006-.023.02-.044.028-.067.015-.042.029-.085.051-.124.015-.026.037-.047.055-.071.023-.032.044-.065.071-.093.023-.023.053-.04.079-.06.029-.024.055-.05.088-.069h.001l9.61-5.533a.802.802 0 0 1 .8 0l9.61 5.533h.002c.032.02.059.045.088.068.026.02.055.038.078.06.028.029.048.062.072.094.017.024.04.045.054.071.023.04.036.082.052.124.008.023.022.044.028.068a.809.809 0 0 1 .028.209v20.559l8.008-4.611v-10.51c0-.07.01-.141.028-.208.007-.024.02-.045.028-.068.016-.042.03-.085.052-.124.015-.026.037-.047.054-.071.024-.032.044-.065.072-.093.023-.023.052-.04.078-.06.03-.024.056-.05.088-.069h.001l9.611-5.533a.801.801 0 0 1 .8 0l9.61 5.533c.034.02.06.045.09.068.025.02.054.038.077.06.028.029.048.062.072.094.018.024.04.045.054.071.023.039.036.082.052.124.009.023.022.044.028.068zm-1.574 10.718v-9.124l-3.363 1.936-4.646 2.675v9.124l8.01-4.611zm-9.61 16.505v-9.13l-4.57 2.61-13.05 7.448v9.216l17.62-10.144zM1.602 7.719v31.068L19.22 48.93v-9.214l-9.204-5.209-.003-.002-.004-.002c-.031-.018-.057-.044-.086-.066-.025-.02-.054-.036-.076-.058l-.002-.003c-.026-.025-.044-.056-.066-.084-.02-.027-.044-.05-.06-.078l-.001-.003c-.018-.03-.029-.066-.042-.1-.013-.03-.03-.058-.038-.09v-.001c-.01-.038-.012-.078-.016-.117-.004-.03-.012-.06-.012-.09v-.002-21.481L4.965 9.654 1.602 7.72zm8.81-5.994L2.405 6.334l8.005 4.609 8.006-4.61-8.006-4.608zm4.164 28.764l4.645-2.674V7.719l-3.363 1.936-4.646 2.675v20.096l3.364-1.937zM39.243 7.164l-8.006 4.609 8.006 4.609 8.005-4.61-8.005-4.608zm-.801 10.605l-4.646-2.675-3.363-1.936v9.124l4.645 2.674 3.364 1.937v-9.124zM20.02 38.33l11.743-6.704 5.87-3.35-8-4.606-9.211 5.303-8.395 4.833 7.993 4.524z" fill="#FF2D20" fill-rule="evenodd"/></svg>
            <p class="text-center text-gray-500 mt-2 text-sm"></p>
          </div>
          <div>
            <p class="text-2xl font-bold text-gray-900">Laravel App</p>
            <p class="h-16 text-gray-500 text-sm mb-3">Setup Workflow for Laravel, with MySql, PHPstan, Phpcs, PHPunit</p>
            <button wire:click="template('laravelapp')"
                    class="px-4 py-1 text-sm text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2">Select</button>
          </div>
        </div>
      <div  class="bg-white p-4 bg-opacity-80 rounded-3xl flex space-x-12 items-center shadow-md hover:shadow-xl">
        <div>

          <img class="h-32 w-32" src="https://www.php.net/images/logos/new-php-logo.svg" />
          <p class="text-center text-gray-500 mt-2 text-sm"></p>
        </div>
        <div>
          <p class="text-2xl font-bold text-gray-900">PHP</p>
          <p class="h-16 text-gray-500 text-sm mb-3">Setup Workflow for PHP Package</p>
          <button wire:click="template('phppackage')"
                  class="px-4 py-1 text-sm text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2">Select</button>
        </div>
      </div>
      <div  class="bg-white p-4 bg-opacity-80 rounded-3xl flex space-x-12 items-center shadow-md hover:shadow-xl">
        <div>

          <svg class="h-32 w-32" viewBox="0 0 50 52" xmlns="http://www.w3.org/2000/svg"><title>Logomark</title><path d="M49.626 11.564a.809.809 0 0 1 .028.209v10.972a.8.8 0 0 1-.402.694l-9.209 5.302V39.25c0 .286-.152.55-.4.694L20.42 51.01c-.044.025-.092.041-.14.058-.018.006-.035.017-.054.022a.805.805 0 0 1-.41 0c-.022-.006-.042-.018-.063-.026-.044-.016-.09-.03-.132-.054L.402 39.944A.801.801 0 0 1 0 39.25V6.334c0-.072.01-.142.028-.21.006-.023.02-.044.028-.067.015-.042.029-.085.051-.124.015-.026.037-.047.055-.071.023-.032.044-.065.071-.093.023-.023.053-.04.079-.06.029-.024.055-.05.088-.069h.001l9.61-5.533a.802.802 0 0 1 .8 0l9.61 5.533h.002c.032.02.059.045.088.068.026.02.055.038.078.06.028.029.048.062.072.094.017.024.04.045.054.071.023.04.036.082.052.124.008.023.022.044.028.068a.809.809 0 0 1 .028.209v20.559l8.008-4.611v-10.51c0-.07.01-.141.028-.208.007-.024.02-.045.028-.068.016-.042.03-.085.052-.124.015-.026.037-.047.054-.071.024-.032.044-.065.072-.093.023-.023.052-.04.078-.06.03-.024.056-.05.088-.069h.001l9.611-5.533a.801.801 0 0 1 .8 0l9.61 5.533c.034.02.06.045.09.068.025.02.054.038.077.06.028.029.048.062.072.094.018.024.04.045.054.071.023.039.036.082.052.124.009.023.022.044.028.068zm-1.574 10.718v-9.124l-3.363 1.936-4.646 2.675v9.124l8.01-4.611zm-9.61 16.505v-9.13l-4.57 2.61-13.05 7.448v9.216l17.62-10.144zM1.602 7.719v31.068L19.22 48.93v-9.214l-9.204-5.209-.003-.002-.004-.002c-.031-.018-.057-.044-.086-.066-.025-.02-.054-.036-.076-.058l-.002-.003c-.026-.025-.044-.056-.066-.084-.02-.027-.044-.05-.06-.078l-.001-.003c-.018-.03-.029-.066-.042-.1-.013-.03-.03-.058-.038-.09v-.001c-.01-.038-.012-.078-.016-.117-.004-.03-.012-.06-.012-.09v-.002-21.481L4.965 9.654 1.602 7.72zm8.81-5.994L2.405 6.334l8.005 4.609 8.006-4.61-8.006-4.608zm4.164 28.764l4.645-2.674V7.719l-3.363 1.936-4.646 2.675v20.096l3.364-1.937zM39.243 7.164l-8.006 4.609 8.006 4.609 8.005-4.61-8.005-4.608zm-.801 10.605l-4.646-2.675-3.363-1.936v9.124l4.645 2.674 3.364 1.937v-9.124zM20.02 38.33l11.743-6.704 5.87-3.35-8-4.606-9.211 5.303-8.395 4.833 7.993 4.524z" fill="#FF2D20" fill-rule="evenodd"/></svg>
          <p class="text-center text-gray-500 mt-2 text-sm"></p>
        </div>
        <div>
          <p class="text-2xl font-bold text-gray-900">Laravel Package</p>
          <p class="h-16 text-gray-500 text-sm mb-3">Setup Workflow for Laravel Package</p>
          <button wire:click="template('laravelpackage')"
                  class="px-4 py-1 text-sm text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2">Select</button>
        </div>
      </div>


    </div>

    <div class="mt-5 md:mt-0 md:col-span-2">
      <form wire:submit.prevent="submitForm"  action="#" method="POST">
        @csrf
        <div class="shadow sm:rounded-md sm:overflow-hidden">
          <div class="px-4 py-5 bg-white space-y-6 sm:p-6   ">
            <x-form.input-text
                model="name"
                name="name"
                label="Name"
                value="Laravel Action Workflow"
                help="The name of your workflow. GitHub displays the names of your workflows on your repository's actions page.">
            </x-form.input-text>
            @error('name') <span class="flex items-center font-extrabold  tracking-wide text-red-800 bg-red-200 border-red-600 border-b-2  ">{{ $message }}</span> @enderror


            <fieldset  class="border-2 shadow-2xl p-4 rounded-2xl">
                <legend class="text-xl font-medium text-gray-900 px-2 pb-2">On - GitHub event that triggers the workflow.</legend>
                <div class="md:grid md:grid-cols-3 md:gap-3">
                  <div class="col-span-1 ">
                    <div class="pl-3 pb-2 mt-2 space-y-4">
                      <x-form.input-checkbox
                        model="manualTrigger"
                        name="manualTrigger"
                        label="Manual Trigger"
                        value="1"
                        help=""
                      >
                      </x-form.input-checkbox>
                    </div>
                  </div>
                  <div class="col-span-1 ">
                    <x-form.input-conditional-checkbox
                        model="onPush"
                        name="onPush"
                        label="On Push"
                        id="onPush"
                        value=1
                        wire:model="onPush"
                    >
                        <x-form.input-text
                            model="onPushBranches"
                            name="onPushBranches"
                            label="Branches"
                            help="Branches for the push, comma separated for example main,develop.">
                        </x-form.input-text>
                    </x-form.input-conditional-checkbox>
                    @error('onPushBranches') <span class="flex items-center font-extrabold  tracking-wide text-red-800 bg-red-200 border-red-600 border-b-2  ">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-span-1 ">
                    <x-form.input-conditional-checkbox
                      model="onPullrequest"
                      name="onPullrequest"
                      label="On Pull Request"
                      id="onPullrequest"
                      value=1
                      wire:model="onPullrequest"
                    >
                      <x-form.input-text
                        model="onPullrequestBranches"
                        name="onPullrequestBranches"
                        label="Branches"
                        help="Branches for the PR, comma separated for example main,develop.">
                      </x-form.input-text>
                    </x-form.input-conditional-checkbox>
                    @error('onPullrequestBranches') <span class="flex items-center font-extrabold  tracking-wide text-red-800 bg-red-200 border-red-600 border-b-2  ">{{ $message }}</span> @enderror
                  </div>
                  @error('onEvents') <div class="col-span-3 "><span class="flex items-center font-extrabold  tracking-wide text-red-800 bg-red-200 border-red-600 border-b-2  ">{{ $message }}</span></div> @enderror
                </div>
            </fieldset>

            <fieldset class="border-2 shadow-2xl p-4 rounded-2xl" x-data="{ showMysqlService: {{ $databaseType === 'mysql' ? 'true' : 'false' }}, showPostgresqlService: {{ $databaseType === 'postgresql' ? 'true' : 'false' }} }">
              <legend class="text-xl font-medium text-gray-900 px-2 pb-2">Select Database</legend>
                <x-form.input-select
                  model="databaseType"
                  name="databaseType"
                  label="Select the Database"
                  :list="['none'=>'None', 'mysql'=>'MySql Service', 'sqlite' => 'Sqlite', 'postgresql' => 'Postgresql']"
                  help="Database: *None* if you don't want a database in your workflow,o otherwise select Mysql or Sqlite"
                  multiselect=0
                  onChange='showMysqlService= $event.target.value==="mysql";showPostgresqlService= $event.target.value==="postgresql"'>
                </x-form.input-select>

                <div  x-show="showMysqlService">
                  <div class="md:grid md:grid-cols-3 md:gap-3" x-data="{ showInputPassword: {{ $mysqlPasswordType !== 'skip' ? 'true' : 'false' }} }">

                    <div class="col-span-1 ">
                      <x-form.input-text
                          model="mysqlVersion"
                          name="mysqlVersion"
                          label="Mysql Version"
                          help="Define the Mysql Version">
                      </x-form.input-text>
                      @error('mysqlVersion') <span class="flex items-center font-extrabold  tracking-wide text-red-800 bg-red-200 border-red-600 border-b-2  ">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1 ">
                      <x-form.input-text
                          model="mysqlDatabaseName"
                          name="mysqlDatabaseName"
                          label="Mysql Database Name"
                          help="Define the Mysql database name">
                      </x-form.input-text>
                      @error('mysqlDatabaseName') <span class="flex items-center font-extrabold  tracking-wide text-red-800 bg-red-200 border-red-600 border-b-2  ">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1 ">
                      <x-form.input-text
                          model="mysqlDatabasePort"
                          name="mysqlDatabasePort"
                          label="Mysql Database Port"
                          help="The Port exposed by the container, this is the external port.">
                      </x-form.input-text>
                      @error('mysqlDatabasePort') <span class="flex items-center font-extrabold  tracking-wide text-red-800 bg-red-200 border-red-600 border-b-2  ">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-2 ">
                      <x-form.input-select
                        model="mysqlPasswordType"
                        name="mysqlPasswordType"
                        label="Mysql Password: skip, or read from secret or hardcoded"
                        :list="['skip'=>'Skip', 'secret'=>'From Secret', 'hardcoded' => 'Hardcoded']"
                        help="Mysql Password: skip, or read from secret or hardcoded"
                        multiselect=0
                        onChange='showInputPassword= $event.target.value!=="skip"'>
                      </x-form.input-select>
                    </div>
                    <div class="col-span-1 " x-show="showInputPassword">
                        <x-form.input-text
                          model="mysqlPassword"
                          name="mysqlPassword"
                          label="MySql Password"
                          help="For secret, fill with the name of your parameter for example DB_PASSOWORD, for Hardcoded, fill with your password (valid only for CICD, not production or stage)">
                        </x-form.input-text>
                    </div>
                  </div>
                </div>
                <div  x-show="showPostgresqlService">
                  <div class="md:grid md:grid-cols-3 md:gap-3" x-data="{ showInputPasswordPostgresql: {{ $postgresqlPasswordType !== 'skip' ? 'true' : 'false' }} }">

                    <div class="col-span-1 ">
                      <x-form.input-text
                          model="postgresqlVersion"
                          name="postgresqlVersion"
                          label="Postgresql Version"
                          help="Define the Postgresql Version">
                      </x-form.input-text>
                      @error('postgresqlVersion') <span class="flex items-center font-extrabold  tracking-wide text-red-800 bg-red-200 border-red-600 border-b-2  ">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1 ">
                      <x-form.input-text
                          model="postgresqlDatabaseName"
                          name="postgresqlDatabaseName"
                          label="Postgresql Database Name"
                          help="Define the Postgresql database name">
                      </x-form.input-text>
                      @error('postgresqlDatabaseName') <span class="flex items-center font-extrabold  tracking-wide text-red-800 bg-red-200 border-red-600 border-b-2  ">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1 ">
                      <x-form.input-text
                          model="postgresqlDatabasePort"
                          name="postgresqlDatabasePort"
                          label="Postgresql Database Port"
                          help="The Port exposed by the container, this is the external port.">
                      </x-form.input-text>
                      @error('postgresqlDatabasePort') <span class="flex items-center font-extrabold  tracking-wide text-red-800 bg-red-200 border-red-600 border-b-2  ">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-2 ">
                      <x-form.input-select
                        model="postgresqlPasswordType"
                        name="postgresqlPasswordType"
                        label="Postgresql Password: skip, or read from secret or hardcoded"
                        :list="['secret'=>'From Secret', 'hardcoded' => 'Hardcoded']"
                        help="Postgresql Password: read from secret or hardcoded"
                        multiselect=0
                        onChange='showInputPasswordPostgresql= $event.target.value!=="skip"'>
                      </x-form.input-select>
                    </div>
                    <div class="col-span-1 " x-show="showInputPasswordPostgresql">
                        <x-form.input-text
                          model="postgresqlPassword"
                          name="postgresqlPassword"
                          label="Postgresqll Password"
                          help="For secret, fill with the name of your parameter for example DB_PASSOWORD, for Hardcoded, fill with your password (valid only for CICD, not production or stage)">
                        </x-form.input-text>
                    </div>
                  </div>
                </div>

            </fieldset>

            <fieldset class="border-2 shadow-2xl p-4 rounded-2xl">
              <legend class="text-xl font-medium text-gray-900 px-2 pb-2">Caching</legend>
              <div class="md:grid md:grid-cols-3 md:gap-3">
                <div class="col-span-1 ">
                  <div class="pl-3 pb-2 mt-2 space-y-4">
                    <x-form.input-checkbox
                      model="stepCachePackages"
                      name="stepCachePackages"
                      label="Cache PHP Packages"
                      value="1"
                      help="Enable this, to improve speed of installing packages"
                    >
                    </x-form.input-checkbox>
                  </div>
                </div>
                <div class="col-span-1 ">
                  <div class="pl-3 pb-2 mt-2 space-y-4">
                    <x-form.input-checkbox
                      model="stepCacheVendors"
                      name="stepCacheVendors"
                      label="Cache Vendor directory"
                      value="1"
                      help="Enable this, to skip installing packages using previous vendor cache"
                    >
                    </x-form.input-checkbox>
                  </div>
                </div>

                <div class="col-span-1 ">
                  <div class="pl-3 pb-2 mt-2 space-y-4">
                    <x-form.input-checkbox
                      model="stepCacheNpmModules"
                      name="stepCacheNpmModules"
                      label="Cache Npm Modules"
                      value="1"
                      help="Enable this, to use cached Npm modules"
                    >
                    </x-form.input-checkbox>
                  </div>
                </div>
              </div>
            </fieldset>

            <fieldset class="border-2 shadow-2xl p-4 rounded-2xl">
              <legend class="text-xl font-medium text-gray-900 px-2 pb-2">Environments (PHP / Node)</legend>
              <div class="md:grid md:grid-cols-2 md:gap-2">
                <div class="col-span-1 ">
                  <x-form.input-select
                    model="stepPhpVersions"
                    name="stepPhpVersions"
                    label="PHP Versions"
                    :list="['8.0'=>'8.0','7.4'=>'7.4','7.3'=>'7.3']"
                    help="Select PHP Versions (Multiple)"
                    multiselect=1>
                  </x-form.input-select>
                </div>
                <div class="col-span-1 ">
                  <x-form.input-conditional-checkbox
                    model="stepNodejs"
                    name="stepNodejs"
                    label="Install node for NPM build"
                    id="stepNodejs"
                    value=1
                    wire:model="stepNodejs"
                  >
                    <x-form.input-text
                      model="stepNodejsVersion"
                      name="stepNodejsVersion"
                      label="Node Js Version"
                      help="Define the nodejs Version">
                    </x-form.input-text>
                  </x-form.input-conditional-checkbox>
                </div>
              </div>
            </fieldset>


            @include('livewire.form.laravel-stuff')
            @include('livewire.form.code-quality')

          </div>

          <div class="flex flex-row w-full text-right">
            <div class="flex-grow px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button  type="button" class="copy-btn inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                       data-clipboard-text="{{ $result }}">
                Copy
              </button>
            </div>
            <div class="flex-grow-0 px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button type="submit" class="uppercase inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Generate Yaml File
              </button>

              <!--button x-on:click="$wire.submitForm().then(result=>{
              let yc =document.getElementById('yaml-code');
              hljs.lineNumbersBlock(yc);
              hljs.highlightBlock(yc);
              })"
              class="uppercase inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Generate Yaml File</button-->
            </div>
          </div>
        </div>
      </form>
    </div>

  </div>
  @error('yaml')
    <div class="alert flex flex-row items-center bg-red-200 p-5 rounded border-b-2 border-red-300">
      <div class="alert-icon flex items-center bg-red-100 border-2 border-red-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
				<span class="text-red-500">
					<svg fill="currentColor"
               viewBox="0 0 20 20"
               class="h-6 w-6">
						<path fill-rule="evenodd"
                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
					</svg>
				</span>
      </div>
      <div class="alert-content ml-4">
        <div class="alert-title font-semibold text-lg text-red-800">
          Error
        </div>
        <div class="alert-description text-sm text-red-600">
          {{ $message }}
        </div>
      </div>
    </div>



  @enderror

  @if ($errors->any())
    <div class="  pl-3 bg-rose-200 font-extrabold   text-red-800 bg-red-200 border-red-600 border-b-2  ">
      There was some error during validation. Take a look about your data in the form:
      <ul class="  list-inside list-disc ">
        @foreach ($errors->all() as $error)
          <li class=" pl-5">{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @foreach ($hints as $hint)

    <div class="flex items-center bg-yellow-500 border-l-4 border-yellow-700 py-2 px-3 shadow-md mb-2">
      <!-- icons -->
      <div class="text-yellow-500 rounded-full bg-white mr-3">
        <svg width="1.8em" height="1.8em" viewBox="0 0 16 16" class="bi bi-exclamation" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
        </svg>
      </div>
      <!-- message -->
      <div class="text-white font-bold  w-full ">
        {{ $hint }}
      </div>
    </div>
  @endforeach


    <div class="px-4 mt-3  ">
      <div wire:loading wire:target="submitForm">
        <div class="w-full bg-blue-500 border border-blue-200 text-blue-900  pl-4 pr-8 py-3 rounded relative" role="info">
          <strong class="font-bold">Loading</strong>
          <span class="block sm:inline">Generating Yaml file, waiting please...</span>
        </div>

      </div>
      <pre
        id="code"
        class="h-full font-mono text-sm prettyprint linenums selectable {{ $errors->has('yaml')? "bg-red-200":"" }}" data-line-numbers="true"
      ><code id="yaml-code" class="hljs yaml">{{ $result }}</code></pre>
    </div>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      // Livewire.hook('component.initialized', (component) => {})
      // Livewire.hook('element.initialized', (el, component) => {})
      // Livewire.hook('element.updating', (fromEl, toEl, component) => {})
      // Livewire.hook('element.updated', (el, component) => {})
      // Livewire.hook('element.removed', (el, component) => {})
      // Livewire.hook('message.sent', (message, component) => {})
      // Livewire.hook('message.failed', (message, component) => {})
      // Livewire.hook('message.received', (message, component) => {})
      Livewire.hook('message.processed', (message, component) => {
        let yc =document.getElementById('yaml-code');
        hljs.lineNumbersBlock(yc);
        hljs.highlightBlock(yc);
      })
    });
  </script>
</div>
