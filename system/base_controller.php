<?php

/**
 * Controller
 * This is the class that every controller MUST extend to work.
 * @package MVC
 * @author Andrew Varnerin
 * @copyright 2011
 * @version $Id$
 * @access public
 */
class Controller
{

    public $loaded_components;
    public $load;
    private $temp_controller_name;
    private $temp_view_name;
    
    public function __construct()
    {
        $this->loaded_components = array();
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
    
    /**
     * Controller::yield()
     * Yields a layout to the controller, inserting the controller's contents
     *   into the layout.
     * @return void
     */
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
     * Controller::__set()
     * Sets an undefined variable.
     * @param mixed $name
     * @param mixed $value
     * @return void
     */
    function __set($name, $value)
    {
        $this->loaded_components[$name] =& $value;
    }
    
    /**
     * Controller::__get()
     * Gets an 'undefined' variable.
     * @param mixed $name
     * @return
     */
    function __get($name)
    {
        if (isset($this->loaded_components[$name]))
        {
            return $this->loaded_components[$name];
        } else
        {
            throw new EXCEPTION('No such component');
        }
    }
}