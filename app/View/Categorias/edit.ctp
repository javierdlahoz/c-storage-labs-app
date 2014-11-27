<h2>Modificando Categor&iacute;as</h2>
<p><?php 
if($cpadre=='517eb611398dacb818000004'){
	echo $this->Html->link('<< Regresar', array('controller' => 'categorias', 'action' => 'index')); }
	else
	{
		echo $this->Html->link('<< Regresar', array('controller' => 'categorias', 'action' => 'view', $cpadre));
		} ?></p><br>
<?php
    echo $this->Form->create('Categoria', array($id_cat)); 
		foreach($categorias as $categoria){
				$nombre = $categoria['nombre'];
				$descripcion = $categoria['descripcion'];
			}
	
	?>
    <fieldset><?php
		echo $this->Form->input('nombre', array('value'=>$nombre));
        echo $this->Form->input('descripcion', array('type' => 'textarea', 'value' => $descripcion));       
		echo $this->Form->input('cpadre', array('type' => 'hidden', 'value' => $cpadre));
		?>
</fieldset>
   <?php echo $this->Form->end('Modificar');?>