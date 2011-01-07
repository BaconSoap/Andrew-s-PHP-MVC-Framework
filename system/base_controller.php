<?php
class Controller
{

    public $loader;
    
    public function __construct()
    {
    }
    public function render($controller_name, $view_name)
    {
        require_once 'app/views/'.strtolower(substr($controller_name, 0, -11)).'/'.strtolower($view_name).'_view.php';
    }
}