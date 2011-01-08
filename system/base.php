<?php
require_once 'autoloader.php';
require_once 'dispatcher.php';
require_once 'loader.php';
include 'configuration.php';

$load = new Loader();

//Start the buffers!
ob_start();

$dispatcher = new Dispatcher();
$dispatcher->config =& $config;
$dispatcher->load =& $load;
$dispatcher->dispatch();

//The action is over. Flush the buffer and go home.
ob_flush();