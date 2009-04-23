<?php

class libx_form_button extends libx
{
    public function __construct($label, $icon = '')
    {
        $this->generate_id();
        
        // escape single quote and backslash
        $label   = libsys_tool::escape_singlequote($label);
        $icon    = libsys_tool::escape_singlequote($icon);
        $command = libsys_tool::escape_singlequote($command);
        
        $this->_src .= "parent.{$this->_id}=new qx.ui.form.Button('$label', '$icon');";
    }
}
