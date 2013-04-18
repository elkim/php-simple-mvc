<?php

ob_start();

define('DS', '/');

define('APPS_DIR', ROOT_DIR . DS . 'application/');
define('BASE_DIR', APPS_DIR . 'base/');
define('VIEWS_DIR', ROOT_DIR . DS . 'views/');

define('CONTROLLERS_DIR', APPS_DIR . 'controllers/');
define('MODELS_DIR', APPS_DIR . 'models/');

require(BASE_DIR . 'controller.php');
require(BASE_DIR . 'view.php');
require(BASE_DIR . 'loader.php');

//TODO: add config file
//TODO: sanitize request

$loader = new BaseLoader();
$loader->execute();
