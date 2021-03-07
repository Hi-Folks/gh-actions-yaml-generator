
    <footer class="w-full text-gray-700 bg-gray-100 body-font">
        <div
            class="container flex flex-col flex-wrap px-5 py-10 mx-auto md:items-center lg:items-start md:flex-row md:flex-no-wrap">
            <div class="flex-shrink-0 w-64 mx-auto text-center md:mx-0 md:text-left">
                <a class="flex items-center justify-center font-medium text-gray-900 title-font md:justify-start">
                {{ config("app.name") }}
                </a>
                <p class="mt-2 text-sm text-gray-500">Github Actions Workflow Configurator</p>
            </div>
            <div class="flex flex-wrap flex-grow text-center lg:-mb-10 md:mt-0">
                <div class="w-full px-4 mt-4 lg:w-1/3 md:w-1/3">
                    <a class="text-gray-500 cursor-pointer hover:text-gray-900" href="https://github.com/Hi-Folks/gh-actions-yaml-generator">Source Code</a>
                </div>

                <div class="w-full px-4 mt-4 lg:w-1/3 md:w-1/3">
                    <a class="text-gray-500 cursor-pointer hover:text-gray-900" href="{{ config("app.url") }}">Home</a>
                </div>
              <div class="w-full px-4 mt-4 lg:w-1/3 md:w-1/3">
                <a class="text-gray-500 cursor-pointer hover:text-gray-900" href="{{ route("about") }}">What is Ghygen?</a>
              </div>
            </div>
        </div>
    </footer>
