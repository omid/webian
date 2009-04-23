<?php

include_once('etc/main_config.php');

{
    $win1 = new libx_window('Second window', sys_resource::get('icon://Tango/16/apps/utilities-notes.png'), 10);
    $win1->move_to(100, 200);
    $win1->set_status('this is status');
    $win1->open();
}
echo $g['js_asaps'] . $win1->get_src() . $g['js_alaps'];