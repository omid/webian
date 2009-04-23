<?php

class libsys_tool extends libsys
{
    
    function get_hash ($str)
    {
        return md5($str);
    }
    
    function escape_singlequote ($str)
    {
        return str_replace(array("'", '\\'), array("\\'", '\\'), $str);
    }
}
