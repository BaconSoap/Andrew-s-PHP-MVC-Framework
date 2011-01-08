<?php
class Welcome_Controller extends Controller
{
    public $data;
    public $id;
    public $uri_helper;
    function index()
    {
        $this->uri_helper = $this->load->helper('uri');
        $this->data = "Hello!";
    }
    
    function view($id)
    {
        $this->id = $id;
    }
}