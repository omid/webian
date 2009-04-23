<?php

class libx_tab_view extends libx
{
    private $_positions = array('left', 'right', 'top', 'bottom');
    
    public function __construct($bar_position = 'top')
    {
        $this->generate_id();
        
        // set align parameters
        $bar_position = strtolower($bar_position);
        if(!in_array($bar_position, $this->_positions)){
            $bar_position = 'top';
        }
        
        $this->_src .= "parent.{$this->_id}=new qx.ui.tabview.TabView('$bar_position');";
    }
    
    public function add($el)
    {
        $id = $el->get_id();
        $this->_src .= $el->get_src();
        $this->_src .= "{$this->_id}.add($id);";
    }
}
