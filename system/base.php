<?php
require_once 'autoloader.php';
require_once 'dispatcher.php';
require_once 'loader.php';
include 'configuration.php';

$load = new Loader();
Dispatcher::$stat_dispatcher =& $load;
//Start the buffers!
ob_start();

$dispatcher = new Dispatcher($config);
$dispatcher->config = $config;

$dispatcher->dispatch();

//The action is over. Flush the buffer and go home.
ob_flush();