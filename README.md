<p align=center>
    <a href="https://github.com/Hi-Folks/gh-actions-yaml-generator/actions"><img src="https://img.shields.io/github/actions/workflow/status/Hi-Folks/gh-actions-yaml-generator/check-php.yml?branch=develop&style=for-the-badge" alt="GitHub Workflow Status (develop branch)"></a>
    <a href="https://github.com/Hi-Folks/gh-actions-yaml-generator/releases"><img src="https://img.shields.io/github/v/release/Hi-Folks/gh-actions-yaml-generator?style=for-the-badge" alt="GitHub release (latest by date)"></a>
    <a href="https://ghygen.hi-folks.dev/"><img src="https://img.shields.io/website?label=Demo%20Site&style=for-the-badge&url=https%3A%2F%2Fghygen.hi-folks.dev%2F" alt="Website"></a>
</p>

![Ghygen](ghygen-github-actions-yaml-generator-laravel.png "Ghygen")

<h1 align=center>
    Ghygen
</h1>

<p align=center>
    <i><b>Ghygen</b> is a GitHub Actions configurator for your PHP / Laravel project.</i>
</p>

__Ghygen__ allows you creating your __Yaml__ file for __GitHub Actions__, for Laravel/PHP web application,  so you can:

- select triggering events: manually or automatically, when the developer _push_ the code on a specific branch, or a developer create a new _Pull Request_;
- select branches;
- enable caching for all vendors;
- enable __caching__ PHP packages;
- select __multiple__ PHP versions (8.3, 8.2, 8.1, 8.0, 7.4);
- select __multiple Laravel__ versions (11, 10, 9, 8, 7, 6), useful if you are developing a Laravel Package and you want to test it with multiple Laravel version;
- select __Node__ version for NPM (executing scripts via `npm run`);
- caching node packages;
- setup __Mysql__ Database service;
- setup __PostgreSQL__ Database service;
- setup __Sqlite__ in memory database;
- run migrations;
- __execute tests__ via phpunit;
- __execute tests__ via PestPHP;
- static __code analysis__ with phpstan or psalm;
- create Sarif report (with Psalm) for __GitHub integration with code scanning__;
- code sniffer (via phpcs for __PSR12__ compatibility);
- __validate Yaml__ file;
- execute __Browser Test__ via Laravel Dusk.
- Run __Deployments__ via Ploi using [Ploi Deploy Action](https://github.com/Glennmen/ploi-deploy-action).

If you want to test and use quickly this tool, I deployed the codebase (`develop` branch) on Digital Ocean Platform:

- [Ghygen Demo](https://ghygen.hi-folks.dev/).

If you want to start using it locally you can clone the repo and install it following the instructions below.

## Command line
Ghygen is also a command line tool for generating **automatically** a GitHub Actions workflow Yaml file.
You can install Gygen as project with composer:
```shell
composer create-project hi-folks/ghygen
cd ghygen
```
Once you installed Ghygen, you can execute:
```shell
php artisan ghygen:generate --projectdir=../otherproject
```
Where `../otherproject` is the directory (absolute or relative path name) with your Laravel project (application or package) that yuo want to automatically generate the GitHub Actions workflow yaml file.

This command, will extract information from some project file like:
- `composer.json`
- `package.json` (if it exists)
- `.env` file
- ... and other assets 

in order to guess a configuration for your GitHub Actions workflow.

By default, the command execution will show the Yaml workflow file in the standard output. If you want to save it in a file, for example the "my-workflow.yml" file, you can use `--save` option:
```shell
php artisan ghygen:generate  --save=my-workflow.yml
```

If you want to autogenerate Yaml file in the `.github/workflows` directory use `--save=auto`:

```shell
php artisan ghygen:generate  --save=auto
```

The file name will be created with the `name` value found in the `composer.json`.

So if you want to generate the workflow for the project in the directory `../myproject`, you can execute the command with `--projectdir` and the `--save` options:

```shell
php artisan ghygen:generate --projectdir=../myproject/ --save=auto
```

## The Ghygen Web version
### Install the Web version

For running the Web version of Ghygen, you can clone source code, enter the new directory and perform a couple of instructions:
```shell
git clone https://github.com/Hi-Folks/gh-actions-yaml-generator.git
cd gh-actions-yaml-generator
make install
```
Then create your database and update the .env file with the right values for DB_* .

Once your Database is configured you can execute the migrations:
```shell
php artisan migrate
```
Start development server
```shell
php artisan serve
```
Open the browser to the URL: http://127.0.0.1:8000

### Usage
Follow these steps:
- access to the form (by default the URL is http://127.0.0.1:8000 if you run php artisan serve);
- fill the form;
- click on "Generate Yaml File" button.

![github-actions-generator-laravel](github-actions-generator-laravel.png "github-actions-generator-laravel")

Next, copy the content of your generated Yaml in a new file in your Laravel project _.github/workflows/laravel_workflow.yaml_ .

Commit and push the new file.

If you configured "On - Push" you will see the running Actions in your Actions section of your GitHub project.

## Thanks to

Thanks to all the people for providing feedback, opening issues, creating Pull Requests.
Thank you to all the contributors! You can see the list of contributors [at this section](https://github.com/Hi-Folks/gh-actions-yaml-generator/graphs/contributors).

In the PHP ecosystem, we have many tools that help developers work with great productivity, reliability, and efficiency. One of these tools is JetBrains PHP Storm.
JetBrains supports the open-source community by providing licenses for open-source projects.
You can find more information in the [Open Source section of the JetBrains website](https://jb.gg/OpenSourceSupport).

<img src="https://resources.jetbrains.com/storage/products/company/brand/logos/PhpStorm_icon.png" alt= "PhpStorm logo" width="128" height="128">


JetBrains is providing me the license for the Ghygen project.
This fills me with joy, because Ghygen has been recognized as a deserving open-source software.
Thank you.
