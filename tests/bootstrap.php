<?php

use Nip\Container\Container;
use Nip\Inflector\Inflector;

require dirname(__DIR__).'/vendor/autoload.php';

define('PROJECT_BASE_PATH', __DIR__.'/..');
define('TEST_BASE_PATH', __DIR__);
define('TEST_FIXTURE_PATH', __DIR__.DIRECTORY_SEPARATOR.'fixtures');

$container = new Container();
$container->set('inflector', new Inflector());
$container->set('config', new \Nip\Config\Config());

Container::setInstance($container);
