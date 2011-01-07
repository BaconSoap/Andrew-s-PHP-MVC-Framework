<?php
class Welcome_Controller extends Controller
{
    public $data;
    public $id;
    function index()
    {
        $this->data = "Hello!";
    }
    
    function view($id)
    {
        $this->id = $id;
    }
}