<?php
class Loader
{
    /**
     * Loads a controller and calls its function
     */
    function load_controller($controller, $function = "index", $params = null)
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
        $loaded->loader =& $this;
        $loaded->$function($params[0],$params[1],$params[2],$params[3],$params[4],$params[5],$params[6],$params[7]);
            
        $loaded->render($controller, $function);
    }
}