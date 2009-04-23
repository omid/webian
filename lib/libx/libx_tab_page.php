<?php

class libx_tab_page extends libx
{
    public function __construct($label, $icon = '')
    {
        $this->generate_id();
        
        // escape single quote and backslash
        $label = libsys_tool::escape_singlequote($label);
        $icon  = libsys_tool::escape_singlequote($icon);
        
        $this->_src .= "parent.{$this->_id}=new qx.ui.tabview.Page('$label', '$icon');";
    }
    
    public function add($el)
    {
        $id = $el->get_id();
        $this->_src .= $el->get_src();
        $this->_src .= "{$this->_id}.add($id);";
    }
}
