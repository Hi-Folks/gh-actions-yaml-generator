# Deployment Step
    - name: Require Vapor CLI
      run: composer global require laravel/vapor-cli
    - name: Deploy Environment
      run: vapor deploy
      env:
        VAPOR_API_TOKEN: $@{{ secrets.VAPOR_API_TOKEN }}
