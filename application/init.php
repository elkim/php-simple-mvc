<?php

ob_start();

define('DS', '/');

define('APPS_DIR', ROOT_DIR . DS . 'application/');
define('BASE_DIR', APPS_DIR . 'base/');
define('VIEWS_DIR', ROOT_DIR . DS . 'views/');
define('LAYOUTS_DIR', ROOT_DIR . DS . 'layouts/');

define('CONTROLLERS_DIR', APPS_DIR . 'controllers/');
define('MODELS_DIR', APPS_DIR . 'models/');

require(BASE_DIR . 'pdo.php');
require(BASE_DIR . 'error.php');
require(BASE_DIR . 'model.php');
require(BASE_DIR . 'controller.php');
require(BASE_DIR . 'view.php');
require(BASE_DIR . 'loader.php');
require(BASE_DIR . 'service.php');

$loader = new BaseLoader();
$loader->execute();