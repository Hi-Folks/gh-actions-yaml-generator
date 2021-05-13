@if ( $deployType === "ploi" )
      # Deploy to Ploi
      uses: Glennmen/ploi-deploy-action@v1.2.0
      with:
@if ( $webhookType === 'secret' )
        webhook_url: $@{{ secrets.WEBHOOK_URL }}
@endif
@if ( $webhookType === 'hardcoded' )
        webhook_url: {{ $webhookUrl }}
@endif        
@endif