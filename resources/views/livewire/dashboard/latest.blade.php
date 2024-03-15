<div class="flex flex-col">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <x-table.title>
          Latest configurations
        </x-table.title>

        <table class="w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
          <tr>
            <x-table.th >Code</x-table.th>
            <x-table.th >Title</x-table.th>
            <x-table.th >Database</x-table.th>
            <x-table.th >Updated At</x-table.th>
            <x-table.th >Counts</x-table.th>

          </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">

          @foreach( $latest as $l)
          <tr class="">
            <x-table.td>
              <x-table.link url='{{ route("index", ["code" => $l->code ]) }}'>{{ $l->code }}</x-table.link>
            </x-table.td>
            <x-table.td align="left">
              {{ $l->configuration->name }}
            </x-table.td>

            <x-table.td align="left">

              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">

                {{ $l->getDatabaseType() }}
                  @if ($l->isMysqlService() )
                    {{ $l->configuration->mysqlVersion }}
                  @endif
                @if ($l->isPostgresqlService() )
                  {{ $l->configuration->postgresqlVersion }}
                @endif
              </span>

            </x-table.td>
            <x-table.td align="left">
              {{ $l->updated_at }}
            </x-table.td>
            <x-table.td align="right">
                {{ $l->counts }}
            </x-table.td>
          </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
