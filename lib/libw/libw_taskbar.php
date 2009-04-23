<?php

class libw_taskbar
{
    private $_taskbar;
    
    public function __construct()
    {
        global $g;
        
        $this->_taskbar = new libx_toolbar_toolbar();
        $tbid = $this->_taskbar->get_id();
            
        $g['js_functions'][] = "libw_taskbar_new_window_func:function(){"
            ."var pw='parent.'+parent.window_xids[parent.window_xids.length-1];"
            ."eval("
            ."pw+'_tb_button=new qx.ui.toolbar.RadioButton('+pw+'.getCaption(), '+pw+'.getIcon());"
            ."parent.{$tbid}.add('+pw+'_tb_button);"
            ."'+pw+'_tb_button.addListener(\"changeChecked\", function(){"
            ."if('+pw+'.cmode==\"minimized\"){'+pw+'.cmode=null;"
            ."if('+pw+'.lmode==\"maximized\"){'+pw+'.maximize();}"
            ."else{'+pw+'.restore();}'+pw+'.open();}"
            ."else{'+pw+'.minimize();'+pw+'.cmode = \"minimized\";}});"
            ."'+pw+'.addListener(\"close\", function(){parent.{$tbid}.remove('+pw+'_tb_button);});"
            ."'+pw+'.addListener(\"maximize\", function(){'+pw+'.lmode=\"maximized\";'+pw+'.cmode=\"maximized\";});"
            ."'+pw+'.addListener(\"restore\", function(){'+pw+'.lmode=\"restore\";'+pw+'.cmode=\"restore\";});"
            ."'+pw+'.addListener(\"minimize\", function(){'+pw+'_tb_button.setChecked(true);'+pw+'.cmode=\"minimized\";});"
            ."');}";
            
        $g['ebus']->subscribe(EV_NEW_WIN, 'this.libw_taskbar_new_window_func');
        
        return $this->_taskbar;
    }
    
    public function get_id()
    {
        return $this->_taskbar->get_id();
    }
    
    public function get_src()
    {
        return $this->_taskbar->get_src();
    }
}
