# Set environment
      env:
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
