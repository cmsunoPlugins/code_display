<?php
session_start(); 
if(!isset($_POST['unox']) || $_POST['unox']!=$_SESSION['unox']) {sleep(2);exit;} // appel depuis uno.php
?>
<?php
include('../../config.php');
include('lang/lang.php');
$busy = (isset($_POST['ubusy'])?preg_replace("/[^A-Za-z0-9-_]/",'',$_POST['ubusy']):'index');
$defaultJSON = '{"css":"androidstudio.min.css","num":0,"pag":0}';
if(!file_exists('../../data/codeDisplay.json')) file_put_contents('../../data/codeDisplay.json', $defaultJSON);
// ********************* actions *************************************************************************
if(isset($_POST['action'])) {
	switch ($_POST['action']) {
		// ********************************************************************************************
		case 'plugin': ?>
		<link id="highlightCSS" rel="stylesheet" href="uno/plugins/code_display/highlight/styles/androidstudio.min.css">
		<div class="blocForm">
			<h2><?php echo T_("Code Display");?></h2>
			<p><?php echo T_("This plugin allows you to insert code (PHP, HTML, JS, CSS) with syntax highlighting in the content of the page.");?></p>
			<p>
				<?php echo T_("It is used with the button"); ?>
				<img src="uno/plugins/code_display/codesnippet/icons/codesnippet.png" title="codesnippet" alt="codesnippet" style="border:1px solid #aaa;padding:3px;margin:0 3px -5px;border-radius:2px;" />
				<?php echo T_("added to the text editor when the plugin is active."); ?>
			</p>
			<table class="hForm">
				<tr>
					<td><label><?php echo T_("Output CSS");?></label></td>
					<td>
						<select name="codisCss" id="codisCss" onchange="css_codeDisplay(this)">
						<?php $css = scandir('highlight/styles');
						foreach($css as $f) {
							if(strpos($f,'.min')!==false) $b = strpos($f,'.min');
							else if(strpos($f,'.css')!==false) $b = strpos($f,'.css');
							else $b = null;
							$a = substr($f,0,$b);
							if($f!='.' && $f!='..') echo '<option value="'.$f.'">'.$a.'</option>';
						} ?>

						</select>
					</td>
				</tr>
				<tr>
					<td><label><?php echo T_("Line number");?></label></td>
					<td><input type="checkbox" class="input"  name="codisNumber" id="codisNumber" /></td>
					<td><em><?php echo T_("Adds line numbers.");?></em></td>
				</tr>
				<?php if(file_exists('../multipage/multipage.php')) { ?>
				
				<tr>
					<td><label><?php echo T_("Only this page");?></label></td>
					<td><input type="checkbox" class="input"  name="codisPage" id="codisPage" /></td>
					<td><em><?php echo T_("This configuration will be applied only on this page (Multipage environment).");?></em></td>
				</tr>
				<?php } ?>
				
			</table>
			<div class="bouton fr" onClick="save_codeDisplay();" title="<?php echo T_("Save");?>"><?php echo T_("Save");?></div>
			<div class="clear"></div>
			<div style="margin-top:10px;">
<pre><code>&lt;!DOCTYPE html>
&lt;title>Title&lt;/title>
&lt;style>body {width: 500px;}&lt;/style>
&lt;script type="application/javascript">
	function myInit(i) { let a=12.345; return true; } // Nice function
&lt;/script>
&lt;body>
	&lt;p id="title" class="title">Title &lt;input type='checkbox' id='ch1' onClick="fct(this)" checked />&lt;/p>
	&lt;!-- here goes the rest of the page -->
&lt;/body>
</code></pre>
			</div>
		</div>
		<?php break;
		// ********************************************************************************************
		case 'save':
		$a = array();
		$a['css'] = (!empty($_POST['css'])?strip_tags($_POST['css']):'');
		$a['num'] = (!empty($_POST['num'])?1:0);
		$a['pag'] = (!empty($_POST['pag'])?1:0);
		$out = json_encode($a);
		if(!$a['pag']) {
			if(file_exists('../../data/'.$busy.'/codeDisplay.json')) unlink('../../data/'.$busy.'/codeDisplay.json');
			if(file_put_contents('../../data/codeDisplay.json', $out)) echo T_('Backup performed');
			else echo '!'.T_('Impossible backup');
		}
		else {
			if(file_put_contents('../../data/'.$busy.'/codeDisplay.json', $out)) echo T_('Backup performed');
			else echo '!'.T_('Impossible backup');
		}
		break;
		// ********************************************************************************************
		case 'load':
		$q = '';
		if(file_exists('../../data/'.$busy.'/codeDisplay.json')) $q = file_get_contents('../../data/'.$busy.'/codeDisplay.json');
		else if(file_exists('../../data/codeDisplay.json')) $q = file_get_contents('../../data/codeDisplay.json');
		if(empty($q)) $q = $defaultJSON;
		echo $q;
		break;
		// ********************************************************************************************
	}
	clearstatcache();
	exit;
}
?>
