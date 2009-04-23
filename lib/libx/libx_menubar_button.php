<?php

class libx_menubar_button extends libx
{
    public function __construct($label, $icon = '', $menu = 'null')
    {
        global $g;
        
        if($menu != 'null' && get_class($menu) != 'libx_menu_menu'){
            return false;
        }
        
        $this->generate_id();
        
        // escape single quote and backslash
        $label = libsys_tool::escape_singlequote($label);
        $icon  = libsys_tool::escape_singlequote($icon);
        
        if($menu != 'null'){
            $this->_src .= $menu->get_src();
            $g['js_functions'][] = $menu->get_function();
            $menu = "this.{$menu->get_id()}_func()";
        }
        
        $this->_src .= "parent.{$this->_id}=new qx.ui.menubar.Button('$label', '$icon', $menu);";
    }
}
