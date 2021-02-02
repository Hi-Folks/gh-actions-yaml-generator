.PHONY : help phpstan test coverage phpcs


help:           ## Show this help.
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'

phpstan: ## Execute phpstan
	vendor/bin/phpstan analyse app -c ./vendor/nunomaduro/larastan/extension.neon  --level=4 --no-progress

test: ## Execute phpunit
	vendor/bin/phpunit

coverage: ## Execute the coverage test
	vendor/bin/phpunit --coverage-text

phpcs: ## execute phpcs
	phpcs --standard=PSR12 app

allcheck: phpcs phpstan test ## all check
