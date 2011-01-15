<?php
/**
 * configuration.php
 * This file loads the user's configuration data.
 * @package MVC
 * @author Andrew Varnerin
 * @copyright 2011
 * @version $Id$
 */
 
if (!isset($_BASEPATH))
{ echo "No direct access"; exit; }

$config = array();
include 'app/config.php';