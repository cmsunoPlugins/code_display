//
// CMSUno
// Plugin Code Display
//
UconfigNum++;

CKEDITOR.plugins.addExternal('pbckcode',UconfigFile[UconfigNum-1]+'/../pbckcode/');
CKEDITOR.editorConfig = function(config){
	config.extraPlugins += ',pbckcode';
	config.toolbarGroups.push('pbckcode');
	config.pbckcode = {
		cls : '',
		highlighter : 'PRETTIFY',
		modes :  [ ['HTML', 'html'], ['CSS', 'css'], ['PHP', 'php'], ['JS', 'javascript'] ],
		theme : 'textmate',
		tab_size : '4'
	};
	if(UconfigFile.length>UconfigNum)config.customConfig=UconfigFile[UconfigNum];
};