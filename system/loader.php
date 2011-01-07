<?php
class Loader
{
    /**
     * Loads a controller and calls its function
     */
    function load_controller($controller, $function = "index", $params = null)
    {
        if (is_null($function))
            $function = 'index';
        if (is_null($params))
        {
            $controller = ucfirst($controller);
            $controller .= '_controller';
            
            $loaded = new $controller();
            $loaded->loader =& $this;
            $loaded->$function();
            
            $loaded->render($controller, $function);
        }
    }
}