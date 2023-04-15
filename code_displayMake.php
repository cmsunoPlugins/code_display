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
	$Ucontent = code_displayPatch($Ucontent,$Ubusy);
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
function code_displayPatch($content,$busy) { // Patch Version 1.3 : Change from google-code-prettify => highlightJS
	if(strpos($content,'class="prettyprint')!==false) {
		// Output Patch
		$reg = '/(<pre).*prettyprint.*(>)([\S\n\r\s]*?)(<\/pre>)/';
		$content = preg_replace_callback($reg, function($m){return '<pre><code>'.trim($m[3]).'</code></pre>';}, $content);
		// Editor Content Patch
		$q = file_get_contents('data/'.$busy.'/site.json');
		$a = json_decode($q,true);
		if(!empty($a['chap'])) foreach($a['chap'] as $k=>$v) {
			if(file_exists('data/'.$busy.'/chap'.$v['d'].'.txt')) {
				$c = file_get_contents('data/'.$busy.'/chap'.$v['d'].'.txt');
				$c = preg_replace_callback($reg, function($m){return '<pre><code>'.trim($m[3]).'</code></pre>';}, $c);
				file_put_contents('data/'.$busy.'/chap'.$v['d'].'.txt', $c);
			}
		}
	}
	return $content;
}
?>
