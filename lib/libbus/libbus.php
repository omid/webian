<?php

class libbus
{
    protected $_src = '';
    protected $_id;
    
    final public function get_src()
    {
        return $this->_src;
    }
    
    final public function get_id()
    {
        return $this->_id;
    }
    
    final protected function generate_id()
    {
        global $g;
        
        $id = get_class($this);
        $id = substr($id, strpos($id, '_') + 1);
        
        // generate a new ID in session
        @$gid = ++$_SESSION['busids'][$id];
        $this->_id = $id . $gid;
        
        // add element's ID to JS
        if($gid == 1){
            $g['js_inits'][] = "parent.{$id}_busids=new Array();";
        }
        $this->_src .= "parent.{$id}_busids.push('{$this->_id}');";
    }
    
    public function __toString(){
        return $this->_src;
    }
}
