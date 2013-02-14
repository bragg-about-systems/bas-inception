# ZfcRbac Module for Zend Framework 2 [![Master Branch Build Status](https://secure.travis-ci.org/ZF-Commons/ZfcRbac.png?branch=master)](http://travis-ci.org/ZF-Commons/ZfcRbac)

bas-inception is a module for Zend Framework 2 geared towards quick & easy Doctrine Entity generation. This module is already pre-configured and should only need calling the service and passing in your php array.

## Requirements
 - PHP 5.3 or higher
 - [Zend Framework 2](http://www.github.com/zendframework/zf2)
 - [Doctrine Module](https://www.github.com/doctrine/DoctrineModule)
 - [Doctrine ORM Module](https://github.com/doctrine/DoctrineModule)

## Installation

Installation of bas-inception uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

#### Installation steps

  1. `cd my/project/directory`
  2. create a `composer.json` file with following contents:

     ```json
     {
         "require": {
             "bragg-about-systems/bas-inception": "dev-master"
         }
     }
     ```
  3. install composer via `curl -s http://getcomposer.org/installer | php` (on windows, download
     http://getcomposer.org/installer and execute it with PHP)
  4. run `php composer.phar install`
  5. open `my/project/directory/configs/application.config.php` and add the following key to your `modules`:

     ```php
     'Inception',
     ```
