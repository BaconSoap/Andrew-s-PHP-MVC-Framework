<?php

/**
 * Loader
 * This is the main loader class. It is used to load various components of an
 *  application, and is generally used in the form $this->load->(component type).
 * @author Andrew Varnerin
 */
class Loader
{
    public $uri_helpers;
    public $config;
    /**
     * Loads a controller and calls its function
     */
    function controller($controller, $function = "index", $params = null)
    {
        //Pads the params array with null's until it reaches 8.
        for($i = count($params); $i < 8; $i++)
        {
            $params[$i] = null;
        }
        
        //Routes to index by default
        if (is_null($function))
        {
            $function = 'index';
        }
        
        $controller = ucfirst($controller);
        $controller .= '_controller';

        $loaded = new $controller();
        $loaded->load =& $this;
        $loaded->$function($params[0],$params[1],$params[2],$params[3],$params[4],$params[5],$params[6],$params[7]);
        
        $loaded->render($controller, $function);
    }
    
    
    /**
     * Loads a helper.
     */
    function helper($helper)
    {
        $base_helpers = array('uri');
        //First determine if the helper is one of the base helpers
        if(array_search($helper, $base_helpers) >= 0)
        {
            
            $helper = ucfirst($helper."_helper");
            $helped = new $helper();
            $helped->load =& $this;
            
            if($helper == 'Uri_helper')
            {
                $helped->uri_helpers = $this->uri_helpers;
            }
            $helped->config = $this->config;
            
            return $helped;
        }
    }
}