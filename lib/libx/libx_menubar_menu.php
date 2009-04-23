<?php

class libx_menubar_menu extends libx
{
    public function __construct()
    {
        $this->generate_id();
        
        $this->_src .= "parent.{$this->_id}=new qx.ui.menubar.MenuBar();";
    }
    
    public function add($el)
    {
        $id = $el->get_id();
        $this->_src .= $el->get_src();
        $this->_src .= "{$this->_id}.add($id);";
    }
}
