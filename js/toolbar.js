// create and position the toolbar
var hasMenu = 0;
var menuTimer;
var menuOffSpeed = 500;
var scrollbarOffset = 5;
var toolbarWidth = document.documentElement.clientWidth-scrollbarOffset;
var innerSpacing = toolbarWidth - 12;
var acc02 = 0;
var acc03 = 0;
document.write('<div id="toolbar" style="position: absolute; top: 0px; left: 0px; width: '+toolbarWidth+'px; height: 33px; overflow: hidden; z-index: 10;">');
document.write('	<div id="innerToolbar" style="width: '+innerSpacing+'px; height: 33px; background-image: url(\'./images/toolbar_ct.png\');">');
document.write('		<div class="toolbarCell1" title="Back to Home / Business Documents"><a href="home.php" class="tbTextSmall">Home</a></div>');
document.write('		<div class="tbDividerLeft"><!-- --></div>');
document.write('		<div class="tbDividerLeftShadow"><!-- --></div>');
if (acc01==1)
	{
	//document.write('		<div class="toolbarCellLeft" title="Open your Dashboard"><a href="dashboard.php" class="tbTextSmall">Dashboard</a></div>');
	//document.write('		<div class="tbDividerLeft"><!-- --></div>');
	//document.write('		<div class="tbDividerLeftShadow"><!-- --></div>');
	document.write('		<div class="toolbarCellLeft" title="Open your Dashboard"><span style="color: #999"><em>Dashboard</em></span></div>');
	document.write('		<div class="tbDividerLeft"><!-- --></div>');
	document.write('		<div class="tbDividerLeftShadow"><!-- --></div>');
	}
if (acc02==1)
	{
	document.write('		<div class="toolbarCellLeft" title="Vendor Online"><a href="vm.php" class="tbTextSmall">Vendor Online</a></div>');
	document.write('		<div class="tbDividerLeft"><!-- --></div>');
	document.write('		<div class="tbDividerLeftShadow"><!-- --></div>');
	}
if (acc03==1)
	{
	document.write('		<div class="toolbarCellLeft" title="Vendor e-Community"><a href="vcons.php" class="tbTextSmall">Vendor e-Community</a></div>');
	document.write('		<div class="tbDividerLeft"><!-- --></div>');
	document.write('		<div class="tbDividerLeftShadow"><!-- --></div>');
	}
if (acc04==1)
	{
	document.write('		<div class="toolbarCellLeft" title="Open your bulletins and other important notifications"><a href="apps_vcm.php?sp=" class="tbTextSmall">Bulletins</a></div>');
	document.write('		<div class="tbDividerLeft"><!-- --></div>');
	document.write('		<div class="tbDividerLeftShadow"><!-- --></div>');
	//document.write('		<div class="toolbarCellLeft" title="Open your bulletins and other important notifications"><span style="color: #999"><em>Bulletins</em></span></div>');
	//document.write('		<div class="tbDividerLeft"><!-- --></div>');
	//document.write('		<div class="tbDividerLeftShadow"><!-- --></div>');
	}
document.write('		<div class="toolbarCellLeft" title="Open your account profile and other settings"><a href="account.php" class="tbTextSmall">My Account</a></div>');
document.write('		<div class="tbDividerLeft"><!-- --></div>');
if (tbIsAdmin==0)
	{
	document.write('		<div class="toolbarCellLeft" title="Business Documents / Messages System"><a href="home.php?f=1" class="tbTextSmall">BDMS</a></div>');
	}
else
	{
	document.write('		<div class="toolbarCellLeft" title="" onMouseOver="showTools(\'toolsMenu\',1);" onMouseOut="showTools(\'toolsMenu\',0);"><a href="javascript:void(0);" class="tbTextSmall">Portal Applications</a></div>');
	}
document.write('		<div class="tbDividerLeft"><!-- --></div>');
document.write('		<div class="tbDividerLeftShadow"><!-- --></div>');
document.write('		<div class="toolbarCellRight" title="Logout from the SM Trade Portal"><a href="logout.php" class="tbTextSmall">Logout</a></div>');
document.write('		<div class="tbDividerRightShadow"><!-- --></div>');
document.write('		<div class="tbDividerRight"><!-- --></div>');
/*
document.write('		<div class="toolbarCellRight" title="Live chat with one of our Customer Support Representatives"><a href="javascript:doChat();" class="tbTextSmall">Live Chat</a></div>');
document.write('		<div class="tbDividerRightShadow"><!-- --></div>');
document.write('		<div class="tbDividerRight"><!-- --></div>');
document.write('		<div class="toolbarCellRight" title="Customer Support Ticket Tracking System"><a href="/support" class="tbTextSmall" target="_blank">Support</a></div>');
document.write('		<div class="tbDividerRightShadow"><!-- --></div>');
document.write('		<div class="tbDividerRight"><!-- --></div>');
document.write('		<div class="toolbarCellRight" title="Help & FAQs to guide you on the SM Trade Portal"><a href="help.php" class="tbTextSmall">Help & FAQs</a></div>');
document.write('		<div class="tbDividerRightShadow"><!-- --></div>');
document.write('		<div class="tbDividerRight"><!-- --></div>');
*/
document.write('	</div>');
document.write('</div>');

function updateToolbarPos()
	{
	// re-calculate the toolbar width
	var scrollbarOffset = 5;
	var toolbarWidth = document.documentElement.clientWidth-scrollbarOffset;
	var innerSpacing = toolbarWidth - 12;
	document.getElementById('toolbar').style.width = toolbarWidth + 'px';
	document.getElementById('innerToolbar').style.width = innerSpacing + 'px';
	}

function showTools(menuID, action)
	{
	if (action==0)
		{
		// switch off the tools menu
		// start timer for the switching off of the menu
                hasMenu=0;
		setTimeout('menuOff(\''+menuID+'\');', menuOffSpeed);
		}
	else
		{
		// switch on the tools menu
                hasMenu = 1;
                $("#"+menuID).fadeIn(200, "linear");
                // $("#"+menuID).slideDown(300, 'swing');
		}
	}

function menuOff(menuID)
	{
        if (hasMenu==0)
		{
                $("#"+menuID).fadeOut(200, "linear");
                // $("#"+menuID).slideUp(300, 'swing');
		}
	}