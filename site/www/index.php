<?php

date_default_timezone_set('Europe/Helsinki');

// Define path separator
defined('PATH_SEPARATOR')
    || define('PATH_SEPARATOR', '/');

defined('BASE_PATH')
    || define('BASE_PATH', realpath(dirname(__FILE__)));
    
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', BASE_PATH . '/../application/');

// Define path to library
defined('LIBRARY_PATH')
    || define('LIBRARY_PATH', BASE_PATH . '/../library/');

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(LIBRARY_PATH),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()->run();