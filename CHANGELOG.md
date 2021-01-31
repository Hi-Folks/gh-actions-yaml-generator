# Changelog

## 0.1.6 - WIP
### Add
- Add Laravel Matrix (for Laravel 8, Laravel 7 and Laravel 6)
- Add caching Schema Yaml file (to improve the speed during Yaml checks)

## 0.1.5 - 2021-01-23
### Add
- Add syntax highlight for Yaml workflow file
- Add copy button. ONce the Yaml is generated, you can click Copy Button in order to copy in the clipboard the content (so you can paste in your .github/workflows/*.yml file)
- Add Open Graph meta in the main page
- Add Larastan for phpstan, for a better compatibility with Laravel for static code analysis

### Change
- fix margin and padding for checkboxes
- change input colors, from indigo to blue
- Fix load env parameters (load DB_ parameters only if database is needed)
- Fix Chrome driver version for Browser Tests (Laravel Dusk)

## 0.1.4 - 2021-01-15
### Add
- new .env parameter for forcing HTTPS for assets: APP_FORCE_HTTPS;
- using Larastan (to enhance the compatibility for phpstan with Laravel)
- adding check for Laravel Dusk, so your workflow can launch browser test directly in the CICD


## 0.1.3 - 2021-01-07
### Add
- Validate Yaml file generated
- Show errors if there is some syntax error in Yaml file

### Change
- red background if some error happens during the generation of Yaml file


## 0.1.2 - 2021-01-05
### Add
- Tests execution (via phpunit)
- Code Sniffer (via phpcs)
- Static Analysis (via phpstan)
- Select Mysql Password: skip / from secret / hardcoded
- Run migrations (php artisan migrate)
- Nodejs setup (optional)
- Npm packages installation
- Caching Npm packages

### Change
- fix array/string conversion for branches


## 0.1.1 (Proof of Concept) - 2021-01-03

### Change
- MYSQL_ALLOW_EMPTY_PASSWORD for mysql container service
- use features/** for triggering actions on push event
- fix indent _jobs_ in yaml file

## 0.1.0 (Proof of Concept) - 2021-01-03

### Add
- initial release
- Collect some parameters about:
    - name of workflow;
    - "On" (events that trigger the workflow); 
    - setup mysql service container;
    - Caching vendors and packages;
    - select PHP versions;
    - select NodeJs version (for npm build);
    - some specific Laravel stuff (.env file, fix storage permissions).
- Generate Yaml file
