<?php
class Controller
{

    public $load;
    public $uri_helper;
    
    public function __construct()
    {
    }
    
    public function render($controller_name, $view_name)
    {
        require_once 'app/views/'.strtolower(substr($controller_name, 0, -11)).'/'.strtolower($view_name).'_view.php';
    }
    
    function link_to($text, $place)
    {
        if (!isset($this->uri_helper))
        {
            $this->uri_helper = $this->load->helper('uri');
        }
        $this->uri_helper->link_to($text, $place);
    }
}