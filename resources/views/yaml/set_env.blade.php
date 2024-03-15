# Set environment
      env:
@if ( $databaseType === "mysql")
@if ( $mysqlDatabase != "")
        DB_CONNECTION: {{ $mysqlDatabase }}
@endif
@if ( $mysqlDatabaseName != "")
        DB_DATABASE: {{ $mysqlDatabaseName }}
@endif
@if ( $mysqlDatabasePort != "")
        DB_PORT: {{ $mysqlDatabasePort }}
@endif
        DB_USER: root
@if ( $mysqlPasswordType === 'skip' )
@endif
@if ( $mysqlPasswordType === 'secret' )
        DB_PASSWORD: $@{{ secrets.DB_PASSWORD }}
@endif
@if ( $mysqlPasswordType === 'hardcoded' )
        DB_PASSWORD: {{ $mysqlPassword }}
@endif
@elseif ( $databaseType === "postgresql")
        DB_CONNECTION: pgsql
@if ( $postgresqlDatabaseName != "")
        DB_DATABASE: {{ $postgresqlDatabaseName }}
@endif
@if ( $postgresqlDatabasePort != "")
        DB_PORT: {{ $postgresqlDatabasePort }}
@endif
        DB_USERNAME: postgres
@if ( $postgresqlPasswordType === 'secret' )
        DB_PASSWORD: $@{{ secrets.DB_PASSWORD }}
@endif
@if ( $postgresqlPasswordType === 'hardcoded' )
        DB_PASSWORD: {{ $postgresqlPassword }}
@endif
@else
        SESSION_DRIVER: array
@endif
@if ( $databaseType === "sqlite" )
        DB_CONNECTION: sqlite
        DB_DATABASE: ":memory:"
@endif
