# Deployment Step
    - name: Setup SSH
      uses: webfactory/ssh-agent@v0.7.0
      with:
        ssh-private-key: $@{{ secrets.SSH_PRIVATE_KEY }}
    - name: Require Forge CLI
      run: composer global require laravel/forge-cli
    - name: Deploy Site
      run: |
        forge server:switch {{ $stepDeployForgeServerName }}
        forge deploy {{ $stepDeployForgeSiteName}}
      env:
        FORGE_API_TOKEN: $@{{ secrets.FORGE_API_TOKEN }}
