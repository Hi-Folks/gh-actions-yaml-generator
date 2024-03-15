<div class="flex flex-col lg:flex-row w-full lg:space-x-2 space-y-2 lg:space-y-0 mb-2 lg:mb-4">
  <div class="w-full lg:w-1/4">
    <div class="widget w-full p-4 rounded-lg bg-white border border-gray-100 dark:bg-gray-900 dark:border-gray-800">
      <div class="flex flex-row items-center justify-between">
        <div class="flex flex-col">
          <div class="text-xs uppercase font-light text-gray-500">Unique Configurations</div>
          <div class="text-xl font-bold">{{ $count }}</div>
        </div>
      </div>
    </div>
  </div>
  <div class="w-full lg:w-1/4">
    <div class="widget w-full p-4 rounded-lg bg-white border border-gray-100 dark:bg-gray-900 dark:border-gray-800">
      <div class="flex flex-row items-center justify-between">
        <div class="flex flex-col">
          <div class="text-xs uppercase font-light text-gray-500">Total Configurations</div>
          <div class="text-xl font-bold">{{ $total }}</div>
        </div>
      </div>
    </div>
  </div>
  <div class="w-full lg:w-1/4">
    <div class="widget w-full p-4 rounded-lg bg-white border border-gray-100 dark:bg-gray-900 dark:border-gray-800">
      <div class="flex flex-row items-center justify-between">
        <div class="flex flex-col">
          <div class="text-xs uppercase font-light text-gray-500">Last 4 Hours</div>
          <div class="text-xl font-bold">{{ $last4hours }}</div>
        </div>
      </div>
    </div>
  </div>
  <div class="w-full lg:w-1/4">
    <div class="widget w-full p-4 rounded-lg bg-white border border-gray-100 dark:bg-gray-900 dark:border-gray-800">
      <div class="flex flex-row items-center justify-between">
        <div class="flex flex-col">
          <div class="text-xs uppercase font-light text-gray-500">Last 24 Hours</div>
          <div class="text-xl font-bold">{{ $last24hours }}</div>
        </div>
      </div>
    </div>
  </div>
  <div class="w-full lg:w-1/4">
    <div class="widget w-full p-4 rounded-lg bg-white border border-gray-100 dark:bg-gray-900 dark:border-gray-800">
      <div class="flex flex-row items-center justify-between">
        <div class="flex flex-col">
          <div class="text-xs uppercase font-light text-gray-500">Last 3 Days</div>
          <div class="text-xl font-bold">{{ $last3days }}</div>
        </div>
      </div>
    </div>
  </div>

</div>
