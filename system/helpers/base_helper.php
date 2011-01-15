<?php
//if (!isset($_BASEPATH))
//{ echo "No direct access"; exit; }

/**
 * Helper
 * This is the base helper that all helpers (should) extend.
 * @package MVC
 * @author Andrew Varnerin
 * @copyright 2011
 * @version $Id$
 * @access public
 */
class Helper
{
    public $load;
    public $config;
    
    public function __construct($config, &$load)
    {
        $this->config = $config;
        $this->load =& $load;
    }
}