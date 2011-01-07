<?php
function __autoload($class_name)
{
    //First see if the class exists as a base_ class
    if(file_exists('system/base_'.strtolower($class_name).'.php'))
    {
        require_once 'system/base_'.strtolower($class_name).'.php';
    //Then check to see if it is a controller
    } else if (substr_count($class_name, '_controller'))
    {
        require_once 'app/controllers/'.strtolower($class_name).'.php';
    }
}