/**
 * 
 */

$("#DocumentoArchivo").change(
	function(){
		var uploadValue = $("#DocumentoArchivo").val();
		
		if(uploadValue == ""){
			$("#upload-placeholder").show();
			$("#upload-file").hide();
		}
		else{
			uploadValue = uploadValue.replace("C:\\fakepath\\", "");
			$("#upload-file").html(uploadValue);
			$("#upload-file").show();
			$("#upload-placeholder").hide();
		}
	}
);