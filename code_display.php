<?php
session_start(); 
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])!='xmlhttprequest') {sleep(2);exit;} // ajax request
if(!isset($_POST['unox']) || $_POST['unox']!=$_SESSION['unox']) {sleep(2);exit;} // appel depuis uno.php
?>
<?php
include('../../config.php');
include('lang/lang.php');
// ********************* actions *************************************************************************
if (isset($_POST['action']))
	{
	switch ($_POST['action'])
		{
		// ********************************************************************************************
		case 'plugin': ?>
		<div class="blocForm">
			<h2><?php echo T_("Code Display");?></h2>
			<p><?php echo T_("This plugin allows you to insert code (PHP, HTML, JS, CSS) with syntax highlighting in the content of the page.");?></p>
			<p><?php echo T_("It is used with the button") .'<img src="uno/plugins/code_display/pbckcode/icons/pbckcode.png" style="border:1px solid #aaa;padding:3px;margin:0 6px -5px;border-radius:2px;" />' . T_("added to the text editor when the plugin is active.");?></p>
			<br />
			<p style="text-align:center;">
				<img src="uno/plugins/code_display/code_display_exemple.jpg" style="box-shadow:1px 1px 3px #999;max-width:100%;" alt="<?php echo T_("Code Display");?>"  title="<?php echo T_("Code Display");?>"/>
			</p>
			<div class="clear"></div>
		</div>
		<?php break;
		// ********************************************************************************************
		}
	clearstatcache();
	exit;
	}
?>
