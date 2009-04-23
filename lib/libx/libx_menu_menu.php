<?php

class libx_menu_menu extends libx
{
    private $_function;
    
    public function __construct()
    {
        $this->generate_id();
        
        $this->_function .= "{$this->_id}_func:function(){parent.{$this->_id}=new qx.ui.menu.Menu();/*#####{$this->_id}#####*/return {$this->_id};}";
    }
    
    public function add($el)
    {
        $id = $el->get_id();
        $src = $el->get_src();
        $src .= "{$this->_id}.add($id);";
        $src .= "/*#####{$this->_id}#####*/";
        
        $this->_function = str_replace("/*#####{$this->_id}#####*/", $src, $this->_function);
    }
    
    public function get_function()
    {
        return $this->_function;
    }
}
