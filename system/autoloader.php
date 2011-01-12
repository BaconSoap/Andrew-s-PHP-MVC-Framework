<?php
if (!isset($_BASEPATH))
{ echo "No direct access"; exit; }
function __autoload($class_name)
{
    $class_name = strtolower($class_name);
    
    //Check for the base controller.
    if ($class_name == 'controller')
    {
        require_once 'system/base_controller.php';
    //Check for the base helper.
    } else if ($class_name == 'helper')
    {
        require_once 'system/helpers/base_helper.php';
    //Check to see if a corresponding controller exists.
    } else if (substr_count($class_name, '_controller'))
    {
        require_once 'app/controllers/'.$class_name.'.php';
    //Then check to see if it is a base helper
    } else if (file_exists('system/helpers/'.$class_name.'.php'))
    {
        require_once 'system/helpers/'.$class_name.'.php';
    }
}