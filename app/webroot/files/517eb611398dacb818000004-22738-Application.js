////file:app/webroot/js/application.js
$(document).ready(function(){
// Caching the movieName textbox:
var username = $('#username');
var nombreDocumentos = $('#nombreDocumentos');
// Defining a placeholder text:
username.defaultText('Busca usuarios');
nombreDocumentos.defaultText('Buscar Documentos');

// Using jQuery UI's autocomplete widget:
username.autocomplete({
	minLength    : 3,
	source: 'users/index'
});

nombreDocumentos.autocomplete({
	minLength    : 3,
	source: 'documentos/index'
});

});

// A custom jQuery method for placeholder text:

$.fn.defaultText = function(value){

var element = this.eq(0);
element.data('defaultText',value);

element.focus(function(){
if(element.val() == value){
element.val('').removeClass('defaultText');
}
}).blur(function(){
if(element.val() == '' || element.val() == value){
element.addClass('defaultText').val(value);
}
});

return element.blur();
}