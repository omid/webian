<?php

class libbus_ebus extends libbus
{
    public function __construct()
    {
        global $g;
        
        $this->generate_id();
        
        $g['js_alaps'] .= "parent.{$this->_id}=qx.event.message.Bus;";
    }
    
    /**
     * Subscribe to an event dispatcher
     **/
    public function subscribe($event, $method, $params = 'this')
    {
        global $g;
        $g['js_alaps'] .= "parent.{$this->_id}.subscribe('$event', $method, $params);";
    }
    
    /**
     * Unsubscribe from an event dispatcher
     **/
    public function unsubscribe($event, $method, $params)
    {
        global $g;
        $g['js_alaps'] .= "parent.{$this->_id}.unsubscribe('$event', $method, $params);";
    }
    
    public function dispatch($event)
    {
        global $g;
        $g['js_alaps'] .= "parent.ebus{$_SESSION['busids']['ebus']}.getInstance().dispatch('$event');";
    }
}
