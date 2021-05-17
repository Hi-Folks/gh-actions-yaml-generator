# Deployment Step
    - name: Deploy via Ploi
      uses: Glennmen/ploi-deploy-action@v1.2.0
      with:
@if ( $stepDeployWebhookType === 'secret' )
        # loaded from secret
        webhook_url: $@{{ secrets.WEBHOOK_URL }}
@endif
@if ( $stepDeployWebhookType === 'hardcoded' )
        # loaded hardcoded
        webhook_url: {{ $stepDeployWebhookUrl }}
@endif
