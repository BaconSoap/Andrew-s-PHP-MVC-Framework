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
    
    function model_test()
    {
        $this->posts = $this->load->model('posts');
        $this->posts->insert(array('title'=>'test'));
        $this->posts->hello();
        echo $this->posts->select('count(*)')->now();
    }
    
    function recent()
    {
        $this->posts = $this->load->model('posts');
        $this->all_posts = $this->posts->recent()->tested()->select('*')->now(true);
    }
}