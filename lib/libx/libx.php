<?php

class libx
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
    
    final function add_listener($command = 'execute', $function = '')
    {
        $id = $this->get_id();
        
        // escape single quote and backslash
        $command = libsys_tool::escape_singlequote($command);
        
        $this->_src .= "parent.{$this->_id}.addListener('$command', $function);";
    }
    
    final protected function generate_id()
    {
        global $g;
        
        $id = get_class($this);
        $id = substr($id, strpos($id, '_') + 1);
        
        // generate a new ID in session
        @$gid = ++$_SESSION['xids'][$id];
        $this->_id = $id . $gid;
        
        // add element's ID to JS
        if($gid == 1){
            $g['js_asaps'] .= "parent.{$id}_xids=new Array();";
        }
        $this->_src .= "parent.{$id}_xids.push('{$this->_id}');";
    }
    
    final public function __toString()
    {
        return $this->_src;
    }
}
