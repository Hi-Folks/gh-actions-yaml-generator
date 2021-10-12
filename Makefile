.PHONY : help phpstan test coverage phpcs
.DEFAULT_GOAL:=help

help:           ## Show this help.
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'

phpstan: ## Execute phpstan
	vendor/bin/phpstan analyse -c ./phpstan.neon --no-progress

test: ## Execute phpunit
	php artisan test

coverage: ## Execute the coverage test
	vendor/bin/phpunit --coverage-text

phpcs: ## execute phpcs
	phpcs --standard=PSR12 app

phpfix: ## Fix some warnings from phpcs
	phpcbf --standard=PSR12  app
	git commit -m "Auto Fix PSR12 Style" .

allcheck: phpcs phpstan test ## it performs all check (phpcs, phpstan, tests)

push: allcheck ## It performs all check and then git push on the current branch
	git push origin HEAD
