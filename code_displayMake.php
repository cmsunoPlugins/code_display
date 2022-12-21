<?php
if(!isset($_SESSION['cmsuno'])) exit();
?>
<?php
$q1 = '';
if(file_exists('data/'.$Ubusy.'/codeDisplay.json')) $q1 = file_get_contents('data/'.$Ubusy.'/codeDisplay.json');
else if(file_exists('data/codeDisplay.json')) $q1 = file_get_contents('data/codeDisplay.json');
if($q1 && strpos($Ucontent,'/pre')!==false) {
	$a1 = json_decode($q1,true);
	if(isset($a1['css']) && file_exists('plugins/code_display/highlight/styles/'.$a1['css'])) $Uhead .= '<link rel="stylesheet" href="uno/plugins/code_display/highlight/styles/'.$a1['css'].'">'."\r\n";
	else $Uhead .= '<link rel="stylesheet" href="uno/plugins/code_display/highlight/styles/androidstudio.min.css">'."\r\n";
	$Ucontent = code_displayPatch($Ucontent);
	$Ucontent = str_replace('<pre','<div>'."\r\n".'<pre style="overflow:auto;"',$Ucontent);
	$Ucontent = str_replace('</pre>','</pre>'."\r\n".'</div>'."\r\n",$Ucontent);
	$Ufoot .= '<script src="uno/plugins/code_display/highlight/highlight.min.js"></script>'."\r\n";
	if(!empty($a1['num'])) {
		$Ufoot .= '<script src="uno/plugins/code_display/highlight/line-numbers/highlightjs-line-numbers.min.js"></script>'."\r\n";
		$Ustyle .= '.hljs-ln-n{margin-right:4px}';
	}
	$Ufoot .= '<script>hljs.highlightAll();';
	if(!empty($a1['num'])) $Ufoot .= 'hljs.initLineNumbersOnLoad();';
	$Ufoot .= '</script>'."\r\n";
}
//
//
function code_displayPatch($t) { // Patch Version 1.3 : Change from google-code-prettify => highlightJS
	if(strpos($t,' data-pbcklang="')!==false) {
		$reg = '/(<pre).*data-pbcklang.*(>)([\S\n\r\s]*?)(<\/pre>)/';
		$t = preg_replace($reg, '<pre><code>$3</code></pre>', $t);
	}
	return $t;
}
?>
