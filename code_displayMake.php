<?php
if (!isset($_SESSION['cmsuno'])) exit();
?>
<?php
	$Uhead .= '<script src="uno/plugins/code_display/google-code-prettify/run_prettify.js"></script>'."\r\n";
	$Ucontent = str_replace('<pre','<div>'."\r\n".'<pre style="overflow:auto;"',$Ucontent);
	$Ucontent = str_replace('</pre>','</pre>'."\r\n".'</div>'."\r\n",$Ucontent);
?>
