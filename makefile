all: test

test: vendor
	@vendor/bin/phpunit --verbose --testdox

test-coverage: vendor
	@vendor/bin/phpunit --verbose --coverage-text

composer.phar:
	@curl -s http://getcomposer.org/composer.phar -O
	@chmod +x composer.phar

vendor: composer.phar
	@./composer.phar install

