@if ( $mysqlService )
    # Service container Mysql {{ $mysqlDatabase }}
    services:
      # Label used to access the service container
      mysql:
        # Docker Hub image (also with version)
        image: {{ $mysqlDatabase }}:{{ $mysqlVersion }}
        env:
          MYSQL_ROOT_PASSWORD: $@{{ secrets.DB_PASSWORD }}
          MYSQL_DATABASE: {{ $mysqlDatabaseName }}
        ## map the "external" 33306 port with the "internal" 3306
        ports:
          - {{ $mysqlDatabasePort }}:3306
        # Set health checks to wait until mysql database has started (it takes some seconds to start)
        options: >-
          --health-cmd="mysqladmin ping"
          --health-interval=10s
          --health-timeout=5s
          --health-retries=3
@endif
