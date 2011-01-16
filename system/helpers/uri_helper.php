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
    
    public function __construct($config, &$load)
    {
        parent::__construct($config, $load);
        $this->uri_helpers = $this->load->uri_helpers;
    }
    
    function link_to($text, $place)
    {
        
        if(isset($this->uri_helpers[$place]))
        {
            echo "<a href='".$this->uri_helpers[$place]."'>$text</a>";
        } else
        {
            echo "<br/>ERROR: Route not found: <b>$place</b>";
            print_r($this->uri_helpers[$place]);
        }
    }
    
    function style_link($sheet)
    {
        echo '<link rel="stylesheet" rev="stylesheet" href="'.$this->config['style_path'].$sheet.'" media="screen">';
    }
    
    /**
     * Uri_helper::jquery()
     * Adds the jQuery script tag, using either Google's CDN or a local copy,
     *   depending on the developer's config options.
     * @return void
     */
    function jquery()
    {
        if($this->config['jquery_local'])
        {
            echo '<script type="text/javascript" src="'.$this->config['javascript_path'].'jquery-'.$this->config['jquery_version'].'.min.js"></script>';
        } else
        {
            echo '<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/'.$this->config['jquery_version'].'/jquery.min.js"></script>';
        }
        
    }
    
    /**
     * Uri_helper::javascript()
     * Adds a link to a javascript file to the document.
     * @param string $file
     * @return void
     */
    function javascript($file)
    {
        echo '<script type="text/javascript" src="'.$this->config['javascript_path'].$file.'.js"></script>';
    }
}