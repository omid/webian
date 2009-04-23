<?php

class libx_toolbar_button extends libx
{
    public function __construct($label, $icon = '', $command = 'null')
    {
        if($command != 'null' && get_class($command) != 'libx_event_command'){
            return false;
        }
        
        $this->generate_id();
        
        // escape single quote and backslash
        $label = libsys_tool::escape_singlequote($label);
        $icon  = libsys_tool::escape_singlequote($icon);
        
        $this->_src .= "parent.{$this->_id}=new qx.ui.toolbar.Button('$label', '$icon');";
        
        if($command != 'null'){
            $id = $command->get_id();
            $this->_src .= $command->get_src();
            $this->_src .= "{$this->_id}.setCommand($id);";
        }
    }
}
