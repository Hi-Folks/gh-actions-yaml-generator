@if ( $databaseType === "postgresql" )
    # Service container Postgresql {{ $postgresqlDatabase }}
    services:
      # Label used to access the service container
      postgres:
        # Docker Hub image (also with version)
        image: postgres:{{ $postgresqlVersion }}
        env:
          POSTGRES_USER: postgres
@if ( $postgresqlPasswordType === 'secret' )
          POSTGRES_PASSWORD: $@{{ secrets.DB_PASSWORD }}
@endif
@if ( $postgresqlPasswordType === 'hardcoded' )
          POSTGRES_PASSWORD: {{ $postgresqlPassword }}
@endif
          POSTGRES_DB:  {{ $postgresqlDatabaseName }}
        ## map the "external" 55432 port with the "internal" 5432
        ports:
          - {{ $postgresqlDatabasePort }}:5432
        # Set health checks to wait until postgresql database has started (it takes some seconds to start)
        options: >-
          --health-cmd pg_isready
          --health-interval 10s
          --health-timeout 5s
          --health-retries 5
@endif
