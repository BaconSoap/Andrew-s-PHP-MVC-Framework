<?php

/**
 * Uri_helper
 * This is a core helper. Its purpose is to provide easy functions for dealing
 *   with URI's while in a view.
 * @package MVC
 * @author Andrew
 * @copyright 2011
 * @version $Id$
 * @access public
 */
class Uri_helper extends Helper
{
    public $uri_helpers;
    public $config;
    
    function link_to($text, $place)
    {
        
        if(isset($this->uri_helpers[$place]))
        {
            echo "<a href='".$this->uri_helpers[$place]."'>$text</a>";
        } else
        {
            echo "<br/>ERROR: Route not found: <b>$place</b>";
        }
    }
    
    function style_link($sheet)
    {
        echo '<link rel="stylesheet" rev="stylesheet" href="'.$this->config['style_path'].$sheet.'" media="screen">';
    }
}