<?php

//error_reporting(E_ALL);
//ini_set('display_error', 1);

///////// CONFIGURABLE VARIABLES

$protocol           = 'http://';

///////// DON'T CHANGE THESE VARIABLES

$g['loc_dir']       = $_SERVER['DOCUMENT_ROOT'];
$g['web_dir']       = $protocol . $_SERVER['SERVER_ADDR'] . dirname($_SERVER['REQUEST_URI']);

/* contains list of needed JS functions */
$g['js_functions']  = array();
/* contains list of needed JS codes, they will be included ASAP */
$g['js_asaps']      = '';
/* contains list of needed JS codes, they will be included AT LATE AS POSSIBLE */
$g['js_alaps']      = '';

require_once('event_list.php');

///////// INITIALIZED HEADERS

@session_start();
if(strpos($_SERVER['SCRIPT_NAME'], 'loader.php') === false){ session_destroy(); }
header('Content-type: application/javascript');

///////// INITIALIZED FUNCTIONS

function __autoload($name)
{
    $dummy = explode('_', $name);
    
    if(strpos($dummy[0], 'lib') === 0){
        require_once('lib/' . $dummy[0] . '/' . $name . '.php');
        
    }elseif(strpos($dummy[0], 'sys') === 0){
        require_once('sys/' . $name . '/' . $name . '.php');
    }
}
