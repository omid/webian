/* ************************************************************************

#asset(qx/*)

************************************************************************ */

qx.Class.define("qx.Application",
{
  extend : qx.application.Standalone,

  members :
  {
    /**
     * This method contains the initial application code and gets called 
     * during startup of the application
     */
    main : function()
    {
      // Call super class
      this.base(arguments);
	  
	  // Document is the application root
      var doc = this.getRoot();
	  
      // Enable logging in debug variant
      if (qx.core.Variant.isSet("qx.debug", "on"))
      {
        qx.log.appender.Native;
        qx.log.appender.Console;
      }
      
      /*
      -------------------------------------------------------------------------
        Below is your actual application code...
      -------------------------------------------------------------------------
      */
	  
      var con1 = new qx.ui.container.Composite(new qx.ui.layout.VBox(10));
	  
      // Create a button
      var button1 = new qx.ui.form.Button("First Button");
      var button2 = new qx.ui.form.Button("Sec Button");
      var button3 = new qx.ui.form.Button("3rd Button");
      var button4 = new qx.ui.form.Button("Forth Button");
	  // Add an event listener
      button1.addListener("execute", function(e) {
        alert("Hello World!");
      });
      
      // create tab
      parent.tabView = new qx.ui.tabview.TabView();
      
      var page1 = new qx.ui.tabview.Page("Layout", "icon/16/apps/utilities-terminal.png");
      page1.setLayout(new qx.ui.layout.VBox());
      page1.add(new qx.ui.basic.Label("Page Content"));
      parent.tabView.add(page1);
      var page2 = new qx.ui.tabview.Page("Notes", "icon/16/apps/utilities-notes.png");
      parent.tabView.add(page2);
      
      this._newTab = new qx.event.Command("CTRL+T");
      this._newTab.addListener("execute", this.tabViewAdd);
      
      this._openWindow = new qx.event.Command("CTRL+O");
      this._openWindow.addListener("execute", this.openWindow);
      
	  // create menu
	  var menu = new qx.ui.menubar.MenuBar();
	  var mainButton1 = new qx.ui.menubar.Button("Accessories", null, this.getFileMenu());
	  var mainButton2 = new qx.ui.menubar.Button("Games", null, this.getFileMenu());
	  var mainButton3 = new qx.ui.menubar.Button("Graphics", null, this.getFileMenu());
	  var mainButton4 = new qx.ui.menubar.Button("Internet", null, this.getFileMenu());
	  var mainButton5 = new qx.ui.menubar.Button("Office", null, this.getFileMenu());
	  var mainButton6 = new qx.ui.menubar.Button("Programming", null, this.getFileMenu());
	  var mainButton7 = new qx.ui.menubar.Button("Sound & Video", null, this.getFileMenu());
	  var mainButton8 = new qx.ui.menubar.Button("System Tools", null, this.getFileMenu());
	  menu.add(mainButton1);
	  menu.add(mainButton2);
	  menu.add(mainButton3);
	  menu.add(mainButton4);
	  menu.add(mainButton5);
	  menu.add(mainButton6);
	  menu.add(mainButton7);
	  menu.add(mainButton8);
      con1.add(menu);
      
      con1.add(parent.tabView);
      
	  // create a window
	  parent.win = new qx.ui.window.Window("Open File", "");
	  
      parent.win.setContentPadding(10);
	  parent.win.setLayout(new qx.ui.layout.VBox(10));
	  parent.win.add(button1);
	  parent.win.add(button2);
	  parent.win.add(button3);
	  parent.win.add(button4);
      parent.win.moveTo(500,250);
	  parent.win.open();
	  doc.add(parent.win);
      
      doc.add(con1, {top: 0, left: 0, bottom: 0, right: 0});
	  
    },
    
    tabViewAdd : function()
    {
      parent.tabView.add(new qx.ui.tabview.Page("Test"));
    },
    
    openWindow : function()
    {
      parent.win.open();
    },
    
    getFileMenu : function()
    {
      var menu = new qx.ui.menu.Menu;

      var button1 = new qx.ui.menu.Button("Calculator", "", this._openWindow);
      var button2 = new qx.ui.menu.Button("Character Map");
      var button3 = new qx.ui.menu.Button("Dictionary");
      var button4 = new qx.ui.menu.Button("Disk Usage Analyzer");
      var button5 = new qx.ui.menu.Button("Take Screenshot");
      var button6 = new qx.ui.menu.Button("Terminal");
      var button7 = new qx.ui.menu.Button("Text Editor", "", this._newTab);

      menu.add(button1);
      menu.add(button2);
      menu.add(button3);
      menu.add(button4);
      menu.add(button5);
      menu.add(button6);
      menu.add(button7);

      return menu;
    }
  }
});