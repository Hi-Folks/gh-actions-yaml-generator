# Changelog

## 0.2.4 - WIP
### Add
- Add Postgresql database

### Change
- Fix Dashboard when some old data is loaded (isMysqlService vs dataType)

## 0.2.3 - 2021-04-04
### Add
- Add Sqlite (in memory) support in your workflow (now the user can select: none, mysql or sqlite);
- Add Validation for Laravel version


### Change


## 0.2.2 - 2021-03-07
### Add
- All Hashcode configurations are logged into log_configurations table;
- Dashboard: Show the total configurations created daily;
- Add About page with /about URL.

### Change
- Dashboard: sort latest configurations by updated_at.

## 0.2.1 - 2021-02-26
### Add
- Add API for listing configurations
- Add Dashboard for showing some infos from configurations

## 0.2.0 - 2021-02-15
### Add
- Add permalink to load saved configuration
- Add Makefile for deploy
- Add check for Rate Limit https://github.com/danharrin/livewire-rate-limiting
- Add LaraLens package https://github.com/Hi-Folks/lara-lens
### Change
- Use database migrations in tests
- Change Demo URL: https://ghygen.hi-folks.dev/
- optimize js code after submit form

## 0.1.8 - 2021-02-06
### Add
- Caching node_modules directory when npm build is selected
- add check for on events (just to avoid a mix of manual/automatic behaviour)

## 0.1.7 - 2021-02-05
### Add
- Validation for some mandatory fields like name, "on events";
- Conditional validation for some mandatory fields that depend on a check (, branches if "On" event is selected, mysql parameter if Mysql service is selected);
- Add Makefile for development.
- Add Hints / Suggestions

## 0.1.6 - 2021-01-31
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
