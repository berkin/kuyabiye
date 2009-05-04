/**
 * updateWebdebug
 * @param {obj} request 
 * @param {obj} json
 */
 function updateWebdebug(request, json) {
 	if((json == null) || (json.webdebug != true)) {
 		alert('You must enable the module "ajaxWebdebug"');
 	} else {
// 		alert(request.responseText);
		sfWebDebug = document.getElementById('sfWebDebug');
		if(sfWebDebug) {
			sfWebDebug.style.display = 'inline';
			sfWebDebug.innerHTML = request.responseText.substr(28,(request.responseText.length - 33));
		}
 	}
 }

/**
 * sfAjaxWebDebug
 */
 function getAjaxWebDebug() {
	new Ajax.Request('ajaxWebdebug/getWebdebug', {asynchronous:true, evalScripts:false, onComplete:function(request, json){updateWebdebug(request, json)}});
 }