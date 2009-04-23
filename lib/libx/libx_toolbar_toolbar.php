<?php

class libx_toolbar_toolbar extends libx
{
    public function __construct()
    {
        $this->generate_id();
        
        $this->_src .= "parent.{$this->_id}=new qx.ui.toolbar.ToolBar();";
    }
    
    public function add($el)
    {
        $id = $el->get_id();
        $this->_src .= $el->get_src();
        $this->_src .= "{$this->_id}.add($id);";
    }
}
