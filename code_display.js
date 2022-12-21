//
// CMS Uno
// Plugin Code Display
//
function load_codeDisplay(){
	let x=new FormData(),t=document.getElementById('codisCss'),to=t.options,v,s;
	x.set('action','load');
	x.set('unox',Unox);
	fetch('uno/plugins/code_display/code_display.php',{method:'post',body:x})
	.then(r=>r.json())
	.then(function(r){
		if(r.css)for(v=0;v<to.length;v++){
			if(to[v].value==r.css){
				to[v].selected=true;
				v=to.length;
			}
			document.getElementById('highlightCSS').href='uno/plugins/code_display/highlight/styles/'+r.css;
		}
		hljs.highlightAll();
		if(r.num){
			document.getElementById('codisNumber').checked=true;
			s=document.createElement('script');
			s.src='uno/plugins/code_display/highlight/line-numbers/highlightjs-line-numbers.min.js';
			s.onload=function(){hljs.initLineNumbersOnLoad();};
			document.head.appendChild(s);
		}
		if(r.pag)document.getElementById('codisPage').checked=true;
	});
}
function save_codeDisplay(){
	let c=document.getElementById('codisCss'),p=document.getElementById('codisPage'),h=new FormData();
	if(p!=null&&p.checked)p=1;else p=0;
	h.set('action','save');
	h.set('unox',Unox);
	h.set('css',c.options[c.selectedIndex].value);
	h.set('num',document.getElementById('codisNumber').checked?1:0);
	h.set('pag',p);
	fetch('uno/plugins/code_display/code_display.php',{method:'post',body:h})
	.then(r=>r.text())
	.then(r=>f_alert(r));
}
function css_codeDisplay(f){
	let a=f.options[f.selectedIndex].value;
	document.getElementById('highlightCSS').href='uno/plugins/code_display/highlight/styles/'+a;
}
//
load_codeDisplay();
