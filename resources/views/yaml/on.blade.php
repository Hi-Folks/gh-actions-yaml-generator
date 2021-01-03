@if ( $manual_trigger )
on: [ workflow_dispatch ]
@else
on:
@if ( $on_push )
  push:
    branches:
    @foreach ( $on_push_branches as $branch)
      - {{ $branch }}
    @endforeach
@endif
@if ( $on_pullrequest )
  pull_request:
    branches:
    @foreach ( $on_pullrequest_branches as $branch)
      - {{ $branch }}
    @endforeach
@endif
@endif
