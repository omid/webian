<?php

class libx_menu_button extends libx
{
    public function __construct($label, $icon = '', $command = 'null', $menu = 'null')
    {
        if($menu != 'null' && get_class($menu) != 'libx_menu_menu'){
            return false;
        }
        
        $this->generate_id();
        
        // escape single quote and backslash
        $label   = libsys_tool::escape_singlequote($label);
        $icon    = libsys_tool::escape_singlequote($icon);
        
        if($menu != 'null'){
            $this->_src .= $menu->get_src();
            $g['js_functions'][] = $menu->get_function();
            $menu = "this.{$menu->get_id()}_func()";
        }
        
        $this->_src .= "parent.{$this->_id}=new qx.ui.menu.Button('$label', '$icon', $menu);";
        
        if($command != 'null'){
            $id = $command->get_id();
            $this->_src .= $command->get_src();
            $this->_src .= "{$this->_id}.setCommand($id);";
        }
    }
}
