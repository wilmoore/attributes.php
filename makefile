all: test

test:
	vendor/bin/phpunit --verbose --testdox
