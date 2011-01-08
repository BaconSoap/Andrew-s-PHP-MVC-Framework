<?php

/**
 * Loader
 * This is the main loader class. It is used to load various components of an
 *  application, and is generally used in the form $this->load->(component type).
 * @author Andrew Varnerin
 */
class Loader
{
    /**
     * Loads a controller and calls its function
     */
    function controller($controller, $function = "index", $params = null)
    {
        for($i = count($params); $i < 8; $i++)
        {
            $params[$i] = null;
        }
        
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
}