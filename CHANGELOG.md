# Changelog

## 0.7.0 - WIP
- Added Laravel 10 options for using L10 in the GitHub Actions workflows

## 0.6.2 - 2022-12-20
- PHPStan Level 6
- Support for PHP 8.2

## 0.6.1 - 2022-04-17
- added php8.1 for auto-detecting php version for matrix
- added make install command by @AlessandroMinoccheri
- fix load template for matrixTestbenchDependencies

## 0.6.0 - 2022-04-13
- upgrade to Laravel 9 framework

## 0.5.2 - 2022-04-12
- added laravel 9 mapping for testbench, thanks to @dkemper
- improve dark/light mode
- update npm packages

## 0.5.1 - 2021-11-27
Welcome PHP 8.1
- update GitHub actions workflows for 8.1
- add option for 8.1 in the UI

## 0.5.0 - 2021-11-21
- Now you can **deploy with Forge** with your CI workflow
- **UI refactoring**: Introducing DaisyUI components
- **Report** for command line execution
- Upgrade to **PHPstan 1**
- Command line: added --dry-run option
- Now is possible to **install Ghygen** with composer create-project hi-folks/ghygen


## 0.4.6 - 2021-10-23
It's still Hacktoberfest!
- Welcome to PHP 8.1, you can select PHP8.1 (experimental) to check the compatibility of your application in CICD

## 0.4.5 - 2021-10-22
It's still Hacktoberfest!
- You can schedule a workflow to run at specific UTC times using POSIX cron syntax;
- Security check

## 0.4.4 - 2021-10-21
It's still Hacktoberfest!
- Welcome --save option for CLI (you can define the filename of the workflow file);
- Set automatically the workflow filename for auto generation (to much automation ;) with --save=auto option
- Twitter card :)

## 0.4.3 - 2021-10-19
It is still Hacktoberfest!
- Psalm, create Sarif report for GitHub code scanning integration
- update to Alpinejs 3
- Allow user to set dependency stability (none, the latest stable, the lowest stable), thanks to @marulitua
- Phpstan Level 6 (from 5 to 6, report missing typehints)

## 0.4.2 - 2021-10-12
Hacktoberfest, goes on...
- Updated Cover image
- Using phpstan.neon file, thanks to @ActuallyConnor
- autodetect usage of phpstan.neon from command line
- better management of title and description in meta html tags. Thanks to @zaratedev


## 0.4.1 - 2021-10-03
It is time for Hacktoberfest!!!
- With template laravelpackage (no composer.lock), avoid cache vendors and cache package. Thanks to @hetpatel33 for the hacktoberfest contribution;
- Update PHP packages, also [Laralens 0.2.6](https://github.com/Hi-Folks/lara-lens);
- Update contributing file for new contributors.
- 
## 0.4.0 - 2021-09-15
- Add command to generate automatically GitHub Actions workflow from composer.json, .env, migrations, packages.json

## 0.3.7 - 2021-08-11

- Add launching tests via PestPHP

## 0.3.6 - 2021-06-13

### Add
- Deploy Serverless Application via Vapor

## 0.3.5 - 2021-05-17

### Add
- Deploy step with Ploi service. Thank you to @ashwind-19

## 0.3.4 - 2021-05-13

### Add
- Add wildcard for branch names
### Change
- Psalm fix MissingReturnType,MissingParamType
- clean up developments stuff after deploy
- cleaning some test workflows for GitHub Actions

## 0.3.3 - 2021-04-24

### Add
- Psalm as Static Code Analysis Tool
- Add composer install --no-dev before deploy

## 0.3.2 - 2021-04-22

### Add
- Postgresql template option

### Change
- Update some style (template cards and header)

## 0.3.1 - 2021-04-18

### Change
- Update default Node version to 15.x (stable)
- Fix some typos in the help labels in the Form
- Upgraded Node packages

## 0.3.0 - 2021-04-15

### Add
- Select Template option: Laravel application, PHP package, Laravel package ( #62 );
- Select tool for code static analysis ( #63 )  


## 0.2.5 - 2021-04-12

### Add
- New option for installing phpstan in workflow
- New option for installing phpcs in workflow
- New option for defining directory to check for phpcs ("app" default )
- New option for defining directory to check for phpstan ("app" default)
- New option for execute (or not) 'php artisan key:generate'
- New option for copying .env template
- Install Phpstan and phpcs as composer dev

### Change
- Upgrade PHP packages


## 0.2.4 - 2021-04-05

### Add
- Add Postgresql database

### Change
- Fix Dashboard when some old data is loaded (isMysqlService vs dataType)

## 0.2.3 - 2021-04-04

### Add
- Add Sqlite (in memory) support in your workflow (now the user can select: none, mysql or sqlite);
- Add Validation for Laravel version


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
