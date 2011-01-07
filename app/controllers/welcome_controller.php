<?php
class Welcome_Controller extends Controller
{
    public $data;
    function index()
    {
        $this->data = "Hello!";
    }
}