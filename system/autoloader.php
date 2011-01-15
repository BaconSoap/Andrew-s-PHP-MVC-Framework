<?php
/**
 * autoloader.php
 * This file contains the magical autoloader.
 * @package MVC
 * @author Andrew Varnerin
 * @copyright 2011
 * @version $Id$
 */
 
if (!isset($_BASEPATH))
{ echo "No direct access"; exit; }

/**
 * __autoload()
 * The automagical autoloader of autorificness.
 * @param mixed $class_name
 * @return void
 */
function __autoload($class_name)
{
    $class_name = strtolower($class_name);
    
    //Check for the base controller.
    if ($class_name == 'controller')
    {
        require_once 'system/base_controller.php';
    //Check for the base model
    } else if ($class_name == 'model')
    {
        require_once 'system/base_model.php';
    //Check for the base helper.
    } else if ($class_name == 'helper')
    {
        require_once 'system/helpers/base_helper.php';
    //Check to see if a corresponding controller exists.
    } else if (substr_count($class_name, '_controller'))
    {
        require_once 'app/controllers/'.$class_name.'.php';
    //Check to see if a corresponding model exists
    } else if (substr_count($class_name, '_model'))
    {
        require_once 'app/models/'.$class_name.'.php';
    //Then check to see if it is a base helper
    } else if (file_exists('system/helpers/'.$class_name.'.php'))
    {
        require_once 'system/helpers/'.$class_name.'.php';
    }
}