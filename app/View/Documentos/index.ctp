<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <h1 class="uk-heading-medium">
        <!-- <?php echo $this->Html->image('docs.png', 
                    array(
                        'height'=>'32', 
                        'width'=>'32'
                        )
                ); 
        ?>-->
        <i class="uk-icon uk-icon-file-o"></i>
        Documentos
    </h1>
</div>
<div class="uk-width-medium-1-1" data-uk-grid-margin="">
    <div class="uk-grid uk-grid-small" data-uk-grid-margin="">
        <div class="uk-width-medium-1-2" data-uk-grid-margin="">
            <?php echo $this->Html->css('autocomplete'); ?>
            <div class="uk-panel uk-panel-box uk-panel-box-primary">
                <?php echo $this->Form->create('Documento',
                        array(
                            'action'=> 'index',
                            'class' => 'uk-panel uk-panel-box uk-form'
                        )
                    ); 
                ?>
                <?php echo $this->Form->input('nombreDocumentos',
                    array(
                        'type'          => 'text',
                        'id'            => 'nombreDocumentos',
                        'label'         => 'Buscar',
                        'div'           => 'uk-form-row',
                        'class'         => 'uk-width-1-1 uk-form-large',
                        'required'      => true,
                        'autofocus'     => true,
                        'placeholder'   => 'Buscar por Nombre de Documento'
                    )
                ); ?>
                <div class="uk-form-row">
                    <?php echo $this->Html->link('Mostrar todos',
                            array(
                                'controller' => 'documentos', 
                                'action'     => 'index'
                            ),
                            array('class' => 'uk-width-1-3 uk-button uk-button-danger')
                        );
                    ?>
                    <?php echo $this->Form->button('Buscar',
                        array(
                            'type'  => 'submit',
                            'class' => 'uk-width-1-3 uk-button uk-button-primary'
                            )
                        ); 
                    ?>
                </div>
                <?php echo $this->Form->end();  ?>
            </div>
            <div class="uk-panel uk-panel-box uk-panel-box-primary">
                <div class="uk-button-group">
                    <?php echo $this->Html->link('<i class="uk-icon uk-hover uk-icon-plus"></i> Cargar Documento',
                            array(
                                'controller' => 'documentos', 
                                'action'     => 'add',
                                $id_cat
                            ),
                            array(
                                'escape'    => false,
                                'class'     => 'uk-button uk-button-danger'
                            )
                        ); 
                    ?>
                    <?php echo $this->Html->link('Asociar nuevo documento', 
                            array(
                                'controller' => 'documentos', 
                                'action'     => 'add', 
                                $id_cat
                            ),
                            array('class' => 'uk-button uk-button-default')
                    ); ?>
                </div>
            </div>
            <div class="uk-panel uk-panel-box uk-panel-box-primary">
                Ruta: <?php echo $this->Html->link('Root', 
                        array(
                            'controller' => 'documentos', 
                            'action'     => 'index'
                        )
                    ); 
                ?>
            </div>
        </div>
        <div class="uk-width-medium-1-2" data-uk-grid-margin="">
            
        </div>
    </div>
</div>

<table width="95%" border="0" cellspacing="3" cellpadding="3" bgcolor="#E1F1FD">
    <tr>
        <td>
<?php	
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
  if(!empty($carpetas) || !empty($objetos)):
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
    if(!empty($objetos)):
      foreach($objetos as $objeto):
      	if(!empty($objeto['documentos']))
    		{
    			if(empty($documentos))
    				$documentos = $objeto['documentos'];
    		}
      endforeach;
    endif;
  
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
<td width="17" valign="middle" style="font-size: 11px"><?php echo $this->Html->image('edit.png', array('height'=>'12', 'width'=>'12'
		, 'url' => array('controller' => 'documentos', 'action' => 'edit', $documento['id'])
		));  ?></td>
<td width="19" align="center" valign="middle" style="font-size: 10px"><?php echo $this->Html->link('x', array('controller' => 'documentos',
		'action' => 'delete', $documento['id']), array('escape' => false), "¿Desea continuar?" );  ?></td>
</tr>
    <?php } ?>
</table>
<?php
   }
endif;