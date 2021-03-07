<div class="flex flex-col">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <x-table.title>
          Daily configurations
        </x-table.title>

        <table class="w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
          <tr>
            <x-table.th >Date</x-table.th>
            <x-table.th >Counts</x-table.th>

          </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">

          @foreach($daily as $date => $count)
            <tr class="">
              <x-table.td>
                {{ $date }}
              </x-table.td>
              <x-table.td align="right">
                {{ $count }}
              </x-table.td>

            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


