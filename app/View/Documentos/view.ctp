<h2>Ver Documento</h2>
<fieldset>
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
	?>
    <table width="95%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10%" align="center" valign="middle"><?php 
			$imagen_prop = array('height'=> '128', 'url' => $doc['archivo']['url']);
			if(strpos($doc['archivo']['type'],'word'))
				echo $this->Html->image('docs.png',$imagen_prop);
			if(strpos($doc['archivo']['type'],'sheet'))
				echo $this->Html->image('xls.png',$imagen_prop);
			if(strpos($doc['archivo']['type'],'presentation'))
				echo $this->Html->image('ppt.png',$imagen_prop);
			if(strpos($doc['archivo']['type'],'pdf'))
				echo $this->Html->image('pdf.png',$imagen_prop);
			if(strpos($doc['archivo']['type'],'mage'))
				{  echo $this->Html->image($doc['archivo']['url'],$imagen_prop);
				}
			
		?></td><td valign="middle">
        <h3>Información del archivo</h3>
        <table>
        <tr><td><?php echo $doc['archivo']['name']; ?></td></tr>
        <tr><td><?php echo $doc['archivo']['type']; ?></td></tr>
        <tr><td><?php echo number_format($doc['archivo']['size']/1024,2)." KB"; ?></td></tr>
        </table></td>
      </tr>
    </table>
<table width="95%" border="0" cellspacing="0" cellpadding="0" bordercolor="#CCCCCC">
          
	<?php
	foreach($propiedades as $propiedad){ ?>
	<tr><td width="12%" bgcolor="#EAEFF2"><strong>
	<?php			
					echo $propiedad['nombre'].":";
					$nombre_input = $propiedad['nombre'];
	?></strong></td>
    <td width="88%"><?php 
		if($propiedad['tipo']=='date'){
				echo $doc[$nombre_input]['day'].'/'.$doc[$nombre_input]['month'].'/'.$doc[$nombre_input]['year'];
			}
		else {
			$comentarios = $doc['comentarios'];
		echo $doc[$nombre_input];}
    ?></td>
          </tr><?php }  ?>
  </table>
<h3>Comentarios/Instrucciones</h3>
<?php echo $comentarios; ?>
</fieldset>