<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="4%"><?php echo $this->Html->image('docs.png', array('height'=>'32', 'width'=>'32')); ?></td>
    <td width="96%"><h2>Documentos</h2></td>
  </tr>
</table>
<table width="95%" border="0" cellpadding="8" cellspacing="0" style="border-bottom-color:#ddd; border-bottom-style:solid; border-bottom-width:thin">
<?php 
	echo $this->Html->css('autocomplete');
	echo $this->Form->create('Documento', array('action'=> 'index'));  ?>
  <tr>
    <td width="95%" valign="middle" style="padding:10px"><?php 
    echo $this->Form->input('nombreDocumentos', array('type'=>'text', 'id' => 'nombreDocumentos', 'label'=>'Buscar:')); ?>
    <?php echo $this->Html->link('Mostrar todos', array('controller' => 'documentos', 'action' => 'index')); ?></td>
    <td width="5%" align="center" valign="middle">
		<?php echo $this->Form->end(__('Buscar', true)); ?>   </td>
  </tr>
</table>
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%"><?php echo $this->Html->image('add.png', array('height'=>'24', 'width'=>'24', 'url' => array('controller' => 'documentos', 'action' => 'add'))); ?></td>
    <td width="98%" valign="middle"><?php echo $this->Html->link('Cargar un nuevo documento', array('controller' => 'documentos', 'action' => 'add', $id_cat)); ?></td>
  </tr>
</table>
<table width="95%" border="0" cellspacing="3" cellpadding="3" bgcolor="#E1F1FD">
  <tr>
    <td>Ruta: <?php 
	echo $this->Html->link('Root', array('controller' => 'documentos', 'action' => 'index'));
	
	if(!empty($cpadres)){
		for($i=count($cpadres)-1; $i>=0; $i--){
			foreach($cpadres[$i] as $cpadre){
					if($cpadre['nombre']!='root'){
						echo " -> ";
						echo $this->Html->link($cpadre['nombre'], array('controller' => 'documentos', 'action' => 'index', $cpadre['id']));
				}
					
				}
		}}
?></td>
  </tr>
</table>
<?php 		if(!empty($mensaje)){
				echo "<br><h3>".$mensaje."</h3>";
			} 
			?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
		<th></th>
        <th width="447">Nombre</th>
        <th width="60">Versión</th>
        <th width="79">Tama&ntilde;o</th>
        <th colspan="3">Descripci&oacute;n</th>
  </tr>
	    <?php foreach ($carpetas as $carpeta): ?>
    <tr>
    	<td width="18" height="1" valign="middle" style="font-size: 11px"><?php echo $this->Html->image('folder.png', array('height'=>'24', 'width' => '24', 'url' => 
		array('controller' => 'documentos', 'action' => 'index', $carpeta['Categoria']['id']))); ?></td>
      <td valign="middle" style="font-size: 11px"><?php echo $this->Html->link($carpeta['Categoria']['nombre'], 
    			array('controller' => 'documentos', 'action' => 'index', $carpeta['Categoria']['id'])) ; ?></td>
      <td align="right" valign="middle" style="font-size: 11px"></td>		
      <td align="right" valign="middle" style="font-size: 11px"></td>
        <td colspan="3" valign="middle" style="font-size: 11px">
            <?php echo $carpeta['Categoria']['descripcion']; ?>
        </td>
    </tr>
    <?php endforeach; 
	   
  foreach($objetos as $objeto):
  	if(!empty($objeto['documentos']))
		{
			if(empty($documentos))
				$documentos = $objeto['documentos'];
		}
  endforeach;
  
  if(!empty($documentos)) {
	 foreach ($documentos as $documento){
    	$tamano = $documento['archivo']['size']/1024;
    ?>
    <tr>
    	<td width="18" height="1" valign="middle" style="font-size: 11px"><?php 
			$imagen_prop = array('height'=> '24', 'url' => array('controller' => 'documentos', 'action' => 'view', $documento['id']));
			if(strpos($documento['archivo']['type'],'word'))
				echo $this->Html->image('docs.png',$imagen_prop);
			if(strpos($documento['archivo']['type'],'sheet'))
				echo $this->Html->image('xls.png',$imagen_prop);
			if(strpos($documento['archivo']['type'],'presentation'))
				echo $this->Html->image('ppt.png',$imagen_prop);
			if(strpos($documento['archivo']['type'],'pdf'))
				echo $this->Html->image('pdf.png',$imagen_prop);
			if(strpos($documento['archivo']['type'],'mage'))
				{  echo $this->Html->image($documento['archivo']['url'],$imagen_prop);
				}
		?></td>
    	<td valign="middle" style="font-size: 11px">
		<?php echo $this->Html->link($documento['archivo']['name'], 
    	array('controller' => 'documentos', 'action' => 'view', $documento['id'])) ; ?>
      </td>
    	<td align="center" valign="middle" style="font-size: 11px"><center><?php if(!empty($documento['Version']))
				echo $documento['Version']; ?></center></td>		
        <td align="right" valign="middle" style="font-size: 11px">
		<?php echo number_format($tamano,2)." KB" ; ?>
	   </td>
        <td width="456" valign="middle" style="font-size: 11px">
        <?php if(!empty($documento['Titulo']))
				echo $documento['Titulo'];
			if(!empty($documento['Nombre']))
				echo $documento['Nombre']; ?>
        </td>
        <td width="17" valign="middle" style="font-size: 11px"><?php if($admin==1) { echo $this->Html->image('edit.png', array('height'=>'12', 'width'=>'12'
		, 'url' => array('controller' => 'documentos', 'action' => 'edit', $documento['id'])
		)); } ?></td>
        <td width="19" align="center" valign="middle" style="font-size: 10px"><?php if($admin==1) { echo $this->Html->link('x', array('controller' => 'documentos',
		'action' => 'delete', $documento['id']), array('escape' => false), "¿Desea continuar?" );  }?></td>
    </tr>
    <?php } ?>
</table>
<?php } ?>