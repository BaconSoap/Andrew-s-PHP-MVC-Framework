<?php
/**
 * Dispatcher
 * This does the heavy lifting of mapping URI's to controllers, and then loading them.
 * @author Andrew Varnerin
 */

class Dispatcher
{
    public static $default_controller;
    public static $default_function;
    public static $default_params;
    private $uri; //The URI represented as an exploded array;
    private $controller;
    private $function;
    private $params;
    public $loader;
    

    /**
     * Dispatcher::__construct()
     * 
     * @return
     */
    public function __construct() {
        //Split the URI into segments.
        $this->uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        //Filter the junk out of the URI
        $pos = array_search('index.php', $this->uri);
        //Grabs the controller, function, and any paramaters.
        $this->controller = $this->_get_controller();
        $this->function = $this->_get_function();
        $this->params = $this->_get_params();
    }

    /**
     * Dispatcher::dispatch()
     * Loads the controller
     */
    public function dispatch()
    {
        if(!is_null($this->params))
        {
            
        } else if (!is_null($this->function))
        {
            
        } else if (!is_null($this->controller))
        {
            
        } else
        {
            $this->loader->load_controller(Dispatcher::$default_controller, Dispatcher::$default_function, Dispatcher::$default_params);
        }
    }
    
    /**
     * Dispatcher::_get_controller()
     * Gets the controller segment from the URI array.
     * @return If there is a controller in the URI, grab that, else null
     */
    private function _get_controller()
    {
        //$this->uri
        return null;
    }
    
    /**
     * Dispatcher::_get_function()
     * Gets the function segment from the URI array.
     * @return If there is a function in the URI, grab that, else null
     */
    private function _get_function()
    {
        return null;
    }
    
    /**
     * Dispatcher::_get_params()
     * Gets the parameters segment from the URI array.
     * @return If there is are parameters in the URI, grab those, else null
     */
    private function _get_params()
    {
        return null;
    }
}