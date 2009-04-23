<?php

class libx_document extends libx
{
    private $debug;
    
    public function __construct($debug = 0)
    {
        $this->_src  .= 'qx.Class.define("qx.Application",{extend:qx.application.Standalone,members:{main:function(){this.base(arguments);var doc=this.getRoot();';
        //$this->_src  .= 'qx.Class.define("qx.Application",{extend:qx.application.Standalone,members:{main:function(){this.base(arguments);var doc=this.getRoot();var manager=new qx.ui.window.Manager();var desktop=new qx.ui.window.Desktop(manager);doc.add(desktop, {top: 0, left: 0, bottom: 0, right: 0});';
        
        $this->debug = $debug;
        if($debug){
            $this->_src .= 'if(qx.core.Variant.isSet("qx.debug", "on")){qx.log.appender.Native;qx.log.appender.Console;}';
        }
    }
    
    public function add($el, $params = array())
    {
        global $g;
        
        // add needed JS definitions
        $this->_src .= $g['js_asaps'];
        $g['js_asaps'] = '';
        
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
        $this->_src .= "doc.add($id, $bound);";
    }
    
    function __destruct()
    {
        $this->_display();
    }
    
    private function _display()
    {
        global $g;
        
        //$this->_src .= $g['ebus'];
        $this->_src .= $g['js_alaps'];
        $this->_src .= '}';
        
        foreach($g['js_functions'] as $fn){
            $this->_src .= ',' . $fn;
        }
        
        $this->_src  .= '}});';
        echo $this->_src;
    }
}