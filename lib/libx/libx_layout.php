<?php

class libx_layout extends libx
{
    private $_types = array('VBox', 'HBox', 'Grow', 'Dock', 'Basic', 'Canvas', 'Grid');
    
    public function __construct($type)
    {
        $this->generate_id();
        
        if(!in_array($type, $this->_types)){
            return false;
        }
        
        $this->_src .= "parent.{$this->_id}=new qx.ui.layout.$type();";
        //$this->_src .= "{$this->_id}._applyStretching(false, null);";
    }
    
    public function add($el, $params = array())
    {
        $bound = '{';
        
        foreach($params as $k => $v){
            switch($k){
                case 'top':
                case 'left':
                case 'bottom':
                case 'right':
                    $bound .= "$k:" . intval($v) . ',';
                    break;
                case 'edge':
                    $bound .= "$k:'" . $v . "',";
                    break;
            }
        }
        $bound .= '}';
        
        $id = $el->get_id();
        $this->_src .= $el->get_src();
        $this->_src .= "{$this->_id}.add($id,$bound);";
    }
}