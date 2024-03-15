@if ( $manual_trigger )
on: [ workflow_dispatch ]
@elseif ( $on_schedule )
on:
  schedule:
    - cron: '{{ $on_schedule_cron }}'
@else
on:
@if ( $on_push )
  push:
    branches:
@foreach ( $on_push_branches as $branch)
@if (Str::startsWith($branch, ['*', '[', '!']))
      - '{{ $branch }}'
@else
      - {{ $branch }}
@endif
@endforeach
@endif
@if ( $on_pullrequest )
  pull_request:
    branches:
@foreach ( $on_pullrequest_branches as $branch)
@if (Str::startsWith($branch, ['*', '[', '!']))
      - '{{ $branch }}'
@else
      - {{ $branch }}
@endif
@endforeach
@endif
@endif
