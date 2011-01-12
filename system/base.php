<?php
require_once 'autoloader.php';
require_once 'dispatcher.php';
require_once 'loader.php';
include 'configuration.php';

if (!isset($_BASEPATH))
{ echo "No direct access"; exit; }

//Load the loader & user configuration send them down the chain.
$load = new Loader();
$load->config = $config;
Dispatcher::$stat_loader =& $load;

//Start the buffers!
ob_start();
$dispatcher = new Dispatcher();
$dispatcher->dispatch();

//The action is over. Flush the buffer and go home.
ob_flush();