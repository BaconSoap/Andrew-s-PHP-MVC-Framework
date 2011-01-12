<?php
class Welcome_Controller extends Controller
{
    public $data;
    public $id;
    public $uri_helper;
    function index()
    {
        $this->h = $this->load->helper('uri');
        $this->data = "Hello!";
        echo $this->h->link_to('a', 'welcome_index_path');
    }
    
    function view($id)
    {
        $this->id = $id;
    }
}