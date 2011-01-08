<?php
/**
 * Dispatcher
 * This does the heavy lifting of mapping URI's to controllers, and then loading them.
 * @author Andrew Varnerin
 * @todo Make a filter list to protect against attacks. Filter non-user-defined routes.
 * @todo Make a routes.php file and make the routing not-automagic by default.
 */

class Dispatcher
{
    public $config;
    private $uri; //The URI represented as an exploded array;
    private $controller;
    private $function;
    private $params;
    public $load;


    /**
     * Dispatcher::__construct()
     * 
     * @return
     */
    public function __construct()
    {
        //Split the URI into segments.
        $this->uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        //Filter the junk out of the URI
        $pos = array_search('index.php', $this->uri);
        $new_uri = null;
        for ($i = $pos + 1; $i < count($this->uri); $i++) {
            $new_uri[$i - $pos - 1] = $this->uri[$i];
        }
        $this->uri = $new_uri;
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
        if (!is_null($this->params))
        {
            $this->load->controller($this->controller, $this->function, $this->params);
        } else if (!is_null($this->function))
        {
            $this->load->controller($this->controller, $this->function);
        } else if (!is_null($this->controller))
        {
            $this->load->controller($this->controller);
        } else
        {
            $this->load->controller($this->config['default_controller'], $this->config['default_function'], $this->config['default_params']);
        }
    }

    /**
     * Dispatcher::_get_controller()
     * Gets the controller segment from the URI array.
     * @return If there is a controller in the URI, grab that, else null
     */
    private function _get_controller()
    {
        if (isset($this->uri[0])) {
            return $this->uri[0];
        }
        return null;
    }

    /**
     * Dispatcher::_get_function()
     * Gets the function segment from the URI array.
     * @return If there is a function in the URI, grab that, else null
     */
    private function _get_function()
    {
        if (isset($this->uri[1])) {
            return $this->uri[1];
        }
        return null;
    }

    /**
     * Dispatcher::_get_params()
     * Gets the parameters segment from the URI array. It trims the unnecessary
     * segments from the beginning of the array.
     * @return If there is are parameters in the URI, grab those, else null
     */
    private function _get_params()
    {
        if (isset($this->uri[2])) {
            $params = array();
            for ($i = 2; $i < count($this->uri); $i++) {
                $params[$i - 2] = $this->uri[$i];
            }
            return $params;
        }
        return null;
    }
}
