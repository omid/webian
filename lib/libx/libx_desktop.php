<?php

class libx_desktop extends libx
{
    public function __construct()
    {
        $this->generate_id();
        
        $this->_src .= "parent.manager=new qx.ui.window.Manager();parent.{$this->_id}=new qx.ui.window.Desktop(manager);doc.add({$this->_id}, {top: 0, left: 0, bottom: 0, right: 0});";
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
        $this->_src .= "{$this->_id}.add($id, $bound);";
    }
}