<?php

class libx_label extends libx
{
    private $_align_values  = array('left', 'right', 'center');
    private $_type_values   = array('html', 'text');
    
    public function __construct($text, $type = 'html', $align = 'left')
    {
        $this->generate_id();
        
        // escape single quote and backslash
        $text = libsys_tool::escape_singlequote($text);
        
        $this->_src .= "parent.{$this->_id}=new qx.ui.basic.Label('$text');";
        
        // set align parameters
        $align = strtolower($align);
        if(!in_array($align, $this->_align_values)){
            $align = 'left';
        }
        
        $this->_src .= "{$this->_id}.setTextAlign('$align');";
        
        // set rich parameters
        $type = strtolower($type);
        if(!in_array($type, $this->_type_values)){
            $type = 'html';
        }
        
        if($type == 'html'){
            $type = 'true';
        }else{
            $type = 'false';
        }
        
        $this->_src .= "{$this->_id}.setRich($type);";
    }
}
