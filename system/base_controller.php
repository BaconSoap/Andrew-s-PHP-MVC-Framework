<?php
class Controller
{

    public $load;
    public $uri_helper;
    private $temp_controller_name;
    private $temp_view_name;
    
    public function __construct()
    {
    }
    
    /**
     * Controller::render()
     * Render the view belonging to an action.
     * @param mixed $controller_name
     * @param mixed $view_name
     * @return void
     */
    public function render($controller_name, $view_name)
    {
        if(file_exists('app/views/layouts/application_layout.php'))
        {
            $this->temp_controller_name = $controller_name;
            $this->temp_view_name = $view_name;
            require_once 'app/views/layouts/application_layout.php';
        } else
        {
            require_once 'app/views/'.strtolower(substr($controller_name, 0, -11)).'/'.strtolower($view_name).'_view.php';
        }
    }
    
    protected function yield()
    {
        require_once 'app/views/'.strtolower(substr($this->temp_controller_name, 0, -11)).'/'.strtolower($this->temp_view_name).'_view.php';
    }
    
    /**
     * Controller::render_partial()
     * Renders a partial.
     * @param mixed $partial_name
     * @return void
     */
    public function render_partial($partial_name)
    {
        $class_name = substr(strtolower(get_class($this)), 0, -11);
        require 'app/views/'.$class_name.'/_'.$partial_name.'.php';
    }
    
    /**
     * Loads the URI helper.
     */
    private function _load_uri_helper()
    {
        if (!isset($this->uri_helper))
        {
            $this->uri_helper = $this->load->helper('uri');
        }
    }
    
    
    /**
     * Controller::link_to()
     * Creates a link to another controller & action.
     * @param mixed $text The anchor text
     * @param mixed $place The place to link to. Ex: "posts_all_path"
     * @return void
     */
    function link_to($text, $place)
    {
        $this->_load_uri_helper();
        $this->uri_helper->link_to($text, $place);
    }
    
    /**
     * Adds a stylesheet link.
     */
    function style_link($sheet)
    {
        $this->_load_uri_helper();
        $this->uri_helper->style_link($sheet);
    }
}