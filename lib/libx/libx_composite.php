<?php

class libx_composite extends libx
{
    public function __construct($layout)
    {
        $this->generate_id();
        
        $this->_src .= $layout->get_src();
        $layout = $layout->get_id();
        $this->_src .= "parent.{$this->_id}=new qx.ui.container.Composite($layout);";
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
