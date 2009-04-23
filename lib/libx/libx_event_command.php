<?php

class libx_event_command extends libx
{
    public function __construct($shortcut = '')
    {
        $this->generate_id();
        
        // escape single quote and backslash
        $shortcut = libsys_tool::escape_singlequote($shortcut);
        
        $this->_src .= "parent.{$this->_id}=new qx.event.Command('$shortcut');";
    }
}
