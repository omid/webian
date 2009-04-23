<?php

class libx_window extends libx
{
    private $taskbar;
    
    public function __construct($title = 'N/A', $icon = '', $padding = 10, $layout = '')
    {
        global $g;
        
        $this->generate_id();
        
        if($layout == '') {
            $layout = new libx_layout('VBox');
        }
        
        $this->_src .= "parent.{$this->_id}=new qx.ui.window.Window('$title', '$icon');";
        $this->_src .= "parent.{$this->_id}.setContentPadding($padding);";
        
        $this->_src .= $layout->get_src();
        $layout = $layout->get_id();
        $this->_src .= "parent.{$this->_id}.setLayout($layout);";
        
        libbus_ebus::dispatch(EV_NEW_WIN);
    }
    
    public function add($el)
    {
        $id = $el->get_id();
        $this->_src .= $el->get_src();
        $this->_src .= "parent.{$this->_id}.add($id);";
    }
    
    public function move_to($left, $top)
    {
        $this->_src .= "parent.{$this->_id}.moveTo($left, $top);";
    }
    
    public function center()
    {
        $this->_src .= "parent.{$this->_id}.center();";
    }

    public function set_status($text)
    {
        // escape single quote and backslash
        $text = libsys_tool::escape_singlequote($text);
        
        $this->_src .= "parent.{$this->_id}.setStatus='$text';";
        $this->_src .= "parent.{$this->_id}.setShowStatusbar(true);";
    }
    
    public function open($desktop_number = 0)
    {
        $this->_src .= "parent.{$this->_id}.open();";
        $this->_src .= "eval('parent.'+parent.desktop_xids[{$desktop_number}]+'.add({$this->_id});');";
    }
}
