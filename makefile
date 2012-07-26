all: test

test:
	vendor/bin/phpunit --verbose --testdox

test-coverage:
	vendor/bin/phpunit --verbose --coverage-text
