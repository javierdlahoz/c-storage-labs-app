<?php echo $this->Html->script('fileupload');
	$opciones = array('si' => 'si',
				'no' => 'no');

	echo $this->Form->create('Documento', array('type' => 'file')); ?>
    <fieldset><h2>Cargar Documento</h2>
        <?php 
        	 echo $this->Html->link('<< Regresar a la lista', array('controller' => 'documentos', 'action' => 'index', $id_cat)); ?><br><br>
    <?php
	
	foreach($propiedades as $propiedad){
			if($propiedad['tipo']=='boolean'){
					echo $this->Form->input($propiedad['nombre'], array('type' => 'select',
					'options' => $opciones));
				}
			else{
					echo $this->Form->input($propiedad['nombre'], array('type' => $propiedad['tipo'], 'required' => true));
				}
		}?>
      <div class="file-wrapper" ondragover="overfile_sign('file-wrapper')" ondragleave="outfile_sign('file-wrapper')"
       ondrop="outfile_sign('file-wrapper')" id='file-wrapper'>
       	<div class="file_sign" id='file_sign'>Arrastra un archivo o haz clic aquí</div>
       <div class='file'><?php echo $this->Form->input('archivo', array('type' => 'file', 'label' => '', 'onchange' => 'seleccionado()',
	   'onmouseover' => "overfile_sign('file-wrapper')", 'onmouseout' => "outfile_sign('file-wrapper')")); ?></div>
       </div>
       </div>
       <table><tr><td>
       <div id="nombreArchivo" style="display:none"></div></td></tr></table>
	  <?php echo $this->Form->input('comentarios', array('type' => 'textarea', 'label' => 'Comentarios/Instrucciones'));   
	  echo $this->Form->input('id_categoria', array('type' => 'hidden', 'value' => $id_cat));
  	  //echo $this->Form->input('id', array('type' => 'hidden', 'value' => $id_cat));       
    	?>
      <h3>Usuarios con permisos sobre este archivo</h3>
      <?php foreach($usuarios as $usuario){ 
	  		echo  $this->Form->input($usuario['username'], array('type' => 'checkbox', 'label' => utf8_encode($usuario['nombre'])));
	  } ?>  
    </fieldset>
<?php echo $this->Form->end(__('Subir'));  ?>