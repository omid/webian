<?php

include_once('etc/main_config.php');


{   // create desktop
    $doc = new libx_document();
    $desk = new libx_desktop();
    $g['ebus'] = new libbus_ebus();
}

{   // create commands

    $cmd1 = new libx_event_command('CTRL+H');
    $cmd1->add_listener('execute', 'function(e) {alert("CTRL+H Pressed");}');
}

{   // create a window

    /*$label1 = new libx_label('Hello World!');
    $label2 = new libx_label('<h1>This is my <i><font color="red">first</font></i> test!</h1>');
    $label3 = new libx_label('<h1>This is my <i><font color="red">first</font></i> test!</h1>', 'text');
    
    $fb1    = new libx_form_button('Press me', sys_resource::get('icon://Tango/16/places/user-home.png'));
    $fb1->add_listener('execute', 'function(e) {alert("Hello World! This is first command!");}');
    
    $lay = new libx_layout('VBox');
    
    // horizontal set of icons
    $lay2 = new libx_layout('HBox');
    $com = new libx_composite($lay2);
    $image1 = new libx_image(sys_resource::get('icon://Tango/128/apps/utilities-terminal.png'));
    $com->add($image1);
    $image1 = new libx_image(sys_resource::get('icon://Tango/64/apps/utilities-terminal.png'));
    $com->add($image1);
    $image1 = new libx_image(sys_resource::get('icon://Tango/32/apps/utilities-terminal.png'));
    $com->add($image1);
    
    $tb1 = new libx_toolbar_toolbar();
    $tbb1 = new libx_toolbar_checkbox('aaaa');
    $tb1->add($tbb1);

    $win = new libx_window('hello', sys_resource::get('icon://Tango/16/apps/utilities-terminal.png'), 0, $lay);
    $win->add($tb1);
    $win->add($label1);
    $win->add($label3);
    $win->add($label2);
    $win->add($fb1);
    $win->add($com);
    $win->move_to(300, 400);
    $win->set_status('this is status');
    $win->open();*/
}

{   // create a menu

    $panel_application = array(
                    'Calculator'    => array(
                            'icon'        => sys_resource::get('icon://Tango/16/places/user-home.png'),
                            'type'        => 'button',
                            'menu'        => 'Accessories',
                        ),
                    'Text Editor'   => array(
                            'icon'        => sys_resource::get('icon://Tango/16/places/network-workgroup.png'),
                            'type'        => 'button',
                            'shortcut'    => 'CTRL+SHIFT+T',
                            'menu'        => 'Accessories',
                        ),
                );
    
    // from here to the end of "create a menu" block, will move to libw library
    $panel_menu = array(
                    'Accessories'   => array('icon' => sys_resource::get('icon://Tango/16/places/folder.png')),
                    'Games'         => array(),
                    'Graphics'      => array(),
                    'Internet'      => array(),
                    'Office'        => array(),
                    'Programming'   => array(),
                    'Sound/Video'   => array(),
                    'System Tools'  => array(),
                    'Settings'      => array(),
                );
    
    $main_panel_menu = new libx_menubar_menu();
    $enabled_menues = array();
    
    foreach($panel_application as $name => $params){
        // create submenu itself!
        $menu = 'panel_submenu_' . preg_replace('/\s/', '', strtolower($params['menu']));
        if(!isset($$menu)) {
            $$menu = new libx_menu_menu();
        }
        
        $submenu = $menu . preg_replace('/\s/', '', strtolower($name));
        
        // add command and optional shortcut
        if(!$params['shortcut']){
            $params['shortcut'] = '';
        }
        
        $submenu_command = $menu . preg_replace('/\s/', '', strtolower($name)) . '_command';
        $$submenu_command = new libx_event_command($params['shortcut']);
        $$submenu_command->add_listener('execute', "function() {var req = new qx.io.remote.Request('loader.php', 'GET', 'text/javascript');req.send();}");
        
        $$submenu = new libx_menu_button($name, $params['icon'], $$submenu_command);
        $$menu->add($$submenu);
        
        // add whole submenu to main menu
        $mmenu = $params['menu'];
        if(!in_array($mmenu, $enabled_menues)) {
            $enabled_menues[] = $mmenu;
        }
    }
    
    foreach($enabled_menues as $menu){
        $menu_name = 'panel_menu_' . preg_replace('/\s/', '', strtolower($menu));
        $submenu_name = 'panel_submenu_' . preg_replace('/\s/', '', strtolower($menu));
        
        $$menu_name = new libx_menubar_button($menu, $panel_menu[$menu]['icon'], $$submenu_name);
        $main_panel_menu->add($$menu_name);
    }
}

{   // create a tab view
    /*$tab1 = new libx_tab_view();
    $page1 = new libx_tab_page('First', sys_resource::get('icon://Tango/16/apps/utilities-terminal.png'));
    $tab1->add($page1);
    $page1 = new libx_tab_page('Second', sys_resource::get('icon://Tango/16/apps/utilities-notes.png'));
    $tab1->add($page1);
}



    $win1 = new libx_window('Second window', sys_resource::get('icon://Tango/16/apps/utilities-notes.png'), 10, $lay);
    $win1->add($tab1);
    $win1->move_to(100, 200);
    $win1->set_status('this is status');
    $win1->open();*/
}
{   // finalize
    $lay3 = new libx_layout('Dock');
    $com1 = new libx_composite($lay3);
    
    $com1->add($main_panel_menu, array('edge' => 'north'));
    $com1->add(new libw_taskbar(), array('edge' => 'south'));
    //$desk->add($win);
    //$desk->add($win1);
    $com1->add($desk, array('edge' => 'center'));
    $doc->add($com1, array('top'    => 0,
                           'left'   => 0,
                           'right'  => 0,
                           'bottom' => 0
                           ));
}
