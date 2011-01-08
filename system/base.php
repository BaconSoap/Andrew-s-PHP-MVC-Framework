<?php
require_once 'autoloader.php';
require_once 'dispatcher.php';
require_once 'loader.php';

/**
 * App defaults
 * @todo Extract these into application-specific settings
 */

Dispatcher::$default_controller = "welcome";
Dispatcher::$default_function = null;
Dispatcher::$default_params = null;

$loader = new Loader();

//Start the buffers!
ob_start();

$dispatcher = new Dispatcher();
$dispatcher->loader =& $loader;
$dispatcher->dispatch();

//The action is over. Flush the buffer and go home.
ob_flush();