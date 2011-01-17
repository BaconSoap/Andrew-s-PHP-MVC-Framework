<?php

/**
 * Loader
 * This is the main loader class. It is used to load various components of an
 *  application, and is generally used in the form $this->load->(component type).
 * @package MVC
 * @author Andrew
 * @copyright 2011
 * @version $Id$
 * @access public
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

        $loaded_controller = new $controller();
        $this->_preload($loaded_controller);
        $loaded_controller->load =& $this;
        $loaded_controller->$function($params[0],$params[1],$params[2],$params[3],$params[4],$params[5],$params[6],$params[7]);
        
        $loaded_controller->render($controller, $function);
    }
    
    /**
     * Loader::_preload()
     * Loads user-defined components into the controller.
     * @param Controller $loaded_controller The controller to load the components into.
     * @return void
     */
    private function _preload(&$loaded_controller)
    {
        if(isset($this->config['load']))
        {
            if(isset($this->config['load']['helper']))
            {
                foreach($this->config['load']['helper'] as $helper)
                {
                    $loaded_controller->$helper = $this->helper($helper);
                }
            }
        }
    }
    
    /**
     * Loader::model()
     * Loads a model, and returns it.
     * @param string $model The model to load
     * @return Model the model loaded.
     */
    function model($model)
    {
        $model = ucfirst($model);
        $model .= '_model';
        
        Model::$stat_load =& $this;
        $loaded_model = new $model();
        return $loaded_model;
    }
    
    
    /**
     * Loader::helper()
     * Loads a helper into a controller
     * @param string $helper
     * @return 
     */
    function helper($helper)
    {
        $base_helpers = array('uri');
        //First determine if the helper is one of the base helpers
        if(array_search($helper, $base_helpers) >= 0)
        {
            
            $helper = ucfirst($helper."_helper");
            $loaded_helper = new $helper($this->config, $this);
            
            return $loaded_helper;
        }
    }
}