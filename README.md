# Clean Architecture in PHP

[![Build Status](https://travis-ci.com/eminetto/clean-architecture-php.svg?branch=master)](https://travis-ci.com/eminetto/clean-architecture-php)

## Install

	php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
	php -r "if (hash_file('sha384', 'composer-setup.php') === '93b54496392c062774670ac18b134c3b3a95e5a5e5c8f1a9f115f203b75bf9a129d5daa8ba6a13e2cc8a1da0806388a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
	php composer-setup.php
	php -r "unlink('composer-setup.php');"
    php composer.phar self-update
    php composer.phar install

## Tests

    ./vendor/bin/phpunit

