.PHONY : help phpstan test coverage phpcs psalm
.DEFAULT_GOAL:=help

help:           ## Show this help.
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'

phpstan: ## Execute phpstan
	composer phpstan

psalm: ## execute psalm
	vendor/bin/psalm

test: ## Execute phpunit
	composer test

coverage: ## Execute the coverage test
	composer test

phpcs: ## execute phpcs
	composer cs

phpfix: ## Fix some warnings from phpcs
	vendor/bin/phpcbf --standard=PSR12  app
	git commit -m "Auto Fix PSR12 Style" .

allcheck: phpcs phpstan test ## it performs all check (phpcs, phpstan, tests)

push: allcheck ## It performs all check and then git push on the current branch
	git push origin HEAD

install: ## executes composer install, key:generate and npm install
	cp .env.example .env
	composer install
	php artisan key:generate
	npm i
	npm run production
