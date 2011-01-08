<?php
class Uri_helper
{
    public $uri_helpers;
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
}