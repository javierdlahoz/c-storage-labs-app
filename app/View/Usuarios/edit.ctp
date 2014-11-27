<div class="users form">
<?php 
	$idprop = $cpadre;
	$temp = explode('-', $cpadre);
	$cpadre = $temp[0];
	
	$opciones = array(
		'text' => 'Texto',
		'textarea' => 'Área de texto',
		'date' => 'Fecha',
		'boolean' => 'Booleano');
	
	foreach($categorias as $categoria){
		$propiedades = $categoria['propiedades'];	
	}
		
	for($i=0; $i<=count($propiedades)-1; $i++){
		if($propiedades[$i]['id']==$idprop){
				$nombre = $propiedades[$i]['nombre'];
				$descripcion = $propiedades[$i]['descripcion'];
				$tipo = $propiedades[$i]['tipo'];
				$cont = $i;
			}	
	}	

	echo $this->Form->create('Propiedade'); ?>
    
    <fieldset>
      <legend>Editar Propiedad</legend>
        <legend>
        <?php 
        	 echo $this->Html->link('<< Regresar a la lista', array('controller' => 'propiedades', 'action' => 'index', $cpadre)); ?>
        <br><br></legend>
      <?php
		echo $this->Form->input('nombre', array('value' => $nombre));
        echo $this->Form->input('descripcion', array('type' => 'textarea', 'value' => $descripcion));
		echo $this->Form->input('tipo', array('type' => 'select', 'options' => $opciones, 'default' => $tipo));       
		echo $this->Form->input('cpadre', array('type' => 'hidden', 'value' => $cpadre));
		echo $this->Form->input('cont', array('type' => 'hidden', 'value' => $cont));
		?>
    	
       
    </fieldset>
<?php echo $this->Form->end(__('Editar'));  ?>
</div>
