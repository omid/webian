<?php

class libx_image extends libx
{
    public function __construct($link)
    {
        $this->generate_id();
        
        // escape single quote and backslash
        $link = libsys_tool::escape_singlequote($link);
        
        $this->_src .= "parent.{$this->_id}=new qx.ui.basic.Image('$link');";
    }
}
