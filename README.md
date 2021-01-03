# Laravel Github Actions Workflow Configurator

## Install
Clone source code, enter the new directory and perform a couple of instructions:
```shell
git clone https://github.com/Hi-Folks/gh-actions-yaml-generator.git
cd gh-actions-yaml-generator
cp .env.example .env
composer install
php artisan key:generate
```
Start development server
```shell
php artisan serve
```
Open the browser to the URL: http://127.0.0.1:8000

## Usage
Access to the form (by default the URL is http://127.0.0.1:8000 if you run php artisan serve), fill the form and click on "Generate Yaml File" button.
Copy the content of your Yaml file in your Laravel project in _.github/workflows/laravel_workflow.yaml_ .
Commit and push the new file.
If you configured "On - Push" you will see the running Actions in your Actions section of your GitHub project.
