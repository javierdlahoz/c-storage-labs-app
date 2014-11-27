<?php echo $this->Html->script('fileupload');
	$opciones = array('si' => 'si',
				'no' => 'no');

	echo $this->Form->create('Documento', array('type' => 'file')); ?>
    <fieldset><legend>Editar Documento</legend>
        <?php 
        	 echo $this->Html->link('<< Regresar a la lista', array('controller' => 'documentos', 'action' => 'index', $id_cat)); ?><br><br>
    <?php
	foreach($documentos as $documento){
			$documento = $documento['documentos'];
		}
	$i=0;
	foreach($documento as $docs){
			if($docs['id']==$id_doc){
					$doc = $docs;
					$pos = $i;
				}
			$i++;	
		}	
	
	foreach($propiedades as $propiedad){
			if($propiedad['tipo']=='boolean'){
					echo $this->Form->input($propiedad['nombre'], array('type' => 'select',
					'options' => $opciones,
					'default' => $doc[$propiedad['nombre']]));
				}
			else{
					echo $this->Form->input($propiedad['nombre'], array('type' => $propiedad['tipo'],
							'value' => $doc[$propiedad['nombre']]));
				}
		}
      ///echo $this->Form->input('archivo', array('type' => 'file'));     ?>
	   <p><?php echo $this->Form->input('nueva_version', array('type' => 'checkbox', 'label' => '¿Es nueva versión?', 'onclick' => 'version_alerta()')); ?><p>
       
	   <div class="file-wrapper" ondragover="overfile_sign('file-wrapper')" ondragleave="outfile_sign('file-wrapper')"
       ondrop="outfile_sign('file-wrapper')" id='file-wrapper'>
       	<div class="file_sign" id='file_sign'>Arrastra un archivo o haz clic aquí</div>
       <div class='file'><?php echo $this->Form->input('archivo', array('type' => 'file', 'label' => '', 'onchange' => 'seleccionado()',
	   'onmouseover' => "overfile_sign('file-wrapper')", 'onmouseout' => "outfile_sign('file-wrapper')")); ?></div>
       </div>
       </div>
	     <table><tr><td>
       <div id="nombreArchivo" style="display:none"></div></td></tr></table>
	  <?php
	  echo $this->Form->input('comentarios', array('type' => 'textarea', 'value' => $doc['comentarios'], 'label' => 'Comentarios/Instrucciones'));   
	  echo $this->Form->input('id_categoria', array('type' => 'hidden', 'value' => $id_cat));
	  echo $this->Form->input('id', array('type' => 'hidden', 'value' => $id_doc));
  	  echo $this->Form->input('pos', array('type' => 'hidden', 'value' => $pos));         
    ?>
     <h3>Usuarios con permisos sobre este archivo</h3>
      <?php foreach($usuarios as $usuario){ 
	  		$pp = false;
			for($k=0; $k<=count($existentes)-1; $k++){
				if($usuario['username']==$existentes[$k]){
						$pp = true;
					}
			}
//			$pp = array_search($usuario['username'], $existentes);
			
			if($pp)
				echo  $this->Form->input($usuario['username'], array('type' => 'checkbox', 'label' => utf8_encode($usuario['nombre']), 'checked' => true));
			else
			echo  $this->Form->input($usuario['username'], array('type' => 'checkbox', 'label' => utf8_encode($usuario['nombre'])));	
	  		
	  } ?>  
    </fieldset>
<?php echo $this->Form->end(__('Modificar'));  ?>