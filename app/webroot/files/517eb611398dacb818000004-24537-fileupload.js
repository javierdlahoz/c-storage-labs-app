function seleccionado(){
	//alert('yo');
	var fu1 = document.getElementById("DocumentoArchivo");
	file = fu1.files[0];
	tamano =  (file.size/1024).toFixed(2);
	var etiquetaFile = document.getElementById('file_sign');
	etiquetaFile.innerHTML = file.name;
	document.getElementById('nombreArchivo').innerHTML = "<h3>Información del archivo</h3><table width='200'><tr><td width='25'>Nombre:</td><td>"+
	file.name+"</td></tr><tr><td width='25'>Tamaño:</td><td>"+
	tamano+" KB</td><tr><td width='25'>Tamaño:</td><td>"+
	file.type+file.tmp_name+"</td></tr></table>";
	$('#nombreArchivo').fadeIn('slow', function() {
        // Animation complete
      });
	uploadFile(file);
}

$(':file-wrapper').drop(function(){
    var formData = new FormData($('form')[0]);
    $.ajax({
        url: 'upload.php',  //server script to process data
        type: 'POST',
        xhr: function() {  // custom xhr
            myXhr = $.ajaxSettings.xhr();
            if(myXhr.upload){ // check if upload property exists
                myXhr.upload.addEventListener('progress',progressHandlingFunction, false); // for handling the progress of the upload
            }
            return myXhr;
        },
        //Ajax events
        beforeSend: beforeSendHandler,
        success: completeHandler,
        error: errorHandler,
        // Form data
        data: formData,
        //Options to tell JQuery not to process data or worry about content-type
        cache: false,
        contentType: false,
        processData: false
    });
});



function overfile_sign(etiqueta){
	var et = document.getElementById(etiqueta);
	et.style.background = "#ddd";
}

function outfile_sign(etiqueta){
	var et = document.getElementById(etiqueta);
	et.style.background = "#F7F7F7";
}

function version_alerta(){
	var version_chk = document.getElementById("DocumentoNuevaVersion");
	if(version_chk)
		alert('No olvide modificar el número de versión');
		document.getElementById("DocumentoVersion").focus();
	}