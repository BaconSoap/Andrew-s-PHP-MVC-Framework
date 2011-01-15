<?php

/**
 * Dispatcher
 * This does the heavy lifting of mapping URI's to controllers, and then
 *   loading them.
 * @package MVC
 * @author Andrew
 * @copyright 2011
 * @version $Id$
 * @access public
 */
class Dispatcher
{
    public $config;
    
    private $uri; //The URI represented as an exploded array;
    private $controller;
    private $function;
    private $params;
    
    public $load;
    
    private $routes;
    private $routes_helpers;
    public static $stat_loader;
    
    /**
     * Dispatcher::__construct()
     * Constructs a Dispatcher and loads all of the components necessary for an
     *   application to run.
     * @return
     */
    public function __construct()
    {
        $this->load =& Dispatcher::$stat_loader;
        $this->config = $this->load->config;
        //Split the URI into segments.
        $this->uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        //Filter the junk out of the URI
        $pos = array_search('index.php', $this->uri);
        $new_uri = null;
        for ($i = $pos + 1; $i < count($this->uri); $i++) {
            $new_uri[$i - $pos - 1] = $this->uri[$i];
        }
        
        $this->uri = $new_uri;
        if($this->_get_controller().'/'.$this->_get_function().'/' != $this->uri)
        {
            $this->params = $this->_get_params();
            $this->uri = array($this->_get_controller(), $this->_get_function());
        }
        //Grabs the controller, function, and any paramaters.
        if ($this->config['automagic_routes'])
        {
            $this->controller = $this->_get_controller();
            $this->function = $this->_get_function();
            $this->params = $this->_get_params();
        }
        //Load the routes and routes helpers.
        $this->_load_routes();
        $this->load->uri_helpers = $this->routes_helpers;
    }

    /**
     * Dispatcher::dispatch()
     * Loads a controller
     */
    public function dispatch()
    {
        //If we are dealing with with a real URI, join it together again.
        if(count($this->uri) > 0)
        {
            $joined_uri = join("/", $this->uri);
        //Check to see if we are dealing with nothing. Reroute to defaults now.
        } else
        {
            $joined_uri = $this->config['default_controller'].'/'.$this->config['default_function'];
        }
        //Automagic routing. Dangerous...
        if ($this->config['automagic_routes'] === true)
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
        //Safe routing, using only defined routes.
        } else if (isset($this->routes[$joined_uri]))
        {
            $this->load->controller($this->routes[$joined_uri]['controller'],$this->routes[$joined_uri]['function'], $this->params);
        //At this point, we have nothing. 404 page to the rescue!.
        } else
        {
            require('404.html');
            exit();
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
    
    
    /**
     * Dispatcher::_load_routes()
     * Loads the routes into the array.
     * @return void
     */
    private function _load_routes()
    {
        include "app/routes.php";
    }
    
    /**
     * Dispatcher::route()
     * This function is used in the user's routes.php file to add routes.
     * @param mixed $uri        The full URI to match against. Ex: "posts/view/:id"
     * @param mixed $controller The controller to route to
     * @param mixed $function   The function to route to
     * @param mixed $params An array of the parameters to pass, of the form
     *                      "array('param'=>'value')". You may use colon values from
     *                      the matched URI. Ex: "array('param'=>':id')"
     * @return void
     */
    private function route($uri, $controller, $function = null, $params = null)
    {
        $this->routes[$uri]['controller']  = $controller;
        $this->routes[$uri]['function']  = $function;
        $this->routes[$uri]['params']  = $params;
        
        $this->routes_helpers[$controller.'_'.$function.'_path'] = $this->config['base_path'].$controller.'/'.$function;
    }
}
