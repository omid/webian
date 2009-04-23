<?php

class sys_resource
{
    /**
     * @param    string  link    a link to a resource, it's protocol could be "icon" or ...
    */
    function get($link)
    {
        $link = explode('://', $link);
        
        switch($link[0]){
            case 'icon':
                return 'usr/share/icons/'. $link[1];
                break;
            
        }
    }
}
