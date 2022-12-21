//
// CMSUno
// Plugin Code Display
//
UconfigNum++;

CKEDITOR.plugins.addExternal('codesnippet',UconfigFile[UconfigNum-1]+'/../codesnippet/');
CKEDITOR.editorConfig = function(config){
	config.extraPlugins += ',codesnippet';
	config.toolbarGroups.push('codesnippet');
	if(UconfigFile.length>UconfigNum)config.customConfig=UconfigFile[UconfigNum];
};
