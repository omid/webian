<?php

class libx_toolbar_radio extends libx
{
    public function __construct($label, $icon = '')
    {
        $this->generate_id();
        
        // escape single quote and backslash
        $label = libsys_tool::escape_singlequote($label);
        $icon  = libsys_tool::escape_singlequote($icon);
        
        $this->_src .= "parent.{$this->_id}=new qx.ui.toolbar.RadioButton('$label', '$icon');";
    }
}
