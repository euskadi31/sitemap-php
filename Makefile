composer.phar:
	@curl -sS https://getcomposer.org/installer | php

vendor: composer.phar
	@php composer.phar install

test:
	@phpunit -c phpunit.xml.dist --coverage-text --coverage-html=build/
